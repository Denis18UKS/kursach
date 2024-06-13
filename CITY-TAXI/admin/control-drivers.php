<?php session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
} ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление</title>
    <link rel="stylesheet" href="../design/css/admin.css">
    <script src="../design/js/admin_panel.js" defer></script>
    <script src="../design/js/save-choose.js" defer></script>
    <script src='../design/js/black-theme.js' defer></script>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- bootstrap -->

</head>

<body style="background-color: gold;">
    <div class="sidebar">
        <a href="admin.php">Управление тарифами</a>
        <a href="control-users.php">Управление пользователями</a>
        <a href="control-drivers.php">Управление водителями</a>
        <a href="control-cars.php">Управление машинами</a>
        <a href="control-city.php">Управление городами</a>
        <a href="../">На главную</a>
    </div>

    <div class="content" id="content-drivers">
        <!-- Контент для управления водителями -->
        <h2>Управление Водителями</h2>


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Зарегистрировать водителя
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Регистрация Водителя</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="drivers" action="add_driver.php" method="post">
                            <label for="driver-surname">Фамилия:</label>
                            <input type="text" id="driver-surname" name="driver-surname" required><br><br>

                            <label for="driver-name">Имя:</label>
                            <input type="text" id="driver-name" name="driver-name" required><br><br>

                            <label for="driver-patronymic">Отчество:</label>
                            <input type="text" id="driver-patronymic" name="driver-patronymic" required><br><br>

                            <label for="driver-age">Возраст:</label>
                            <input type="number" min="20" id="driver-age" name="driver-age" required><br><br>

                            <label for="driver-experience">Стаж:</label>
                            <input type="number" min="3" id="driver-experience" name="driver-experience" required><br><br>

                            <label for="password">Пароль</label>
                            <input type="password" min="3" id="password" name="password" required><br><br>

                            <label for="driver-license">Водительское удостоверение:</label>
                            <input type="text" id="driver-license" name="driver-license" required><br><br>

                            <button type="submit" class="btn btn-dark">Добавить водителя</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section id="drivers-control" class="mb-5">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Возраст</th>
                    <th>Стаж</th>
                    <th>Пароль</th>
                    <th>Водительское удостоверение</th>
                    <th>Машина</th>
                    <th>Статус Смены</th>
                    <th>Статус</th>
                    <th>Действие</th>
                    <th>Действие</th>
                </tr>
                <?php
                include("../database/connectDB.php");

                $driver_control = "SELECT * FROM `drivers` JOIN cars ON drivers.id_cars = cars.id_cars";
                $driver_result = mysqli_query($connect, $driver_control);

                if (mysqli_num_rows($driver_result) > 0) {
                    while ($driver = mysqli_fetch_assoc($driver_result)) {
                        echo "<tr>";
                        echo "<td>" . $driver['id'] . "</td>";
                        echo "<td>" . $driver['surname_driver'] . "</td>";
                        echo "<td>" . $driver['name_driver'] . "</td>";
                        echo "<td>" . $driver['patronymic_driver'] . "</td>";
                        echo "<td>" . $driver['age'] . "</td>";
                        echo "<td>" . $driver['experience'] . "</td>";
                        echo "<td>" . $driver['password'] . "</td>";
                        echo "<td>" . $driver['driver_license'] . "</td>";
                        echo "<td>" . $driver['model_car'] . " " . "X" . $driver['number_car'] . "XX" . "</td>";
                        echo "<td>" . $driver['status_work'] . "</td>";
                        echo "<td>" . $driver['status_driver'] . "</td>";
                        // Добавьте действие для блокировки водителя
                        if ($driver['status_driver'] == 'Заблокирован') {
                            echo "<td><a href='restore-driver.php?driver_id=" . $driver['id'] . "' class='restore'>Восстановить</a>";
                        } else {
                            echo "<td><a href='block-driver.php?driver_id=" . $driver['id'] . "' class='block'>Заблокировать</a>";
                            // Добавьте форму для удаления водителя
                            echo "<form action='#' method='POST'>";
                            echo "<input type='hidden' name='deleteDriverId' value='" . $driver['id'] . "'>";
                            echo "<td><button type='submit' class='remove'>Удалить</button></td>";
                            echo "</form>";

                            // Обработчик удаления водителя
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $driverIdToDelete = $_POST['deleteDriverId'];

                                // Проверяем, есть ли у водителя активные заказы
                                $checkOrdersSql = "SELECT COUNT(*) as orders_count FROM `orders` WHERE `driver_id` = '$driverIdToDelete' AND `order_status`!= 'выполнен'";
                                $checkOrdersResult = mysqli_query($connect, $checkOrdersSql);
                                $checkOrdersRow = mysqli_fetch_assoc($checkOrdersResult);

                                if ($checkOrdersRow['orders_count'] > 0) {
                                    // Если у водителя есть активные заказы, показываем сообщение об ошибке
                                    echo "<script>alert('Невозможно удалить водителя, у которого есть активные заказы.'); location.href='control-drivers.php';</script>";
                                } else {
                                    // Если активных заказов нет, продолжаем процесс удаления
                                    $sql = "DELETE FROM `drivers` WHERE `id` = '$driverIdToDelete'";
                                    $result = mysqli_query($connect, $sql);
                                    if ($result) {
                                        echo "<script>alert('Водитель успешно удален'); location.href='control-drivers.php';</script>";
                                    } else {
                                        echo "<script>alert('Ошибка при удалении водителя.'); location.href='control-drivers.php';</script>";
                                    }
                                }
                            }
                        }
                        echo "</td>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Водители не найдены.</td></tr>";
                }

                ?>
            </table>
        </section>

        <!-- Кнопка для вызова модального окна с формой для переназначения машин -->
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#carexampleModal">
            Переназначить машину
        </button>

        <!-- Модальное окно с формой для переназначения машин -->
        <div class="modal fade" id="carexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Переназначение машин</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php

                        // Запрос для получения данных водителей
                        $driverSql = "SELECT id, surname_driver, name_driver, patronymic_driver FROM drivers";
                        $driverResult = $connect->query($driverSql);

                        // Запрос для получения данных о машинах
                        $carSql = "SELECT id_cars, model_car, number_car FROM cars";
                        $carResult = $connect->query($carSql);
                        ?>

                        <form id="drivers" action="#" method="post">
                            <label for="driver">Водитель:</label>
                            <select name="driver">
                                <option disabled selected>Выберите водителя</option>
                                <?php while ($driver = mysqli_fetch_assoc($driverResult)) { ?>
                                    <option value="<?php echo $driver['id']; ?>">
                                        <?php echo $driver['surname_driver'] . " " . $driver['name_driver'] . " " . $driver['patronymic_driver']; ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label for="car">Машина:</label>
                            <select name="car">
                                <option disabled selected>Выберите машину</option>
                                <?php while ($car = mysqli_fetch_assoc($carResult)) { ?>
                                    <option value="<?php echo $car['id_cars']; ?>">
                                        <?php echo $car['model_car'] . " " . $car['number_car']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <button type="submit" class="btn btn-dark">Переназначить машину</button>
                        </form>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $driver = $_POST['driver'];
                            $car = $_POST['car'];

                            if (empty($driver) || empty($car)) {
                                echo "<script>alert('Заполните все поля!');</script>";
                            } else {
                                $sql = "UPDATE `drivers` SET `id_cars` = '$car' WHERE `id` = '$driver'";
                                $result = $connect->query($sql);
                                echo "<script>alert('Данные успешно обновлены!'); location.href='control-drivers.php';</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>