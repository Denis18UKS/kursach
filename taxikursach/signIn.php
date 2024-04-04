<?php
    class SignIn {
        public function displaySignForm() {
    ?>
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
                <script src="js/blur.js" defer></script>
                <script src='js/black-theme.js' defer></script>
            </head>
            <body>
            

            <a href="/"><img src="image/home-black.png" alt="back" title="Главная" id="back"></a>

            <? include "taxi-squares.html"?>

            <div id="sign">
                <h1>Вход</h1>
                <form action="login.php" method="post">
                    
                <div id="user-content">
                    <div id="form-content">
                        <label for="phone">Телефон : </label>
                        <input type="tel" title="Введите свой номер телефона" name="phone" id="phone">
                    </div>
                </div>


                    <div id="form-content">
                        <label for="password">Пароль : </label>
                        <input type="password" title="Введите пароль" name="password" id="password">
                    </div>

                    <div id="admin-fields" style="display: none;">
                        <div id="form-content">
                            <label for="login">Логин : </label>
                            <input type="text" title="Введите свой логин" name="login" id="login">
                        </div>
                        
                        <div id="form-content">
                            <label for="email">Почта : </label>
                            <input type="email" title="Введите свою почту" name="email" id="email">
                        </div>
                    </div>

                    <div id="driver-fields" style="display: none;">
                        <div id="form-content">
                            <label for="surname">Фамилия : </label>
                            <input type="text" title="Введите свою фамилию" name="dr_surname" id="dr_surname">
                        </div>
                        
                        <div id="form-content">
                            <label for="license">НВУ : </label>
                            <input type="text" title="Введите номер водительского удостоверения" name="license" id="license">
                        </div>
                    </div>


                    <div id="form-content">
                        <label for="user_type">Тип пользователя:</label>
                        <select name="user_type" id="user_type">
                            <option value="users">Пользователь</option>
                            <option value="admin">Админ</option>
                            <option value="driver">Водитель</option>
                        </select>
                    </div>
                    
                    <div id="submit">
                        <input type="submit" class="submit" value="Вход">
                    </div>
                </form>
            </div>

            <script>
                document.getElementById('user_type').addEventListener('change', function() {
                    if (this.value === 'admin') {
                        document.getElementById('admin-fields').style.display = 'flex';
                        document.getElementById('user-content').style.display = 'none';
                        document.getElementById('driver-fields').style.display = 'none';
                    } else if (this.value ==='driver'){
                        document.getElementById('driver-fields').style.display = 'flex';
                        document.getElementById('user-content').style.display = 'none';
                        document.getElementById('admin-fields').style.display = 'none';
                    } else {
                        document.getElementById('admin-fields').style.display = 'none';
                        document.getElementById('user-content').style.display = 'flex';
                        document.getElementById('driver-fields').style.display = 'none';
                    }
                });
            </script>
            
            </body>
            </html>
            <?php
        }

    public function processFormSignIn() {
        header("Location: login.php");
    }
}
    $signIn = new SignIn();
    $signIn ->displaySignForm();
?>