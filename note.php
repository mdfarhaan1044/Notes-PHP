<?php
include 'includes/db.inc.php';
session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $note_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $note = $pdo->query("SELECT * FROM notes WHERE id = $note_id AND user_id = $user_id")->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Note</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen bg-blue-300">
    <div class="p-4 m-5 border-2  rounded-lg bg-white">
        <header class="mb-5 flex flex-col justify-evenly items-center">
            <h1 class="text-2xl font-bold">Title: <?php echo $note['title']; ?></h1>
            <p><strong>Updated At:</strong> <?php echo $note['updated_at']; ?></p>
        </header>
        <main class="p-4 m-5 border-2  rounded-lg bg-white">
            <p class=""><?php echo $note['content']; ?></p>
        </main>
        <div class="flex justify-end">
            <a class="text-white p-2 hover:underline bg-blue-500 rounded-lg m-2 " href="updateNote.php?id=<?php echo $note['id']; ?>">Update</a>
            <a class="text-white p-2 hover:underline bg-red-500 rounded-lg m-2 " href="deleteNote.php?id=<?php echo $note['id']; ?>">Delete</a>
        </div>
    </div>
</body>

</html>