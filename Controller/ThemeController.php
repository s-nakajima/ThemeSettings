<?php
App::uses('AppController', 'Controller');
/**
 * Theme Controller
 *
 * @author    @author Takako Miyagawa <nekoget@gmail.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */
class ThemeController extends AppController {

/**
 * beforeFilter
 *
 * @return void
 * @author Takako Miyagawa <nekoget@gmail.com>
 **/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

/**
 * index
 * @return void
 * @author Takako Miyagawa <nekoget@gmail.com>
 **/
	public function index() {

		$themeList = $this->getThemeList();
		$this->set("confirm" , false); //確認モーダル表示 OFF
		$this->set('themeList', $themeList);
	}

	//テーマの設定確認画面
	function confirm($theme="default") {
		$this->theme = $theme;
		$themeList = $this->getThemeList();
		$this->set('themeList', $themeList); //テーマ一覧を取得する
		$this->set("confirm" , true); //確認モーダル表示 ON
		$this->set("themeInfo" , $themeList[$theme]);
		$this->view = "index";
	}



	function getThemeList()
	{
		$themeList = array(); //テーマの情報を格納
		$dir = realpath(App::themePath('')). '/';
		//フォルダの中を取得
		$dirList = scandir($dir, 1);
		//フォルダ名だけのリストをつくる
		foreach($dirList as $d) {
			if(is_dir($dir. $d) && ($d != '.' && $d != '..')) {
				if(is_file($dir. $d. "/package.json")) {
					$file = file_get_contents($dir. $d. '/package.json');
					$package = json_decode($file , true);
					$package['snapshot'] = '';
					if(is_file(App::themePath($d). '/snapshot.jpg')) {
						$package['snapshot'] =  '/'. $d. '/snapshot.jpg';
					} elseif(App::themePath($d). '/snapshot.png') {
						$package['snapshot'] =  '/'. $d. '/snapshot.png';
					}
					$themeList[$d] = $package;
				}
			}
		}
		ksort($themeList);
		return $themeList;
	}

	function update($theme="defalut") {
		$this->set('themeList', $this->getThemeList()); //テーマ一覧を取得する
		$this->set("confirm" , false); //確認モーダル表示 ON
	}
}
