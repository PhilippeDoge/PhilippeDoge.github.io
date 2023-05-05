<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Rechercher des utilisateurs</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1>Rechercher des utilisateurs</h1>
	<?php
	require_once "connect.php";
		$pseudo=$_GET['pseudo'];
		echo "<a href=\"accueil.php?pseudo=".$pseudo."\">Retour en arrière</a>";
		?>
	<form method="POST" action="">

		<label for="recherche">Saisissez le nom de l'utilisateur que vous souhaitez rechercher:</label>
		<input type="text" id="pseudo" name="pseudo" required>

		<input type="submit" name="rechercher" value="Rechercher">
	</form>

	<?php
		require_once "connect.php";

		 if(isset($_POST['rechercher'])){
		 	$pseudo2=$_POST['pseudo'];

		 	$select="SELECT * FROM profil WHERE pseudo='$pseudo2'";

		 	$get=mysqli_query($conn,$select);

		 	if(mysqli_num_rows($get)>0){
		 		header("Location: profil.php?pseudo=$pseudo&pseudo2=$pseudo2");
		 		exit();
		 	}else{
		 		echo "<div class='erreur'>Utilisateur introuvable.</div>";
		 	}
		 }
	?>

</body>
</html>