<div>
<?php foreach ($items as $item): ?>
	<div class="row my-5 animate flipInY">
		<?php if ($item->img_on_title) { ?>
		<div class="col-sm-12 col-md-2">
			<a href="" title="" target="_top">
			<img src="//sector.biz.ua/img/news/<?php echo $item->id; ?>/imgnewstitle.jpg" alt="" title="" class="rounded mx-auto d-block">
			</a>
		</div>
		<div class="col-sm-12 col-md-10">
		<?php } else { ?>
		<div class="col-sm-12 col-md-12">
		<?php } ?>
			<a href="" title="" target="_top">
				<h4><?php echo $item->short_title; ?></h4>
			</a>
			<div class="text-justify">
				<span class="badge badge-primary"><i class="far fa-calendar-alt"></i><?php echo date('d/m/Y H:i', strtotime($item->time_publish)); ?></span>
				<span class="badge badge-primary"><i class="far fa-eye"></i><?php echo $item->views_sum; ?></span> <?php echo $item->short_text; ?>
			</div>
			<div class="text-right text-muted">
				
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>