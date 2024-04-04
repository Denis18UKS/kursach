<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="/js/admin_panel.js" defer></script>
    <script src="/js/save-choose.js" defer></script>
    <script src='/js/black-theme.js' defer></script>

</head>
<body>
    <div class="sidebar">
        <a href="admin.php" id="add-met-link">Управление тарифами</a>
        <a href="control-users.php" id="add-programs-link">Управление пользователями</a>
        <a href="#" id="add-programs-link">Управление водителями</a>
        <a href="../" id="logout-link">На главную</a>
    </div>

    <div class="content" id="content-drivers">
        <!-- Контент для управления водителями -->
        <h2>Управление Водителями</h2>

        <section id="add-driver-form">
            <h3>Добавить нового водителя</h3>
            <form id="drivers" action="add_driver.php" method="post">

                <label for="driver-surname">Фамилия:</label>
                <input type="text" id="driver-surname" name="driver-surname" required><br><br>

                <label for="driver-name">Имя:</label>
                <input type="text" id="driver-name" name="driver-name" required><br><br>
                
                <label for="driver-patronymic">Отчество:</label>
                <input type="text" id="driver-patronymic" name="driver-patronymic" required><br><br>

                <label for="driver-age">Возраст:</label>
                <input type="number" min = "18" id="driver-age" name="driver-age" required><br><br>

                <label for="driver-experience">Стаж:</label>
                <input type="number" min="3" id="driver-experience" name="driver-experience" required><br><br>
                
                <label for="driver-license">Номер водительского удостоверения:</label>
                <input type="text" id="driver-license" name="driver-license" required><br><br>
                
                <button type="submit">Добавить водителя</button>
            </form>
        </section>

        <section id="drivers-control">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Возраст</th>
                    <th>Номер водительского удостоверения</th>
                    <th>Статус</th>
                    <th>Действие</th>
                </tr>
                <?php
                include("../connectDB.php");

                $driver_control = "SELECT * FROM `drivers`";
                $driver_result = mysqli_query($connect, $driver_control);

                if (mysqli_num_rows($driver_result) > 0) {
                    while ($driver = mysqli_fetch_assoc($driver_result)) {
                        echo "<tr>";
                        echo "<td>" . $driver['id'] . "</td>";
                        echo "<td>" . $driver['name'] . "</td>";
                        echo "<td>" . $driver['age'] . "</td>";
                        echo "<td>" . $driver['driver_license'] . "</td>";
                        echo "<td>" . $driver['status'] . "</td>";
                        // Добавьте действие для блокировки водителя
                        echo "<td><a href='block_driver.php?driver_id=" . $driver['id'] . "' class='block'>Заблокировать</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Водители не найдены.</td></tr>";
                }
                ?>
            </table>
        </section>
    </div>

</body>
</html>