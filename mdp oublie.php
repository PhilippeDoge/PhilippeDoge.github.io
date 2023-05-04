<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Mot de passe oublié?</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1>Mot de passe oublié</h1>
	<form method="POST" action="">
		<a href="index.php">Retour à la page de connexion</a>

		<label for="pseudo">Veuillez saisir votre pseudo:</label>
		<input type="text" id="pseudo" name="pseudo" required>

		<label for="mail">Veuillez saisir votre adresse mail:</label>
		<input type="email" id="mail" name="mail" required><br>

		<input type="submit" name="envoyer" value="Envoyer">
	</form>
	<?php
		require_once "connect.php";

		if(isset($_POST['envoyer'])){

			//Récupère les données
			$mail=$_POST['mail'];
			$pseudo=$_POST['pseudo'];

			// Échappe les caractères spéciaux pour éviter les injections SQL
    		$pseudo=mysqli_real_escape_string($conn,$pseudo);
    		$mail=mysqli_real_escape_string($conn,$mail);

    		//Traite les données
			$select="SELECT pseudo,mail FROM user WHERE pseudo='$pseudo' AND mail='$mail';";

			$result=mysqli_query($conn,$select);

			//Si on trouve un résultat, renvoie vers la page de réinitialisation de mot de passe
			if(mysqli_num_rows($result)>0){
				header("Location:http://localhost/zebi/reset%20mdp.php?pseudo=$pseudo");
				exit();
			}else{
				//Sinon renvoie un message d'erreur
				echo "<div class='erreur'>Pseudo ou mail incorrect.</div>";
			}

			//Ferme la connexion à la base de données
            mysqli_close($conn);
		}
	?>

</body>
</html>
