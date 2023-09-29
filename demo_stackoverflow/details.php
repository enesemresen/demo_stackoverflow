<?php
session_start();
include 'C:\xampp\htdocs\demo_stackoverflow\connection.php';
$post_id = $_GET["post_id"];
$user_id = $_SESSION["id"];


$connection = new Connection();
$sql = "SELECT users.id, users.first_name, users.last_name, comments.id AS comment_id, comments.user_id, comments.text
FROM users
LEFT JOIN comments ON users.id = comments.user_id
WHERE comments.post_id = :id";

$q = $connection->connect()->prepare($sql);
$q->execute(['id'=>$post_id]);
$soru = $q->fetchAll(PDO::FETCH_ASSOC);

$sql_postDetay = "SELECT * FROM posts INNER JOIN users ON users.id = posts.user_id WHERE posts.id =:id1";

$q_postDetay = $connection->connect()->prepare($sql_postDetay);
$q_postDetay->execute(['id1'=>$post_id]);
$detay = $q_postDetay->fetch(PDO::FETCH_ASSOC);

print_r($detay);


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $text = $_POST["text"];
    
    $sql_yorum = "INSERT INTO comments (`user_id`,`post_id`,`text`) VALUES(:user_id,:post_id,:text)";
    
    $q_yorum= $connection->connect()->prepare($sql_yorum);
    $q_yorum->execute([
        'user_id' =>  $user_id,
        'post_id' => $post_id,
        'text' => $text]);
    header("location:details.php?post_id=".$post_id);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <h1>Detaylar</h1>
    <h3><?php echo $detay['first_name'] . " " . $detay['last_name']?></h3>
    

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>Post id: <?php echo $detay['id'] ?></h4>
                    <h4>Başlık: <?php echo $detay['title'] ?></h4>
                    <p>Soru: <?php echo $detay['question'] ?></p>
                </div>
            </div>
        </div>



        <div><?php ?></div>
        <div class="container">
            <form action="" method="post">
                <input type="text" name="text" value="">
                <input type="submit" name="yorum_ekle" class="btn btn-success" value="Yorum Ekle">
            </form>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php foreach($soru as $s): ?>
                    <h4>İsim: <?php echo $s['first_name'] ?></h4>
                    <h4>Yorum: <?php echo $s['text'] ?></h4>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>