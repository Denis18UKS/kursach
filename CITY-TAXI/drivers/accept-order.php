<?php
session_start();
if (!isset($_SESSION['driver'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

require_once "../database/connectDB.php"; // Подключаем файл с подключением к БД

if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'accept') {
    $order_id = $_GET['id'];
    $driverID = $_SESSION['driver'];

    // Обновляем статус заказа на "принят"
    $sql = "UPDATE orders SET id_drivers = $driverID, status_ord = 'принят' WHERE id_order = '$order_id'";
    if (mysqli_query($connect, $sql) === TRUE) {
        $sql = "SELECT * FROM orders 
        JOIN users ON orders.id_user = users.id 
        JOIN tarifs ON orders.id_tarifs = tarifs.id
        JOIN drivers ON orders.id_drivers = drivers.id
        JOIN cars ON drivers.id_cars = cars.id_cars
        JOIN city ON orders.id_city = city.id_city";
        $result = mysqli_query($connect, $sql);
        $res = mysqli_fetch_assoc($result);
        $email = $res['email'];

        $date = $res['order-travel'];
        $time = $res['time-travel'];
        $point_A = $res['point_A'];
        $city = $res['name_city'];
        $street = $res['street'];
        $tariffTitle = $res['title_tarif'];
        $tariffPrice = $res['price_tarif'];
        $price_all = $res['price_all'];

        $car = $res['model_car'] . " " . $res['number_car'];
        $driver = $res['name_driver'] . " " . $res['patronymic_driver'];

        echo "<script>alert('Заказ принят!'); location.href = 'order_history.php';</script>"; // Перенаправляем на главную страницу
        $to = $email; // Замените на реальный адрес электронной почты пользователя
        $subject = "Заказ принят!";
        $message = "Заказ принят!.\nДетали заказа: \nВаш водитель: $driver\n Ваша машина: $car\nДата поездки: $date\nВремя отправления: $time\nТочка отправления: $point_A\nГород назначения: $city\n \Улица назначения: $street\nТариф: $tariffTitle\nСтоимость поездки: $price_all руб.";
        $headers = "From: lakos208@gmail.com"; // Замените на ваш адрес электронной почты

        mail($to, $subject, $message, $headers);
    } else {
        echo "Ошибка: " . mysqli_error($connect);
    }
} else {
    echo "Ошибка: Неверный запрос.";
}
