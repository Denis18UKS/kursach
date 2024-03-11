<?php
include "connectDB.php";

function generateResetLink() {
    $resetToken = substr(md5(uniqid(rand(), true)), 0, 10);
    $resetLink = "https://yoursite.com/reset-password.php?token=" . $resetToken;
    return $resetLink;
}

function sendSms($phone, $message) {
    $apiUrl = "https://sms-service.com/api/send-sms";
    $apiKey = "your-api-key";
    $data = [
        'phone' => $phone,
        'message' => $message,
        'api_key' => $apiKey
    ];
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close($ch);
    if ($response === false) {
        return false;
    } else {
        return true;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверяем, переданы ли значения
    if (isset($_POST['tel']) && isset($_POST['token'])) {
        // Получаем значения из POST-запроса
        $tel = $_POST['tel'];
        $token = $_POST['token'];
        
        // Генерируем ссылку для сброса пароля
        $resetLink = generateResetLink();
        
        // Формируем сообщение для отправки по SMS
        $message = "Для сброса пароля перейдите по ссылке: " . $resetLink;
        
        // Отправляем SMS-сообщение
        $smsSent = sendSms($tel, $message);
        
        // Проверяем результат отправки SMS
        if ($smsSent) {
            echo "SMS успешно отправлено на номер " . $tel;
        } else {
            echo "Ошибка отправки SMS";
        }
    } else {
        echo "Не переданы необходимые значения";
    }
}
?>