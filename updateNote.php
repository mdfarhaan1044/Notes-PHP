<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Note</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen bg-blue-300">
    <div class="flex flex-col items-center justify-center w-[70%] h-[90vh] m-5 border-2  rounded-lg bg-white">
        <?php
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
                echo "Note updated successfully! <a class='text-white bg-blue-500 hover:underline p-2 rounded-lg m-2' href='index.php'>Back to Home</a>";
            } else if ($stmt->rowCount() == 0) {
                echo "No Changes Detected!<a class='text-white bg-blue-500 hover:underline p-2 rounded-lg m-2' href='index.php'>Back to Home</a>";
            } else {
                echo "Error: " . $pdo->errorInfo();
            }
        }

        $note = $pdo->query("SELECT * FROM notes WHERE id = {$_GET['id']}")->fetch();
        ?>
        <h1 class="text-2xl font-bold mb-5">Update Note</h1>


        <form class="flex flex-col w-[70%]" method="post">
            <label class="text-xl font-bold" for="title">Title:</label><input class="border border-gray-300 rounded-lg p-2 mb-2 w-full" type="text" name="title" value="<?= $note['title'] ?>" required><br>
            <label class="text-xl font-bold" for="content">Content:</label><textarea name="content" id="content" class="p-2 m-2 border-2 rounded-lg w-full"><?= $note['content'] ?></textarea>

            <input type="submit" value="Update Note" class="text-white p-2 hover:underline bg-blue-500 rounded-lg m-2 w-[20%]">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
        </form>


    </div>
</body>



</html>