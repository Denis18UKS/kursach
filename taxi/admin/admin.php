<!-- <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет админа</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="../js/admin_panel.js" defer></script>

    <style>
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#" id="tariffs-link">Управление тарифами</a>
        <a href="#" id="users-link">Управление пользователями</a>
        <a href="#" id="logout-link">Выйти</a>
    </div>

    <h1>Личный кабинет админа</h1>

    <div class="form-container">
        <h2>Добавить новый тариф</h2>
        <form id="tariff-form" action="insert_tarif.php" method="post" >
            <label for="img">Изображение:</label>
            <input type="file" id="img" name="img" required><br>

            <label for="title">Название:</label>
            <input type="text" id="title" name="title" required minlength="5" maxlength="20"><br>

            <label for="description">Описание:</label>
            <textarea id="description" name="description" rows="4" required minlength="5" maxlength="500"></textarea><br>

            <label for="price">Цена:</label>
            <input type="number" id="price" name="price" required min="300" max="1500"><br>

            <button type="submit">Добавить тариф</button>
        </form>
    </div>

    <script>
        
    </script>

</body>
</html> -->


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет админа</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="/js/admin_panel.js" defer></script>
    <script src="/js/save-choose.js" defer></script>
</head>
<body>
    <div class="sidebar">
        <a href="#" id="tariffs-link">Управление тарифами</a>
        <a href="#" id="users-link">Управление пользователями</a>
        <a href="../exit.php" id="logout-link">Выйти</a>
    </div>


    <div class="content" id="content-tariffs">
        <!-- Контент для управления тарифами -->
        <h2>Управление тарифами</h2>
        <div class="form-container">
            <h2>Добавить новый тариф</h2>
            <form id="tariff-form" action="insert_tarif.php" method="post" >
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

        <?php
            include("../connectDB.php");

            $tariff_control = "SELECT * FROM `tarifs`";
            $tariff_result = mysqli_query($connect, $tariff_control);

        
            if (mysqli_num_rows($tariff_result) > 0) {
                while ($tariff = mysqli_fetch_assoc($tariff_result)) {
            ?>
                    <div id="tarifsInfo">
                        <p>Название: <? echo $tariff['tittle_tarif'] ?> </p>
                        <p>Название: <? echo $tariff['description_tarif'] ?> </p>
                        <p>Название: <? echo $tariff['price_tarif'] ?> </p>
                        <div id="control-tarifs">
                            <a href="red-tarif.php" class="redact">Редактировать</a>
                            <a href="remove-tarif.php" class="remove">Удалить</a>
                        </div>
                    <!-- // Другие поля тарифа, которые нужно вывести -->
                    </div>
                <?php
                }
            } else {
                echo "Нет тарифов для отображения.";
            }
        ?>
    </div>

    <div class="content" id="content-users" style="display: none;">
        <!-- Контент для управления пользователями -->
        <h2>Управление пользователями</h2>
        <?php
            include("../connectDB.php");
            $user_control = "SELECT * FROM `users`";
            $user_result = mysqli_query($connect, $user_control);

            if (mysqli_num_rows($user_result) > 0) {
                while ($user = mysqli_fetch_assoc($user_result)) {
                    echo "<p>Фамилия: " . $user['surname'] . "</p>";
                    echo "<p>Имя: " . $user['name'] . "</p>";
                    echo "<p>Email: " . $user['phone'] . "</p>";
                    echo "<p>Пароль: " . $user['password'] . "</p>";
                    echo "<p>Адрес: " . $user['address'] . "</p>";
                    echo "<p>Дата Регистрации: " . $user['reg-time'] . "</p>";
                    // echo "<a href = 'remove-user.php'></a>";
                    // Другие поля пользователя, которые нужно вывести
                    echo "<hr>";

                }
            } else {
                echo "Нет пользователей для отображения.";
            }
        ?>
    </div>

</body>
</html>