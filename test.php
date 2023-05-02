<?php
// Démarrage de la session
session_start();

// Vérification si l'utilisateur a soumis le formulaire
if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des identifiants de connexion dans une base de données
    $dsn = "mysql:host=localhost;dbname=ma_base_de_donnees;charset=utf8";
    $user = "mon_nom_d_utilisateur";
    $passwd = "mon_mot_de_passe";

    $db = new PDO($dsn, $user, $passwd);
    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':username' => $username,
        ':password' => $password,
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification si les identifiants de connexion sont valides
    if ($user) {
        // Enregistrement de l'utilisateur dans la session
        $_SESSION['user'] = $user;
        // Redirection vers la page d'accueil
        header('Location: index.php');
        exit();
    } else {
        // Affichage d'un message d'erreur si les identifiants sont invalides
        $message = "Nom d'utilisateur ou mot de passe incorrect";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Page de connexion</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<form action="test.php" method="post">
			<h2>Se connecter</h2>
			<label for="username">Nom d'utilisateur :</label>
			<input type="text" id="username" name="username" required>
			<label for="password">Mot de passe :</label>
			<input type="password" id="password" name="password" required>
			<input type="submit" value="Se connecter" name="submit">
		</form>
	</div>
</body>
</html>