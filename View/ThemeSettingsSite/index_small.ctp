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
			<li><a href="/theme_settings/<?php echo $classUrl; ?>/index/">
				<?php echo __("画像"); ?></a></li>
			<li class="active"><a href="/theme_settings/<?php echo $classUrl; ?>/index/small"><?php echo __("一覧"); ?></a></li>
		</ul>

		<div class="row">

			<div ng-app class="ng-app" style="display: none;">
				<div ng-controller="ThemeSettingsSiteIndexCtrl">
					<div class="container">
						<form>
						<input type="text" class="" ng-model="query" value="">
						<button ng-click="setQuery()" class="btn btn-primary"><?php echo __("検索"); ?></button>
						</form>
					</div>
					<table class="table table-striped" ng-onload="{{setJson()}}">
					<tr>
						<th>設定確認</th>
						<th>テーマ</th>
						<th>説明</th>
					</tr>
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
						<td></td>
					</tr>
					</table>
				</div>
			</div>

		</div>
	</div>


<!-- 確認用モーダル  -->

<?php if(isset($confirm) && $confirm) { ?>

<!-- Modal -->
<div class="modal modal-open" id="SiteThemeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-open">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">テーマの設定</h4>
			</div>
			<div class="modal-body">
				<?php echo __("テーマを設定しますか？"); ?>
				<p class="text-center">
					<a href="/theme_settings/<?php echo h($classUrl); ?>/index/<?php echo $listType; ?>" class="btn btn-default" role="button"><?php echo __('キャンセル')?></a>

					<a href="javascript:void(0)" id="btnSiteThemePost"  class="btn btn-primary" role="button"><?php echo __('設定する')?></a>
					<?php echo $this->Form->create(null, array("id"=>"SiteThemePost")); ?>
					<?php echo $this->Form->input("ThemeSettingsSiteValue.value" , array(
							"type"=>"hidden",
							//"name" => "data[value]",
							"value" => h($targetTheme)
						)
					); ?>
					<?php echo $this->Form->end(); ?>
				</p>

			</div>
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">テーマの詳細情報</h4>
			</div>
			<?php // echo '<pre>';  var_dump($themeInfo); echo '</pre>'; ?>
			<div class="modal-body">
				<p class="text-center"><?php echo $this->Html->image($themeInfo['snapshot'] , array('class'=>"img-thumbnail")); ?></p>
				<h2><?php echo h($themeInfo["name"]); ?></h2>
				<div>
					<h4><?php echo __("テーマの説明"); ?></h4>
					<?php echo nl2br(h($themeInfo["description"])); ?>
					<h4><?php echo __("サイト"); ?></h4>
					<?php echo $this->Html->link(h($themeInfo["homepage"]), h($themeInfo["homepage"]), array("target"=>"_blank")); ?>
					<h4><?php echo __("作者"); ?></h4>
					<?php if(isset($themeInfo["author"]) && $themeInfo["author"]) {
							echo h($themeInfo["author"]);
						}
						elseif(isset($themeInfo["authors"]) && $themeInfo["authors"])
						{
							foreach($themeInfo["authors"] as $i)
							{
								if(isset($i["name"]) && $i["name"]) {
									echo h($i["name"]);
								}
								if(isset($i["homepage"]) && $i["homepage"]) {
									echo "<br>".$this->Html->link(h($i["homepage"]) , h($i["homepage"]) , array("target"=>"_blank"));
								}
							}
						}
					?>
					<h4><?php echo __("ライセンス"); ?></h4>
					<?php foreach($themeInfo['licenses'] as $key=>$i) {
						echo h($i["type"]);
						if(isset($i["url"]) && $i["url"]) {
							echo "<br>".$this->Html->link(h($i["url"]) , h($i["url"]) , array("target"=>"_blank"));
						}
					} ?>
					<h4><?php echo __("必要構成"); ?></h4>
					<?php foreach($themeInfo['dependencies'] as $key=>$i) {
						echo h($key) . " : ";
						echo h($i);
						echo "<br>";
					} ?>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
	<script type="application/javascript">
		window.onload = function () {
			$(document).ready(function () {
				$("#SiteThemeModal").modal("show");
				$("#btnSiteThemePost").click(function(){
					$("#SiteThemePost").submit();
				});
			});
		}
	</script>




<?php  } ?>
