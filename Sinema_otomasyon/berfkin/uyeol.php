<?php
include("baglan.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>FinKin Sinema</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/indexuye.css">
</head>
<body>
    <header>
        <h2>FinKin Sinema</h2>
    </header>
    <h2>Üye Ol</h2>
    <div class="tableouter"><br><br>  
        <form action="kayit.php" method="post">
            <input type="text" name="uye_adi" placeholder="Kullanıcı Adı" required="">
            <input type="text" name="uye_soyadi" placeholder="Soyadı" required="">
            <input type="email" name="uye_mail" placeholder="Eposta" required="">
            <input type="password" name="uye_sifre" placeholder="Şifre" required="">
            <button type="submit" class="sub" id="giris" name="uye">Üye ol</button>
        </form>
        <a href="index.php"><button type="submit" class="sub" id="uye">Geri Çık</button></a>
    </div><br>
</body>
</html>