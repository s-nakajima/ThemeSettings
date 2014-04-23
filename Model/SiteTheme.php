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
		'SiteThemeValue' => array(
			'ClassName' => 'SiteThemeValue',
			'confitions' => array("SiteThemeValue.id" => "SiteTheme.id"),
			'dependent' => true
		)
	);

/**
 * updateThemeのためのバリデーションルール
 * @var array
 */

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
		$updateData = array();
		if (is_array($theme)) {
			$updateData = $theme;
		} elseif (is_string($theme)) {
			$updateData['SiteThemeValue']['value'] = $theme;
		}
		//旧データの存在を確認
		$ck = $this->find('first', array(
			'conditions' => array('name' => "Theme")
		));

		if ($ck
			&& isset($ck['SiteTheme'])
			&& isset($ck['SiteTheme']['id'])
		) {
			//データの更新
			$updateData['SiteTheme']['name'] = 'Theme';
			$updateData['SiteTheme']['id'] = $ck['SiteTheme']['id'];
			$updateData['SiteThemeValue']['id'] = $ck['SiteThemeValue']['id'];
			return $this->saveAssociated($updateData);
		} else {
			//データの保存 insert
			$updateData['SiteTheme']['name'] = 'Theme';
			return $this->saveAssociated($updateData);
		}
	}

/**
 * サイトのテーマ名の取得
 * @return string|null
 */
	public function getThemeName() {
		$theme = $this->getTheme();
		if ($theme && isset($theme["SiteThemeValue"])
			&& isset($theme["SiteThemeValue"]["value"])
			&& $theme["SiteThemeValue"]["value"]
		) {
			return $theme["SiteThemeValue"]["value"];
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
