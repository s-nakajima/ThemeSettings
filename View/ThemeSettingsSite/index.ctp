<?php
//js呼び出し
$this->Html->script('ThemeSettings.theme_setting_site.js', false, array('inline' => false));
?>
<script>
//テーマ関連情報
	ThemeSettingThemeList = <?php echo $themeListJson; ?>;
	SnapshotNoImage = '/theme_setting/img/snapshot_noimage.png';
</script>

	<!-- container-main -->
	<div id="container-main" role="main">
		<?php
		//エラー表示
		if (isset($errors) && $errors) {
			?>
			<div class="alert alert-warning alert-de">
				<button type="button" class="close  alert-danger" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>エラーが発生しました。</strong>
				<br><?php if (isset($errors) && is_array($errors) && $errors) : ?>
						<?php echo h(join('<br>', $errors)); ?>
								<?php endif; ?>
				<br><?php echo __('再度テーマを選択してください。'); ?>
			</div>
			<?php
		}
		?>

		<ul class="nav nav-tabs">
			<li  class="active">
				<?php echo $this->Html->link(__('画像から選ぶ'), '/theme_settings/' . $classUrl . '/index/', array(
						'class' => ''
					));
				?>
			</li>
			<li>
				<?php echo $this->Html->link(__('一覧から選ぶ'), '/theme_settings/' . $classUrl . '/index/small', array('class' => '')); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('テーマのアップロード'), '/theme_settings/theme_settings_upload/', array()); ?>
			</li>
		</ul>

		<div class="page-header">
			<h2><?php echo __('テーマの設定管理'); ?></h2>
			<?php
			echo __('サイト全体のデザインを指定します。');
			?>
		</div>


		<div>
			<div ng-controller='ThemeSettingsSiteIndexCtrl'>
				<?php echo $this->element('ThemeSettings.site_index_search'); //検索フォームパーツ ?>

				<div class="row" ng-onload="{{setJson()}}">
					<div class="col-sm-4 col-md-3" ng-repeat="theme in ThemeList | filter:getQuery()">
						<div class="thumbnail">
							<img  class="img-thumbnail" src="{{snapshot(theme.snapshot)}}" alt="{{theme.name}}">
							<div>
								<h3 class="text-center">{{theme.name}}</h3>
								<p class="text-center">
									<a href="/theme_settings/<?php echo h($classUrl); ?>/confirm/{{theme.key}}" class="btn btn-primary form-control" role="button"><?php echo __('設定確認')?></a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>









	</div>
</div>



<!-- 確認用モーダル  -->
<?php
if (isset($confirm) && $confirm) {
	echo $this->element('ThemeSettings.site_index_modal');
}