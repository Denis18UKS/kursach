<?php
// Подключение к базе данных
    include "../connectDB.php";
// Проверка подключения
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Обработка загруженного файла
$target_dir = "../tarifs/"; // Путь к папке для загрузки
$target_file = $target_dir . basename($_FILES["img"]["name"]);
move_uploaded_file($_FILES["img"]["tmp_name"], $target_file); // Перемещение файла

// Получение остальных данных из формы
$title = $_POST["title"];
$description = $_POST["description"];
$price = $_POST["price"];

// Вставка данных в базу данных
$sql = "INSERT INTO tarifs (picture_tarif, title_tarif, description_tarif, price_tarif, status_tarif) VALUES ('$target_file', '$title', '$description', '$price', 'активен')";

if ($connect->query($sql) === TRUE) {
    // Успешно добавлено
    echo "<script>location.href='admin.php'; alert('Новый тариф успешно добавлен!');</script>";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();
?>