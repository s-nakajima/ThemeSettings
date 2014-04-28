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
class ThemeSettingsSiteTest extends CakeTestCase {

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
/**
 * getThemeSite サイト用テーマ名の取得
 * @return void
 */
	public function testGetThemeName() {
		//データがある場合
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertTextEquals("UnitTestTheme", $ck);
		//データが無い場合を作る
		$ck = $this->ThemeSettingsSite->delete(2);
		$this->assertTrue($ck);
		//問い合わせた結果データは無いのでnullが戻る
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertEquals(null, $ck);
	}

/**
 * testGetTheme()
 * @return void
 */
	public function testGetTheme() {
		//データがある場合
		$ck = $this->ThemeSettingsSite->getTheme();
		//var_dump($ck);
		$this->assertTextEquals("UnitTestTheme", $ck['ThemeSettingsSiteValue']['value']);
		//データを削除
		$ck = $this->ThemeSettingsSite->delete(2);
		$this->assertTrue($ck);
		//データが無い状態
		$ck = $this->ThemeSettingsSite->getTheme();
		$this->assertNull($ck);
	}

	public function testUpdateTheme() {
		$theme = 'Default';
		$ck = $this->ThemeSettingsSite->updateTheme($theme);
		$this->assertTrue($ck);
		//名前を確認する
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertTextEquals($theme, $ck);
		//配列の場合
		$theme2['ThemeSettingsSiteValue']['value'] = "test2";
		$ck = $this->ThemeSettingsSite->updateTheme($theme2);
		$this->assertTrue($ck);
		//名前を確認する
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertTextEquals("test2", $ck);
		//valueがブランク
		$theme2['ThemeSettingsSiteValue']['value'] = "";
		$ck = $this->ThemeSettingsSite->updateTheme($theme2);
		//$this->assertTrue(!$ck);
	}

	public function testCreateTheme() {
		//データが無い場合を作る
		$ck = $this->ThemeSettingsSite->delete(2);
		$this->assertTrue($ck);
		//問い合わせた結果データは無いのでnullが戻る
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertEquals(null, $ck);
		//テーマを設定する
		$theme = 'Default';
		$ck = $this->ThemeSettingsSite->updateTheme($theme);
		$this->assertTrue($ck);
		//名前を確認する
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertTextEquals($theme, $ck);
		//var_dump($this->ThemeSite->find('all'));
	}
}
