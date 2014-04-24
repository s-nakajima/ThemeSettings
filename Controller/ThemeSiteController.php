<?php
App::uses('AppController', 'Controller');

/**
 * Site Controller
 *
 * @author    @author Takako Miyagawa <nekoget@gmail.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */
class ThemeSiteController extends AppController {

/**
 * helper
 * @var array
 */
	public $helpers = array('Form');

/**
 * SiteTheme model class格納用
 * @var null
 */
	public $SiteTheme = null;

/**
 * ThemeSiteValue model class格納用
 * @var null
 */
	public $ThemeSiteValue = null;

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
		$this->ThemeSite = Classregistry::init("Theme.ThemeSite");
		$this->ThemeSiteValue = Classregistry::init("Theme.ThemeSiteValue");
	}

/**
 * index
 * @return void
 * @author Takako Miyagawa <nekoget@gmail.com>
 **/
	public function index($type = "") {
		$themeList = $this->getThemeList();
		$this->set("confirm", false); //確認モーダル表示 OFF
		$this->set('themeList', $themeList);
		return $this->render();
	}

/**
 * テーマの設定確認画面
 * @param string $theme
 */
	public function confirm($theme = "default") {
		//themeが使用可能かどうかチェック
		$themeList = $this->getThemeList();
		if (! isset($themeList[$theme]) || ! $themeList[$theme]) {
			//エラー 登録できないテーマ
			$this->set("errors", array("指定できないテーマが選択されています。"));
			$this->view = "index";
			return $this->index();
		}
		//getのとき
		if (! $this->request->isPost()) {
			return $this->__confirmForm($theme);
		}
		//Postのとき
		if ($this->request->isPost()) {
			$ck = $this->ThemeSite->updateTheme($this->request->data);
			if ($ck) {
				//完了画面表示 //成功した場合
				$this->theme = $this->ThemeSite->getThemeName();
				$this->set('themeList', $this->getThemeList()); //テーマ一覧を取得する
				$this->set("confirm", false); //確認モーダル表示 ON
				$this->view = "update_end"; //完了画面表示
				return $this->render();
			} else {
				//バリデーションエラー
				if (isset($this->ThemeSite->validationErrors) && $this->ThemeSite->validationErrors) {
					$errors = $this->ThemeSite->validationErrors;
					$this->set("errors", $errors["ThemeSiteValue"]["value"]);
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
				$oldTheme = $this->ThemeSite->getTheme();
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
	private function __confirmForm($theme) {
		$this->view = "index";
		$this->theme = $theme;
		$themeList = $this->getThemeList();
		$oldTheme = $this->ThemeSite->getTheme();
		$this->set("confirm", true); //モーダル表示ON
		$this->set("oldTheme", $oldTheme);
		$this->set('themeList', $themeList); //テーマ一覧を取得する
		$this->set("themeInfo", $themeList[$theme]);
		$this->set("targetTheme", $theme);
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
						$package['snapshot'] = '/' . $d . '/snapshot.jpg';
					} elseif (App::themePath($d) . '/snapshot.png') {
						$package['snapshot'] = '/' . $d . '/snapshot.png';
					}
					$themeList[$d] = $package;
				}
			}
		}
		ksort($themeList);
		return $themeList;
	}

/**
 * update
 * @param string $theme
 * @return void
 * @author Takako Miyagawa <nekoget@gmail.com>
 */
	public function setting($theme = "Defalut") {
		$ThemeSite = Classregistry::init("Theme.ThemeSite");
		$ThemeSite->updateTheme($theme);//更新
		$this->theme = $ThemeSite->getThemeName();
		$this->set('themeList', $this->getThemeList()); //テーマ一覧を取得する
		$this->set("confirm", false); //確認モーダル表示 ON
	}
}
