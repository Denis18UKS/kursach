<?php

session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include "../database/connectDB.php";

// Установка часового пояса
date_default_timezone_set('YEKT');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user'];
    $point_A = $_POST['point_a'];
    $city = $_POST['id_city'];
    $street = $_POST['street'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $tariff = $_POST['tariff'];

    if (empty($date)) {
        echo "Ошибка: Дата не была предоставлена.";
        exit();
    }

    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
        echo "<script>alert('Ошибка: Дата должна быть в формате YYYY-MM-DD.'); location.href='order.php';</script>";
        exit();
    }

    if (strtotime($date) <= strtotime(date('Y-m-d'))) {
        echo "<script>alert('Ошибка: Нельзя выбрать прошедшую дату.'); location.href='order.php';</script>";
        exit();
    }

    $driverSql = "SELECT id FROM drivers LIMIT 1";
    $driverResult = $connect->query($driverSql);
    $driverRow = $driverResult->fetch_assoc();
    $driverId = $driverRow['id'];

    $userSql = "SELECT email FROM users WHERE id = $userId";
    $userResult = $connect->query($userSql);
    $userRow = $userResult->fetch_assoc();
    $userEmail = $userRow['email'];

    $carSql = "SELECT id_cars FROM cars LIMIT 1";
    $carResult = $connect->query($carSql);
    $carRow = $carResult->fetch_assoc();
    $carId = $carRow['id_cars'];

    $tariffSql = "SELECT title_tarif, price_tarif FROM tarifs WHERE id = $tariff";
    $tariffResult = $connect->query($tariffSql);
    $tariffRow = $tariffResult->fetch_assoc();
    $tariffTitle = $tariffRow['title_tarif'];
    $tariffPrice = $tariffRow['price_tarif'];

    $priceSql = "SELECT price_travel FROM city";
    $priceResult = $connect->query($priceSql);

    if ($priceResult && $priceResult->num_rows > 0) {
        $priceRow = $priceResult->fetch_assoc();
        $price_all = $tariffRow["price_tarif"] + $priceRow["price_travel"];
    } else {
        echo "Ошибка: Не удалось получить цену поездки.";
        exit();
    }

    $sql = "INSERT INTO orders (id_user, id_drivers, id_tarifs, point_A, id_city, street, `order-travel`, `price_all`, `time-travel`, `status_ord`) 
    VALUES ('$userId', '$driverId', '$tariff', '$point_A', '$city', '$street', '$date', '$price_all', '$time', 'в обработке')";

    $citySql = "SELECT * FROM city";
    $cityResult = $connect->query($citySql);

    if ($cityResult && $cityResult->num_rows > 0) {
        $cityRow = $cityResult->fetch_assoc();
        $cityname = $cityRow["name_city"];
    } else {
        echo "Ошибка: Не удалось получить название города.";
        exit();
    }

    if ($connect->query($sql) === TRUE) {

        $to = $userEmail;
        $subject = "Заказ создан";
        $message = "Заказ создан.\n\nДетали заказа:\nДата отправления: $date\nВремя отправления: $time\nТочка отправления: $point_A\nГород назначения: $cityname\nУлица назначения: $street\nТариф: $tariffTitle\nСтоимость поездки: $price_all руб.";
        $headers = "From: lakos208@gmail.com";

        mail($to, $subject, $message, $headers);

        echo "<script>alert('Заказ успешно оформлен'); location.href='order-history.php';</script>";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $connect->error;
    }

    $connect->close();
} else {
    echo "Ошибка: Неверный метод запроса.";
}
