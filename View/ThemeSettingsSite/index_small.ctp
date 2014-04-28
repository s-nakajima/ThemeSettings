<?php
$this->Html->script("/net_commons/angular/angular.js", false , array('inline'=>false));

//js呼び出し
$this->Html->script("ThemeSettings.theme_site.js", false , array('inline'=>false));

?>

<div  class="container">
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
				<?php echo __("画像大"); ?></a></li>
			<li class="active"><a href="/theme_settings/<?php echo $classUrl; ?>/index/small"><?php echo __("小"); ?></a></li>
		</ul>

		<div class="row">
		<div ng-controller="ThemeSettingsthemeCtrl">
		<script>
			themeList = <?php echo json_encode($themeList);?>;
		</script>
		<table class="table">
			<tr ng-repeat="themeList  in theme">
			  <td>{{theme.name}}</td>
			</tr>

		</table>
		{{themeList|json}}
		</div>
			<table class="table">
			<?php foreach ($themeList as $key=>$i) {
				if( ! isset($i["snapshot"]) || ! $i["snapshot"]) {
					$i["snapshot"] = ''; //noimage
				}
				?>

					<tr>
						<td>
							<a href="/theme_settings/<?php echo h($classUrl); ?>/confirm/<?php echo h($key); ?>/small" class="btn btn-primary btn-small" role="button"><?php echo __('確認')?></a>
						</td>
						<td>

							<?php echo $this->Html->image(h($i["snapshot"]), array(
								'class'=>"media-object",
								'alt'=>h($i['name']),
								'style'=>'width:100px;'
							)); ?>


					</td><td>
							<h4 class="media-heading"><?php echo h($i['name']) ; ?></h4>
							<?php echo h($i['description']); ?>
					</td>
					</tr>

				<!--
				<div class="col-sm-6 col-md-3">
					<div class="thumbnail">
						<?php echo $this->Html->image('/theme_settings/'. h($key).'/snapshot.png' , array('class'=>"img-thumbnail")); ?>
						<div class="caption">
							<h3 class="text-center"><?php echo h($i['name']); ?></h3>
							<p><?php echo nl2br(h($i['description'])); ?></p>
							<p class="text-center">
								<a href="/theme_settings/<?php echo h($classUrl); ?>/confirm/<?php echo h($key); ?>" class="btn btn-primary" role="button"><?php echo __('設定確認/詳細を見る')?></a>
							</p>
						</div>
					</div>
				</div>
				-->

			<?php } ?>
			</table>
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
				<?php //var_dump($_POST); ?>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">テーマの設定</h4>
			</div>
			<div class="modal-body">
				<?php echo __("テーマを設定しますか？"); ?>
				<p class="text-center">
					<a href="/theme_settings/<?php echo h($classUrl); ?>/" class="btn btn-default" role="button"><?php echo __('キャンセル')?></a>
					<?php //TODO:POST ?>
					<a href="javascript:void(0)" id="btnSiteThemePost"  class="btn btn-primary" role="button"><?php echo __('設定する')?></a>
					<?php echo $this->Form->create(null, array("id"=>"SiteThemePost")); ?>
					<?php echo $this->Form->input("ThemeSiteValue.value" , array(
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
			<div class="modal-body">
				<p class="text-center"><?php echo $this->Html->image('/theme_settings/'. h($targetTheme).'/snapshot.png' , array('class'=>"img-thumbnail")); ?></p>
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




<?php } ?>
