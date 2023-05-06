<?php
	require_once "connect.php";

	if(isset($_POST['rechercher'])){
		 $pseudo=$_POST['pseudo'];
		 if($pseudo==$_SESSION['pseudo']){
		 	header("Location: profil perso.php");
		 	exit();
		 }else{
		 	//Récupère les informations dans la table user
		 	$select="SELECT * FROM profil WHERE pseudo='$pseudo';";
			$get=mysqli_query($conn,$select);

		 	if(mysqli_num_rows($get)>0){
		 		$_SESSION['pseudo_rec']=$pseudo;
		 		header("Location: profil.php");
		 		exit();
		 	}else{
		 		echo "<div class='erreur'>Utilisateur introuvable.</div>";
		 	}
		 }
	}
?>
