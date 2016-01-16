<?php
/**
 * ThemeSettings Component
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('Component', 'Controller');

/**
 * ThemeSettings Component
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\ThemeSettings\Controller\Component
 */
class ThemeSettingsComponent extends Component {

/**
 * Called before the Controller::beforeFilter().
 *
 * @param Controller $controller Controller with components to initialize
 * @return void
 * @link http://book.cakephp.org/2.0/en/controllers/components.html#Component::initialize
 */
	public function initialize(Controller $controller) {
		$controller->helpers[] = 'ThemeSettings.ThemeSettings';

		$this->controller = $controller;
	}

/**
 * テーマリストの取得
 *
 * @return array
 */
	public function setThemes() {
		$controller = $this->controller;

		$themes = array();
		$themePath = realpath(App::themePath('')) . DS;

		$dirs = scandir($themePath, 1);

		foreach ($dirs as $path) {
			if (! is_dir($themePath . $path) ||
				! is_file($themePath . $path . DS . 'theme.json') ||
				$path === '.' || $path === '..') {

				continue;
			}

			$package = json_decode(file_get_contents($themePath . $path . DS . 'theme.json'), true);
			if (is_file(App::themePath($path) . 'webroot/snapshot.jpg')) {
				$package['snapshot'] = FULL_BASE_URL . '/theme/' . $path . '/snapshot.jpg';
			} elseif (is_file(App::themePath($path) . 'webroot/snapshot.png')) {
				$package['snapshot'] = FULL_BASE_URL . '/theme/' . $path . '/snapshot.png';
			} else {
				$package['snapshot'] = FULL_BASE_URL . '/theme_setting/img/snapshot_noimage.png';
			}
			$package['key'] = $path;

			$themes[] = $package;
		}

		$controller->set('themes', Hash::sort($themes, '{n}.key', 'asc'));
	}

}
