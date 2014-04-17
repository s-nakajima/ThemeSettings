<?php

App::uses('AppModel', 'Model');

class SiteTheme extends AppModel {

/**
 * テーブルの指定
 * @var bool
 */
	public $useTable = 'site_settings';

	public $name = "SiteTheme";

	public $hasOne = array(
		'SiteSettingValue' => array(
			'ClassName' => 'SiteSettingValue',
			'confitions' => array("SiteSettingValue.id" => "SiteTheme.id"),
			'dependent' => true
		)
	);

/**
 * __construct
 * @param bool $id
 * @param null $table
 * @param null $ds
 * @return void
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
	}

/**
 * テーマの更新
 * @param array $theme
 */
	public function updateTheme($theme) {

		$updateData['SiteSettingValue']['value'] = $theme;
		$updateData['SiteTheme']['name'] = 'Theme';
		$ck = $this->find('first', array(
			'conditions' => array('name' => "Theme")
		));
		if ($ck
			&& isset($ck['SiteTheme'])
			&& isset($ck['SiteTheme']['id'])
		) {
			$updateData['SiteTheme']['id'] = $ck['SiteTheme']['id'];
			$updateData['SiteSettingValue']['id'] = $ck['SiteSettingValue']['id'];
			 return $this->saveAll($updateData);
		}
		else
		{
			return $this->saveAll($updateData);
		}
	}

/**
 * サイトのテーマ名の取得
 * @return string|null
 */
	public function getThemeName() {
		$theme = $this->getTheme();
		if ($theme && isset($theme["SiteSettingValue"])
			&& isset($theme["SiteSettingValue"]["value"])
			&& $theme["SiteSettingValue"]["value"]
		) {
			return $theme["SiteSettingValue"]["value"];
		}
		return null;
	}

/**
 * サイトのテーマデータ（配列）の取得
 * @return array|null
 */
	public function getTheme() {
		$theme = $this->find('first', array(
			'conditions' => array('SiteTheme.name' => "Theme")
		));
		if ($theme) {
			return $theme;
		}
		return null;
	}
}
