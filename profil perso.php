<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profil personnel</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1>Votre profil</h1>
	<?php
		require_once "connect.php";
		$pseudo=$_GET['pseudo'];
		echo "<a href=\"accueil.php?pseudo=".$pseudo."\">Retour en arrière</a>";

		/*Récupère les données
		$getinfo="SELECT * FROM profil WHERE pseudo='$pseudo';";
		$data=mysqli_query($conn,$getinfo);
		$row=mysqli_fetch_assoc($data);
		$followers=$row['followers'];
		$publications=$row['publications'];
		$admin=$row['admin'];
		*/
	
		 echo "<div class='profil'> 
        	insere les données recuperées ici <br>
        	une autre ici etc..<br>
        	</div>";
		//pense a aller check style ducoup
	?>

	<form method="POST" action="">

		<input type="submit" name="mdp" value="Changer le mot de passe"> 
	</form>
	<?php

		if(isset($_POST['mdp'])){
			header("Location:modif mdp.php?pseudo=$pseudo");
			exit;
		}

		?>




</body>
</html>
