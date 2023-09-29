<?php
session_start();
include 'C:\xampp\htdocs\demo_stackoverflow\connection.php';

$user_id = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $question = $_POST["question"];

    $connection = new Connection();
    $sql = "INSERT INTO posts (`user_id`,`title`,`question`) VALUES(:user_id,:title,:question)";
    $q = $connection->connect()->prepare($sql);
    $q->execute([
        'user_id' =>  $user_id,
        'title' => $title,
        'question' => $question]);
    
    header("location:profil.php");
}   
?>


<!DOCTYPE html>
<html>
<head>
    <title>Soru Ekleme Ekranı</title>
</head>
<body>
    <h2>Soru Ekle</h2>
    <form method="POST" action="add_question.php">


        <label for="title">Başlık:</label>
        <input type="title" id="title" name="title" required><br><br>

        <label for="question">Soru: </label>
        <input type="question" id="question" name="question" required><br><br>

        <input type="submit" value="Soru Ekle">
    </form>
</body>
</html>