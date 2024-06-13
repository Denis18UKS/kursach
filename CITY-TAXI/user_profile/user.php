<? session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет пользователя</title>
    <link rel="stylesheet" href="../design/css/user.css">
    <script src="../design/js/save-choose.js" defer></script>
    <script src='../design/js/black-theme.js' defer></script>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- bootstrap -->

</head>

<body style="background-color: gold; color: black">

    <div class="sidebar">
        <a href="../orders/order-history.php">История заказов</a>
        <a href="../" id="logout-link">На главную</a>
    </div>

    <div id="edit" class="container">
        <h1>Мои данные</h1>
        <?php

        require('../database/connectDB.php');

        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user'];
            $sql = "SELECT * FROM users WHERE id = '$userId'";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc(); ?>
                <form action="update_profile.php" method="post">
                    <div id="form-contents">
                        <div class="mb-3">
                            <label for="surname" class="form-label">Фамилия:</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $user['surname']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Имя:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="login" class="form-label">Логин:</label>
                            <input type="text" class="form-control" id="login" name="login" value="<?php echo $user['login']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Почта:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль:</label>
                            <input type="text" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Адрес:</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="reg-time" class="form-label">Дата регистрации:</label>
                            <input readonly type="text" class="form-control" id="reg-time" name="reg-time" value="<?php echo $user['reg-time']; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Сохранить изменения</button>
                </form>
        <?php
            } else {
                echo "Пользователь не найден.";
            }
        } else {
            header("Location: ../signIn.php");
            exit();
        }
        ?>
    </div>


    <div id="edit" class="container">
        <h1>Мои Адреса</h1>
        <?php
        require('../database/connectDB.php');

        $userId = $_SESSION['user'];
        $sql = "SELECT * FROM address WHERE id_user = '$userId'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='addresses-table'><thead><tr><th>Адрес</th></tr></thead><tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['address']}</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>Адреса не найдены.</p>";
        }
        ?>
    </div>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
        Добавить Адрес
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Добавление Адреса
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="address-add.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="address" id="formId1" placeholder="Введите адрес" require />
                            <label for="formId1">Введите Адрес</label>
                        </div>
                    </form>
                    <a href="address-add.php" class="btn btn-dark">Добавить адрес</a>
                </div>
            </div>
        </div>
    </div>



</body>

</html>