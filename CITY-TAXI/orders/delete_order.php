<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include("../database/connectDB.php");

// Проверяем, установлена ли сессия с ID пользователя
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];
    $orderId = $_GET['id'] ?? null; // Используем оператор null coalescing для установки значения по умолчанию

    if ($orderId) {
        // Обновляем статус заказа на "отменённый"
        $sql = "UPDATE orders SET status_ord = 'отменён' WHERE id_order = $orderId AND id_user = $userId";
        if (mysqli_query($connect, $sql) === TRUE) {
            echo "<script>alert('Заказ отменён'); location.href='order-history.php';</script>";
        } else {
            echo "Ошибка при обновлении статуса заказа: " . $connect->error;
        }
    } else {
        echo "ID заказа не указан.";
    }
} else {
    echo "Ошибка: пользователь не авторизован.";
}

$connect->close();
