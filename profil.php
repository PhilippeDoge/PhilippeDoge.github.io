<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profil</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<?php
		require_once "connect.php";
		$pseudo=$_GET['pseudo'];
		$pseudo2=$_GET['pseudo2'];
		echo "<h1>Profil de $pseudo2</h1>";
		//Récupère les données
		$getinfo="SELECT * FROM profil WHERE pseudo='$pseudo2';";
		$data=mysqli_query($conn,$getinfo);
		$row=mysqli_fetch_assoc($data);
		$followers=$row['followers'];
		$publications=$row['publications'];
		$admin=$row['admin'];

		echo "<a href=\"accueil.php?pseudo=".$pseudo."\">Retour en arrière</a>";
		?>

	<form method="POST" action="">
		<p>Pseudo:<?php echo "$pseudo2";?></p>
		<p>Followers:<?php echo "$followers";?></p>
		<p>Publications:<?php echo "$publications";?></p>
		<p>Admin:<?php if($admin==0){echo "Non";}else{echo "Oui";};?></p>
		<input type="submit" name="suivre" value="Suivre"> 
	</form>

	<?php
		if(isset($_POST['suivre'])){

			$update="UPDATE profil SET followers='$followers'+1 WHERE pseudo='$pseudo2'";

			$update=mysqli_query($conn,$update);
			echo "<div class='succes'>Utilisateur suivi</div>";

		}
		?>

</body>
</html>