<?php
App::uses('AppController', 'Controller');

/**
 * Site Controller
 *
 * @author    @author Takako Miyagawa <nekoget@gmail.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */
class ThemeSettingsSiteController extends AppController {

/**
 * helper
 * @var array
 */
	public $helpers = array('Form' , 'Html');

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
 * beforeFilter
 *
 * @return void
 * @author Takako Miyagawa <nekoget@gmail.com>
 **/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		$this->set("classUrl", "theme_site");
		$this->ThemeSettingsSite = Classregistry::init("ThemeSettings.ThemeSettingsSite");
		$this->ThemeSettingsSiteValue = Classregistry::init("ThemeSettings.ThemeSettingsSiteValue");
	}

/**
 * index
 * @return void
 * @author Takako Miyagawa <nekoget@gmail.com>
 **/
	public function index($listType = "") {
		if($listType == "small") {
			$this->view = "index_small";
		}
		$themeList = $this->getThemeList();
		$this->set("confirm", false); //確認モーダル表示 OFF
		$this->set('themeList', $themeList);
		$this->set('listType' , $listType);
		return $this->render();
	}

/**
 * テーマの設定確認画面
 * @param string $theme
 */
	public function confirm($theme = "default", $listType="") {
		//themeが使用可能かどうかチェック
		$themeList = $this->getThemeList();
		if (! isset($themeList[$theme]) || ! $themeList[$theme]) {
			//エラー 登録できないテーマ
			$this->set("errors", array("指定できないテーマが選択されています。"));
			$this->view = "index";
			$this->response->statusCode(404);
			return $this->index();
		}
		//getのとき
		if (! $this->request->isPost()) {
			return $this->__confirmForm($theme , $listType);
		}
		//Postのとき
		if ($this->request->isPost()) {
			$ck = $this->ThemeSettingsSite->updateTheme($this->request->data);
			if ($ck) {
				//完了画面表示 //成功した場合
				$this->theme = $this->ThemeSettingsSite->getThemeName();
				$this->set('themeList', $this->getThemeList()); //テーマ一覧を取得する
				$this->set("confirm", false); //確認モーダル表示 ON
				$this->view = "update_end"; //完了画面表示
				return $this->render();
			} else {
				//バリデーションエラー
				if (isset($this->ThemeSettingsSite->validationErrors) && $this->ThemeSettingsSite->validationErrors) {
					$errors = $this->ThemeSettingsSite->validationErrors;
					$this->set("errors", $errors["ThemeSettingsSiteValue"]["value"]);
					$this->view = "index";
					return $this->index();
				} else {
					//バリデーション以外のエラー
					$this->view = "index";
					return $this->index();
				}
				$this->set("errors", "");
				$this->set("confirm", false); //確認モーダル表示 ON
				$this->view = "index";
				$this->theme = $theme;
				$themeList = $this->getThemeList();
				$oldTheme = $this->ThemeSettingsSite->getTheme();
				$this->set("oldTheme", $oldTheme);
				$this->set('themeList', $themeList); //テーマ一覧を取得する
				$this->set("themeInfo", $themeList[$theme]);
				$this->set("targetTheme", $theme);
				return $this->render();
			}
		}
	}

/**
 * テーマ設定確認画面
 *
 * @param $theme
 * @return CakeResponse
 */
	private function __confirmForm($theme , $listType="") {
		$this->view = "index";
		if($listType == "small") {
			$this->view = "indexSmall";
		}
		$this->theme = $theme;
		$themeList = $this->getThemeList();
		$oldTheme = $this->ThemeSettingsSite->getTheme();
		$this->set("confirm", true); //モーダル表示ON
		$this->set("oldTheme", $oldTheme);
		$this->set('themeList', $themeList); //テーマ一覧を取得する
		$this->set("themeInfo", $themeList[$theme]);
		$this->set("targetTheme", $theme);
		$this->set("listType", $listType);
		return $this->render();
	}

/**
 * getThemeList
 * テーマの情報を取得し配列にして返す
 * @return array
 */
	public function getThemeList() {
		$themeList = array(); //テーマの情報を格納
		$dir = realpath(App::themePath('')) . '/';
		//フォルダの中を取得
		$dirList = scandir($dir, 1);
		//フォルダ名だけのリストをつくる
		foreach ($dirList as $d) {
			if (is_dir($dir . $d) && ($d != '.' && $d != '..')) {
				if (is_file($dir . $d . "/theme.json")) {
					$file = file_get_contents($dir . $d . '/theme.json');
					$package = json_decode($file, true);
					$package['snapshot'] = '';
					if (is_file(App::themePath($d) . '/snapshot.jpg')) {
						$package['snapshot'] = '/theme/' . $d . '/snapshot.jpg';
					} elseif (App::themePath($d) . '/snapshot.png') {
						$package['snapshot'] = '/theme/' . $d . '/snapshot.png';
					}
					$themeList[$d] = $package;
				}
			}
		}
		ksort($themeList);
		//var_dump($themeList);
		return $themeList;
	}
}
