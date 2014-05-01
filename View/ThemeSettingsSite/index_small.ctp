<?php
echo $this->element('ThemeSettings.site_index_call_js');
?>

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
			<li><a href="/theme_settings/<?php echo $classUrl; ?>/index/">
				<?php echo __("画像"); ?></a></li>
			<li class="active"><a href="/theme_settings/<?php echo $classUrl; ?>/index/small"><?php echo __("一覧"); ?></a></li>
		</ul>

		<div class="row">

			<div ng-app class="ng-app" style="display: none;">
				<div ng-controller="ThemeSettingsSiteIndexCtrl">
					<?php echo $this->element('ThemeSettings.site_index_search'); //検索フォームパーツ ?>
					<table class="table table-striped" ng-onload="{{setJson()}}">

					<tr ng-repeat="theme in ThemeList | filter:getQuery()">
						<td>
							<p class="text-center" style="padding-top:5px;">
								<a href="/theme_settings/<?php echo $classUrl; ?>/confirm/{{theme.key}}/<?php echo $listType; ?>" class="btn btn-primary">
									<?php echo __("設定確認"); ?>
								</a>
							</p>
						</td>
						<td>
							<a href="/theme_settings/<?php echo $classUrl; ?>/confirm/{{key}}">
								<img src="{{snapshot(theme.snapshot)}}" alt="theme.name" width="140" height="84">
							</a>
						</td>
						<td>
							<h4>{{theme.name}}</h4>
							<p>{{strimwidth(theme.description)}}</p>
						</td>
					</tr>
					</table>
				</div>
			</div>

		</div>
	</div>


<!-- 確認用モーダル  -->
<?php if(isset($confirm) && $confirm) {
 	    echo $this->element('ThemeSettings.site_index_modal');
}
