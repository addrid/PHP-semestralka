<?php

session_start();

require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $hashed2 = password_hash($password2, PASSWORD_DEFAULT);
    $role = 'registered';
    $active = 1;

    // Ziskani uzivatele
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $stmt->execute(array($email));
    $id = $stmt->fetchAll()[0];
    $guest = 'guest';

    if ($id) {
        echo "Tato emailova adresa jiz existuje";
    }
    elseif (strcmp($password, $password2) !== 0) {
        echo "Both passwords must be the same.";
        header('Location: signup.php');
    } else {
        $stmt = $db->prepare("INSERT INTO users(email, password) VALUES (?, ?)");
        $stmt->execute(array($email, $hashed,));

        $stmt = $db->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt->execute(array($email));
        $user_id = (int)$stmt->fetchColumn();

        $_SESSION["email"] = $email;
        $_SESSION["id"] = $user_id;

        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>Football app</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
<div id="signup-box">
<h1>Football app</h1>

<h2>New Signup</h2>

<form action="" method="POST">

    <div id="signup-box-name" style="margin-top:20px;">Email<br/></div>
    <div id="signup-box-field" style="margin-top:20px;"><input type="text" name="email" pattern="^([0-9a-z]+@)([a-z]+)([.])([a-z].{1,4})" value="" required/></div>

    <div id="signup-box-name">Password<br/></div>
    <input type="password" name="password" value="" minlength="6" required /><br/><br/>

    <div id="signup-box-name">Password again<br/></div>
    <input type="password" name="password2" value="" minlength="6" required /><br/><br/>

    <div class="login-box-options">
    <input type="submit" value="Create Account"> <a href="/~navd00/index.php">Cancel</a>
    </div>
</form>
</div>
</body>

</html>
