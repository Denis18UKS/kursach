<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Заказать поездку</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/reg.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/taxi.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/back.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='fonts/font.css'>
</head>
<body>
<?php include "taxi-squares.html"?>
<a href="/"><img src="image/dynnamitt_home.svg" alt="back" title="Главная" id="back"></a>

    <div id="registration">
        <h1>Заказать поездку</h1>
        <form action="orders.php" method="post">

            <div id="form-content">
                <label for="name">Дата и время поездки: </label>
                <input type="text" name="password" id="password" required>
            </div>

            <div id="form-content">
                <label for="name">Пункт назначения : </label>
                <input type="text" name="address2" id="address2" required>
            </div>

            <div id="form-content">
                <label for="name">Количество людей </label>
                <input type="number" min="1" max="4"  name="address2" id="address2" required>
            </div>
            
            <div id="submit">
                <input type="submit" class="submit" value="Заказать поездку">
            </div>
        </form>

    
</body>
</html>