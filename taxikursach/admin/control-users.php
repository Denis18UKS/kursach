<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="/js/admin_panel.js" defer></script>
    <script src="/js/save-choose.js" defer></script>
</head>
<body>
    <div class="sidebar">
        <a href="admin.php" id="add-met-link">Управление тарифами</a>
        <a href="#" id="add-programs-link">Управление программами</a>
        <a href="../" id="logout-link">На главную</a>
    </div>

    <div class="content" id="content-tariffs">
        <!-- Контент для управления программами -->
        <h2>Управление пользователями</h2>

    <section id="users-control">    
        <table>
            <tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>Дата регистрации</th>
                <th>Статус пользователя</th>
                <th>Действие</th>
            </tr>
            <?php
            include("../connectDB.php");

            $user_control = "SELECT * FROM `users`";
            $user_result = mysqli_query($connect, $user_control);

            if (mysqli_num_rows($user_result) > 0) {
                while ($user = mysqli_fetch_assoc($user_result)) {
                    echo "<tr>";
                    echo "<td>" . $user['id'] . "</td>";
                    echo "<td>" . $user['surname'] . "</td>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['phone'] . "</td>";
                    echo "<td>" . $user['address'] . "</td>";
                    echo "<td>" . $user['reg-time'] . "</td>";
                    echo "<td>" . $user['status'] . "</td>";
                    echo "<td><a href='block_user.php?user_id=" . $user['id'] . "' class='block'>Заблокировать</a></td>";
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