<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <title>projetdemerde</title>
</head>
<body>
      <?php
            if (isset($_POST['submit'])) {
        // récupérer les données du formulaire
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $message = $_POST['message'];}
      ?>
      <form method="POST" action="">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message :</label>
            <textarea id="message" name="message" required></textarea>

            <input type="submit" name="submit" value="Envoyer">
      </form>
</body>
</html>