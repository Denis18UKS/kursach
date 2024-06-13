<?php
class SignIn
{
    public function displaySignForm()
    {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <title>Вход</title>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' type='text/css' media='screen' href='design/css/sign.css'>
            <link rel='stylesheet' type='text/css' media='screen' href='design/css/taxi.css'>
            <link rel='stylesheet' type='text/css' media='screen' href='design/css/back.css'>
            <script src="design/js/blur.js" defer></script>
            <script src='design/js/black-theme.js' defer></script>
        </head>

        <body>


            <a href="/"><img src="image/home-black.png" alt="back" title="Главная" id="back"></a>

            <? include "taxi-squares.html" ?>

            <div id="sign">
                <h1>Вход</h1>
                <form action="database/auth-db.php" method="post">

                    <div id="user-content">
                        <div id="form-content">
                            <label for="login">Логин : </label>
                            <input type="text" title="Введите свой логин" name="login" id="login">
                        </div>
                    </div>


                    <div id="form-content">
                        <label for="password">Пароль : </label>
                        <input type="password" title="Введите пароль" name="password" id="password">
                    </div>

                    <div id="submit">
                        <input type="submit" class="submit" value="Вход">
                    </div>
                </form>
            </div>
        </body>

        </html>
<?php
    }

    public function processFormSignIn()
    {
        header("Location: login.php");
    }
}
$signIn = new SignIn();
$signIn->displaySignForm();
?>