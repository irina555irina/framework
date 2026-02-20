<html>
<head>
	<meta charset="utf-8">
	<link href="/css\main.css" 
	rel="stylesheet">
	 
</head>
<body>
<h1>I am Default Layout</h1>

<a href="/user/signup">Регистрация</a><br><br>
<a href="/user/login">Вход</a><br><br>
<a href="/user/logout">Выход </a><br><br>



<?php if(isset ($_SESSION['errors'])) :?>
	
	<div class="alert">
		<?=$_SESSION['errors']; unset($_SESSION['errors']); ?>
	</div>
<?php endif; ?>

<?php if(isset ($_SESSION['success'])) :?>
	<div class="alert">
		<?=$_SESSION['success']; unset($_SESSION['success']); ?>
	</div>
<?php endif; ?>

<!-- <?= debug($_SESSION); ?> -->




<?=

$content;
?> 

<h2>END of Default Layout</h2>

<!-- 
<?= debug(framework\core\Db::$countSql)?>
<?= debug(framework\core\Db::$queries)?>

 -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>

<?php
	foreach($scripts as $script) {
		echo $script;
	}

?>




</body>
</html>

