<?php
session_start();
include 'C:\xampp\htdocs\demo_stackoverflow\connection.php';
$id = $_SESSION['id'];


$connection = new Connection();
$sql = "SELECT * FROM users WHERE id = $id";

$q = $connection->connect()->prepare($sql);
$q->execute(); 
$user = $q->fetch(PDO::FETCH_ASSOC); 
//print_r($user);
$sql_soru = "SELECT * FROM posts";

$q_soru = $connection->connect()->prepare($sql_soru);
$q_soru->execute(); 
$sorular = $q_soru->fetchAll(PDO::FETCH_ASSOC); 
//print_r($sorular);



?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>index.php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <br><br>
    <div class="container">
      <a href="login.php" class="btn btn-success">Giriş Yap</a>
      <a href="create.php" class="btn btn-primary">Kayıt Ol</a>
    </div>

    <div class="container">
    <br>

    
    <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Konu id</th>
                    <th scope="col">Konu Başlığı</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sorular as $soru): ?>
                <tr>
                    <th><?php echo $soru['id'] ?></th>
                    <td><a href="details.php?post_id=<?php echo $soru['id']?>"><?php echo $soru['title'] ?></a></td>
              
                </tr>
                <?php endforeach ?>
            </tbody>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>