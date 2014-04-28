<?php

Router::connect('/theme_settings/site/:action', array(
	'plugin' => 'ThemeSettings',
	'controller' => 'ThemeSettingsSite'
));
