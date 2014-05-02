<?php

App::uses('AppController', 'Controller');

class ThemeSettingsAppController extends AppController {

/**
 * helper
 * @var array
 */
	public $helpers = array('Cache', 'Form', 'Html');

/**
 * component
 * @var array
 */
	public $components = array('Security', 'ThemeSettings.ThemeSettingsThemeList');
}
