<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilet Sat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 80%;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            width: calc(100% - 22px);
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Bilet Al</h1>

    <?php
    // Veritabanı bağlantısını oluşturalım
    $servername = "localhost"; // sunucu adı
    $username = "root"; // veritabanı kullanıcı adı
    $password = ""; // veritabanı şifre
    $dbname = "sinema"; // kullanılacak veritabanı adı

    // Veritabanı bağlantısını oluştur
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
    }

    // Kullanıcının seçtiği verileri alalım
    $film_id = isset($_POST['film_id']) ? $_POST['film_id'] : (isset($_GET['film_id']) ? $_GET['film_id'] : null);
    $seans_saat = isset($_POST['seans_saat']) ? $_POST['seans_saat'] : (isset($_GET['seans_saat']) ? $_GET['seans_saat'] : null);
    $seans_tarihi = isset($_POST['seans_tarihi']) ? $_POST['seans_tarihi'] : (isset($_GET['seans_tarihi']) ? $_GET['seans_tarihi'] : null);
    $secilen_koltuklar = isset($_POST['secilen_koltuk']) ? $_POST['secilen_koltuk'] : array();

    // Eğer gerekli bilgiler sağlanmadıysa kullanıcıya uyarı verelim
    if (!$film_id || !$seans_saat || !$seans_tarihi || empty($secilen_koltuklar)) {
        echo "<p>Gerekli bilgilere erişilemedi. Lütfen tekrar deneyin.</p>";
        // Gerekli bilgiler sağlanmadığı için işlemi durduralım
        exit;
    }

    // Random 6 haneli bir bilet kimlik numarası oluştur
    $bilet_kimlik = sprintf("%06d", mt_rand(1, 999999));

    // Formdan gelen bilgileri ekranda gösterelim
    // Film adını ve fiyatını veritabanından sorgulayalım
    $sql_film = "SELECT film_adi, fiyat FROM filmler WHERE id = $film_id";
    $result_film = $conn->query($sql_film);
    if ($result_film->num_rows > 0) {
        $row_film = $result_film->fetch_assoc();
        $film_adi = $row_film['film_adi'];
        $fiyat = $row_film['fiyat'];

        echo "<p>Film Adı: $film_adi</p>";
        echo "<p>Fiyat: $fiyat TL</p>"; // Fiyatı görüntüle
    } else {
        echo "<p>Film bulunamadı.</p>";
    }

    echo "<p>Seans Saati: $seans_saat</p>";
    echo "<p>Seans Tarihi: $seans_tarihi</p>";
    echo "<p>Seçilen Koltuklar: " . implode(", ", $secilen_koltuklar) . "</p>";

    // Bilet kimlik numarasını ekranda göster
    echo "<p>Bilet Kimlik Numarası: $bilet_kimlik</p>";

    // Ödeme bilgilerini gönderilmişse
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kart_numarasi']) && isset($_POST['son_kullanma_tarihi']) && isset($_POST['cvv'])) {
        // Ödeme bilgilerini al
        $kart_numarasi = $_POST['kart_numarasi'];
        $son_kullanma_tarihi = $_POST['son_kullanma_tarihi'];
        $cvv = $_POST['cvv'];

        // Ödeme bilgilerini veritabanına ekle
        $sql_odeme = "INSERT INTO odemeler (kart_numarasi, son_kullanma_tarihi, cvv) VALUES ('$kart_numarasi', '$son_kullanma_tarihi', '$cvv')";
        if ($conn->query($sql_odeme) === TRUE) {
            echo "<p>Ödeme bilgileri başarıyla eklendi.</p>";

            // Rezervasyon bilgilerini al
            // Üye girişi yapılmışsa uygun üye_id alınmalıdır, aşağıdaki örnek bu durumu göz ardı eder
            $uye_id = 1; // Örnek olarak 1 kullanıcı id'sini kullanıyoruz
            $secilen_koltuklar = implode(",", $secilen_koltuklar);

            // Rezervasyon bilgilerini veritabanına ekle
            $sql_rezervasyon = "INSERT INTO rezervasyonlar (film_id, uye_id, seans_saati, koltuk_no, bilet_kimlik) VALUES ('$film_id', '$uye_id', '$seans_saat', '$secilen_koltuklar', '$bilet_kimlik')";
            if ($conn->query($sql_rezervasyon) === TRUE) {
                echo "<p>Rezervasyon başarıyla oluşturuldu.</p>";

                // Ödeme alındıktan sonra "Bilet İptali İçin Tıkla" butonunu göster
                echo "<form action='bilet_iptal.php'><input type='submit' value='Bilet İptali İçin Tıkla'></form>";
            } else {
                echo "<p>Rezervasyon oluşturulurken hata oluştu: " . $conn->error . "</p>";
            }
        } else {
            echo "<p>Ödeme bilgileri eklenirken hata oluştu: " . $conn->error . "</p>";
        }
    } else {
        // Ödeme bilgileri gönderilmediyse, ödeme formunu gösterelim
        ?>
        <h2>Ödeme Bilgileri</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Ödeme seçeneklerini buraya ekleyebilirsiniz -->
            <label for="kart_numarasi">Kredi Kartı Numarası:</label>
            <input type="text" id="kart_numarasi" name="kart_numarasi" required><br><br>

            <label for="son_kullanma_tarihi">Son Kullanma Tarihi:</label>
            <input type="text" id="son_kullanma_tarihi" name="son_kullanma_tarihi" required><br><br>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required><br><br>

            <!-- Gizli alanlar olarak film_id, seans_saat, seans_tarihi ve bilet_kimlik bilgilerini ekleyelim -->
            <input type="hidden" name="film_id" value="<?php echo $film_id; ?>">
            <input type="hidden" name="seans_saat" value="<?php echo $seans_saat; ?>">
            <input type="hidden" name="seans_tarihi" value="<?php echo $seans_tarihi; ?>">
            <input type="hidden" name="bilet_kimlik" value="<?php echo $bilet_kimlik; ?>">

            <!-- Seçilen koltukları da gizli alan olarak ekleyelim -->
            <?php
            foreach ($secilen_koltuklar as $koltuk) {
                echo "<input type='hidden' name='secilen_koltuk[]' value='$koltuk'>";
            }
            ?>

            <input type="submit" value="Ödeme Yap">
        </form>
        <?php
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>

    <!-- Anasayfaya dön butonu -->
    <form action="index.php">
        <input type="submit" value="Anasayfaya Dön">
    </form>


</div>
</body>
</html>




