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

    <script src='main.js'></script>
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
            <p>Любишь гулять и кататься ночью по городу? Тогда стоит позаботиться о средстве передвижения. Любая прогулка, любая встреча, может ненароком затянуться. Ночные автобусы не всегда ходят по расписанию, а цены на такси кусаются. Таксопарк TAXI предлагает лучшее решение – услуга «Ночное такси» для ночных бабочек.</p>
        </div>
    </section>

    <h1 class="tarifs">Тарифы</h1>

    <section id="tarifs">

        <div id="tarif-card">
            <div id="tarif-img-text">
                <img src="/image/детский.png" alt="">
            </div>

            <div id="tarif-card-text">
                <h2>Тариф детский - это</h2>
                <p>удобство, безопасность и комфорт для самых маленьких пассажиров. С нами ваш ребенок будет под надежной защитой, а поездка пройдет в приятной и уютной атмосфере.</p>
            </div>
        </div>

        <div id="tarif"></div>
        <div id="tarif"></div>
    </section>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>