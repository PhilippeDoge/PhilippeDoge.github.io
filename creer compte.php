<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Créer votre compte</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1>Créez votre compte:</h1>
	<form method="POST" action="">
	<a href="index.php">Retour à la page d'accueil</a>
		
	<label for="pseudo">Saisissez votre pseudo:</label>
            <input type="text" id="pseudo" name="pseudo" required><br>

      	<label for="mail">Saisissez votre adresse mail:</label>
            <input type="email" id="mail" name="mail" required><br>

        <label for="mdp">Saisissez votre mot de passe:</label>
            <input type="password" id="mdp" name="mdp" required><br>

        <label for="mdp2">Confirmez votre mot de passe:</label>
            <input type="password" id="mdp2" name="mdp2" required><br>

        <label for="verif">Vérifiez que vous êtes un humain: Ecrivez "Je ne suis pas un bot"</label>
            <input type="text" id="verif" name="verif" required><br>

        <p>Envoyer le formulaire d'inscription:</p>
        <input type="submit" name="envoyer" value="Envoyer">
    </form>

    <?php
    	if(isset($_POST['envoyer'])){

    		//Récupère les données du formulaire
    		$pseudo=$_POST['pseudo'];
    		$mail=$_POST['mail'];
    		$mdp=$_POST['mdp'];
    		$mdp2=$_POST['mdp2'];
    		$verif=$_POST['verif'];

    		//Traite les données
    		if($mdp==$mdp2){
                //Cas où les mots de passe sont différents
    			echo "<div class='erreur'> Les deux mots de passe doivent être identiques </div>"; //j'ai rajouté des class pour mieux placer ces messages avec les css
    		}else if($verif!='Je ne suis pas un bot'){
                //Cas où la vérification a échouée
    			echo "<div class='erreur'> Vous êtes un bot, ou alors vous savez pas trop écrire </div>";
    		}else{
                //Attend 3 secondes et renvoie vers la page d'accueil
			echo "<div class='succes'>Création réussie. Veuillez patienter...</div>"; //Pareil que la class erreur. Tu feras gaffe ici, le texte ne s'affiche pas a cause du sleep
    			sleep(3);
    			header("Location: accueil.php");
    			exit();
    		}
    	}
    ?>
</body>
</html>
