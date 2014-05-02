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

<h1>作成中</h1>