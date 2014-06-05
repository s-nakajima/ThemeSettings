<?php
/**
 * SiteThemeValue Mode
 * バリデーションルールのためだけのModel
 *
 * @property SiteSetting $SiteSetting
 * @property CreatedUser $CreatedUser
 * @property ModifiedUser $ModifiedUser
 *
 * @author   Takako Miyagawa <nekoget@gmail.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppModel', 'Model');

/**
 * Summary for SiteSettingValue Model
 */
class ThemeSettingsSiteValue extends AppModel {

/**
 * テーブルの指定
 * @var bool
 */
	public $useTable = 'site_setting_values';

	public $name = "ThemeSettingsSiteValue";

/**
 * __construct
 *
 * @param bool $id id
 * @param null $table db table
 * @param null $ds connection
 * @return void
 * @SuppressWarnings(PHPMD)
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'site_setting_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'value' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'), //アルファベットOR数字
				'required' => true,
				'message' => "Please enter the number or alphabet."
				),
			'maxLength' => array(
				'rule' => array('maxLength', 100), //１００文字以内
				'message' => "Please enter more than 100 characters."
			),
			'maxLength' => array(
				'rule' => array('minlength', 1), //1文字以上
				'message' => "Please input of one or more characters."
			)
		)
	);
}
