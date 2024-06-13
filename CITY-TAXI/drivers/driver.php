<?php
session_start();
$driverID = $_SESSION['driver'];
if (!isset($_SESSION['driver'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Для водителей</title>

    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">

    <link rel='stylesheet' type='text/css' media='screen' href='../design/css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../design/css/driver.css'>


    <script src='../design/js/main.js' defer></script>
    <script src='../design/js/black-theme.js' defer></script>
</head>

<body style="background-color:gold; ">
    <?php include "../includes/nav.php"; ?>

    <center style="font-size: larger;">
        <h2>Личный кабинет водителя</h2>

        <div class="container">
            <div class="status-section">
                <h3>Статус</h3>
                <?php
                include "../database/connectDB.php";


                $driverSql = "SELECT status_work FROM drivers WHERE id = $driverID";
                $result = $connect->query($driverSql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $status = $row['status_work'];
                    echo "<p>{$status}</p>";
                } else {
                    echo "<p>Статус не определен</p>";
                }
                ?>
            </div>

            <div class="change-status-section">
                <h3>Сменить статус</h3>
                <form method="post" action="update_status.php">
                    <?php
                    if ($status == 'на смене') {
                        echo "<button type='submit' class='btn btn-primary' name='change_status' value='off'>Выйти со смены</button>";
                    } else {
                        echo "<button type='submit' class='btn btn-primary' name='change_status' value='on'>Выйти на смену</button>";
                    }
                    ?>
                </form>
            </div>

            <div class="orders-section">
                <?php
                $sql = "SELECT * FROM orders JOIN users ON orders.id_user = users.id 
                JOIN drivers ON orders.id_drivers = drivers.id 
                JOIN tarifs ON orders.id_tarifs = tarifs.id 
                JOIN city ON orders.id_city = city.id_city
                WHERE status_ord = 'в обработке' AND status_work = 'на смене'";
                $result = $connect->query($sql);

                if ($result === false) {
                    die("Ошибка выполнения запроса: " . $connect->error);
                }

                if ($result->num_rows > 0) {
                    if ($status == 'на смене') {
                        echo "<table class='orders-table'>";
                        echo "<thead>";
                        echo "<tr><th>Заказчик</th><th>Тариф</th><th>Пункт отправления</th><th>Пункт назначения</th><th>Дата и время отправления</th><th>Дата заказа</th><th>Статус заказа</th><th>Стоимость</th><th>Действия</th></tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['surname']} {$row['name']}</td>";
                            echo "<td>{$row['title_tarif']}</td>";
                            echo "<td>{$row['point_A']}</td>";
                            echo "<td>{$row['name_city']}, {$row['street']}</td>";
                            echo "<td>{$row['order-travel']}, {$row['time-travel']}</td>";
                            echo "<td>{$row['order-date']}</td>";
                            echo "<td>{$row['status_ord']}</td>";
                            echo "<td>{$row['price_all']} ₽</td>";
                            echo "<td>";
                            echo "<a href='accept-order.php?id={$row['id_order']}&action=accept' class='accept-order-btn'>Принять</a>";
                            echo "<a href='reject-order.php?id={$row['id_order']}&action=reject' class='reject-order-btn'>Отклонить</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<h1>Вы не на смене.</h1>";
                    }
                } else {
                    echo "<h1>Заказов нет.</h1>";
                }
                ?>
            </div>

        </div>
    </center>
</body>

</html>