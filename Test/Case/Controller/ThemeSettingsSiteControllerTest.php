<?php
/**
 * AnnouncementEditsController Test Case
 *
 * @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppController', 'Controller');

/**
 * Summary for AnnouncementEditsController Test Case
 */
class ThemeSiteControllerTest extends ControllerTestCase {

/**
 * setUp
 * @return   void
 */
	public function setUp() {
		parent::setUp();
	}

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'Session',
		'SiteSetting',
		'SiteSettingValue',
		'Page'
	);

	public function testIndex() {
		$this->testAction('/theme_settings/theme_settings_site  /index', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

	public function testConfirmFromGet() {
		//存在してるテーマを指定
		$this->testAction('/theme_settings/theme_settings_site/confirm/Default', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
		//存在しないテーマを指定
		$this->testAction('/theme_settings/theme_settings_site/confirm/UnitTest2', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
		//postのとき
		$this->testAction('/theme_settings/theme_settings_site/confirm/UnitTest2', array('method' => 'post'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

}
