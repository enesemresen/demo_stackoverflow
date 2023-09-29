<?php
session_start();
include 'C:\xampp\htdocs\demo_stackoverflow\connection.php';

@$id = $_GET["id"];
$deneme = $id;
$connection = new Connection();
$sql_get = "SELECT * FROM posts WHERE id=:id";
$q_get = $connection->connect()->prepare($sql_get);
$q_get->execute(['id'=>$id]);
$degisken = $q_get->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["updateSubmit"])){
    echo "deneme". '<br>';
    $title = $_POST['title'];
    $question = $_POST['question'];

    $connection = new Connection();
    $sql = "UPDATE posts SET title=:title,question=:question WHERE id=:id";
    $q = $connection->connect()->prepare($sql);
    $q-> execute([
        'id'=>$id,
        'title'=>$title,
        'question'=>$question
    ]);
    if($q->rowCount()){
        header("location:profil.php");
    }
    
}


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>update.php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Başlık</label>
                <input type="text" class="form-control" name="title" value="<?php echo $degisken['title']?>">
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">Soru</label>
                <input type="text" class="form-control" name="question" value="<?php echo $degisken['question']?>">
            </div>
           
            <input type="submit" class="btn btn-primary" name="updateSubmit" value="KAYDET">
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>