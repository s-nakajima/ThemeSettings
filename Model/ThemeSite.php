<?php

App::uses('AppModel', 'Model');

class ThemeSite extends AppModel {

/**
 * テーブルの指定
 * @var bool
 */
	public $useTable = 'site_settings';

	public $name = "ThemeSite";

	public $hasOne = array(
		'ThemeSiteValue' => array(
			'ClassName' => 'ThemeSiteValue',
			'confitions' => array("ThemeSiteValue.id" => "ThemeSite.id"),
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
			$updateData["ThemeSiteValue"]["value"] = $theme;
		}
		//旧データの存在を確認
		$ck = $this->find('first', array(
			'conditions' => array('name' => "Theme")
		));
		if ($ck
			&& isset($ck['ThemeSite'])
			&& isset($ck['ThemeSite']['id'])
		) {
			//データの更新
			$updateData['ThemeSite']['name'] = 'Theme';
			$updateData['ThemeSite']['id'] = $ck['ThemeSite']['id'];
			$updateData['ThemeSiteValue']['id'] = $ck['ThemeSiteValue']['id'];
			return $this->saveAssociated($updateData);
		} else {
			//データの保存 insert
			$updateData['ThemeSite']['name'] = 'Theme';
			return $this->saveAssociated($updateData);
		}
	}

/**
 * サイトのテーマ名の取得
 * @return string|null
 */
	public function getThemeName() {
		$theme = $this->getTheme();
		if ($theme && isset($theme["ThemeSiteValue"])
			&& isset($theme["ThemeSiteValue"]["value"])
			&& $theme["ThemeSiteValue"]["value"]
		) {
			return $theme["ThemeSiteValue"]["value"];
		}
		return null;
	}

/**
 * サイトのテーマデータ（配列）の取得
 * @return array|null
 */
	public function getTheme() {
		$theme = $this->find('first', array(
			'conditions' => array('ThemeSite.name' => "Theme")
		));
		if ($theme) {
			return $theme;
		}
		return null;
	}
}
