<?php
/**
 * Class ThemeSettingsThemeListComponen
 *
 * @property AssetComponent $Asset
 *
 * @author   Takako Miyagawa <nekoget@gmail.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */
class ThemeSettingsThemeListComponent extends Component {

/**
 * テーマリスト
 * @var array
 */
	public $ThemeList = array();

/**
 * テーマ一覧をarrayで返す
 * @param Controller $controller
 * @return array
 */
	public function getList(Controller $controller) {
		$themeList = array(); //テーマの情報を格納
		$dir = realpath(App::themePath('')) . '/';
		//フォルダの中を取得
		$dirList = scandir($dir, 1);
		//フォルダ名だけのリストをつくる
		$package['snapshot'] = '';
		foreach ($dirList as $d) {
			if (is_dir($dir . $d) && ($d != '.' && $d != '..')) {
				if (is_file($dir . $d . "/theme.json")) {
					$file = file_get_contents($dir . $d . '/theme.json');
					$package = json_decode($file, true);
					if (is_file(App::themePath($d) . 'webroot/snapshot.jpg')) {
						$package['snapshot'] = '/theme/' . $d . '/snapshot.jpg';
					} elseif (is_file(App::themePath($d) . 'webroot/snapshot.png')) {
						$package['snapshot'] = '/theme/' . $d . '/snapshot.png';
					}
					$package['key'] = $d;
					$themeList[$d] = $package;
					$package['snapshot'] = '';
				}
			}
		}
		ksort($themeList);
		$this->ThemeList = $themeList;
		return $this->ThemeList;
	}

/**
 * テーマリストのjsonを返す
 * @return string
 */
	public function getJson(Controller $controller) {
		$array = $this->ThemeList;
		if (! $array) {
			$this->getList($controller);
		}
		$array = array_values($array);
		return json_encode($this->__h($controller, $array));
	}
/**
 * jsonで吐き出す前に配列の中身をh()する
 * @param $array
 * @return mixed
 */
	private function __h(Controller $controller, $array) {
		foreach ($array as $key => $item) {
			if (! is_array($item)) {
				$array[$key] = htmlspecialchars($item); //htmlspecialchars
			} else {
				$array[$key] = $this->__h($controller, $item);
			}
		}
		return $array;
	}

}