<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Сброс пароля</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/sign.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/taxi.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/back.css">
</head>
<body>
    <?php include "taxi-squares.html"?>

    <a href="/"><img src="image/dynnamitt_home.svg" alt="back" title="Главная" id="back"></a>

    <div id="sign">
    <h1>Сброс пароля</h1>
    <form action="reset_password-sms.php" method="post">
        <div id="form-content">
            <label for="phone">Номер телефона:</label>
            <input type="tel" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Введите номер телефона" required>
        </div>

        <div id="submit">
            <input type="submit" class="submit" value="Отправить ссылку на сброс пароля">
        </div>
    </form>
    </div>

    <script>
    // Если поле номера телефона заполнено, блокируем его после отправки формы
    var phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('change', function() {
        if (phoneInput.value) {
        phoneInput.disabled = true;
        }
    });
    </script>

</body>
</html>