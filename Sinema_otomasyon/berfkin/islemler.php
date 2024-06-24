<!DOCTYPE html>
<html>
<head>
    <title>FinKin Sinema</title>
    <style>
        body {
            font-family: Serif, Times New Roman;
            background-color: #2f4f4f;
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 50px; 
            text-align: center;
            margin-top: 50px;
            color: #ffe4c4; /* Başlık rengi */
        }
        .film-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .film {
            margin: 20px;
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 200px; /* Film kutusu genişliği */
            border: 1px solid #ddd; /* Kenarlık */
        }
        .film img {
            width: 150px; /* Afiş genişliği */
            height: 225px; /* Afiş yüksekliği */
            object-fit: cover; /* İçeriği kapsamak için */
            border-radius: 10px;
            margin-bottom: 10px; /* Afiş ile başlık arasındaki boşluk */
        }
        .film h2 {
            font-size: 23px; /* Başlık boyutu */
            color: #333; /* Başlık rengi */
            margin-bottom: 10px; /* Başlık ile düğme arasındaki boşluk */
        }
        .film button {
            padding: 10px 20px;
            background-color: #556b2f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px; /* Düğme metni boyutu */
        }
        .film button:hover {
            background-color: #2f4f4f;
        }
    </style>
</head>
<body>

    <?php
    // Veritabanı bağlantısı
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

    // Filmleri seç ve sorguyu çalıştır
    $sql = "SELECT * FROM filmler";
    $result = $conn->query($sql);

    // Veritabanından gelen verileri kullanarak film afişlerini ve adlarını göster
    echo "<h1>Filmler</h1>";
    echo "<div class='film-container'>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='film'>";
            echo "<img src='afisler/{$row['afis']}' alt='{$row['film_adi']}'><br>";
            echo "<h2>{$row['film_adi']}</h2>";
            echo "<a href='biletsec.php?film_id={$row['id']}'><button>Bilet Al</button></a>";
            echo "</div>";
        }
    } else {
        echo "Veritabanında herhangi bir film bulunamadı.";
    }
    echo "</div>";

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>
</body>
</html>