<ul class="nav nav-tabs">
	<li>
		<?php echo
		$this->Html->link(__("画像から選ぶ"),
			'/theme_settings/site/index/',
			array("class" => "")
		);
		?>
	</li>
	<li>
		<?php echo
		$this->Html->link(__("一覧から選ぶ"),
			'/theme_settings/site/index/small',
			array("class" => "")
		);
		?>
	</li>
	<li class="active">
		<?php echo
		$this->Html->link(__("テーマのアップロード"),
			'/theme_settings/upload/',
			array()
		);
		?>
	</li>
</ul>

<div class="page-header">
	<h2><?php echo __("テーマのアップロード"); ?></h2>
	<?php
	echo __("テーマファイル(ZIP)をアップロードしてください。");
	?>
</div>

<form style="margin-bottom: 5px;" onsubmit="event.returnValue = false;" enctype="multipart/form-data" action="/theme_settings/theme_settings/upload" method="post" accept-charset="utf-8">
	<input type="file" id="upload_file" name="data[upload_file]" style="display:inline" />

	<button
		class="btn btn-primary access-counters-editor-button-request"
		ng-click="submit();">
		<span class="glyphicon glyphicon-share-alt"></span>
		<span><?php echo __('アップロード'); ?></span>
	</button>

</form>