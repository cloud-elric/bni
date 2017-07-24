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
		<h1>Lead atendido</h1>

		<p>Hola <?=$user?></p>
		<p>El lead con los siguientes datos ha sido atendido</p>
		<p>Nombre de contacto <?= $nombre_contacto ?></p>
		<p>Numero de contacto <?= $numero_contacto ?></p>
		<p>Descripcion <?= $descripcion ?></p>
		
		<p>-Equipo 2 Geeks one Monkey</p>
	</section>
	<footer> </footer>


</body>
</html>
