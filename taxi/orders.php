<?php


//     include "connectDB.php";    
//     $sql_test = "SELECT * FROM users INNER JOIN orders ON users.id = orders.id_user JOIN tarifs ON tarifs.id = orders.id_tarifs;";

//     $token = "6818454315:AAFUgZObH-aEou6XMcDHQRgNbGxyU8tE5Ko";
//     $chat_id = "1282617164";
    
//     $conn = mysqli_connect($connect);
    
//     if (!$conn) {
//         die("Ошибка подключения к базе данных: " . mysqli_connect_error());
//     }

//     if ($_SERVER["REQUEST_METHOD"] == "POST") {
//         $name = $_POST["name"];
//         $surname = $_POST["surname"];
//         $patronymic = $_POST["patronymic"];
//         $tel = $_POST["tel"];
//         $email = $_POST["email"];
//         $title = $_POST["title"];
//         $vk_tg = $_POST["vk-or-tg"];
//         $desrp = $_POST["desrp"];
        
//         $sql = "INSERT INTO orders (order-title, order-tarif-name, order-commentaries, order-date) VALUES ('$surname', '$surname', '$patronymic', '$tel', '$email', '$title' , '$desrp')";
    
//         if (mysqli_query($conn, $sql)) {
//             // Заказ оформлен успешно!
//             echo "<script>alert('Заказ оформлен!'); location.href = '/'</script>";

//             $random = uniqid();

//             // Отправляем сообщение в Telegram
//             $message = "Телефон: $tel\n"
//                 . "Название сайта: $title\n";
    
//             $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode($message);
//             file_get_contents($url);
//     }
//     mysqli_close($conn);
// }
?>

<?php
// Подключение к базе данных
include "connectDB.php";
// $sql_test = "SELECT * FROM users INNER JOIN orders ON users.id = orders.id_user JOIN tarifs ON tarifs.id = orders.id_tarifs;";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_time = $_POST['date_time'];
    $destination = $_POST['destination'];
    $people_count = $_POST['people_count'];
    
    // Добавление заказа в базу данных
    $sql = "INSERT INTO orders (date_time, destination, people_count) VALUES ('$date_time', '$destination', '$people_count')";
    $result = $conn->query($sql);
    
    // Отправка информации в Telegram
    $telegram_token = 'YOUR_TELEGRAM_BOT_TOKEN';
    $chat_id = 'YOUR_CHAT_ID';
    $message = "Новый заказ! Дата и время: $date_time, Пункт назначения: $destination, Людей: $people_count";
    
    $telegram_url = "https://api.telegram.org/bot$telegram_token/sendMessage?chat_id=$chat_id&text=" . urlencode($message);
    
    file_get_contents($telegram_url); // Отправка запроса на URL для отправки сообщения в Telegram
}
?>