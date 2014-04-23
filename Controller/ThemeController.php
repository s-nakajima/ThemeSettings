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
		//サイト設定へリダイレクト
		redirect("/theme/site");
	}
}
