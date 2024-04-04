<?php
    session_start();

    if ($_SESSION) {
        // Проверяем, является ли пользователь учителем
        if ($_SESSION['user_type'] === "admin") {
            $userType = "admin";
        } else if ($_SESSION['user_type'] === "driver"){
            $userType = "driver";
            header("Location: drivers/driver.php?type=$userType");
        } else {
            $userType = "user";
        }

        // Проверяем текущий URL на наличие параметра type
        if (!isset($_GET['type'])) {
            // Перенаправляем на index.php с соответствующим параметром
            header("Location: index.php?type=$userType");
            exit; // Обязательно завершаем выполнение скрипта после перенаправления
        }
    } else {
        // Обработка для случая, когда пользователь не авторизован
        // Вы можете добавить здесь соответствующий код, например, перенаправление на страницу входа
    }
?>