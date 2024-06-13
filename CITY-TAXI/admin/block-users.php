<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include("../database/connectDB.php");

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    $user_query = "SELECT status FROM users WHERE id = $userId";
    $user_result = mysqli_query($connect, $user_query);

    if (mysqli_num_rows($user_result) == 1) {
        $user = mysqli_fetch_assoc($user_result);

        $new_status = ($user['status'] == 'активен') ? 'заблокирован' : 'активен';

        $update_query = "UPDATE users SET status = '$new_status' WHERE id = $userId";
        if (mysqli_query($connect, $update_query)) {
            header("Location: control-users.php"); // Перенаправление на страницу со списком пользователей     
            exit();
        } else {
            echo "Ошибка изменения статуса пользователя: " . mysqli_error($connect);
        }
    } else {
        echo "Пользователь не найден";
    }
} else {
    echo "Некорректный запрос";
}
