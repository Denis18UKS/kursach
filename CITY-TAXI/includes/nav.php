<? session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='/design/css/nav.css'>

    <script src='/design/js/main.js'></script>
</head>

<body>


    <nav>
        <div class="Logo-content">
            <img src="/image/logo-taxi.svg" alt="" class="logo-img">
            <h1 class="logo-text">CITY-TAXI</h1>
        </div>

        <ul class="nav-list">
            <?php

            if ($_SESSION) {
                if (isset($_SESSION['admin'])) { ?>
                    <li><a href="admin/admin.php">Управление</a></li>
                    <li><a href="../map.php">Карта</a></li>
                    <li><a href="../#tarifs-contents">Тарифы</a></li>
                    <div class="dropdown">
                        <button class="dropdown-toggle" onclick="toggleDropdown()">Дополнительно</button>
                        <ul class="dropdown-menu" id="dropdownMenu">
                            <li><button id="black-theme" onclick=BlackTheme()>Тёмная тема</button></li>
                            <li><button id="Off-BlackTheme" onclick="Off_BlackTheme()">Выключить ТТ</button></li>
                        </ul>
                    </div>
                <? } else if (isset($_SESSION['driver'])) {
                    echo "<li><a href='../drivers/driver.php'>Заказы</a></li>";
                    echo "<li><a href='../drivers/order_history.php'>История заказов</a></li>";

                } else { ?>
                        <li><a href='user_profile/user.php'>Личный кабинет</a></li>
                        <li><a href="../map.php">Карта</a></li>
                        <li><a href="../#tarifs-contents">Тарифы</a></li>
                        <div class="dropdown">
                            <button class="dropdown-toggle" onclick="toggleDropdown()">Дополнительно</button>
                            <ul class="dropdown-menu" id="dropdownMenu">
                                <li><button id="black-theme" onclick=BlackTheme()>Тёмная тема</button></li>
                                <li><button id="Off-BlackTheme" onclick="Off_BlackTheme()">Выключить ТТ</button></li>
                            </ul>
                        </div>
                <? }
            } else { ?>
                <li><a href="reg.php">Регистрация</a></li>
                <li><a href="signIn.php">Вход</a></li>
                <li><a href="../map.php">Карта</a></li>
                <li><a href="../#tarifs-contents">Тарифы</a></li>
                <div class="dropdown">
                    <button class="dropdown-toggle" onclick="toggleDropdown()">Дополнительно</button>
                    <ul class="dropdown-menu" id="dropdownMenu">
                        <li><button id="black-theme" onclick=BlackTheme()>Тёмная тема</button></li>
                        <li><button id="Off-BlackTheme" onclick="Off_BlackTheme()">Выключить ТТ</button></li>
                    </ul>
                </div>
            <? }
            ?>

            <!-- Выпадающий список -->

        </ul>

        <form action="search.php" id="Searching" method="post">
            <input type="search" name="search" id="search" placeholder="Поиск" required>
            <input type="submit" value="Поиск" id="sub-searching">
        </form>

        <ul class="nav-list">
            <?php
            if ($_SESSION) {
                if (isset($_SESSION['admin']) || isset($_SESSION['driver'])) {
                    echo '<li><a href="../database/exit.php">Выйти</a></li>';
                } else {
                    echo "<li><a href='orders/order.php'>Заказать</a></li>";
                    echo '<li><a href="database/exit.php">Выйти</a></li>';
                }
            }
            ?>
        </ul>
    </nav>

</body>

</html>