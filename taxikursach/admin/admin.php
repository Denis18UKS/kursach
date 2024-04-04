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
        <a href="control-drivers.php" id="add-drivers-link">Управление водителями</a>
        <a href="../" id="logout-link">На главную</a>
    </div>

    <div class="content" id="content-tariffs">
        <!-- Контент для управления методичками -->
        <h2>Управление тарифами</h2>
        <div class="form-container">
            <h2>Добавить новый тариф</h2>
            <form id="tariff-form" action="insert_tarif.php" method="post" enctype="multipart/form-data" >
                <label for="img">Изображение:</label>
                <input type="file" id="img" name="img" accept="image/*" required><br>

                <label for="title">Название:</label>
                <input type="text" id="title" name="title" required minlength="5" maxlength="20"><br>

                <label for="description">Описание:</label>
                <textarea id="description" name="description" rows="4" required minlength="5" maxlength="500"></textarea><br>

                <label for="price">Цена:</label>
                <input type="number" id="price" name="price" required min="300" max="1500"><br>

                <button type="submit">Добавить тариф</button>
            </form>
        </div>

    <section id="tarifs-control">
        <table>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Стоимость</th>
                <th>Статус</th>
                <th>Действие</th>
                <th>Действие</th>
            </tr>
            <?php
                include("../connectDB.php");

                $tariff_control = "SELECT * FROM `tarifs`";
                $tariff_result = mysqli_query($connect, $tariff_control);

                if (mysqli_num_rows($tariff_result) > 0) {
                    while ($tariff = mysqli_fetch_assoc($tariff_result)) {
                        echo "<tr>";
                        echo "<td>" . $tariff['id'] . "</td>";
                        echo "<td>" . $tariff['title_tarif'] . "</td>";
                        echo "<td>" . $tariff['description_tarif'] . "</td>";
                        echo "<td>" . $tariff['price_tarif'] . "₽" . "</td>";
                        echo "<td>" . $tariff['status_tarif'] . "</td>";
                        if ($tariff['status_tarif'] == 'активен') {
                            echo "<td><a href='change-status-tarif.php?id=" . $tariff['id'] . "&status=активен' onclick='confirmRemove()' class='remove'>Удалить</a></td>";
                        } else {
                            echo "<td><a href='change-status-tarif.php?id=" . $tariff['id'] . "&status=неактивен' onclick='confirmRestore() class='restore'>Восстановить</a></td>";
                        } ?>

                        <td><a href='delete-tarif.php?id=<?php echo $tariff['id']; ?>' onclick='return confirmDelete()' class='delete'>Уничтожить</a></td>

                        <?php echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Нет тарифов для отображения.</td></tr>";
                }
            ?>
        </table>
    </section>
    </div>

    <script>
        function confirmRemove(){
            return confirm ("Вы уверена что хотите удалить тариф?");
        }

        function confirmRestore(){
            return confirm ("Вы уверена что хотите восстановить тариф?");
        }

        function confirmDelete(){
            return confirm ("Вы уверены что точно хотите удалить тариф навсегда без возможности восстановления?");
        }
    </script>

</body>
</html>