<?php
session_start();
include 'C:\xampp\htdocs\demo_stackoverflow\connection.php';
$id = $_GET["id"];

if(isset($_POST["onayla"])){
    $connection = new Connection();
    $sql = "DELETE FROM posts where `id`=:id";

    $q = $connection->connect()->prepare($sql); 
    $q->execute(['id'=>$id]); 

    header("location:profil.php");
    
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>profil.php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    
    <form action="" method="POST">

    <a class="btn btn-warning "href="profil.php ?>">VAZGEÇ</a>
    <button type="submit" name="onayla" class="btn btn-danger">ONAYLA</button>

    </form>
    
        
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>