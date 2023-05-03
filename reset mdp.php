<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Réinitialisation de votre mot de passe</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<a href="index.php">Retour à la page de connexion</a>
	<h1>Réinitialisation de votre mot de passe</h1>
	<form method="POST" action="">
		<label for="mdp">Saisissez votre nouveau mot de passe:</label>
		<input type="password" id="mdp" name="mdp"><br>

		<label for="mdp2">Confirmez le nouveau mot de passe:</label>
		<input type="password" id="mdp2" name="mdp2"><br>

		<input type="submit" name="confirmer" value="Confirmer">
	</form>

	<?php
		if(isset($_POST['confirmer'])){
			//Récupère les données du formulaire
			$mdp=$_POST['mdp'];
			$mdp2=$_POST['mdp2'];

			if($mdp!=$mdp2){
				//Cas où les mots de passe ne sont pas identiques
				echo "<div class='erreur'>Les deux mots de passe ne sont pas identiques.</div>";
			}else if($mdp=='1234'){
				//Cas où le mot de passe est identique au précédent
				echo "<div class='erreur'>Le mot de passe doit être différent du précédent.</div>";
			}else{
				//Change le mot de passe
				echo "<div class='succes'> Mot de passe changé avec succès. </div>";
			}
		}
	?>
</body>
</html>
