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

/**
 * index
 *
 * @return void
 */
	public function index() {
	}

/**
 * index
 *
 * @return void
 */
	public function upload() {
		$themeDir = ROOT . DS . 'app' . DS . 'View' . DS . 'Themed';

		$tmp = $this->request->data['upload_file']['tmp_name'];
		if(is_uploaded_file($tmp)) {
			$file_name = basename($this->request->data['upload_file']['name']);
			$file = $themeDir . DS . $file_name;

			if (move_uploaded_file($tmp, $file)) {
				$messages = array();
				$ret = array();
				$cmd = 'cd ' . $themeDir . ' && tar xzvf ' . $file_name;
				exec($cmd, $messages, $ret);

				@unlink($file);
				$this->Session->setFlash(__('The upload theme has been saved.'), 'default', array(), 'good');
				$this->redirect('/theme_settings/site/index/');
			}
		}
	}

}