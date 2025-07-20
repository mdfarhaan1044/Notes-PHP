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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen bg-blue-300">
    <div class="flex flex-col">
        <h1 class="text-2xl font-bold mb-5">Are you sure you want to delete this note?</h1>
        <form class="flex flex-row gap-5 justify-center" method="post">
            <input class="mb-5" type="hidden" name="id" value="<?= $note['id'] ?>">
            <input class="p-3 px-5 rounded-lg bg-red-500 hover:bg-red-600 text-white" type="submit" value="Yes">
            <a href="index.php" class="p-3 px-5 rounded-lg bg-gray-500 hover:bg-gray-600 text-white">No</a>
        </form>
    </div>
</body>

</html>