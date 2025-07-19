<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <?php include 'includes/db.inc.php';
    $notes = $pdo->query("SELECT * FROM notes WHERE user_id = {$_SESSION['user_id']}");
    ?>

    <h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
    <p>You can add notes here <a href="addNote.php">Add Note</a></p>

    <?php
    while ($note = $notes->fetch()) {
        echo "<div class='bg-red-500 p-4 mb-4'>";
        echo "<p>{$note['title']}</p>";
        echo "<p>{$note['content']}</p>";
        echo "<p>{$note['updated_at']}</p>";
        echo "<hr>";
        echo "<a href='updateNote.php?id={$note['id']}'>Update</a>";
        echo "<a href='deleteNote.php?id={$note['id']}'>Delete</a>";
        echo "</div>";
    }
    ?>
</body>

</html>


<a href="logout.php">Logout</a>