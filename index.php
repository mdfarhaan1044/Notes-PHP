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
    <div>

        <?php include 'includes/db.inc.php';
        $notes = $pdo->query("SELECT * FROM notes WHERE user_id = {$_SESSION['user_id']}");
        ?>
        <header class="flex justify-between p-4 m-5 border-2  rounded-lg bg-white">
            <h1>Welcome,<span class="text-2xl font-bold"> <?php echo $_SESSION['user']; ?>!</span></h1>
            <a href="logout.php">Logout</a>
        </header>
        <div class="flex p-4 m-5 border-2  rounded-lg bg-white justify-between">
            <p>You can add notes here <span class="text-blue-500 hover:underline cursor-pointer"><a href="addNote.php">Add Note</a></span></p>
        </div>

        <?php
        while ($note = $notes->fetch()) {
            echo "<div class='p-4 m-5 border-2  rounded-lg bg-white'>";
            echo "<div class=''>";
            echo "<p><span class='font-bold'>Title:</span> {$note['title']}</p>";
            echo "<p class='truncate max-w-[70%]'><span class='font-bold'>Content:</span> {$note['content']}</p>";
            echo "<p><span class='font-bold'>Updated At:</span> {$note['updated_at']}</p>";
            echo "<hr>";
            echo "</div>";
            echo "<div class='flex justify-end'>";
            echo "<a type='button' class='text-white p-2 hover:underline bg-green-500 rounded-lg m-2 ' href=note.php?id={$note['id']}>View</a>";
            echo "<a type='button' class='text-white p-2 hover:underline bg-blue-500 rounded-lg m-2 ' href=updateNote.php?id={$note['id']}>Update</a>";
            echo "<a type='button' class='text-white p-2 hover:underline bg-red-500 rounded-lg m-2 ' href=deleteNote.php?id={$note['id']}>Delete</a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>