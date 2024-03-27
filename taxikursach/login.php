<?php
    include "connectDB.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $phone = $_POST["phone"];
        $admin_login = $_POST["login"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user_type = $_POST["user_type"]; // Добавляем получение типа пользователя

            // Проверка типа пользователя
            if ($user_type == "users") {
                $sql = "SELECT * FROM users WHERE phone = '$phone' AND password = '$password'";
            } elseif ($user_type == "admin") {
                $sql = "SELECT * FROM admins WHERE admin_email = '$email' AND admin_password = '$password' AND admin_login = '$admin_login';";
            }

            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Найден пользователь или учитель - запускаем сессию и перенаправляем
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['user_type'] = $user_type; // Сохраняем тип пользователя в сессии
                header("Location: /"); // Перенаправление на главную страницу или личный кабинет
                exit();
            } else {
                echo "<p class='error'></p>";
                echo "<script>alert('Неверный email или пароль!'); location.href = 'signIn.php';</script>";
            }
        }

?>

<link rel='stylesheet' type='text/css' media='screen' href='css/nav.css'>
