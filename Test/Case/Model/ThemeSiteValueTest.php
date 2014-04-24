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

	public $ThemeSite;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ThemeSite = ClassRegistry::init('Theme.ThemeSite');
		$this->ThemeSiteValue = ClassRegistry::init('Theme.ThemeSiteValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ThemeSite);
		unset($this->ThemeSiteValue);
		parent::tearDown();
	}

	public function testSave() {
		$this->assertFalse($this->ThemeSiteValue->save(array()));
	}
}
