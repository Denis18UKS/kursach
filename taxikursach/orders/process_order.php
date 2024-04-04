<?php

include "../connectDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = $_POST['name'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $tariff = $_POST['tariff'];
    $userId = 6; // Предположим, что id=6 соответствует текущему пользователю

    // SQL запрос для добавления заказа в базу данных
    $sql = "INSERT INTO orders (id_user, id_tarifs, order-travel, status) VALUES ('$userId', '$name', '$destination', '$date', '$tariff')";

    // Выполнение запроса
    if ($connect->query($sql) === TRUE) {
        echo "Заказ успешно оформлен.";
    } else {
        echo "Ошибка при оформлении заказа: " . $connect->error;
    }

    $connect->close();
}

?>