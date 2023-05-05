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

		<input type="submit" name="recherche" value="Rechercher des utilisateurs";>

		<input type="submit" name="profil" value="Votre profil">

	</form>
	<?php
		require_once "connect.php";
		
		//Récupère le pseudo
		$pseudo=$_GET['pseudo'];

		//Renvoie vers la page de connexion
		if(isset($_POST['deco'])){
			session_destroy();
			header("Location: index.php");
			exit();
		}

		if(isset($_POST['recherche'])){
			header("Location: recherche.php?pseudo=$pseudo");
			exit();
		}

		//Renvoie vers le profil
		if(isset($_POST['profil'])){
			header("Location: profil perso.php?pseudo=$pseudo");
			exit();
		}


	?>
	<h1>Accueil</h1>
	<h2>Bienvenue <?php echo "$pseudo";?> !</h2>

</body>
</html>
