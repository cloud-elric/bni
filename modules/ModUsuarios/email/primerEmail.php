<?php 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?= Yii::$app->charset ?>" />
<title>Datos de cuenta</title>
</head>
<body>
	<header> </header>
	<section>
		<h1>Datos de cuenta</h1>

		<p>Hola <?=$user?></p>
		<p> Datos</p>
		<p>Nombre de contacto <?= $nombre_contacto ?></p>
		<p>Numero de contacto <?= $numero_contacto ?></p>
		<p>Descripcion <?= $descripcion ?></p>
		<p><a href='<?=$url?>'>Atender</a></p>
		<p>-Equipo 2 Geeks one Monkey</p>
	</section>
	<footer> </footer>


</body>
</html>
