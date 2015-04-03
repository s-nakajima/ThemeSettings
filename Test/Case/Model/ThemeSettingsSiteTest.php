<?php
/**
 * SiteSetting Test Case
 *
 * @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */

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
		'plugin.net_commons.site_setting',
	);

/**
 * Model
 *
 * @var array
 */
	public $ThemeSettingsSite;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ThemeSettingsSite = ClassRegistry::init('ThemeSettings.ThemeSettingsSite');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ThemeSettingsSite);
		parent::tearDown();
	}
/**
 * getThemeSite サイト用テーマ名の取得
 *
 * @return void
 */
	public function testGetThemeName() {
		/*
		//データがある場合
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertTextEquals("UnitTestTheme", $ck);
		//データが無い場合を作る
		$ck = $this->ThemeSettingsSite->delete(2);
		$this->assertTrue($ck);
		//問い合わせた結果データは無いのでnullが戻る
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertEquals(null, $ck);
		*/
	}

/**
 * テーマ情報の取得 (1レコード分の配列）
 *
 * @return void
 */
	public function testGetTheme() {
		/*
		//データがある場合
		$ck = $this->ThemeSettingsSite->getTheme();
		$this->assertTextEquals("UnitTestTheme", $ck['ThemeSettingsSite']['value']);
		*/
	}

/**
 * testGetThemeNoData()該当のレコードが無い場合
 *
 * @return void
 */
	public function testGetThemeNoData() {
		/*
		$ck = $this->ThemeSettingsSite->getTheme();
		//データが無い状態をつくる。
		if ($ck) {
			$ck = $this->ThemeSettingsSite->delete($ck['ThemeSettingsSite']['id']);
			$this->assertTrue($ck);
		}
		//データが無い状態の場合nullが戻る。
		$ck = $this->ThemeSettingsSite->getTheme();
		$this->assertNull($ck);
		*/
	}

/**
 * テーマのアップデート
 *
 * @return void
 */
	public function testUpdateTheme() {
		/*
		//stringの場合のupdate処理実行
		$theme = 'Default';
		$ck = $this->ThemeSettingsSite->updateTheme($theme);
		$this->assertTrue($ck);
		//名前を確認する
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertTextEquals($theme, $ck);
		*/
	}

/**
 * テーマのアップデート配列で登録
 *
 * @return void
 */
	public function testUpdateThemeArray() {
		/*
		//配列の場合のupdate処理実行
		$theme2 = array();
		$theme2['ThemeSettingsSite']['value'] = "test2";
		$ck = $this->ThemeSettingsSite->updateTheme($theme2);
		$this->assertTrue($ck);
		//名前を確認する
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertTextEquals("test2", $ck);
		*/
	}
/**
 * テーマのアップデート配列で登録 + 中身がブランク
 *
 * @return void
 */
	public function testUpdateThemeArrayBlank() {
		/*
		//valueがブランク
		$oldName = $this->ThemeSettingsSite->getThemeName();
		$theme2 = array();
		$theme2['ThemeSettingsSite']['value'] = "";
		$ck = $this->ThemeSettingsSite->updateTheme($theme2);
		$this->assertFalse($ck); //update失敗
		//データは下記変わらないので旧のまま。
		$this->assertTextEquals($this->ThemeSettingsSite->getThemeName(), $oldName);
		*/
	}

/**
 * テーマの新規登録
 *
 * @return void
 */
	public function testCreateTheme() {
		/*
		//データが無い場合を作る
		$ck = $this->ThemeSettingsSite->getTheme();
		//データが無い状態をつくる。
		if ($ck) {
			//削除処理
			$ck = $this->ThemeSettingsSite->delete($ck['ThemeSettingsSite']['id']);
			$this->assertTrue($ck);
		}
		//テーマを設定する //insert
		$theme = 'Default';
		$ck = $this->ThemeSettingsSite->updateTheme($theme);
		$this->assertTrue($ck);
		//登録されている名前を確認する
		$ck = $this->ThemeSettingsSite->getThemeName();
		$this->assertTextEquals($theme, $ck);
		*/
	}
}
