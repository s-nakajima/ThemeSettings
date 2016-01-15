<?php
/**
 * ThemeSettingsヘルパー
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppHelper', 'View/Helper');

/**
 * ThemeSettingsヘルパー
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\ThemeSettings\View\Helper
 */
class ThemeSettingsHelper extends AppHelper {

/**
 * テーマ設定のレンダー
 *
 * @param string $callback callbackのパス
 * @return string HTML
 */
	public function render($callback) {
		return $this->_View->element('ThemeSettings.render_index', array('callback' => $callback));
	}

}
