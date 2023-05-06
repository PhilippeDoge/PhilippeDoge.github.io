<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Votre profil</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1>Votre profil</h1>
	<?php
		session_start();
		require_once "connect.php";

		//Renvoie vers la page d'accueil
		echo "<a href=\"accueil.php\">Retour en arrière</a>";

		//Récupère les données
		$select="SELECT * FROM profil WHERE pseudo='{$_SESSION['pseudo']}';";
		$data=mysqli_query($conn,$select);
		$row=mysqli_fetch_assoc($data);
		$followers=$row['followers'];
		$publications=$row['publications'];
		$admin=$row['admin'];
		$prive=$row['prive'];
	?>

	<form method="POST" action="">

		<p>Pseudo:<?php echo $_SESSION['pseudo'];?></p>
		<p>Followers:<?php echo "$followers";?></p>
		<p>Publications:<?php echo "$publications";?></p>
		<p>Admin:<?php if($admin==0){echo "Non";}else{echo "Oui";};?></p>
		<p>Privé: <?php if($prive==false){echo "Non";}else{echo "Oui";}?></p>

		<input type="submit" name="mdp" value="Changer le mot de passe"> 
		<input type="submit" name="rpub" value="Rendre votre profil public">
		<input type="submit" name="rpri" value="Rendre votre profil privé">
	</form>
	<?php

		if(isset($_POST['mdp'])){
			header("Location:modif mdp.php");
			exit;
		}

		if(isset($_POST['rpub'])){
			if($prive==false){
				echo "<div class='erreur'>Votre profil est déjà public.</div>";
			}else{
				$up1="UPDATE profil SET prive=false WHERE pseudo='{$_SESSION['pseudo']}';";
				$up1=mysqli_query($conn,$up1);
				echo "<div class='succes'>Votre profil a été rendu public avec succès.</div>";
			}
		}

		if(isset($_POST['rpri'])){
			if($prive==true){
				echo "<div class='erreur'>Votre profil est déjà privé.</div>";
			}else{
				$up1="UPDATE profil SET prive=true WHERE pseudo='{$_SESSION['pseudo']}';";
				$up1=mysqli_query($conn,$up1);
				echo "<div class='succes'>Votre profil a été rendu privé avec succès.</div>";
			}
		}
	

		?>




</body>
</html>
