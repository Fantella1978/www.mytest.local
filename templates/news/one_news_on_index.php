<div class="row mb-4 mt-2 animate flipInY news-item-on-index">
	<div class="col-sm-12 col-md-3 col-lg-2 news-item-img-on-title my-2">
		<a href="<?php echo $item->url; ?>" title="" target="_top">
			<img src="//sector.biz.ua<?php echo $item->img_on_title_url; ?>" alt="" title="" class="rounded d-block mx-auto">
		</a>
	</div>
	<div class="col-sm-12 col-md-9 col-lg-10 pl-3">
		<h4 class="news-item-header">
			<a href="<?php echo $item->url; ?>" title="" target="_top">
				<?php echo $item->short_title; ?>
			</a>
		</h4>
		<div class="text-justify">
			<span class="badge badge-light news-item-badge"><i class="far fa-calendar-alt"></i><?php echo date('d/m/Y H:i', strtotime($item->time_publish)); ?></span>
			<span class="badge badge-light news-item-badge"><i class="far fa-eye"></i><?php echo $item->views_sum; ?></span> <?php echo $item->short_text; ?>
		</div>
		<div class="text-right">
			<a href="<?php echo $item->url; ?>" role="button" class="btn btn-sm btn-outline-primary">Подробнее</a>
		</div>
	</div>
	<div class="col-sm-12 col-md-12">
	</div>
</div>