<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}



require('../database/connectDB.php');

if (isset($_SESSION['user']) && isset($_POST['surname'], $_POST['name'], $_POST['login'], $_POST['email'], $_POST['password'], $_POST['address'])) {

    $userId = $_SESSION['user'];
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Хеширование пароля
    $address = $_POST['address'];

    $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND id != $userId";
    $result = mysqli_query($connect, $sql);

    if ($result->num_rows > 0) { ?>
        <script>
            alert('Эта почта уже занята!');
            location.href = 'user.php';
        </script>
    <? } else if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND id != $userId")) > 0) { ?>
        <script>
            alert('Этот логин уже занят!');
            location.href = 'user.php';
        </script>
<? } else {

        $sql = "UPDATE users SET surname = '$surname', name = '$name', login = '$login', email = '$email', password = '$password', address = '$address' WHERE id = '$userId'";

        if ($connect->query($sql) === TRUE) {
            echo "<script>alert('Данные успешно обновлены'); location.href='user.php'</script>";
            exit();
        } else {
            echo "Ошибка: " . $connect->error;
        }
    }
} else {
    echo "Ошибка: данные не получены.";
}

$connect->close();
