<?php
session_start();
include 'C:\xampp\htdocs\demo_stackoverflow\connection.php';
$id = $_SESSION['id'];


$connection = new Connection();
$sql = "SELECT users.id,users.first_name,users.last_name,posts.title,posts.question,posts.id as posts_id
FROM users
INNER JOIN posts ON users.id=posts.user_id
where users.id =:id";

$q = $connection->connect()->prepare($sql);
$q->execute(['id'=>$id]); 
$item = $q->fetchAll(PDO::FETCH_ASSOC); 


$sql = "SELECT * FROM users where id =$id";

$q = $connection->connect()->prepare($sql); 
$q->execute(); 
$result = $q->fetch(PDO::FETCH_ASSOC);

// [
//     0 => ['id' => 13, 'firsnt_name' ='enes'],
//     1 => [],
//     2 => [],
//     3 => [],
// ]




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
    <h1><?php echo $result['first_name']." ".$result['last_name'] ?> Hoşgeldin </h1>
    <br>
    <a href="add_question.php" class="btn btn-primary">SORU EKLE</a>


    <div class="container">
    <br>

    <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Question</th>
                    <th scope="col">GÜNCELLE</th>
                    <th scope="col">SİL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($item as $i): ?>
                <tr>
                    <th><?php echo $i['posts_id'] ?></th>
                    <td><?php echo $i['title'] ?></td>
                    <td><?php echo $i['question'] ?></td>
                    <td><a class="btn btn-success" href="update.php?id=<?php echo $i['posts_id']?>">GÜNCELLE</a></td>
                    <td><a class="btn btn-danger" href="delete.php?id=<?php echo $i['posts_id']?>">SİL</a></td>
                </tr>
                <?php endforeach ?>
            </tbody>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>