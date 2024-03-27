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
                <link rel='stylesheet' type='text/css' media='screen' href='css/teacher.css'>
                <link rel='stylesheet' type='text/css' media='screen' href='css/back.css'>
                <script src="js/blur.js" defer></script>
            </head>
            <body>
            

            <a href="/"><img src="image/home.svg" alt="back" title="Главная" id="back"></a>


            <div id="sign">
                <h1>Вход</h1>
                <form action="login.php" method="post">
                    
                <div id="user-content">
                    <div id="form-content">
                        <label for="phone">Телефон : </label>
                        <input type="tel" name="phone" id="phone">
                    </div>
                </div>


                    <div id="form-content">
                        <label for="password">Пароль : </label>
                        <input type="password" name="password" id="password">
                    </div>

                    <div id="admin-fields" style="display: none;">
                        <div id="form-content">
                            <label for="login">Логин : </label>
                            <input type="text" name="login" id="login">
                        </div>
                        
                        <div id="form-content">
                            <label for="email">Почта : </label>
                            <input type="email" name="email" id="email">
                        </div>
                    </div>


                    <div id="form-content">
                        <label for="user_type">Тип пользователя:</label>
                        <select name="user_type" id="user_type">
                            <option value="users">Пользователь</option>
                            <option value="admin">Админ</option>
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
                    } else {
                        document.getElementById('admin-fields').style.display = 'none';
                        document.getElementById('user-content').style.display = 'flex';
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