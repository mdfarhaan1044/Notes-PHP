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
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div>
        <header>
            <h1>View Note</h1>
        </header>
        <main>
            <p><?php echo $note['content']; ?></p>
        </main>
        <footer>
            <button class="text-white p-2 hover:underline bg-blue-500 rounded-lg m-2 " href="updateNote.php?id=<?php echo $note['id']; ?>">Update</button>
            <button class="text-white p-2 hover:underline bg-red-500 rounded-lg m-2 " href="deleteNote.php?id=<?php echo $note['id']; ?>">Delete</button>
        </footer>
    </div>
</body>

</html>