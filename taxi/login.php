<?php
    include "connectDB.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $phone = $_POST["tel"];
        $password = $_POST["password"];

        // Проверка на пустые поля
        if (empty($phone) || empty($password)) {
            echo "<script>alert('Заполните все поля!'); location.href = 'signIn.php';</script>";
        } else {
            // ... Ваш код для проверки существования пользователя в базе данных ...
            $sql = "SELECT * FROM users WHERE phone = '$phone' AND password = '$password'";
            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Пользователь найден, запустить сессию и перенаправить на страницу профиля
                session_start();
                $_SESSION['phone'] = $phone;
                header("Location: /");
                exit();
            } else {
                echo "<p class='error'></p>";
                echo "<script>alert('Неверный номер телефона или пароль!'); location.href = 'signIn.php';</script>";
            }
        }
    }
?>
