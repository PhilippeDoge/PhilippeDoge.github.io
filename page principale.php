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
        <h1>racontes nous ta vie</h1>
        <form class='creation' method="post" action="">
            <label for="content">Contenu</label><br>
            <textarea type="text" id="content" name="content"></textarea><br>

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
                echo "<div class='succes'>post crée avec succée";
                } else {
                // Handle the error
                echo "Error: " . $conn->error;
                }
            }
        ?></div>
        
        <div class="middle">
        <?php
        require_once "connect.php";

        // Retrieve the list of users the current user follows
        $user_id = $_SESSION['id'];
        $query = "SELECT followed_id FROM follower WHERE follower_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Extract the followed users' IDs into an array
        $followed_users = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $followed_users[] = $row['followed_id'];
        }

        // Retrieve the posts from the followed users
        if (count($followed_users) > 0) {
            $followed_users_str = implode(',', $followed_users);
            $query = "SELECT posts.content, user.pseudo FROM posts 
                    INNER JOIN user ON posts.user_id = user.id 
                    WHERE user_id IN ($followed_users_str)";
            $result = mysqli_query($conn, $query);
        }
        ?>

        <h1>Posts from followed users</h1>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class='post'>
                <p>Posted by <?php echo $row['pseudo']; ?> : <?php echo $row['content']; ?></p>
            </div>
        <?php } ?></div>

        <div>Pub de merde</div>
    </div>
</body>
</html>