<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

include "../database/connectDB.php";

if ($connect->connect_error) {
    die("Ошибка подключения к базе данных: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $surname = $_POST['driver-surname'];
    $name = $_POST['driver-name'];
    $patronymic = $_POST['driver-patronymic'];
    $age = $_POST['driver-age'];
    $experience = $_POST['driver-experience']; // новое поле стаж
    $license = $_POST['driver-license'];
    $password = $_POST['password'];

    if (empty($surname) || empty($name) || empty($patronymic) || empty($age) || empty($experience) || empty($license) || empty($password)) { ?>
        <script>
            alert('Заполните все поля!');
            location.href = 'control-drivers.php';
        </script>
<? } else {
        // Получаем список всех машин
        $carSql = "SELECT id_cars FROM cars";
        $carResult = $connect->query($carSql);

        $carId = null;
        while ($carRow = $carResult->fetch_assoc()) {
            // Проверяем, не используется ли машина другим водителем
            $checkCarSql = "SELECT id_cars FROM drivers WHERE id_cars = " . $carRow['id_cars'] . " AND status_driver = 'Активен'";
            $checkCarResult = $connect->query($checkCarSql);
            if ($checkCarResult->num_rows == 0) {
                // Если машина не используется, используем ее
                $carId = $carRow['id_cars'];
                break;
            }
        }

        if ($carId === null) {
            echo "<script>alert('Ошибка: Все машины заняты.'); location.href='control-drivers.php'</script>";
            exit();
        }

        $checkDrivers = "SELECT * FROM `drivers` WHERE `driver_license` = '$license'";
        $checkResDriver = mysqli_query($connect, $checkDrivers);

        if ($checkResDriver->num_rows > 0) {
            echo "<script>alert('Данное водительское удостоворение уже занято!'); location.href='control-drivers.php';</script>";
        } else {
            // Готовим SQL запрос для добавления водителя в базу данных
            $sql = "INSERT INTO drivers (id_cars, surname_driver, name_driver, patronymic_driver, age, experience, driver_license, password, status_driver, status_work, id_role) VALUES ('$carId', '$surname', '$name', '$patronymic', $age, $experience, '$license', '$password', 'Активен', 'не на смене', 2)";

            if ($connect->query($sql) === TRUE) {
                echo "<script>alert('Водитель был успешно добавлен'); location.href='control-drivers.php';</script>";
            } else {
                echo "Ошибка при добавлении водителя в базу данных: " . $connect->error;
            }
        }
    }
} else {
    echo "Данные не были отправлены методом POST";
}

// Закрываем соединение с базой данных
$connect->close();
