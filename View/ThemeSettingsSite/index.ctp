<?php
//js呼び出し
$this->Html->script("/net_commons/angular/angular.js", false , array('inline'=>false));
$this->Html->script("ThemeSettings.theme_setting_site.js", false , array('inline'=>false));
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
				<br><?php echo h(join("<br>" , $errors)); ?>
				<br><?php echo __("再度テーマを選択してください。"); ?>
			</div>
			<?php
		}
		?>

		<ul class="nav nav-tabs">
			<li  class="active"><a href="/theme_settings/<?php echo $classUrl; ?>/index/">
					<?php echo __("画像"); ?></a></li>
			<li><a href="/theme_settings/<?php echo $classUrl; ?>/index/small"><?php echo __("一覧"); ?></a></li>
		</ul>


		<div ng-app class="ng-app" style="display: none;">
			<div ng-controller="ThemeSettingsSiteIndexCtrl">
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
<?php if(isset($confirm) && $confirm) {
	echo $this->element('ThemeSettings.site_index_modal');
}