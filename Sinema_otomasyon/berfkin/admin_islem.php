<?php
include("baglan.php");

// Form gönderildiğinde
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen bilet kimlik numarası
    $bilet_kimlik = $_POST['bilet_kimlik'];

    // Bilet kimlik numarasının girilip girilmediğini kontrol etme
    if(empty($bilet_kimlik)) {
        echo "Lütfen iptal etmek istediğiniz biletin kimlik numarasını girin.";
    } else {
        // Veritabanında rezervasyonu iptal et
        $sql = "DELETE FROM rezervasyonlar WHERE bilet_kimlik = '$bilet_kimlik'";
        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "Bilet iptal edildi.";
        } else {
            echo "Bir hata oluştu. Lütfen tekrar deneyin.";
        }
    }
}

// Veritabanından rezervasyonları al ve sondan başa doğru sırala
$sql = "SELECT * FROM rezervasyonlar ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rezervasyonlar ve İptal Formu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .tableouter {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        .iptal-et {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .iptal-et:hover {
            background-color: #c0392b;
        }

        .anasayfa {
            background-color: #555;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .anasayfa:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
<header class="header">
    <h2>Rezervasyonlar ve İptal Formu</h2>
</header>
<div class="container">
    <div class="tableouter">
        <table>
            <thead>
                <tr>
                    <th>Üye ID</th>
                    <th>Bilet Kimlik</th>
                    <th>İptal Et</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Rezervasyonları tabloya ekle
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['uye_id'] . "</td>";
                    echo "<td>" . $row['bilet_kimlik'] . "</td>";
                    echo "<td>";
                    echo "<form action='' method='post'>";
                    echo "<input type='hidden' name='bilet_kimlik' value='" . $row['bilet_kimlik'] . "'>";
                    echo "<button type='submit' class='iptal-et'>İptal Et</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <a href="index.php" class="anasayfa">Çıkış</a>
</div>
</body>
</html>
