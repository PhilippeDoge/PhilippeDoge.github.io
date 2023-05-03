<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Créer votre compte</title>
</head>
<body>
	<a href="index.php">Retour à la page d'accueil</a>
	<h1>Créez votre compte:</h1>
	<form method="POST" action="">
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
    //Vérifie si le formulaire a été soumis
    	if(isset($_POST['envoyer'])){

    		//Récupère les données du formulaire
    		$pseudo=$_POST['pseudo'];
    		$mail=$_POST['mail'];
    		$mdp=$_POST['mdp'];
    		$mdp2=$_POST['mdp2'];
    		$verif=$_POST['verif'];

    		//Traitement des données
    		if($mdp!=$mdp2){
    			echo "Les deux mots de passe doivent être identiques";
    		}else if($verif!='Je ne suis pas un bot'){
    			echo "Vous êtes un bot";
    		}else{
    			echo "Création réussie. Veuillez patienter...";
    			sleep(3);
    			header("Location: accueil.php");
    			exit();
    		}
    	}
    ?>

</body>
</html>