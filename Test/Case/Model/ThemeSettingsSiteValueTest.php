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
	);

	public $ThemeSettingsSite;

	public $siteValue;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ThemeSettingsSite = ClassRegistry::init('ThemeSettings.ThemeSettingsSite');
		$this->siteValue = ClassRegistry::init('ThemeSettings.ThemeSettingsSiteValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ThemeSettingsSite);
		unset($this->siteValue);
		parent::tearDown();
	}

/**
 * testSave
 *
 * @return void
 */
	public function testSave() {
		$this->assertFalse($this->siteValue->save(array()));
	}
}
