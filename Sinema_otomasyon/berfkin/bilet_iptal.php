<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilet İptali</title>
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
        h1 {
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
        <h1>Bilet İptali</h1>

    <!-- Bilet iptali için form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="bilet_kimlik">Bilet Kimlik Numarası:</label>
        <input type="text" id="bilet_kimlik" name="bilet_kimlik" required>
        <input type="submit" value="Bilet İptal Et">
    </form>

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

    // Formdan gelen bilet kimlik numarasını alalım ve bilet iptal işlemini gerçekleştirelim
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bilet_kimlik'])) {
        // Bilet kimlik numarasını güvenli hale getirelim
        $bilet_kimlik = $conn->real_escape_string($_POST['bilet_kimlik']);

        // Bilet iptal işlemini gerçekleştirelim
        $sql = "DELETE FROM rezervasyonlar WHERE bilet_kimlik = '$bilet_kimlik'";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo "<p>Bilet iptal işlemi başarıyla gerçekleştirildi.</p>";
            } else {
                echo "<p>Böyle bir bilet bulunamadı veya zaten iptal edilmiş olabilir.</p>";
            }
        } else {
            echo "<p>Bilet iptal işlemi sırasında hata oluştu: " . $conn->error . "</p>";
        }
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>

    <!-- Anasayfaya dön butonu -->
    <form action="index.php">
        <input type="submit" value="Anasayfaya Dön">
    </form>

</body>
</html>


