<?php
/**
 * ThemeSettingsUpload Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Takako Miyagawa <nekoget@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('AppController', 'Controller');

/**
 * ThemeSettingsUpload Controller
 *
 * @author Takako Miyagawa <nekoget@gmail.com>
 * @package NetCommons\ThemeSettings\Controller
 */
class ThemeSettingsUploadController extends ThemeSettingsAppController {

/**
 * uses
 *
 * @var array
 */
	public $uses = array(
		'Pages.Page',
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(); //あとで適切なものに修正
		$this->set('classUrl', 'upload');
		$this->ThemeSettingsSite = Classregistry::init('ThemeSettings.ThemeSettingsSite');
		$this->ThemeSettingsSiteValue = Classregistry::init('ThemeSettings.ThemeSettingsSiteValue');
	}

/**
 * index
 *
 * @return void
 */
	public function index() {
	}
}
