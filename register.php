<?php
session_start();
include 'includes/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen bg-blue-300">
    <div class="flex flex-col items-center justify-center w-[350px] h-[90vh] m-5 border-2  rounded-lg bg-white p-8">
        <h1 class="text-2xl font-bold mb-5">Register</h1>
        <form method="post">
            <label for="name">Name:</label>
            <input class="border border-gray-300 rounded-lg p-2 mb-2 w-full" type="text" name="name" id="name">
            <label for="username">Username:</label>
            <input class="border border-gray-300 rounded-lg p-2 mb-2 w-full" type="text" name="username" id="username">
            <label for="password">Password:</label>
            <input class="border border-gray-300 rounded-lg p-2 mb-2 w-full" type="password" name="password" id="password">
            <button class=" mb-5 w-full bg-blue-500 text-white p-2 rounded-lg" type="submit">Register</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $check = $pdo->query("SELECT * FROM users WHERE username='$username'");
            if ($check->rowCount() > 0) {
                echo "<p class='text-red-500 m-3'>Username already exists.</p>";
            } else {
                $sql = "INSERT INTO users (name, username, password) VALUES (:name, :username, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'name' => $name,
                    'username' => $username,
                    'password' => $password
                ]);

                if ($stmt->rowCount() > 0) {
                    echo "<p class='text-green-500 m-3'>Registered successfully! You can now login.</p>";
                } else {
                    echo "<p class='text-red-500 m-3'>Error: " . $pdo->errorInfo();
                }
            }
        }
        ?>
        <p>Already have an account? <a class="text-white p-2 hover:underline bg-blue-500 rounded-lg" href="login.php">Login</a>
    </div>



    </p>
</body>

</html>