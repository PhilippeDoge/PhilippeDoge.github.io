<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Page</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>

    <div class="container">
	<form method="POST" class='deco' action="">
			<input type="submit" name="deco" value="Déconnexion"><br>
			<input type="submit" name="profil" value="Votre profil">
	</form>
        <div>

            <!-- Barre de recherche -->
            <form class ="recherche" method="POST" action="">

                <input type="text" id="pseudo" name="pseudo">

                <input type="submit" name="rechercher" value="Rechercher">
            </form>

            <!-- Création de post -->
            <h1>Racontes nous ta vie</h1>
            <form class='creation' method="POST" action="">
                <label for="content">Contenu</label><br>
                <textarea type="text" id="content" name="content"></textarea><br>

                <input type="submit" name="post" value="Publier">

            </form>


            <!-- Retour page profil -->
            
        <?php
        	session_start();
        	if(isset($_POST['post'])){
        		require_once "creer post.php";

        	}

        	if(isset($_POST['rechercher'])){
        		require_once "recherche.php";
        	}

        	if(isset($_POST['deco'])){
        		header("Location: index.php");
       			exit();
       		}

        	if(isset($_POST['profil'])){
        		header("Location: profil perso.php");
        		exit();
        		}
        	?>
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
