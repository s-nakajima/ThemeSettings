<?php

Router::connect('/theme_settings/site/:action/*', array(
	'plugin' => 'ThemeSettings',
	'controller' => 'ThemeSettingsSite'
));

Router::connect('/theme_settings/site/', array(
	'plugin' => 'ThemeSettings',
	'controller' => 'ThemeSettingsSite',
	'action' => 'index'
));
