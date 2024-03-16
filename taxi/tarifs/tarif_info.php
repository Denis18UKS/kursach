<?php
    if(isset($_GET['tariff'])) {
        $tariff_id = $_GET['tariff'];
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Taxi";

        $connect = new mysqli($servername, $username, $password, $dbname);

        if ($connect->connect_error) {
            die("Ошибка подключения: " . $connect->connect_error);
        }

        $sql = "SELECT * FROM tarifs WHERE id = $tariff_id";
        $result = $connect->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<h1>" . $row['tittle_tarif'] . "</h1>";
            echo "<img src='../image/tarifs/" . $row['picture_tarif'] . "' alt=''>";
            echo "<p>" . $row['description_tarif'] . "</p>";
            echo "<p>Цена: " . $row['price_tarif'] . "₽</p>";
        } else {
            echo "Тариф не найден.";
        }

        $connect->close();
        
    } else {
        echo "Ошибка: Тариф не выбран.";
    }
?>