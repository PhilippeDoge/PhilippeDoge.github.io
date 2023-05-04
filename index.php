<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>projet de merde</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1> Bienvenue sur la page de connexion</h1>
	<form method="POST" action="">
		<label for="pseudo">Saisissez votre pseudo:</label>
        <input type="text" id="pseudo" name="pseudo" required><br>

        <label for="mdp">Saisissez votre mot de passe:</label>
        <input type="password" id="mdp" name="mdp" required><br>

        <input type="submit" name="envoyer" value="Envoyer"> 

        <a href="creer compte.php">Créer votre compte</a><br>

    	<a href="mdp oublie.php">Mot de passe oublié?</a>

    </form>

    <?php
   		require_once "connect.php";

		// Vérifie si le formulaire a été soumis
		if (isset($_POST['envoyer'])) {

    		// Récupère les données du formulaire
    		$pseudo=$_POST['pseudo'];
    		$mdp=$_POST['mdp'];

    		// Échappe les caractères spéciaux pour éviter les injections SQL
    		$pseudo=mysqli_real_escape_string($conn,$pseudo);
    		$mdp=mysqli_real_escape_string($conn,$mdp);

    		//Traite les données
    		$select="SELECT pseudo,mdp FROM user WHERE pseudo='$pseudo' AND mdp='$mdp';";

    		$result=mysqli_query($conn,$select);

    		//Si on trouve un résultat, renvoie vers la page d'accueil
    		if(mysqli_num_rows($result)>0){
    			header("Location: accueil.php");
    			exit();
    		}else{
    			//Sinon renvoie un message d' erreur
    			echo "<div class='erreur'> Identifiant ou mot de passe incorrect. </div>";
    		}

    		//Ferme la connexion à la base de données
            mysqli_close($conn);

		}
	?>
</body>
</html>
