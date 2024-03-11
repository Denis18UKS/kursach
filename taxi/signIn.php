<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Вход</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/sign.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/taxi.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/back.css'>
</head>
<body>
<?php include "taxi-squares.html"?>

<a href="/"><img src="image/dynnamitt_home.svg" alt="back" title="Главная" id="back"></a>


    <div id="sign">
        <h1>Вход</h1>
        <form action="login.php" method="post">
            <div id="form-content">
                <label for="tel">Номер телефона : </label>
                <input type="tel" name="tel" id="tel">
            </div>

            <div id="form-content">
                <label for="password">Пароль : </label>
                <input type="password" name="password" id="password">
            </div>
            
            <div id="submit">
                <input type="submit" class="submit" value="Вход">
            </div>
        </form>

        <a href="reset_password.php">Забыли пароль?</a>

    </div>

    
</body>
</html>