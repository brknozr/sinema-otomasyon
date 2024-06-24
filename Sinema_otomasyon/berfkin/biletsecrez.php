<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koltuk Seçimi</title>
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
        h1, h2, p {
            color: #333;
            margin-bottom: 10px;
        }
        .koltuk-düzeni {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .koltuk-satiri {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }
        .koltuk {
            display: none;
        }
        .koltuk:checked + label {
            background-color: #b22222;
        }
        label {
            display: block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border: 2px solid #ccc;
        }
        input[type="checkbox"] {
            display: none;
        }
        input[type="checkbox"]:checked + label {
            border-color: #fbc531;
        }
        .koltuk-satiri::after {
            content: "";
            flex-grow: 99999999;
            min-width: 10px;
        }
        .perde {
            width: 100%;
            height: 40px;
            background-color: gray;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-weight: bold;
        }
        /* Dolu koltukların stili */
        .dolu label {
            pointer-events: none; /* Dolu koltukların tıklanmasını engelle */
            background-color: #ccc; /* Opsiyonel: Dolu koltukların arka plan rengini değiştir */
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sinema";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
        }

        $film_id = $_GET['film_id'];
        $seans_saat = $_GET['seans_saat'];
        $seans_tarihi = $_GET['seans_tarihi'];

        // Film, tarih ve seans bilgilerine göre uygun salonu ve koltuk düzenini al
        $sql = "SELECT filmler.*, salon.salon_adi, salon.salon_kapasite, salon.koltuk_sayisi, GROUP_CONCAT(rezervasyonlar.koltuk_no) AS rezervasyon_koltuklar FROM filmler INNER JOIN salon ON filmler.salon_id = salon.id LEFT JOIN rezervasyonlar ON filmler.id = rezervasyonlar.film_id AND rezervasyonlar.seans_saati = '$seans_saat' WHERE filmler.id = $film_id GROUP BY filmler.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h1>{$row['film_adi']}</h1>";
            echo "<p>Seans Saati: $seans_saat</p>";
            echo "<h2>Salon Bilgisi</h2>";
            echo "<p>Salon Adı: {$row['salon_adi']}</p>";
            echo "<p>Salon Kapasitesi: {$row['salon_kapasite']} kişi</p>";
            echo "<h2>Seçilen Tarih</h2>";
            echo "<p>Kullanıcının seçtiği tarih: $seans_tarihi</p>";
            echo "<h2>Koltuk Düzeni</h2>";
            echo "<form action='biletsat.php' method='post'>";
            echo "<div class='koltuk-düzeni'>";
            $koltuk_sayisi = $row['koltuk_sayisi'];
            $satir_sayisi = ceil($koltuk_sayisi / 5);
            $counter = 1;
            $rezervasyon_koltuklar = array();
            if (isset($row['rezervasyon_koltuklar']) && !empty($row['rezervasyon_koltuklar'])) {
                $rezervasyon_koltuklar = explode(',', $row['rezervasyon_koltuklar']);
            }
            for ($i = 0; $i < $satir_sayisi; $i++) {
                echo "<div class='koltuk-satiri'>";
                for ($j = 0; $j < 5; $j++) {
                    if ($counter <= $koltuk_sayisi) {
                        $dolu_mu = in_array($counter, $rezervasyon_koltuklar) ? "dolu" : "boş";
                        $renk = ($dolu_mu == "dolu") ? "red" : "green";
                        $pointer_events = ($dolu_mu == "dolu") ? "none" : "auto"; // pointer-events değeri
                        echo "<input type='checkbox' id='koltuk-$counter' class='koltuk' name='secilen_koltuk[]' value='$counter'>";
                        echo "<label for='koltuk-$counter' style='background-color: $renk; pointer-events: $pointer_events'>$counter</label>";
                    } else {
                        echo "<input type='checkbox' id='bos' class='koltuk' style='visibility: hidden'>";
                        echo "<label for='bos' style='visibility: hidden'></label>";
                    }
                    $counter++;
                }
                echo "</div>";
            }
            echo "</div>";
            echo "<div class='perde'>Perde</div>";
            echo "<input type='hidden' name='film_id' value='$film_id'>";
            echo "<input type='hidden' name='seans_saat' value='$seans_saat'>";
            echo "<input type='hidden' name='seans_tarihi' value='$seans_tarihi'>";
            echo "<input type='submit' name='sec' value='Seç' style='padding: 10px 20px; background-color: #6b8e23; color: #fff; border: none; border-radius: 5px; cursor: pointer;'>";
            echo "</form>";
        } else {
            echo "<p>Seçilen film bulunamadı.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>








