<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM notes WHERE user_id = :user_id AND id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'id' => $id
    ]);
    if ($stmt->rowCount() > 0) {
        echo "Note deleted successfully! <a href='index.php'>Back to Home</a>";
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
    <title>Delete Note</title>
</head>

<body>
    <form method="post">
        <input type="hidden" name="id" value="<?= $note['id'] ?>">
        <input type="submit" value="Delete Note">
    </form>
</body>

</html>