<?php
$servername= "localhost";
$username= "root";
$password= "";
$database= "sinema";

$conn = new mysqli($servername, $username, $password, $database);


if($conn->connect_error) {
   die("Veritabanı bağlantısında hata:" . $conn->connect_error);
}
//echo "Veritabanına başarıyla bağlandı!";
?>