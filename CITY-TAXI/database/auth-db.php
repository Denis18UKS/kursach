<?php
session_start();
require "connectDB.php";

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

// Проверяем, заполнены ли все поля
if (empty($login) || empty($password)) {
    echo "<script>alert('Заполните все поля!'); location.href='../signIn.php';</script>";
} else {
    // Проверяем существование пользователя с таким логином и паролем в таблице "users"
    $sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
    $result = mysqli_query($connect, $sql);

    // Проверяем количество строк, возвращенных из запроса
    if (mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_assoc($result);
        $role = $res['id_role'];

        if ($role == 3) {
            $_SESSION['admin'] = $res['id'];
            echo "<script>alert('Вы вошли как администратор'); location.href='../';</script>";
        } else if ($role == 1) {
            $_SESSION['user'] = $res['id'];
            echo "<script>alert('Вы вошли как пользователь'); location.href='../';</script>";
        }
    } else {
        // Проверка для роли водителя
        $sql_driver = "SELECT * FROM `drivers` WHERE `driver_license` = '$login' AND `password` = '$password'";
        $result_driver = mysqli_query($connect, $sql_driver);

        if (mysqli_num_rows($result_driver) == 1) {
            $driver = mysqli_fetch_assoc($result_driver);
            $_SESSION['driver'] = $driver['id'];
            echo "<script>alert('Вы вошли как водитель'); location.href='../';</script>";
        } else {
            echo "<script>alert('Некорректные данные'); location.href='../signIn.php';</script>";
        }
    }
}
