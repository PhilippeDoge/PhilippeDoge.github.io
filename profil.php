<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profil</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<?php
	session_start();
		require_once "connect.php";
		echo "<h1>Profil de ".$_SESSION['pseudo_rec']."</h1>";
		//Récupère les données
		$getinfo="SELECT * FROM profil WHERE pseudo='{$_SESSION['pseudo_rec']}';";
		$data=mysqli_query($conn,$getinfo);
		$row=mysqli_fetch_assoc($data);
		$followers=$row['followers'];
		$publications=$row['publications'];
		$admin=$row['admin'];
	?>

	<a href="accueil.php">Retour à la page d'accueil</a>
	<form method="POST" action="">
		<p>Pseudo:<?php echo $_SESSION['pseudo_rec'];?></p>
		<p>Followers:<?php echo $followers;?></p>
		<p>Publications:<?php echo $publications;?></p>
		<p>Admin:<?php if($admin==0){echo "Non";}else{echo "Oui";};?></p>
		<input type="submit" name="suivre" value="Suivre"> 
	</form>

	<?php
		require_once "connect.php";

		if(isset($_POST['suivre'])){


			//Récupère l'id de l'utilisateur recherché
			$sel_id="SELECT id FROM user WHERE pseudo='{$_SESSION['pseudo_rec']}';";
			$getid=mysqli_query($conn,$sel_id);
			$result = mysqli_fetch_assoc($getid);
			$_SESSION['idp'] = $result['id'];

			//Vérifie si l'utilisateur est déjà suivi ou non
			$select="SELECT * FROM follower WHERE follower_id={$_SESSION['id']} AND followed_id={$_SESSION['idp']}";
			$result2=mysqli_query($conn,$select);

			if(mysqli_num_rows($result2)>0){
    			echo "<div class='erreur'>Utilisateur déjà suivi.</div>";
			}else{
    			$update_p="UPDATE profil SET followers='$followers'+1 WHERE pseudo='{$_SESSION['pseudo_rec']}';";
    			$insert="INSERT INTO follower(follower_id,followed_id) VALUES ('{$_SESSION['id']}','{$_SESSION['idp']}');";
    			mysqli_query($conn,$update_p);
    			mysqli_query($conn,$insert);
    			echo "<div class='succes'>Utilisateur suivi</div>";
				}
			}
		?>

</body>
</html>
