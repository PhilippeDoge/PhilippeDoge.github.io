<?php
    require_once "connect.php";



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
		echo "<div class='succes'>post crée avec succès</div>";
	}else{
			// Handle the error
			echo "Error: " . $conn->error;
		}	
		
?>
