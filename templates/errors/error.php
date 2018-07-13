<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error <?php echo $errorCode; ?></title>
</head>
<body>
	<h1>Ошибка <?php echo $errorCode; ?></h1>
    <section>
        <p><?php echo $errorText; ?></p>
        <hr>
		<p><a href="/" target="_top"><?php echo $_SERVER['HTTP_HOST']; ?></a></p>
    </section>
</body>
</html>