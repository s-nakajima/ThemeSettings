<?php
/**
 * SiteSetting Test Case
 *
 * @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('ThemeSettingsSiteValue', 'ThemeSettings.Model');
App::uses('ThemeSettingsSite', 'ThemeSettings.Model');

/**
 * Summary for SiteSetting Test Case
 */
class ThemeSettingsSiteValueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'site_setting',
		//'app.created_user',
		//'app.modified_user',
		'site_setting_value'
	);

	public $ThemeSettingsSite;

	public $ThemeSettingsSiteValue;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ThemeSettingsSite = ClassRegistry::init('ThemeSettings.ThemeSettingsSite');
		$this->ThemeSettingsSiteValue = ClassRegistry::init('ThemeSettings.ThemeSettingsSiteValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ThemeSettingsSite);
		unset($this->ThemeSettingsSiteValue);
		parent::tearDown();
	}

	public function testSave() {
		$this->assertFalse($this->ThemeSettingsSiteValue->save(array()));
	}
}
