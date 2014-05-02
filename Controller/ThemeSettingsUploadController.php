<?php
App::uses('AppController', 'Controller');

/**
 * ThemeSettingsUpload Controller
 *
 * @author    @author Takako Miyagawa <nekoget@gmail.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */
class ThemeSettingsUploadController extends ThemeSettingsAppController {

/**
 * beforeFilter
 *
 * @return void
 * @author Takako Miyagawa <nekoget@gmail.com>
 **/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(); //あとで適切なものに修正
		$this->set("classUrl", "upload");
		$this->ThemeSettingsSite = Classregistry::init("ThemeSettings.ThemeSettingsSite");
		$this->ThemeSettingsSiteValue = Classregistry::init("ThemeSettings.ThemeSettingsSiteValue");
	}

	public function index() {
	}
}