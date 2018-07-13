<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новости</title>
</head>
<body>

<?php foreach ($items as $item): ?>
	<h1><?php echo $item->short_title; ?></h1>
	<div><?php echo $item->short_text; ?></div>
	<hr>
	<div><?php echo $item->text; ?></div>
	<hr>
	<div><?php echo 'Просмотров: ' . $item->views_sum; ?></div>
<?php endforeach; ?>

</body>
</html>