<?php
/**
 * SiteSetting Test Case
 *
 * @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('SiteThemeValue', 'Theme.Model');
App::uses('SiteTheme', 'Theme.Model');

/**
 * Summary for SiteSetting Test Case
 */
class SiteThemeValueTest extends CakeTestCase {

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

	public $SiteTheme;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SiteTheme = ClassRegistry::init('Theme.SiteTheme');
		$this->SiteThemeValue = ClassRegistry::init('Theme.SiteThemeValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SiteTheme);
		unset($this->SiteThemeValue);
		parent::tearDown();
	}

	public function testSave() {
		$this->assertFalse($this->SiteThemeValue->save(array()));
	}
}
