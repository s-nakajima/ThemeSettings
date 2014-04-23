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
class SiteThemeTest extends CakeTestCase {

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
/**
 * getSiteTheme サイト用テーマ名の取得
 * @return void
 */
	public function testGetThemeName() {
		//データがある場合
		$ck = $this->SiteTheme->getThemeName();
		$this->assertTextEquals("UnitTestTheme", $ck);
		//データが無い場合を作る
		$ck = $this->SiteTheme->delete(2);
		$this->assertTrue($ck);
		//問い合わせた結果データは無いのでnullが戻る
		$ck = $this->SiteTheme->getThemeName();
		$this->assertEquals(null, $ck);
	}

/**
 * testGetTheme()
 * @return void
 */
	public function testGetTheme() {
		//データがある場合
		$ck = $this->SiteTheme->getTheme();
		//var_dump($ck);
		$this->assertTextEquals("UnitTestTheme", $ck['SiteThemeValue']['value']);
		//データを削除
		$ck = $this->SiteTheme->delete(2);
		$this->assertTrue($ck);
		//データが無い状態
		$ck = $this->SiteTheme->getTheme();
		$this->assertNull($ck);
	}

	public function testUpdateTheme() {
		$theme = 'Default';
		$ck = $this->SiteTheme->updateTheme($theme);
		$this->assertTrue($ck);
		//名前を確認する
		$ck = $this->SiteTheme->getThemeName();
		$this->assertTextEquals($theme, $ck);
		//配列の場合
		$theme2['SiteThemeValue']['value'] = "test2";
		$ck = $this->SiteTheme->updateTheme($theme2);
		$this->assertTrue($ck);
		//名前を確認する
		$ck = $this->SiteTheme->getThemeName();
		$this->assertTextEquals("test2", $ck);
		//valueがブランク
		$theme2['SiteThemeValue']['value'] = "";
		$ck = $this->SiteTheme->updateTheme($theme2);
		//$this->assertTrue(!$ck);
	}

	public function testCreateTheme() {
		//データが無い場合を作る
		$ck = $this->SiteTheme->delete(2);
		$this->assertTrue($ck);
		//問い合わせた結果データは無いのでnullが戻る
		$ck = $this->SiteTheme->getThemeName();
		$this->assertEquals(null, $ck);
		//テーマを設定する
		$theme = 'Default';
		$ck = $this->SiteTheme->updateTheme($theme);
		$this->assertTrue($ck);
		//名前を確認する
		$ck = $this->SiteTheme->getThemeName();
		$this->assertTextEquals($theme, $ck);
		//var_dump($this->SiteTheme->find('all'));
	}
}
