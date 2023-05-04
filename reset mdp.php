<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Réinitialisation de votre mot de passe</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1>Réinitialisation de votre mot de passe</h1>
	<form method="POST" action="">
		<a href="index.php">Retour à la page de connexion</a>

		<label for="pseudo">Confirmez de nouveau votre pseudo:</label>
		<input type="text" id="pseudo" name="pseudo"><br>

		<label for="mdp">Saisissez votre nouveau mot de passe:</label>
		<input type="password" id="mdp" name="mdp"><br>

		<label for="mdp2">Confirmez le nouveau mot de passe:</label>
		<input type="password" id="mdp2" name="mdp2"><br>

		<input type="submit" name="confirmer" value="Confirmer">
	</form>

	<?php
		require_once "connect.php";

		if(isset($_POST['confirmer'])){
			//Récupère les données du formulaire
			$pseudo=$_POST['pseudo'];
			$pseudo2=$_GET['pseudo'];
			$mdp=$_POST['mdp'];
			$mdp2=$_POST['mdp2'];

			if($mdp!=$mdp2){
				//Cas où les mots de passe ne sont pas identiques
				echo "<div class='erreur'>Les deux mots de passe ne sont pas identiques.</div>";
			}else if($pseudo!=$pseudo2){
				echo "<div class='erreur'>Le pseudo est différent.</div>";
			}else{
				// Échappe les caractères spéciaux pour éviter les injections SQL
				$pseudo=mysqli_real_escape_string($conn,$pseudo);
                $mdp=mysqli_real_escape_string($conn,$mdp);
                $mdp2=mysqli_real_escape_string($conn,$mdp2);

                //Traite les données
                $select="SELECT pseudo,mdp FROM user WHERE pseudo='$pseudo' AND mdp!='$mdp';";
                $update="UPDATE user SET mdp='$mdp' WHERE pseudo='$pseudo';";

                $result=mysqli_query($conn,$select);

                if(mysqli_num_rows($result)>0){
                	mysqli_query($conn,$update);
					echo "<div class='succes'>Mot de passe changé avec succès. Retournez vers la page d'accueil.</div>";
				}else{
					echo "<div class='erreur'>Impossible de changer le mot de passe. Veuillez réessayer.</div>";
				}
			}

			//Ferme la connexion à la base de données
            mysqli_close($conn);
		}
	?>
</body>
</html>
