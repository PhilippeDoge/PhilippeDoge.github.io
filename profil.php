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
		$prive=$row['prive'];

		//Récupère l'id de l'utilisateur recherché
		$sel_id="SELECT id FROM user WHERE pseudo='{$_SESSION['pseudo_rec']}';";
		$getid=mysqli_query($conn,$sel_id);
		$result = mysqli_fetch_assoc($getid);
		$_SESSION['idp'] = $result['id'];

		//Vérifie si l'utilisateur est déjà suivi ou non
		$select="SELECT * FROM follower WHERE follower_id={$_SESSION['id']} AND followed_id={$_SESSION['idp']}";
		$result2=mysqli_query($conn,$select);


		echo "<a href=\"accueil.php\">Retour à la page d'accueil</a>";
		echo "<form method=\"POST\" action=\"\">";
		if($prive==true && mysqli_num_rows($result2)==0){
			echo "Le profil de l'utilisateur est privé. Veuillez le suivre afin de voir ses publications";
		}else{
			echo "<p>Pseudo:".$_SESSION['pseudo_rec']."</p>";
			echo "<p>Followers:".$followers."</p>";
			echo "<p>Publications:".$publications."</p>";
			if($prive==false){
				echo "Privé: Non";
			}else{
				echo "Privé: Oui";
			}
		}
	?>
		<input type="submit" name="suivre" value="Suivre"> 
		</form>
		

	<?php
		require_once "connect.php";

		if(isset($_POST['suivre'])){




			if(mysqli_num_rows($result2)>0){
    			echo "<div class='erreur'>Utilisateur déjà suivi.</div>";
			}else{
    			$update_p="UPDATE profil SET followers=followers WHERE pseudo='{$_SESSION['pseudo_rec']}';";
    			$insert="INSERT INTO follower(follower_id,followed_id) VALUES ('{$_SESSION['id']}','{$_SESSION['idp']}');";
    			mysqli_query($conn,$update_p);
    			mysqli_query($conn,$insert);
    			echo "<div class='succes'>Utilisateur suivi</div>";
				}
			}

		?>
		
	<?php
        require_once "connect.php";

        $getpost = "SELECT posts.content, user.pseudo 
        FROM posts 
        INNER JOIN user 
        ON posts.user_id = user.id 
        WHERE user.pseudo='{$_SESSION['pseudo_rec']}' 
        ORDER BY posts.id DESC";
        $result = mysqli_query($conn, $getpost);

        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class='post'>
                <p>Posted by <?php echo $row['pseudo']; ?> : <?php echo $row['content']; ?></p>
            </div>
        <?php }
    ?>

</body>
</html>
