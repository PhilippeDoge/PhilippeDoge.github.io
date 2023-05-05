<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Créer votre post</title>
    <link href="style.css" rel="stylesheet">
<body>
	<h1>Create a Post</h1>
	<form method="post" action="">
		<label for="content">Content:</label><br>
		<textarea id="content" name="content"></textarea><br>

		<input type="submit" value="Create post">
	</form>

    <?php
		session_start();
        require_once "connect.php";


		// Check if the form has been submitted
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Get the current user ID from the session
			$user_id = $_SESSION['id'];
		
			// Get the post data from the form
			$content = $_POST['content'];
		
			// Prepare and execute the SQL statement to insert a new post
			$stmt = $conn->prepare("INSERT INTO posts (content, user_id) VALUES (?, ?)");
			$stmt->bind_param("ss",$content, $user_id);
			$stmt->execute();
		
			// Check if the post was inserted successfully
			if ($stmt->affected_rows > 0) {
			// Redirect the user to the post page
			echo "post crée avec succée";
			} else {
			// Handle the error
			echo "Error: " . $conn->error;
			}
		}
		
		// Close the database connection
		$conn->close();
    ?>
</body>
</html>