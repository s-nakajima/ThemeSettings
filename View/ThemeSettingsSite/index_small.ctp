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
				<br><?php echo h(join("<br>", $errors)); ?>
				<br><?php echo __("再度テーマを選択してください。"); ?>
			</div>
			<?php
		}
		?>

		<ul class="nav nav-tabs">
			<li>
				<?php echo
				$this->Html->link(__("画像から選ぶ"),
					'/theme_settings/' . $classUrl . '/index/',
					array("class" => "")
				);
				?>
			</li>
			<li class="active">
				<?php echo
				$this->Html->link(__("一覧から選ぶ"),
					'/theme_settings/' . $classUrl . '/index/small',
					array("class" => "")
				);
				?>
			</li>
			<li>
				<?php echo
				$this->Html->link(__("テーマのアップロード"),
					'/theme_settings/theme_settings_upload/',
					array()
				);
				?>
			</li>
		</ul>

		<div class="page-header">
			<h2><?php echo __("テーマの設定管理"); ?></h2>
			<?php
				echo __("サイト全体のデザインを指定します。");
			?>
		</div>

		<div class="row">
			<div>
				<div ng-controller="ThemeSettingsSiteIndexCtrl">
					<?php echo $this->element('ThemeSettings.site_index_search'); //検索フォームパーツ ?>
					<table class="table table-striped" ng-onload="{{setJson()}}">
					<tr ng-repeat="theme in ThemeList | filter:getQuery()">
						<td class="col-lg-1">
							<p class="text-center" style="padding-top:5px;">
								<a href="/theme_settings/<?php echo $classUrl; ?>/confirm/{{theme.key}}/
									<?php echo $listType; ?>" class="btn btn-primary">
									<?php echo __("設定確認"); ?>
								</a>
							</p>
						</td>
						<td class="col-lg-1">
							<a href="/theme_settings/<?php echo $classUrl; ?>/confirm/{{key}}">
								<img src="{{snapshot(theme.snapshot)}}" alt="theme.name" width="140" height="84">
							</a>
						</td>
						<td  class="col-lg-10">
							<h4>{{theme.name}}</h4>
							<p>{{strimwidth(theme.description)}}</p>
							<p><?php echo __("作者"); ?><span ng-repeat="author in theme.authors"> : {{author.name}}</span></p>
						</td>
					</tr>
					</table>
				</div>
			</div>
		</div>
	</div>


<!-- 確認用モーダル  -->
<?php if (isset($confirm) && $confirm) : ?>
	echo $this->element('ThemeSettings.site_index_modal');
<?php endif;