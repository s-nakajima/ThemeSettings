<?php
/**
 * Rooms Helper
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppHelper', 'View/Helper');

/**
 * ルーム表示ヘルパー
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\UserAttribute\View\Helper
 */
class ThemeSettingsHelper extends AppHelper {

/**
 * 使用するヘルパー
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.NetCommonsForm',
		'NetCommons.NetCommonsHtml',
	);

/**
 * After render file callback.
 * Called after any view fragment is rendered.
 *
 * Overridden in subclasses.
 *
 * @param string $viewFile The file just be rendered.
 * @param string $content The content that was rendered.
 * @return void
 */
//	public function afterRenderFile($viewFile, $content) {
//		$content = $this->NetCommonsHtml->css('/rooms/css/style.css') . $content;
//		parent::afterRenderFile($viewFile, $content);
//	}

/**
 * ルームナビの出力
 *
 * @param array $urlOptions URLオプション
 * @return string HTML
 */
	public function render($callback) {
		return $this->_View->element('ThemeSettings.render_index', array('callback' => $callback));
	}

}
