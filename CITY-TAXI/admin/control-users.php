<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление</title>
    <link rel="stylesheet" href="../design/css/admin.css">
    <script src="../design/js/admin_panel.js" defer></script>
    <script src="../design/js/save-choose.js" defer></script>
    <script src='../design/js/black-theme.js' defer></script>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- bootstrap -->

</head>

<body style="background-color: gold;">
    <div class="sidebar">
        <a href="admin.php">Управление тарифами</a>
        <a href="control-users.php">Управление пользователями</a>
        <a href="control-drivers.php">Управление водителями</a>
        <a href="control-cars.php">Управление машинами</a>
        <a href="control-city.php">Управление городами</a>
        <a href="../">На главную</a>
    </div>

    <div class="content" id="content-tariffs">
        <!-- Контент для управления пользователми -->
        <h2>Управление пользователями</h2>

        <section id="users-control">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Логин</th>
                    <th>Адрес</th>
                    <th>Дата регистрации</th>
                    <th>Статус пользователя</th>
                    <th>Действие</th>
                </tr>
                <?php
                include("../database/connectDB.php");

                $user_control = "SELECT * FROM users";
                $user_result = mysqli_query($connect, $user_control);

                if (mysqli_num_rows($user_result) > 0) {
                    while ($user = mysqli_fetch_assoc($user_result)) {
                        echo "<tr>";
                        echo "<td>" . $user['id'] . "</td>";
                        echo "<td>" . $user['surname'] . "</td>";
                        echo "<td>" . $user['name'] . "</td>";
                        echo "<td>" . $user['login'] . "</td>";
                        echo "<td>" . $user['address'] . "</td>";
                        echo "<td>" . $user['reg-time'] . "</td>";
                        echo "<td>" . $user['status'] . "</td>";

                        if ($user['status'] == 'заблокирован') {
                            echo "<td><a href='block-users.php?user_id=" . $user['id'] . "' class='unblock'>Разблокировать</a></td>";
                        } else {
                            echo "<td><a href='block-users.php?user_id=" . $user['id'] . "' class='block'>Заблокировать</a></td>";
                        }

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Пользователи не найдены.</td></tr>";
                }
                ?>
            </table>
        </section>
    </div>

</body>

</html>