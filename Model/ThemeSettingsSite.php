<?php

App::uses('AppModel', 'Model');

class ThemeSettingsSite extends AppModel {

/**
 * テーブルの指定
 * @var bool
 */
	public $useTable = 'site_settings';

	public $name = "ThemeSettingsSite";

	public $hasOne = array(
		'ThemeSettingsSiteValue' => array(
			'ClassName' => 'ThemeSettingsSiteValue',
			'confitions' => array("ThemeSettingsSiteValue.id" => "ThemeSettingsSite.id"),
			'dependent' => true
		)
	);

/**
 * テーマの更新
 *
 * @param array $theme theme dir name
 * @return bool True if successful
 */
	public function updateTheme($theme) {
		$updateData = array();
		if (is_array($theme)) {
			$updateData = $theme;
		} elseif (is_string($theme)) {
			$updateData["ThemeSettingsSiteValue"]["value"] = $theme;
		}
		//旧データの存在を確認
		$ck = $this->find('first', array(
			'conditions' => array('name' => "Theme")
		));
		if ($ck
			&& isset($ck['ThemeSettingsSite'])
			&& isset($ck['ThemeSettingsSite']['id'])
		) {
			//データの更新
			$updateData['ThemeSettingsSite']['name'] = 'Theme';
			$updateData['ThemeSettingsSite']['id'] = $ck['ThemeSettingsSite']['id'];
			$updateData['ThemeSettingsSiteValue']['id'] = $ck['ThemeSettingsSiteValue']['id'];
			return $this->saveAssociated($updateData);
		} else {
			//データの保存 insert
			$updateData['ThemeSettingsSite']['name'] = 'Theme';
			return $this->saveAssociated($updateData);
		}
	}

/**
 * サイトのテーマ名の取得
 *
 * @return string|null theme dir name
 */
	public function getThemeName() {
		$theme = $this->getTheme();
		if ($theme && isset($theme["ThemeSettingsSiteValue"])
			&& isset($theme["ThemeSettingsSiteValue"]["value"])
			&& $theme["ThemeSettingsSiteValue"]["value"]
		) {
			return $theme["ThemeSettingsSiteValue"]["value"];
		}
		return null;
	}

/**
 * サイトのテーマデータ（配列）の取得
 *
 * @return array|null recode
 */
	public function getTheme() {
		$theme = $this->find('first', array(
			'conditions' => array('ThemeSettingsSite.name' => "Theme")
		));
		if ($theme) {
			return $theme;
		}
		return null;
	}
}
