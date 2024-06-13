<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Результаты поиска файлов</title>
    <link rel="stylesheet" type="text/css" media="screen" href="design/css/search.css">
    <link rel='stylesheet' type='text/css' media='screen' href='design/css/back.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src='design/js/black-theme.js' defer></script>

</head>

<?php include "includes/nav.php" ?>


<body style="background-color: gold;">

    <h1>Результаты поиска</h1>

    <section id="search-contents">
        <div class="search-results">
            <?php
                include "database/connectDB.php";
                if(isset($_POST['search'])) {
                    $search_query = $_POST['search']; // Получаем значение запроса поиска
                    // Выполняем поиск файлов в двух таблицах базы данных
                    $sql = "SELECT * FROM tarifs WHERE title_tarif LIKE '%$search_query%' OR description_tarif LIKE '%$search_query%'";
                    $result = $connect->query($sql);

                    if ($result !== false && $result->num_rows > 0) {
                        // Выводим найденные файлы
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='tarif'>";
                            echo "<h2>".$row['title_tarif']."</h2>";
                            echo "<p>".$row['description_tarif']."</p>";
                            echo "<a href='/#tarifs'><button class='btn btn-warning'>Перейти</button></a>";
                            echo "</div>";
                        }
                    } else {
                        echo "Ничего не найдено";
                    }
                }
            ?>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>