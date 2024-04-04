<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Результаты поиска файлов</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/search.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/back.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src='js/black-theme.js' defer></script>

</head>
<body style="background-color: goldenrod;">

    <a href="/"><img src="image/home-black.png" alt="back" title="Главная" id="back"></a>
    <h1>Результаты поиска</h1>

    <section id="search-contents">
        <div class="search-results">
            <?php
                include "connectDB.php";
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
                            // echo "<a href='/?id=" . $row["id"] . "'><button class='btn btn-primary'>Перейти</button></a>";
                            echo "<a href='/#tarifs'><button class='btn-search'>Перейти</button></a>";
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