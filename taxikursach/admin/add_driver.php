<?php
    include "../connectDB.php";

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

        // Готовим SQL запрос для добавления водителя в базу данных
        $sql = "INSERT INTO drivers (surname, name, patronymic, age, experience, driver_license, status) VALUES ('$surname', '$name', '$patronymic', $age, $experience, '$license', 'Активен')";

        if ($connect->query($sql) === TRUE) {
            echo "<script>alert('Водитель был успешно добавлен'); location.href='admin.php';</script>";
        } else {
            echo "Ошибка при добавлении водителя в базу данных: " . $connect->error;
        }
    } else {
        echo "Данные не были отправлены методом POST";
    }

    // Закрываем соединение с базой данных
    $connect->close();
?>