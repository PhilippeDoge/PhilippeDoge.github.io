<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Page d'accueil</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
<?php
    session_start();
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

<!DOCTYPE html>
<html>
<head>
    <title>Posts from followed users</title>
</head>
<body>
    <h1>Posts from followed users</h1>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div>
            <p><?php echo $row['content']; ?></p>
            <p>Posted by user <?php echo $row['pseudo']; ?></p>
        </div>
    <?php } ?>
</body>
</html>

</html>