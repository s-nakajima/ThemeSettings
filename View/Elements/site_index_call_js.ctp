<?php
//js呼び出し
$this->Html->script("ThemeSettings.theme_setting_site.js", false, array('inline' => false));
//$this->Html->css('ThemeSettings.theme_settings.css', false , array('inline' => false));
?>

<script>
	//テーマ関連情報
	ThemeSettingThemeList = <?php echo $themeListJson; ?>;
	SnapshotNoImage = '/theme_setting/img/snapshot_noimage.png';
</script>
