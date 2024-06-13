<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

require('../database/connectDB.php');


$userId = $_SESSION['user'];
$address = $_POST['address'];

// Проверяем, существует ли уже такой адрес
$sql = "SELECT * FROM address WHERE id_user='$userId' AND address='$address'";
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Данный адрес уже существует'); location.href='user.php';</script>";
} else {
    $sql = "INSERT INTO `address`(`id_user`, `address`)
        VALUES('$userId','$address')";

    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Адрес был успешно добавлен'); location.href='user.php'</script>";
    } else {
        echo "Ошибка: " . mysqli_error($connect);
    }
}
