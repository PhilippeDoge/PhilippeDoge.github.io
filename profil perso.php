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
	?>

	<form method="POST" action="">

		<p>Pseudo:<?php echo $_SESSION['pseudo'];?></p>
		<p>Followers:<?php echo "$followers";?></p>
		<p>Publications:<?php echo "$publications";?></p>
		<p>Admin:<?php if($admin==0){echo "Non";}else{echo "Oui";};?></p>

		<input type="submit" name="mdp" value="Changer le mot de passe"> 
	</form>
	<?php

		if(isset($_POST['mdp'])){
			header("Location:modif mdp.php");
			exit;
		}

		?>




</body>
</html>
