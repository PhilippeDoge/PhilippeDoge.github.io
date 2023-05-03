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
		// Vérifie si le formulaire a été soumis
		if (isset($_POST['envoyer'])) {

    		// Récupération des données du formulaire
    		$pseudo = $_POST['pseudo'];
    		$mdp = $_POST['mdp'];

   			// Traitement des données
    		if ($pseudo == 'admin' && $mdp == '1234') {
        		// Si l'identifiant et mot de passe sont corrects, redirige vers la page d'accueil
    			header("Location: accueil.php");
    			exit();
    		}else{
        		// Si les identifiants sont incorrects, afficher un message d'erreur
        		echo "Identifiant ou mot de passe incorrect.";
    		}
		}
	?>
</body>
</html>
