<?php
include("baglan.php");

// Form gönderildiğinde
if(isset($_POST["uye"])) {
    // Formdan gelen verileri al
    $uye_adi = $_POST["uye_adi"];
    $uye_soyadi = $_POST["uye_soyadi"];
    $uye_mail = $_POST["uye_mail"];
    $uye_sifre = $_POST["uye_sifre"];
    $hash = password_hash($uye_sifre, PASSWORD_DEFAULT);

    // Veritabanında kullanıcı adının veya e-posta adresinin benzersiz olup olmadığını kontrol et
    $query_check = "SELECT * FROM uyeler WHERE uye_adi = '$uye_adi' OR uye_mail = '$uye_mail'";
    $result_check = mysqli_query($conn, $query_check);

    if(mysqli_num_rows($result_check) > 0) {
        // Kullanıcı adı veya e-posta adresi zaten kullanılıyorsa hata mesajı göster
        echo "Bu kullanıcı adı veya e-posta adresi zaten kullanılıyor.";
    } else {
        // Kullanıcıyı veritabanına ekle
        $query_insert = "INSERT INTO uyeler (uye_adi, uye_soyadi, uye_mail, uye_sifre) VALUES ('$uye_adi', '$uye_soyadi', '$uye_mail', '$uye_sifre')";
        $result_insert = mysqli_query($conn, $query_insert);

        if($result_insert) {
            // Kayıt başarıyla oluşturulduğunda başarılı mesajı göster ve ana sayfaya yönlendir
            echo "Kayıt başarıyla oluşturuldu.";
            header("Location: index.php");
            exit; // Kodun devamını engellemek için exit() fonksiyonunu kullanıyoruz
        } else {
            echo "Kayıt oluşturulurken bir hata oluştu: " . mysqli_error($conn); // Hata mesajı için bağlantı değişkenini kullan
        }
    }
}

mysqli_close($conn);
?>