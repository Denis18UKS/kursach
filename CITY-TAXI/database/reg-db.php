<?php

require "connectDB.php";

$surname = $_POST['surname']?? '';
$name = $_POST['name']?? '';
$login = $_POST['login']?? '';
$email = $_POST['email']?? '';
$password = $_POST['password']?? '';
$address = $_POST['address']?? '';

// Проверяем, заполнены ли все поля
if (empty($surname) || empty($name) || empty($login) || empty($email) || empty($password) || empty($address)) {
    echo "<script>alert('Заполните все поля!'); location.href='../reg.php';</script>";
} else {
    // Проверяем, существует ли пользователь с таким email или адресом
    $sql = "SELECT * FROM `users` WHERE `email` = '$email' OR `login` = '$login'";
    $result = mysqli_query($connect, $sql);
    

    if ($result->num_rows > 0) {
        echo "<script>alert('Пользователь с такой почтой/логином уже существует!'); location.href='../';</script>";
    } else {
        // Вставляем нового пользователя в базу данных
        $sqlInsert = "INSERT INTO `users`(
                        `surname`,
                        `name`,
                        `login`,
                        `email`,
                        `password`,
                        `address`,
                        `id_role`
                    )
                    VALUES(
                        '$surname',
                        '$name',
                        '$login',
                        '$email',
                        '$password',
                        '$address',
                        1
                    )";

        $result = mysqli_query($connect, $sqlInsert);


        echo "<script>alert('Пользователь успешно зарегистрирован'); location.href='../signIn.php'</script>";
    }
}
?>
