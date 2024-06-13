<?php

session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Заказ поездки</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../design/css/order.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../design/css/back.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../design/css/taxi.css'>

    <script src="../design/js/order.js"></script>
    <script src='../design../design/js/black-theme.js' defer></script>

</head>

<body>

    <?php include "../taxi-squares.html" ?>

    <a href="/"><img src="../image/home-black.png" alt="back" title="Главная" id="back"></a>

    <form method="post" action="process_order.php">
        <?php

        require('../database/connectDB.php');

        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user'];
            $sql = "SELECT * FROM users WHERE id = '$userId'";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                // Вывод данных пользователя 
                echo "<p>Пользователь: " . $user['name'] . "</p>";
                echo "<p>Ваша почта: " . $user['email'] . "</p>";
                // ... (вывод других данных)
            } else {
                echo "Пользователь не найден.";
            }
        }
        ?>


        <label for="point_a">Пункт отправления:</label>
        <input type="text" id="point_a" name="point_a" placeholder="Город, улица, дом" required>

        <label for="name_city">Город назначения:</label>
        <?php
        include("../database/connectDB.php");
        $sql = "SELECT * FROM city";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<select name='id_city' id='id_city'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row["id_city"] . "'>" . $row["name_city"] . "</option>";
            }
            echo "</select>";
        } else {
            echo "Города не найдены";
        }
        ?>


        <label for="street">Улица:</label>
        <input type="text" id="street" name="street" placeholder="Улица" required>

        <label for="date">Дата поездки:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Время отправления:</label>
        <input type="time" id="time" name="time" required>

        <label for="tariff">Выберите тариф:</label>
        <select id="tariff" name="tariff" onchange="showFormFields()">
            <?php
            include "../database/connectDB.php";

            $sql = "SELECT * FROM tarifs";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $addressParts = explode(',', $row['address']); // Разбиваем строку адреса на массив
                    $city = $addressParts[0]; // Получаем город из первого элемента массива
                    $restAddress = implode(', ', array_slice($addressParts, 1)); // Собираем остальной адрес

                    echo "<option value='" . $row['id'] . "'>$city - " . $row['title_tarif'] . "</option>";
                }
            }

            ?>
        </select>

        <div id="extraFields" style="display:none;"></div>

        <input type="submit" value="Оформить заказ">
    </form>
</body>

</html>