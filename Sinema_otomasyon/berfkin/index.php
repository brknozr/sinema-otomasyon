<?php
include("baglan.php");

// Form gönderildiğinde
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen kullanıcı adı ve şifre bilgileri
    $uye_adi = $_POST['uye_adi'];
    $uye_soyadi = $_POST['uye_soyadi'];
    $uye_mail = $_POST['uye_mail'];
    $uye_sifre = $_POST['uye_sifre'];

    // Kullanıcı adı, soyadı ve şifre alanlarının doldurulduğunu kontrol etme
    if(empty($uye_adi) || empty($uye_soyadi) || empty($uye_sifre)) {
        echo "Lütfen kullanıcı adı, soyadı ve şifre alanlarını doldurun.";
    } else {
        // Veritabanında kullanıcıyı kontrol et
        $sql = "SELECT * FROM uyeler WHERE uye_adi = '$uye_adi' AND uye_soyadi = '$uye_soyadi'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        // Eğer kullanıcı bulunamazsa
        if($count == 0) {
            echo "Bu kullanıcı adı ve soyadıyla kayıtlı bir hesap bulunamadı. Lütfen üye olun.";
        } else {
            // Kullanıcı bulunduysa, şifre kontrolü yap
            $row = mysqli_fetch_assoc($result);
            if($uye_sifre != $row['uye_sifre']) {
                echo "Girdiğiniz şifre yanlış. Lütfen tekrar deneyin.";
            } else {
                // Giriş başarılı, ilgili işlemlere devam et
                header("Location: islemler.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sinema Otomasyonu</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/index.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #eee8aa;
			margin: 0;
			padding: 0;
		}

		.container {
			width: 80%;
			margin: 0 auto;
		}

		.header {
    background-color: #b8860b; /* Arka plan rengi */
    color: white; /* Yazı rengi */
    font-family: 'Roboto', fantasy; /* Estetik yazı tipi fontu */
    padding: 20px;
		}

		.header h2 {
			margin: 0;
		}

		.tableouter {
			text-align: center;
			margin-top: 50px;
		}

		input[type="text"],
		input[type="password"],
		button {
			padding: 10px;
			margin: 5px;
			border-radius: 5px;
			border: none;
		}
button {
			background-color: 	#556b2f;
			color: white;
			cursor: pointer;
		}

		button:hover {
			background-color: #ffa500;
		}

		button#giris {
    background-color: #8fbc8f; /* Arka plan rengi */
    color: white; /* Yazı rengi */
    border: none; /* Kenarlık yok */
    padding: 10px 20px; /* Düğme boyutu */
    border-radius: 5px; /* Köşe yuvarlama */
    cursor: pointer; /* İmleç tipi */
}

button#giris:hover {
    background-color: #ffa500; /* Hover rengi */
		a {
			text-decoration: none;
		}
	</style>
</head>
<body>
	<header class="header">
		<h2>FinKin Sinema</h2>
	</header>
	<div class="tableouter">
		<form action="" method="post">
			<input type="text" name="uye_adi" placeholder="Kullanıcı Adı">
			<input type="text" name="uye_soyadi" placeholder="Soyadı">
			<input type="email" name="uye_mail" placeholder="Eposta">
			<input type="password" name="uye_sifre" placeholder="Şifre">
			<button type="submit" class="sub" id="giris" name="giris">Giriş Yap</button>
		</form>
		<a href="uyeol.php"><button type="submit" class="sub">Üye Ol</button></a>
                <a href="yonetici_paneli.php"><button type="button" class="sub">Yönetici Paneli</button></a>

	</div>
</body>
</html>
