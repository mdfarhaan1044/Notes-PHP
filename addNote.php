<?php
session_start();

if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.inc.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO notes (title, content, user_id) VALUES (:title, :content, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'content' => $content,
        'user_id' => $user_id
    ]);
    if ($stmt->rowCount() > 0) {
        echo "Note added successfully! <a href='index.php'>Back to Home</a>";
    } else {
        echo "Error: " . $pdo->errorInfo();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Note</title>
</head>

<body>

    <form method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
        <label for="content">Content:</label>
        <textarea name="content" id="content"></textarea>
        <input type="submit" value="Add Note">
    </form>
</body>

</html>