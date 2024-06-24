<!DOCTYPE html>
<html>
<head>
    <title>Bilet Seç</title>
    <style>
       body {
    font-family: Serif, Georgia;
    background-color: #2f4f4f;
    margin: 0;
    padding: 0;
}
.container {
    text-align: center;
    margin-top: 50px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
.film-poster {
    width: 150px;
    height: auto;
    margin-bottom: 20px;
    border-radius: 10px;
}
.aciklama {
    text-align: justify;
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}
.aciklama p {
    margin: 0;
}
.seans-btn {
    padding: 10px 20px;
    background-color: #556b2f;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 16px;
    margin: 5px;
}
.seans-btn:hover {
    background-color: #2f4f4f;
}

    </style>
</head>
<body>

<div class="container">
    <?php
    // Veritabanı bağlantısı
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sinema";

    // Veritabanı bağlantısını oluştur
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
    }

    // Form submit edildiğinde
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Seçilen film ID'sini al
        $film_id = $_POST['film_id'];

        // Seçilen tarih ve seans bilgilerini al
        $seans_tarihi = $_POST['seans_tarihi'];
        $seans_saat = $_POST['seans_saat'];

        // Bilet seçim sayfasına yönlendirme yap
        header("Location: biletsecrez.php?film_id=$film_id&seans_tarihi=$seans_tarihi&seans_saat=$seans_saat");
        exit;
    }

    // Form gösterimi
    // Film ID'sini al
    $film_id = $_GET['film_id'];

    // Filmi ve salon bilgisini veritabanından çek
    $sql = "SELECT filmler.*, salon.salon_adi, salon.salon_kapasite, salon.koltuk_sayisi FROM filmler INNER JOIN salon ON filmler.salon_id = salon.id WHERE filmler.id = $film_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h1>{$row['film_adi']}</h1>";
        echo "<img src='afisler/{$row['afis']}' alt='{$row['film_adi']}' class='film-poster'>";
        echo "<div class='aciklama'>";
        echo "<p>{$row['aciklama']}</p>"; 
        echo "</div>";

        // Tarih ve Seans Seçim Formu
        echo "<div>";
        echo "<h2>Tarih ve Seans Seç</h2>";
        echo "<form action='' method='post'>";

        echo "<input type='hidden' name='film_id' value='$film_id'>"; 

        // Tarih seçim kısmı
        echo "<label>Tarih:</label><br>";
        echo "<select name='seans_tarihi'>";
        $sql_tarih = "SELECT * FROM tarih";
        $result_tarih = $conn->query($sql_tarih);
        if ($result_tarih->num_rows > 0) {
            while ($row_tarih = $result_tarih->fetch_assoc()) {
                $tarih = $row_tarih['tarih'];
                echo "<option value='$tarih'>$tarih</option>";
            }
        } else {
            echo "<option value=''>Tarih bilgisi bulunamadı.</option>";
        }
        echo "</select>";

        // Seans saatleri seçim kısmı
        echo "<br><label>Seans Saati:</label><br>";
        $seans_saatleri = array("11:00", "18:00", "20:00", "23:00");
        foreach ($seans_saatleri as $seans_saat) {
            echo "<input type='radio' id='$seans_saat' name='seans_saat' value='$seans_saat'>";
            echo "<label for='$seans_saat'>$seans_saat</label><br>";
        }

        echo "<br><button type='submit' class='seans-btn'>Seç</button>";
        echo "</form>";
        echo "</div>";

        // Salon bilgisini göster
        echo "<div>";
        echo "<h2>Salon Bilgisi</h2>";
        echo "<p>Salon Adı: {$row['salon_adi']}</p>";
        echo "<p>Salon Kapasitesi: {$row['salon_kapasite']} kişi</p>";
        echo "<p>Koltuk Sayısı: {$row['koltuk_sayisi']}</p>";
        echo "</div>";
    } else {
        echo "<p>Seçilen film bulunamadı.</p>";
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>
</div>

</body>
</html>


