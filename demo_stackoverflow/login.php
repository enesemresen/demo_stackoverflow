<?php
session_start();
include 'C:\xampp\htdocs\demo_stackoverflow\connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];

    $connection = new Connection();
    $sql="SELECT * FROM users WHERE email = '$email'";

    $q = $connection->connect()->prepare($sql);
    $q->execute();
    $user = $q->fetch(PDO::FETCH_ASSOC);//fetch sadece bir veri çeker, fetchAll bütün verileri çeker.

    if($user['email'] == $email && $user['password'] == $sifre){
        $_SESSION['id'] = $user['id'];
        header("location:profil.php");
    }else {
        
        header("location:login.php");
    }

    //print_r ($user);
    // inputlardan gelen email ve şifreyi database ile karşılaştıracağız.
    //$deneme = select * from tablo_adi where email = 'inputtan gelen email'

    // if($inputtan gelen mail == $daneme['mail'] && $inputtangelenpassword == $deneme['password']){
    //     $_SESSION['id'] = $deneme['id']
    // }
    // Kullanıcıyı doğrulamak için veritabanınızı sorgulayın.
    // Örnek bir sorgu:
    // $query = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$kullanici_adi' AND sifre = '$sifre'";
    
    // Sorguyu çalıştırın ve sonucu kontrol edin
    // Eğer kullanıcı doğru ise, oturum başlatın ve ana sayfaya yönlendirin
    // Eğer kullanıcı doğru değilse, hata mesajını gösterin veya yeniden giriş sayfasına yönlendirin.
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Giriş Ekranı</title>
</head>
<body>
    <h2>Giriş Yap</h2>
    <form method="POST" action="login.php">
        <label for="email">Kullanıcı Adı:</label>
        <input type="text" id="email" name="email" required><br><br>
        
        <label for="sifre">Şifre:</label>
        <input type="password" id="sifre" name="sifre" required><br><br>
        
        <input type="submit" value="Giriş Yap">
        <a href="create.php" class="btn btn-primary">Kayıt Ol</a>
    </form>
</body>
</html>