<?php
session_start();
include 'C:\xampp\htdocs\demo_stackoverflow\connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $connection = new Connection();
    $sql = "INSERT INTO users (`first_name`,`last_name`,`email`,`password`) VALUES(:first_name,:last_name,:email,:password)";
    $q = $connection->connect()->prepare($sql);
    $q->execute([
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => $password]);

}   
?>


<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ekranı</title>
</head>
<body>
    <h2>Kayıt Ol</h2>
    <form method="POST" action="create.php">
        <label for="first_name">Ad:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Soyad:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="email">E-posta:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Kayıt Ol">
    </form>
</body>
</html>
