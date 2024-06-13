<?php
session_start();
if (!isset($_SESSION['driver'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

require_once "../database/connectDB.php"; // Подключаем файл с подключением к БД

if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'reject') {
    $order_id = $_GET['id'];

    // Обновляем статус заказа на "отклонен"
    $sql = "UPDATE orders SET status_ord = 'отклонен' WHERE id_order = '$order_id'";
    if (mysqli_query($connect, $sql) === TRUE) {
        echo "<script>alert('Заказ отклонен.'); location.href = 'order_history.php';</script>"; // Перенаправляем на главную страницу
        $sql = "SELECT * FROM orders 
        JOIN users ON orders.id_user = users.id 
        JOIN tarifs ON orders.id_tarifs = tarifs.id
        JOIN city ON orders.id_city = city.id_city";
        $result = mysqli_query($connect, $sql2);
        $res = mysqli_fetch_assoc($result2);
        $email = $res['email'];

        $date = $res['order-travel'];
        $time = $res['time-travel'];
        $point_A = $res['point_A'];
        $city = $res['name_city'];
        $street = $res['street'];
        $tariffTitle = $res['title_tarif'];
        $tariffPrice = $res['price_tarif'];

        $to = $email; // Замените на реальный адрес электронной почты пользователя
        $subject = "Ваш заказ отклонён!";
        $message = "Ваш заказ отклонён:.\n\nДетали заказа:\nДата поездки: $date\nВремя отправления: $time\nТочка отправления: $point_A\Город назначения: $city\n \Улица назначения: $street\nТариф: $tariffTitle\nСтоимость поездки: $tariffPrice руб.";
        $headers = "From: lakos208@gmail.com"; // Замените на ваш адрес электронной почты

        mail($to, $subject, $message, $headers);
    } else {
        echo "Ошибка: " . mysqli_error($connect);
    }
} else {
    echo "Ошибка: Неверный запрос.";
}
