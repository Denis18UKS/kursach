<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/nav.css'>

    <script src='/js/main.js'></script>
</head>
<body>
    <nav>
        <div class="Logo-content">
            <img src="/image/logo-taxi.svg" alt="" class="logo-img">
            <h1 class="logo-text">TAXI</h1>
        </div>

        <ul class="nav-list">
        <?php
            include "session.php";

            if ($_SESSION) {
                if (isset($_GET['type']) && $_GET['type'] === "admin") {
                    echo '<li><a href="admin/admin.php">Управление</a></li>';
                } else {
                    echo '<li><a href="profile/user.php">Личный кабинет</a></li>';
                }
            } else {
                echo '<li><a href="reg.php">Регистрация</a></li>';
                echo '<li><a href="signIn.php">Вход</a></li>';
            }
        ?>

            <li><a href="map.php">Карта</a></li>
            <li><a href="#tarifs">Тарифы</a></li>
            
            <!-- Выпадающий список -->
            <div class="dropdown">
                <button class="dropdown-toggle" onclick="toggleDropdown()">Дополнительно</button>
            <ul class="dropdown-menu" id="dropdownMenu">
                <li><a href="#">Поддержка</a></li>
                <li><button id="black-theme" onclick = BlackTheme()>Тёмная тема</button></li>
                <li><button id="Off-BlackTheme" onclick="Off_BlackTheme()">Выключить ТТ</button></li>
            </ul>
            </div>
        </ul>

        <form action="search.php" id="Searching" method="post">
            <input type="search" name="search" id="search" placeholder="Поиск" required>
            <input type="submit" value="Поиск" id="sub-searching">
        </form>

        <ul class="nav-list">

            <?php 
                include "session.php";

                // if ($_SESSION) {
                //     if(isset($_GET['type']) && $_GET['type'] === "admin")
                //         echo '<li><a href="exit.php">Выйти</a></li>';
                    
                // } else {
                //     // Вывод других ссылок или обработка отсутствия активной сессии
                // }

                if ($_SESSION) {
                    if (isset($_GET['type']) && $_GET['type'] === "admin") {
                        echo '<li><a href="exit.php">Выйти</a></li>';
                    } else {
                        echo "<li><a href='order.php'>Заказать</a></li>";
                        echo '<li><a href="exit.php">Выйти</a></li>';
                    }
                }
            ?>
        </ul>

        
    </nav>


</body>
</html>

