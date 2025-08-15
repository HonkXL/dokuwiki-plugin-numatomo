<?php
/**
 * Configuration settings for the Matomo Plugin
 *
 * @author     Sascha Leib <sascha@leib.be>
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