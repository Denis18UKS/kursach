<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Для водителей</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/driver.css'>

    <script src='../js/main.js' defer></script>
    <script src='../js/black-theme.js' defer></script>
</head>
<body>
<h2>Личный кабинет водителя</h2>

<?php
    include "../connectDB.php";

    if ($connect->connect_error) {
        die("Ошибка подключения: " . $connect->connect_error);
    }

    $status = 'не на смене'; // По умолчанию
    $ordersExist = false;

    if (isset($_POST["status"]) && $_POST["status"] === 'on') {
        $status = 'на смене';

        // Запрос для получения только что поступивших заказов
        $sql = "SELECT * FROM orders WHERE status = 'новый'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $ordersExist = true;
        }
    }
?>

<form method="post" action="driver.php">
    <label class='switch'>
        <input type='checkbox' id='toggle' name='status' <?php if ($status === 'на смене') { echo 'checked'; } ?> onclick='this.form.submit()'>
        <span class='slider'></span>
    </label>
</form>


<p id='status'><?=$status?></p>

<script>
    function handleChange() {
        var statusElement = document.getElementById('status');
        var toggleSwitch = document.getElementById('toggle');

        if (toggleSwitch.checked) {
            statusElement.innerText = 'На смене';
        } else {
            statusElement.innerText = 'Не на смене';
        }
    }
</script>

    <ul>
        <li><a href='order_history.php'>История заказов</a></li>
        <li><a href='../exit.php'>Выйти</a></li>
    </ul>

    <div id='ordersSection'>
        <?php
        if ($status === 'на смене' && $ordersExist) {
            echo "<p>Информация о заказах, которые только что поступили.</p>";
            // Здесь можно обработать вывод информации о заказах
        } elseif ($status === 'на смене' && !$ordersExist) {
            echo "<p>Заказов нет.</p>";
        } elseif ($status === 'не на смене') {
            echo "<p>Вы не на смене.</p>";
        }
        ?>
    </div>


    <?php
        $connect->close();
    ?>

</body>
</html>
