<?php
    include "connectDB.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $surname = $_POST["surname"];
            $name = $_POST["name"];
            $phone = $_POST["tel"];
            $password = $_POST["password"];
            $address = $_POST["address"];

            // Проверка на пустые поля
            if (empty($surname) || empty($name) || empty($phone) || empty($password) || empty($address)) {
                echo "<script>alert('Заполните все поля!'); location.href = 'reg.php';</script>";
            } else {
                // ... Ваш код для добавления пользователя в базу данных ...
                $sql = "SELECT * FROM users WHERE phone = '$phone'";
                    $result = mysqli_query($connect, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<script>alert('Пользователь с таким номером телефона уже существует'); location.href = 'reg.php';</script>";

                    } else {
                        $sql = "INSERT INTO users(
                            surname,
                            name,
                            phone,
                            password,
                            address
                        )
                        VALUES(
                            '$surname',
                            '$name',
                            '$phone',
                            '$password',
                            '$address'
                        )";
                        $query = mysqli_query($connect, $sql);

                        if ($query) {
                            echo "<script>alert('Вы успешно прошли регистрацию'); location.href = 'signIn.php';</script>";
                        } else {
                            echo "<script>alert('Ошибка при добавлении пользователя'); location.href = '/';</script>";

                        }
                    }
            }
        }
    ?>