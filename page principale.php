<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Page</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div>
            <!-- Barre de recherche -->
            <form class ="recherche" method="POST" action="">

                <input type="text" id="pseudo" name="pseudo">

                <input type="submit" name="rechercher" value="Rechercher">
            </form>

            <!-- Création de post -->
            <h1>racontes nous ta vie</h1>
            <form class='creation' method="post" action="">
                <label for="content">Contenu</label><br>
                <textarea type="text" id="content" name="content"></textarea><br>

                <input type="submit" value="Create post">
            </form>

            <?php
                require_once "creer post.php";

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

            <!-- Retour page profil -->
            <input class='pageprofil' type="submit" value="Retour Page Profil">
        </div>
        
        <div class="middle">
            <?php
            require_once "voir poste.php";
            ?>
        </div>

        <div>
            Pub de merde
        </div>
    </div>
</body>
</html>
