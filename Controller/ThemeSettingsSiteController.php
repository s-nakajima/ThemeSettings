<?php
/**
 * ThemeSettingsSite Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Takako Miyagawa <nekoget@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('AppController', 'Controller');

/**
 * ThemeSettingsSite Controller
 *
 * @author Takako Miyagawa <nekoget@gmail.com>
 * @package NetCommons\ThemeSettings\Controller
 */
class ThemeSettingsSiteController extends ThemeSettingsAppController {

/**
 * SiteTheme model class
 *
 * @var null
 */
	public $SiteTheme = null;

/**
 * ThemeSettingsSiteValue model class
 *
 * @var null
 */
	public $siteValue = null;

/**
 * ThemeList
 *
 * @var array
 */
	public $ThemeList = array();

/**
 * beforeFilter
 *
 * @return void
 * @author Takako Miyagawa <nekoget@gmail.com>
 **/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(); //権限 : あとで適切なものに修正 : システム管理社
		$this->set('classUrl', 'site');//このclassへ遷移させるURL
		$this->ThemeSettingsSite = Classregistry::init('ThemeSettings.ThemeSettingsSite');
		$this->Security->requireAuth(array('confirm'));
		$this->ThemeList = $this->__getThemeList();
	}

/**
 * index
 *
 * @param string $listType Type of display
 * @return void
 **/
	public function index($listType = '') {
		if ($listType == 'small') {
			$this->view = 'index_small';
		}
		$this->set('confirm', false); //確認モーダル表示 OFF
		$this->set('listType', $listType);
		$this->set('themeListJson', $this->__createJson());
		return $this->render();
	}

/**
 * confirm
 *
 * @param string $theme テーマ名
 * @param string $listType Type of display
 * @return void
 */
	public function confirm($theme = 'Default', $listType = '') {
		//themeが使用可能かどうかチェック
		$themeList = $this->ThemeList;
		if (! isset($themeList[$theme]) || ! $themeList[$theme]) {
			//エラー 登録できないテーマ
			return $this->__noticeThemeError($listType);
		}
		//getのとき
		if (! $this->request->isPost()) {
			//確認画面表示
			return $this->__confirmForm($theme, $listType);
		} else {
			//postとgetでのテーマの指定が違う
			if (! $this->__checkThemeValue($theme)) {
				return $this->__updateValidationError($listType);
			}
			//登録更新
			$ck = $this->ThemeSettingsSite->updateTheme($this->request->data);
			if ($ck) {
				//処理成功　完了画面表示
				return $this->__updateSuccess($theme, $listType);
			}
			//エラー validation errorと兼用
			return $this->__updateValidationError($listType);
		}
	}

/**
 * checkThemeValue
 *
 * @param string $theme テーマ
 * @return bool True if the same
 */
	private function __checkThemeValue($theme) {
		if (! isset($this->request->data['ThemeSettingsSite'])
			|| ! isset($this->request->data['ThemeSettingsSite']['value'])
			|| $this->request->data['ThemeSettingsSite']['value'] != $theme
		) {
			return false;
		}
		return true;
	}

/**
 * updateValidationError
 *
 * @param string $listType Type of display
 * @return CakeResponse
 */
	private function __updateValidationError($listType) {
		//$errors = $this->ThemeSettingsSite->validationErrors;
		$this->set('errors', '指定されたテーマは、設定できません。');
		$this->view = 'index';
		return $this->index($listType);
	}

/**
 * updateSuccess
 *
 * @param string $theme テーマ
 * @param string $listType Type of display
 * @return CakeResponse
 */
	private function __updateSuccess($theme, $listType) {
		//完了画面表示 //成功した場合
		$this->theme = $theme;
		$this->set('themeList', $this->ThemeList); //テーマ一覧を取得する
		$this->set('confirm', false); //確認モーダル表示 ON
		$this->set('listType', $listType); //表示形式
		$this->view = 'update_end'; //完了画面表示
		return $this->render();
	}

/**
 * noticeThemeError
 *
 * @param string $listType 表示方法
 * @return CakeResponse
 */
	private function __noticeThemeError($listType) {
		$this->set('errors', array(
			__('指定されたテーマは、存在しないか削除されています。'))
		);
		$this->view = 'index';
		$this->response->statusCode(404);
		return $this->index($listType);
	}

/**
 * confirmForm
 *
 * @param string $theme theme
 * @param string $listType Type of display
 * @return CakeResponse
 */
	private function __confirmForm($theme = '', $listType = '') {
		$this->view = 'index';
		if ($listType == 'small') {
			$this->view = 'indexSmall';
		}
		$this->theme = $theme;
		$themeList = $this->ThemeList;
		$this->set('confirm', true); //モーダル表示ON
		$this->set('targetTheme', $theme);
		$this->set('oldTheme', $this->ThemeSettingsSite->getTheme()); //旧テーマ
		$this->set('themeInfo', $themeList[$theme]);
		$this->set('targetTheme', $theme);
		$this->set('listType', $listType);
		$this->set('themeListJson', $this->__createJson($themeList));
		return $this->render();
	}

/**
 * getThemeList
 *
 * @return array
 */
	private function __getThemeList() {
		return $this->ThemeSettingsThemeList->getList($this);
	}

/**
 * createJson
 *
 * @return mixed
 */
	private function __createJson() {
		return $this->ThemeSettingsThemeList->getJson($this);
	}
}
