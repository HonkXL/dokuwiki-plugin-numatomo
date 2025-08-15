<?php

use dokuwiki\Extension\EventHandler;
use dokuwiki\Extension\Event;

/**
 * Action Component for the Nu Matomo Plugin
 *
 * @license	GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author	 Sascha Leib <sascha.leib(at)kolmio.com>
 */

class action_plugin_numatomo extends DokuWiki_Action_Plugin {

	/**
     * Registers a callback functions
     *
     * @param EventHandler $controller DokuWiki's event controller object
     * @return void
     */
    public function register(EventHandler $controller)
    {
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'handleHeader');
    }

    /**
     * Adds the preview parameter to the stylesheet loading in non-js mode
     *
     * @param Event $event event object by reference
     * @return void
     */
	public function handleHeader(Event $event, $param) {

		global $INFO;
		$loggedin = isset($INFO['userinfo']);
		$exgrp = $this->getConf('exclude');
		$exclUser = false;
		if ($exgrp === 'admins' && ($loggedin && ($INFO['isadmin'] === 1))) {
			$exclUser = true;
		} elseif ($exgrp === 'users' && $loggedin) {
			$exclUser = true;
		}

		$code = NL . DOKU_TAB . DOKU_TAB . "var _paq = window._paq = window._paq || [];" . NL;

		foreach (explode(',', $this->getConf('feature-flags')) as $flag) {
			$code .= DOKU_TAB . DOKU_TAB . "_paq.push(['$flag']);" . NL;
		}
		if ($exclUser) {
			$code .= DOKU_TAB . DOKU_TAB . "_paq.push(['optUserOut']);" . NL;
		}
		$code .= DOKU_TAB . DOKU_TAB . "_paq.push(['setLinkClasses', ['interwiki','urlextern']]);" . NL;
		$code .= DOKU_TAB . DOKU_TAB . "_paq.push(['setExcludedQueryParams', ['do']]);" . NL;
		$code .= DOKU_TAB . DOKU_TAB . "_paq.push(['setDoNotTrack', 'true']);" . NL;
		$code .= DOKU_TAB . DOKU_TAB . "_paq.push(['trackPageView']);" . NL;
		$code .= DOKU_TAB . DOKU_TAB . "(function() {" . NL;
		$code .= DOKU_TAB . DOKU_TAB . DOKU_TAB . "var u='{$this->getConf('server')}';" . NL;
		$code .= DOKU_TAB . DOKU_TAB . DOKU_TAB . "_paq.push(['setTrackerUrl', u+'{$this->getConf('instance')}.php']);" . NL;
		$code .= DOKU_TAB . DOKU_TAB . DOKU_TAB . "_paq.push(['setSiteId', '{$this->getConf('siteid')}}']);" . NL;
		$code .= DOKU_TAB . DOKU_TAB . DOKU_TAB . "var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];" . NL;
		$code .= DOKU_TAB . DOKU_TAB . DOKU_TAB . "g.async=true; g.src=u+'{$this->getConf('instance')}.js'; s.parentNode.insertBefore(g,s);" . NL;
		$code .= DOKU_TAB . DOKU_TAB . "})();" . NL. DOKU_TAB;

		// $code .= '<!-- ' . print_r($INFO, true) . ' -->' . NL;

        $event->data['script'][] = [
			'_data'   => $code
        ];
    }
}