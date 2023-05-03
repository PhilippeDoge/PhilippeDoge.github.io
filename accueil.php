<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Page d'accueil</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<form method="POST" action="">
		<input type="submit" name="deco" value="Déconnexion">

	</form>
	<?php
		if(isset($_POST['deco'])){
			header("Location: index.php");
			exit();
		}

	?>
	<h1>Ceci est une page d'accueil. Maintenance en cours...</h1>

</body>
</html> 
