<?php
/**
 * ThemeSettingsSiteController Test Case
 *
 * @author   Takako Miyagawa <nekoget@gmail.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppController', 'Controller');

/**
 * Summary for AnnouncementEditsController Test Case
 */
class ThemeSettingsSiteControllerTest extends ControllerTestCase {

/**
 * setUp
 *
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
	);

/**
 * indexのテスト
 *
 * @return void
 */
	public function testIndex() {
		$this->testAction('/theme_settings/theme_settings_site/index', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
		$this->testAction('/theme_settings/theme_settings_site/index/small', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * 確認画面 getのテスト
 *
 * @return void
 */
	public function testConfirmFromGet() {
		//存在してるテーマを指定
		$this->testAction('/theme_settings/theme_settings_site/confirm/Default', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
		$this->testAction('/theme_settings/theme_settings_site/confirm/Default/small', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
		//存在しないテーマを指定
		$this->testAction('/theme_settings/theme_settings_site/confirm/UnitTest2', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
		//存在しないテーマを指定
		$this->testAction('/theme_settings/theme_settings_site/confirm/UnitTest2/small', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
		//postのとき
		$this->testAction('/theme_settings/theme_settings_site/confirm/UnitTest2', array('method' => 'post'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * 確認画面 POSTのテスト
 *
 * @return void
 */
	public function testConfirmFromPost() {
		//存在するテーマが指定されて、正常に更新された
		$this->Controller = $this->generate('ThemeSettings.ThemeSettingsSite', array(
			'components' => array(
				'Security'
			)
		));
		$data = array();
		$data['ThemeSettingsSiteValue']['value'] = 'Amelia';
		$this->testAction('/theme_settings/theme_settings_site/confirm/Amelia', array(
			'data' => $data,
			'method' => 'post'
		));
		$this->assertTextEquals($this->Controller->theme, 'Amelia');
		$this->assertTextEquals($this->Controller->view, 'update_end');
		$this->assertTextContains('alert-success', $this->view);

		//セキュリティコンポーネント処理
		$this->Controller = $this->generate('ThemeSettings.ThemeSettingsSite', array(
			'components' => array(
				'Security'
			)
		));
		$data = array();
		$data['ThemeSettingsSiteValue']['value'] = 'Default';
		$this->testAction('/theme_settings/theme_settings_site/confirm/Default', array(
			'data' => $data,
			'method' => 'post'
		));
		$this->assertTextEquals($this->Controller->theme, 'Default');
		$this->assertTextEquals($this->Controller->view, 'update_end');
		$this->assertTextContains('alert-success', $this->view);

		//getとpostされたテーマが違う セキュリティコンポーネントはOK
		$this->Controller = $this->generate('ThemeSettings.ThemeSettingsSite', array(
			'components' => array(
				'Security'
			)
		));
		$data = array();
		$data['ThemeSettingsSiteValue']['value'] = 'Default';
		$this->testAction('/theme_settings/theme_settings_site/confirm/Amelia', array(
			'data' => $data,
			'method' => 'post'
		));
		$this->assertTextEquals($this->Controller->theme, 'Default');
		$this->assertTextEquals($this->Controller->view, 'index');

		//deleteの場合はpostとして扱われる。 セキュリティコンポーネントはOK
		$this->Controller = $this->generate('ThemeSettings.ThemeSettingsSite', array(
			'components' => array(
				'Security'
			)
		));
		$data = array();
		$data['ThemeSettingsSiteValue']['value'] = 'Amelia';
		$this->testAction('/theme_settings/theme_settings_site/confirm/Amelia', array(
			'data' => $data,
			'method' => 'delete'
		));
		$this->assertTextEquals($this->Controller->theme, 'Amelia');
		$this->assertTextEquals($this->Controller->view, 'index');

		//バリデーションエラーNG
		$this->Controller = $this->generate('ThemeSettings.ThemeSettingsSite', array(
			'components' => array(
				'Security'
			),
		));
		$this->Controller->ThemeSettingsSiteValue = Classregistry::init("ThemeSettings.ThemeSettingsSiteValue");
		$this->Controller->ThemeSettingsSiteValue->validate = array(
			'value' => array(
				'maxLength' => array(
					'rule' => array('maxLength', 1), //１００文字以内
					'message' => "登録できないテーマです。"
				)
			)
		);
		$data = array();
		$data['ThemeSettingsSiteValue']['value'] = 'Default';
		$this->testAction('/theme_settings/theme_settings_site/confirm/Default', array(
			'data' => $data,
			'method' => 'post'
		));
		$this->assertTextEquals($this->Controller->theme, 'Default');
		$this->assertTextEquals($this->Controller->view, 'index');
	}
}
