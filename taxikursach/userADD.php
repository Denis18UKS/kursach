<?php
include "connectDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = trim($_POST["surname"]);
    $name = trim($_POST["name"]);
    $phone = trim($_POST["tel"]);
    $password = trim($_POST["password"]);
    $admin_password = trim($_POST["admin_password"]);
    $admin_login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $user_type = trim($_POST["user_type"]);
    $address = trim($_POST["address"]);

    // Проверка наличия пользователя в базе данных
    if ($user_type == "users") {
        $check_sql = "SELECT * FROM users WHERE phone = '$phone'";
    } else if ($user_type == "admin") {
        $check_sql = "SELECT * FROM admin WHERE admin_email = '$email'";
    }

    $check_query = mysqli_query($connect, $check_sql);

    if (mysqli_num_rows($check_query) > 0) {
        echo "<script>alert('Пользователь с таким email уже существует'); location.href = 'reg.php';</script>";
    } else {
        // Добавление пользователя в базу данных
        if ($user_type == "users") {
            $sql = "INSERT INTO users (surname, name, password, phone, address) VALUES ('$surname', '$name', '$password', '$phone', '$address')";
        } else if ($user_type == "admin") {
            $sql = "INSERT INTO admin (admin_login, admin_password, admin_email) VALUES ('$admin_login', '$admin_password', '$email')";
        }

        if (mysqli_query($connect, $sql)) {
            echo "<script>alert('Пользователь успешно зарегистрирован.'); location.href='signIn.php'</script>";
        } else {
            echo "Ошибка: " . $sql . "<br>" . mysqli_error($connect);
        }
    }
}
?>