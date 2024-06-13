<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include "../database/connectDB.php";

if (isset($_GET['id'])) {
    $id_tarif = $_GET['id'];

    $sql = "DELETE FROM tarifs WHERE id = $id_tarif";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo "<script>alert('Тариф успешно удален!'); location.href='admin.php';</script>";
    } else {
        echo "Ошибка при удалении тарифа";
    }
} else {
    echo "Не удалось получить идентификатор тарифа для удаления";
}

mysqli_close($connect);
