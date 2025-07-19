<?php
session_start();
include 'includes/db.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $pdo->query("SELECT * FROM users WHERE username='$username'");
    if ($check->rowCount() > 0) {
        echo "Username already exists.";
    } else {
        $sql = "INSERT INTO users (name, username, password) VALUES (:name, :username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'username' => $username,
            'password' => $password
        ]);

        if ($stmt->rowCount() > 0) {
            echo "Registered successfully! You can now <a href='login.php'>login</a>.";
        } else {
            echo "Error: " . $pdo->errorInfo();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form method="post">


        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Register">
    </form>


    <p>Already have an account? <a href="login.php">Login</a>

    </p>
</body>

</html>