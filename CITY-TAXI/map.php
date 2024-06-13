<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Карта</title>
    <link rel='stylesheet' type='text/css' media='screen' href='design/css/map.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='design/css/taxi.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='design/css/back.css'>
    <script src='design/js/black-theme.js' defer></script>


</head>
<body>
    
    <?php include "taxi-squares.html"?>

        <a href="/"><img src="image/home-black.png" alt="back" title="Главная" id="back"></a>

    <div id="content">
        <h1>Карта в Реальном Времени</h1>
        <div id="map">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A5d89bdba88f5bf45a41b6dd12aed047cb8f1c8560180b4074252b1486bd63b16&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
    </div>
</body>
</html>
