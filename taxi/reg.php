<?php
    class Registration {
        public function displayRegistrationForm() {
    ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='utf-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <title>Регистрация</title>
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
                <h1>Регистрация</h1>
                <form action="userADD.php" method="post">
                    <div id="form-content">
                        <label for="surname">Фамилия :</label>
                        <input type="text" name="surname" id="surname">
                    </div>

                    <div id="form-content">
                        <label for="name">Имя : </label>
                        <input type="text" name="name" id="name">
                    </div>

                    <div id="form-content">
                        <label for="tel">Номер телефона : </label>
                        <input type="tel" name="tel" id="tel">
                    </div>

                    <div id="form-content">
                        <label for="password">Пароль : </label>
                        <input type="password" name="password" id="password">
                    </div>

                    <div id="form-content">
                        <label for="address">Ваш адрес : </label>
                        <input type="text" name="address" id="address">
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

        public function processForm() {
            // Здесь будет обработка данных формы, сохранение в базу данных и т.д.
            header("Location: userADD.php");
        }
    }

    $registration = new Registration();
    $registration->displayRegistrationForm();
?>