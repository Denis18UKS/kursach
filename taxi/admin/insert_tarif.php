<?php
    include("../connectDB.php");
    $picture = $_POST["img"];
    $title = $_POST["title"];
    $desc = $_POST["description"];
    $price = $_POST["price"];

    $sql = "INSERT INTO `tarifs`(
        `picture_tarif`,
        `tittle_tarif`,
        `description_tarif`,
        `price_tarif`
    )
    VALUES (
        '$picture',
        '$title',
        '$desc',
        '$price'
    )";

    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Тариф был успешо добавлен'); location.href = '/#tarifs'</script>";
    } else {         
        echo "Ошибка при добавлении записи: " . mysqli_error($connect);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uploadDir = 'путь_до_папки_с_изображениями/'; // Укажите путь до папки с изображениями
        $uploadFile = $uploadDir . basename($_FILES['img']['name']);

        if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
            echo "Файл загружен и сохранен в папке.";
        } else {
            echo "Произошла ошибка при загрузке файла.";
        }
    }

    // Закрываем соединение с базой данных
    mysqli_close($connect);
?>