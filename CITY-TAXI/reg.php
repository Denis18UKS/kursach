<?php
class Registration
{
    public function displayRegistrationForm()
    {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <title>Регистрация</title>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' type='text/css' media='screen' href='design/css/reg.css'>
            <link rel='stylesheet' type='text/css' media='screen' href='design/css/taxi.css'>
            <link rel='stylesheet' type='text/css' media='screen' href='design/css/back.css'>

            <script src="design/js/blur.js" defer></script>
            <script src='design/js/black-theme.js' defer></script>

        </head>

        <body>

            <a href="/"><img src="image/home-black.png" alt="back" title="Главная" id="back"></a>

            <? include "taxi-squares.html" ?>


            <div id="registration">
                <h1>Регистрация</h1>
                <form action="database/reg-db.php" method="post">
                    <div id="user-content">
                        <div id="form-content">
                            <label for="surname">Фамилия :</label>
                            <input type="text" name="surname" id="surname">
                        </div>

                        <div id="form-content">
                            <label for="name">Имя : </label>
                            <input type="text" name="name" id="name">
                        </div>

                        <div id="form-content">
                            <label for="login">Логин</label>
                            <input type="text" name="login" id="login">
                        </div>

                        <div id="form-content">
                            <label for="email">Почта : </label>
                            <input type="email" name="email" id="email">
                        </div>

                        <div id="form-content">
                            <label for="password">Пароль : </label>
                            <input type="password" name="password" id="password">
                        </div>

                        <div id="form-content">
                            <label for="address">Ваш Адрес : </label>
                            <input type="text" name="address" id="address">
                        </div>
                    </div>

                    <div id="submit">
                        <input type="submit" class="submit" value="Регистрация">
                    </div>
                </form>
            </div>
        </body>

        </html>
<?php
    }

    public function processForm()
    {
        // Здесь будет обработка данных формы, сохранение в базу данных и т.д.
        header("Location: database/reg=db.php");
    }
}

$registration = new Registration();
$registration->displayRegistrationForm();
?>