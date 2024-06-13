<?php
session_start();
if (!isset($_SESSION['driver'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}
// Подключение к базе данных 
include "../database/connectDB.php";

session_start();

// Проверяем, что запрос является POST-запросом и содержит параметр change_status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_status'])) {
    // Проверяем, что пользователь авторизован и является водителем
    if (isset($_SESSION['driver'])) {
        $user_id = $_SESSION['driver'];

        // Определяем новый статус работы
        $new_status = ($_POST['change_status'] == 'on') ? 'на смене' : 'не на смене';

        // Формируем SQL-запрос для обновления статуса
        $updateSql = "UPDATE drivers SET status_work = '$new_status' WHERE id = $user_id";

        // Выполняем запрос
        if ($connect->query($updateSql) === TRUE) {
            echo "<script>location.href='driver.php'</script>";
        } else {
            // Выводим ошибку, если запрос не удался
            echo "Ошибка при обновлении статуса: " . $connect->error;
        }
    } else {
        // Пользователь не авторизован или не является водителем
        echo "<script>alert('Действие запрещено'); location.href='../signIn.php'</script>";
    }
} else {
    echo "Некорректный запрос.";
}

$connect->close();
