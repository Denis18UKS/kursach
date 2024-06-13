<?
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
    <title>История Заказов Пользователя</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' media='screen' href='../design/css/orders-history.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../design/css/user.css'>

    <script src='../design/js/main.js' defer></script>
    <script src='../design/js/black-theme.js' defer></script>
</head>

<body style="background-color: gold; color: black;">

    <div class="sidebar">
        <a href="../user_profile/user.php" id="add-programs-link">Мои данные</a>
        <a href="../" id="logout-link">На главную</a>
    </div>

    <div class="content">
        <h1>История заказов</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Дата поездки</th>
                    <th>Время отправления</th>
                    <th>Дата заказа</th>
                    <th>Пункт отправления</th>
                    <th>Город назначения</th>
                    <th>Улица назначения</th>
                    <th>Стоимость поездки</th>
                    <th>Статус заказа</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('../database/connectDB.php');

                if (isset($_SESSION['user'])) {
                    $userId = $_SESSION['user'];
                    $sql = "SELECT * FROM orders 
                        JOIN users ON orders.id_user = users.id 
                        JOIN city ON orders.id_city = city.id_city
                        WHERE id_user = '$userId'";
                    $result = $connect->query($sql);

                    if ($result->num_rows > 0) {
                        while ($order = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $order['surname'] . "</td>";
                            echo "<td>" . $order['name'] . "</td>";
                            echo "<td>" . $order['order-travel'] . "</td>";
                            echo "<td>" . $order['time-travel'] . "</td>";
                            echo "<td>" . $order['order-date'] . "</td>";
                            echo "<td>" . $order['point_A'] . "</td>";
                            echo "<td>" . $order['name_city'] . "</td>";
                            echo "<td>" . $order['street'] . "</td>";
                            echo "<td>" . $order['price_all'] . '₽' . "</td>";
                            echo "<td>" . $order['status_ord'] . "</td>";
                            if ($order["status_ord"] == "в обработке") {
                                echo "<td><a class = 'btn btn-danger' href='delete_order.php?id=" . $order['id_order'] . "'>Отменить заказ</a></td>";
                            } else if ($order["status_ord"] == "принят") {
                                echo "<td><p>Вы не можете отменить принятый заказ";
                            } else {
                                echo "<td><a class='btn btn-danger' href='remove_order.php?id=" . $order['id_order'] . "'>Удалить</a></td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Заказы не найдены.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Ошибка: пользователь не авторизован.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


</body>

</html>