<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Mot de passe oublié?</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<a href="index.php">Retour à la page de connexion</a>
	<h1>Mot de passe oublié</h1>
	<form method="POST" action="">
		<label for="mail">Veuillez saisir votre adresse mail:</label>
		<input type="email" id="mail" name="mail" required><br>

		<input type="submit" name="envoyer" value="Envoyer">
	</form>
	<?php
		if(isset($_POST['envoyer'])){

			//Récupère les données
			$mail=$_POST['mail'];

			//Vérifie si le mail est présent dans la base de données
			if($mail=='jmlesenfants@pdo.com'){
				//Renvoie vers la page de réinitialisation
				header("Location: reset mdp.php");
				exit();
			}else{
				//Renvoie à l'utilisateur que le mail renseigné n'existe pas
				echo "L'adresse mail n'existe pas. Veuillez réessayer.";
			}
		}
	?>
</body>
</html>
