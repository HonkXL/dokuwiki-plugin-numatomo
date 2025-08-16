<?php
/**
 * Configuration settings for the Nu Matomo Plugin
 *
 * @author     Sascha Leib <ad@hominem.info>
 */

 /* Server address (e.g. "/analytics/", or "https://analytics.example.com/") */
$meta['server']      = array('string');

 /* Site ID (e.g. "1") */
$meta['siteid']	= array('numeric', '_min'=> 1);

/* Instance name (e.g. "matomo") */
$meta['instance']	= array('string');

/* Special treatments */
$meta['exclude']  = array('multichoice', '_choices' => array(
	'none', 'users', 'admins'
));

/* Features group */
$meta['_features'] = array('fieldset');
 
/* Feature flags */ 
$meta['feature-flags']  = array('multicheckbox', '_choices' => array(
	'enableLinkTracking', 'trackAllContentImpressions',
	'requireConsent', 'rememberConsentGiven',
	'requireCookieConsent','rememberCookieConsentGiven',
	'enableHeartBeatTimer'
), '_other' => 'never');

/* Honour the DoNotTrack header */
$meta['donottrack'] = array('onoff');