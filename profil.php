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
		$followers=$row['follower'];
		$publications=$row['publication'];
		$admin=$row['admin'];
	?>
    <div class='split-container'>
	<a href="accueil.php">Retour à la page d'accueil</a>
    <div class='right'>
	<form class="suivre" method="POST" action="">
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
    </div>

    
    <div class='left'>
    <?php
        require_once "connect.php";

		$getpost = "SELECT posts.id, posts.content, user.pseudo 
		FROM posts 
		INNER JOIN user 
		ON posts.user_id = user.id 
		WHERE user.pseudo='{$_SESSION['pseudo_rec']}' 
		ORDER BY posts.id DESC";
        $result = mysqli_query($conn, $getpost);

        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class='post'>
                <p>Posted by <?php echo $row['pseudo']; ?> : <?php echo $row['content']; ?></p>
				<?php
					if ($_SESSION['padmin'] == '1') {
            	?>
					<form class="delete" method="post" action="">
							<input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
							<button class='delete' type="submit" name="delete_post">Supprimer</button>
					</form>
				<?php }
        			else {
						$is_owner = $row['pseudo'] == $_SESSION['pseudo'];
						if ($is_owner) {
				?>
				<form class="delete" method="post" action="">
                    <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                    <button class='delete' type="submit" name="delete_post">Supprimer</button>
                </form>
                <?php
					}
				}
						?>
					</div>
				<?php }?>
            </div>
		<?php
			if (isset($_POST['delete_post'])) {
				$post_id = $_POST['post_id'];
				$delete_post_query = "DELETE FROM posts WHERE id='$post_id'";
				mysqli_query($conn, $delete_post_query);
				echo "<div class='succes'>Le post a été supprimé avec succès.</div>";
				header("Location: {$_SERVER['HTTP_REFERER']}");
    			exit;
			}
		?>
    </div>

    </div>
    <

</body>
</html>
