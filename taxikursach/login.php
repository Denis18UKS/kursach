<?php 
include "connectDB.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $phone = $_POST["phone"]; 
    $admin_login = $_POST["login"]; 
    $email = $_POST["email"]; 
    $password = $_POST["password"]; 
    $user_type = $_POST["user_type"]; // Добавляем получение типа пользователя 

    $dr_surname = $_POST['dr_surname']; 
    $driver_license = $_POST['license']; 

    $status = $_POST['status']; 

    // Проверка типа пользователя  
    if ($user_type == "driver") {  
        $sql = "SELECT *, 'активен' as status FROM drivers WHERE surname = '$dr_surname' AND password = '$password' AND driver_license = '$driver_license'";  
    } else if ($user_type == "admin") {  
        $sql = "SELECT *, 'активен' as status FROM admins WHERE admin_email = '$email' AND admin_password = '$password' AND admin_login = '$admin_login'";  
    } else {  
        $sql = "SELECT * FROM users WHERE phone = '$phone' AND password = '$password'";  
    }  

    $result = mysqli_query($connect, $sql); 

    if (mysqli_num_rows($result) > 0) { 
        $user = mysqli_fetch_assoc($result);
        if($user['status'] == 'заблокирован'){
            echo "<script>alert('Доступ запрещен. Вы заблокированы.');</script>";
        } else {
            // Найден пользователь или учитель - запускаем сессию и перенаправляем 
            session_start(); 
            $_SESSION['email'] = $email; 
            $_SESSION['user_type'] = $user_type; // Сохраняем тип пользователя в сессии 
            header("Location: /"); // Перенаправление на главную страницу или личный кабинет 
            exit(); 
        }
    } else { 
        echo "<p class='error'></p>"; 
        echo "<script>alert('Неверный email или пароль!');</script>"; 
    } 
} 
?> 

