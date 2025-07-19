<?php
session_start();
include 'includes/db.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $res = $pdo->query("SELECT * FROM users WHERE username='$username'");
    if ($res->rowCount() > 0) {
        $row = $res->fetch();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen bg-blue-300">
    <div class="flex flex-col items-center justify-center w-[350px] h-[90vh] m-5 border-2  rounded-lg bg-white">
        <h1 class="text-2xl font-bold mb-5">Login</h1>
        <form method="POST">
            Username: <input class="border border-gray-300 rounded-lg p-2 mb-2 w-full" type="text" name="username" required><br>
            Password: <input class="border border-gray-300 rounded-lg p-2 mb-2 w-full" type="password" name="password" required><br>
            <button class=" mb-5 w-full bg-blue-500 text-white p-2 rounded-lg" type="submit">Login</button>
        </form>
        <p>Don't have an account? <a class="text-white p-2 hover:underline bg-blue-500 rounded-lg" href="register.php">Register</a></p>
    </div>
</body>

</html>