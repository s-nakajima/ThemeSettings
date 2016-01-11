<?php
/**
 * テーマリストの表示
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<section class="row">
	<?php foreach ($themes as $theme) : ?>
		<article class="col-xs-4 col-sm-3 text-center">
			<div class="thumbnail">
				<img  class="img-thumbnail"
						src="<?php echo $theme['snapshot']; ?>"
						alt="<?php echo h($theme['name']); ?>">

				<h3>
					<?php echo h($theme['name']); ?>
				</h3>
				<div>
					<?php echo $this->element($callback, array('theme' => $theme)); ?>
				</div>
			</div>
		</article>
	<?php endforeach; ?>
</section>
