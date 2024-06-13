<?php
session_start();
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
    <link rel='stylesheet' type='text/css' media='screen' href='../design/css/orders_history.css'>
    <script src='../design/js/main.js' defer></script>
    <script src='../design/js/black-theme.js' defer></script>
</head>
<?php include "../includes/nav.php"; ?>

<body style="background-color: gold; text-align:center">
    <h2>Личный кабинет водителя</h2>

    <div id="order-section">
        <h1>История Заказов</h1>
        <?php
        include("../database/connectDB.php"); // Подключение к базе данных

        // Проверяем, установлена ли сессия с ID водителя
        if (isset($_SESSION['driver'])) {
            $driverId = $_SESSION['driver'];

            // Обработка завершения заказа
            if (isset($_GET['orderId'])) {
                $orderId = $_GET['orderId']; // Получаем ID заказа из запроса

                // Обновляем статус заказа в базе данных
                $sqlUpdate = "UPDATE orders SET status_ord = 'выполнен' WHERE id_order = $orderId";
                $resultUpdate = mysqli_query($connect, $sqlUpdate);

                if ($resultUpdate) {
                    echo "<script>alert('Заказ завершён.');</script>";
                } else {
                    echo "Ошибка при обновлении заказа.";
                }
            }

            // Запрос для получения истории заказов
            $sql = "SELECT orders.*, city.*, users.surname, users.name, users.email, price_all FROM orders 
            JOIN users ON orders.id_user = users.id 
            JOIN city ON orders.id_city = city.id_city
            WHERE orders.id_drivers = $driverId AND orders.status_ord!= 'в обработке';";

            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>
                <th>Заказчик</th>
                <th>ID заказа</th>
                <th>Точка отправления</th>
                <th>Точка назначения</th>
                <th>Дата и время отправления</th>
                <th>Дата и время заказа</th>
                <th>Стоимость заказа</th>
                <th>Статус</th>";
                if ($row['status_ord'] == "принят") {

                    echo "<th>Действие</th></tr>";
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['surname'] . " " . $row['name'] . "</td>";
                    echo "<td>" . $row['id_order'] . "</td>";
                    echo "<td>" . $row['point_A'] . "</td>";
                    echo "<td>" . $row['name_city'] . ", " . $row['street'] . "</td>";
                    echo "<td>" . $row['order-travel'] . ", " . $row['time-travel'] .  "</td>";
                    echo "<td>" . $row['order-date'] . "</td>";
                    echo "<td>" . $row["price_all"] . ' ₽' . "</td>";
                    echo "<td>" . $row['status_ord'] . "</td>";
                    if ($row['status_ord'] == "принят") {
                        echo "<td>
                        <form action='' method='GET'>
                            <input type='hidden' name='orderId' value='" . $row['id_order'] . "'>
                            <input type='submit' class='btn btn-success' value='Выполнен'>
                        </form>
                    </td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Заказы для этого водителя не найдены.";
            }
        } else {
            echo "ID водителя не указан в сессии.";
        }
        ?>
    </div>
</body>

</html>