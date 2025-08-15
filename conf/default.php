<?php
/**
 * Configuration settings for the Nu Matomo Plugin
 *
 * @author     Sascha Leib <ad@hominem.info>
 */

/* Server address (e.g. "/analytics", or "https://analytics.example.com/") */
$conf['server']		= 'https://analytics.example.com/';

/* Site ID */
$conf['siteid']		= '1';

/* Instance name */
$conf['instance']	= 'matomo';

/* User flags */
$conf['exclude'] = 'admins';

/* Feature flags */
$conf['feature-flags'] = 'requireConsent,requireCookieConsent,enableLinkTracking';