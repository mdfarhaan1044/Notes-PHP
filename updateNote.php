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

    $sql = "UPDATE notes SET title = :title, content = :content WHERE user_id = :user_id AND id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'content' => $content,
        'user_id' => $user_id,
        'id' => $_POST['id']
    ]);
    if ($stmt->rowCount() > 0) {
        echo "Note updated successfully! <a href='index.php'>Back to Home</a>";
    } else {
        echo "Error: " . $pdo->errorInfo();
    }
}

$note = $pdo->query("SELECT * FROM notes WHERE id = {$_GET['id']}")->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Note</title>
</head>

<body>
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?= $note['title'] ?>">
        <label for="content">Content:</label>
        <textarea name="content" id="content"><?= $note['content'] ?></textarea>
        <input type="hidden" name="id" value="<?= $note['id'] ?>">
        <input type="submit" value="Update Note">
    </form>
</body>

</html>