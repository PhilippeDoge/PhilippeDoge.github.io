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
	<div class='split-container'>
	<div class='right'>
	<form class="suivre" method="POST" action="">

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
		</div>

			<div class= "left">
				<?php

					$getpost = "SELECT posts.id, posts.content, user.pseudo, posts.user_id 
					FROM posts 
					INNER JOIN user 
					ON posts.user_id = user.id 
					WHERE user.pseudo='{$_SESSION['pseudo']}' 
					ORDER BY posts.id DESC";
					$result = mysqli_query($conn, $getpost);

					while ($row = mysqli_fetch_assoc($result)) { 
				?>
				<div class='post'>
					<p>Posted by <?php echo $row['pseudo']; ?> : <?php echo $row['content']; ?></p>
					<form class="delete" method="post" action="">
						<input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
						<button class='delete' type="submit" name="delete_post">Supprimer</button>
					</form>

				</div>
				<?php } ?>
				<?php
					if (isset($_POST['delete_post'])) {
						$post_id = $_POST['post_id'];
						$delete_post_query = "DELETE FROM posts WHERE id='$post_id'";
						mysqli_query($conn, $delete_post_query);
						echo "<div class='succes'>Le post a été supprimé avec succès.</div>";
						header("Refresh:0");
					}
				?>
			</div>
		</div>



</body>
</html>
