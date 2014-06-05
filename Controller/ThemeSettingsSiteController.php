<?php
App::uses('AppController', 'Controller');

/**
 * Site Controller
 *
 * @author   Takako Miyagawa <nekoget@gmail.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */
class ThemeSettingsSiteController extends ThemeSettingsAppController {

/**
 * SiteTheme model class格納用
 * @var null
 */
	public $SiteTheme = null;

/**
 * ThemeSettingsSiteValue model class格納用
 * @var null
 */
	public $ThemeSettingsSiteValue = null;

/**
 * ThemeListを格納するもの
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
		$this->set("classUrl", "site");//このclassへ遷移させるURL
		$this->ThemeSettingsSite = Classregistry::init("ThemeSettings.ThemeSettingsSite");
		$this->ThemeSettingsSiteValue = Classregistry::init("ThemeSettings.ThemeSettingsSiteValue");
		$this->Security->requireAuth(array("confirm"));
		$this->ThemeList = $this->__getThemeList();
	}

/**
 * index
 *
 * @param string $listType
 * @return void
 * @author Takako Miyagawa <nekoget@gmail.com>
 **/
	public function index($listType = "") {
		if ($listType == "small") {
			$this->view = "index_small";
		}
		$this->set("confirm", false); //確認モーダル表示 OFF
		$this->set('listType', $listType);
		$this->set('themeListJson', $this->__createJson());
		return $this->render();
	}

/**
 * テーマの設定確認画面
 *
 * @param string $theme
 * @param string $listType
 */
	public function confirm($theme = "Default", $listType = "") {
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
 * postとgetで指定されたテーマが同じかどうかのチェック
 *
 * @param $theme
 * @param $listType
 * @return bool
 */
	private function __checkThemeValue($theme) {
		if (! isset($this->request->data['ThemeSettingsSiteValue'])
			|| ! isset($this->request->data['ThemeSettingsSiteValue']['value'])
			|| $this->request->data['ThemeSettingsSiteValue']['value'] != $theme
		) {
			return false;
		}
		return true;
	}

/**
 * update時 バリデーションエラーが発生した時の画面表示
 * MEMO:テキスト等入力させる機能ではないため、エラー内容は統一させた
 * @param string $listType
 */
	private function __updateValidationError($listType) {
		//$errors = $this->ThemeSettingsSite->validationErrors;
		$this->set("errors", '指定されたテーマは、設定できません。');
		$this->view = "index";
		return $this->index($listType);
	}

/**
 * 更新処理成功-完了画面
 *
 * @param string $theme
 * @param string $listType
 * @return CakeResponse
 */
	private function __updateSuccess($theme, $listType) {
		//完了画面表示 //成功した場合
		$this->theme = $theme;
		$this->set('themeList', $this->ThemeList); //テーマ一覧を取得する
		$this->set("confirm", false); //確認モーダル表示 ON
		$this->set("listType", $listType); //表示形式
		$this->view = "update_end"; //完了画面表示
		return $this->render();
	}

/**
 * 存在しないテーマ名が指定された場合の画面表示
 *
 * @param string $listType
 * @return CakeResponse
 */
	private function __noticeThemeError($listType) {
		$this->set("errors", array(__("指定されたテーマは、存在しないか削除されています。")));
		$this->view = "index";
		$this->response->statusCode(404);
		return $this->index($listType);
	}

/**
 * テーマ設定確認画面 get
 * @param $theme
 * @return CakeResponse
 */
	private function __confirmForm($theme = "", $listType = "") {
		$this->view = "index";
		if ($listType == "small") {
			$this->view = "indexSmall";
		}
		$this->theme = $theme;
		$themeList = $this->ThemeList;
		$this->set("confirm", true); //モーダル表示ON
		$this->set("targetTheme", $theme);
		$this->set("oldTheme", $this->ThemeSettingsSite->getTheme()); //旧テーマ
		$this->set("themeInfo", $themeList[$theme]);
		$this->set("targetTheme", $theme);
		$this->set("listType", $listType);
		$this->set('themeListJson', $this->__createJson($themeList));
		return $this->render();
	}

/**
 * getThemeList
 * テーマの情報を取得し配列にして返す
 * @return array
 */
	private function __getThemeList() {
		return $this->ThemeSettingsThemeList->getList($this);
	}

/**
 * テーマリストのjsonを取得する
 * @return mixed
 */
	private function __createJson() {
		return $this->ThemeSettingsThemeList->getJson($this);
	}
}
