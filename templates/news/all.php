
<?php foreach ($items as $item): ?>
	<h1><?php echo $item->short_title; ?></h1>
	<div><?php echo $item->short_text; ?></div>
	<hr>
	<div><?php echo $item->text; ?></div>
	<hr>
	<div><?php echo 'Просмотров: ' . $item->views_sum; ?></div>
<?php endforeach; ?>
