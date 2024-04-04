<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Таксопарк</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/taxi.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/nav.css'>

    <script src='js/main.js' defer></script>
    <script src='js/black-theme.js' defer></script>
</head>
<body>

<?php include "nav.php" ?>

<header>
    <div id="container-header-text">
        <div id="cont-h1">
            <div id="cont-h1-hr">
                <h1>Ночное такси</h1>
                <hr>
            </div>
            <div id="cont-h3">
                <h3>Вам срочно нужно вызвать такси ночью но другой таксопарк слишком дорог для вас?</h3>
                <h3>Не беспокойтесь! У нас всё дешёво, отвезём быстро, дешёво и с комфортом!</h3>
            </div>
        </div>
    </div>
</header>

<?php include "taxi-squares.html" ?>

<main>
    <section id="info-block">
        <img src="image/mg-taxi-for-ingo.jpg" alt="">
    
        <div id="info-text">
            <h1>Информация</h1>       
            <h2>Ночное такси</h2>
            <p>Любишь гулять и кататься ночью по городу? Тогда стоит позаботиться о средстве передвижения. Любая прогулка, любая встреча, может ненароком затянуться. Ночные автобусы не всегда ходят по расписанию, а цены на такси кусаются. Таксопарк TAXI предлагает лучшее решение – услуга «Ночное такси» для любителей ночной атмосферы.</p>
        </div>
    </section>
    
<section id="tarifs-contents">
    <h1 class="tarifs">Тарифы</h1>
        <section id="tarifs" class="tarifs-container">

        <?php
            include "connectDB.php";

            $sql = "SELECT * FROM tarifs";
            $result = $connect->query($sql);

            if ($result === false) {
                die("Ошибка выполнения запроса: " . $connect->error);
            }

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ($row['status_tarif'] == 'активен') {
                        echo "<div id='tarif-card' style='width: 20rem;'>";
                        echo "<img src='../tarifs/" . $row['picture_tarif'] . "' class='card-img-top' alt=''>";
                        echo "<div class='card-body'>";
                        echo "<h1 class='card-title'>" . $row['title_tarif'] . "</h1>";        
                        echo "<p class='card-text-description' style='display: none;' id='description-" . $row['id'] . "'>" . $row['description_tarif'] . "</p>";
                        echo "<div class='price-and-btn-content'>";
                        echo "<h5>Цена: от " . $row['price_tarif'] . "₽</h5>";
                        echo "<button onclick='displayMore(" . $row['id'] . ")' class='btn btn-primary' id='button-more-" . $row['id'] . "'>Читать подробнее</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            } else {
                echo "0 результатов";
            }

            $connect->close();
        ?>
        </section>
</section>

<section id="video">
    <h1>Видео с ночной поездки</h1>
        <div id="content-video">
            <?php include "video.php" ?>
        </div>
</section>


    <script src="js/displaymore.js" defer></script>
</main>

    <footer>
        <div id="ftr-contents">
            <div id="copyright">&copy Карпов Денис TAXI-Курсовой проект 21-Веб-1</div>
        </div>
    </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

<script>
</script>