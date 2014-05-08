<?php
App::uses('Controller', 'Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('ThemeSettingsThemeListComponent', 'ThemeSettings.Controller/Component');
App::uses('SiteSetting', 'Model');

/**
 * Class ThemeSettingsThemeListComponentTestController
 * CompornentをテストするためのController Class
 */
class ThemeSettingsThemeListComponentTestController extends Controller {
}


/**
 * テスト本体
 */
class ThemeSettingsThemeListComponentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		//'app.site_setting',
		//'app.created_user',
		//'app.modified_user',
		//'app.site_setting_value'
	);

/**
 * getList
 * @return void
 */
	public function testGetList() {
		$App = new ThemeSettingsThemeListComponentTestController;
		$Collection = new ComponentCollection();
		$Component = new ThemeSettingsThemeListComponent($Collection);
		$ck = $Component->getList($App);
		$this->assertTrue(is_array($ck));
		$this->assertTrue(isset($ck['Default']));
	}

/**
 * getList
 * @return void
 */
	public function testGetJson() {
		$App = new ThemeSettingsThemeListComponentTestController;
		$Collection = new ComponentCollection();
		$Component = new ThemeSettingsThemeListComponent($Collection);
		$json = $Component->getJson($App);
		$ck = json_decode($json, true);
		$this->assertTrue((count($ck) > 1));
	}
}
