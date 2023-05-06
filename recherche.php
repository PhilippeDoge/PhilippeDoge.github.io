<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Rechercher des utilisateurs</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1>Rechercher des utilisateurs</h1>
	<a href="accueil.php">Retourner à la page d'accueil</a>
	<form method="POST" action="">

		<label for="recherche">Saisissez le nom de l'utilisateur que vous souhaitez rechercher:</label>
		<input type="text" id="pseudo" name="pseudo" required>

		<input type="submit" name="rechercher" value="Rechercher">
	</form>

	<?php
		session_start();
		require_once "connect.php";

		 if(isset($_POST['rechercher'])){
		 	$pseudo=$_POST['pseudo'];
		 	if($pseudo==$_SESSION['pseudo']){
		 		header("Location: profil perso.php");
		 		exit();
		 	}else{
		 		//Récupère les informations dans la table user
		 		$select="SELECT * FROM profil WHERE pseudo='$pseudo';";
				$get=mysqli_query($conn,$select);

		 		if(mysqli_num_rows($get)>0){
		 			$_SESSION['pseudo_rec']=$pseudo;
		 			header("Location: profil.php");
		 			exit();
		 		}else{
		 			echo "<div class='erreur'>Utilisateur introuvable.</div>";
		 		}
		 	}
		}
	?>

</body>
</html>
