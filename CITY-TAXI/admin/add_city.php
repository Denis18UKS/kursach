<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include "../database/connectDB.php";

if ($connect->connect_error) {
    die("Ошибка подключения к базе данных: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $cityname = $_POST['cityname'];
    $cityprice = $_POST['cityprice'];


    $sql = "INSERT INTO `city`(`name_city`, `price_travel`)
    VALUES('$cityname', '$cityprice')";

    if ($connect->query($sql) === TRUE) {
        echo "<script>alert('Город был успешно добавлен'); location.href='control-city.php';</script>";
    } else {
        echo "Ошибка при добавлении машины в базу данных: " . $connect->error;
    }
} else {
    echo "Данные не были отправлены методом POST";
}

// Закрываем соединение с базой данных
$connect->close();
