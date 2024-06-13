<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Вы не авторизованы');location.href='../';</script>";
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление (Администратор)</title>
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

    <div class="content" id="content-cars">
        <!-- Контент для управления машинами -->
        <h2>Управление Машинами</h2>


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить Машину
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление Машины</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="cars" action="add_cars.php" method="post">
                            <label for="model_car">Модель Машины</label>
                            <input type="text" id="model_car" name="model_car" required><br><br>

                            <label for="number_car">Номер Машины</label>
                            <input type="number" minlength="3" id="number_car" name="number_car" required><br><br>

                            <button type="submit" class="btn btn-dark">Добавить машину</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section id="cars-control">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Модель Машины</th>
                    <th>Номер Машины</th>
                    <th>Статус</th>
                    <th>Действие</th>
                </tr>
                <?php
                include("../database/connectDB.php");

                $cars_control = "SELECT * FROM `cars`";
                $cars_result = mysqli_query($connect, $cars_control);

                if (mysqli_num_rows($cars_result) > 0) {
                    while ($cars = mysqli_fetch_assoc($cars_result)) {
                        echo "<tr>";
                        echo "<td>" . $cars['id_cars'] . "</td>";
                        echo "<td>" . $cars['model_car'] . "</td>";
                        echo "<td>" . $cars['number_car'] . "</td>";
                        echo "<td>" . $cars['status'] . "</td>";
                        // Добавьте действие для блокировки водителя
                        if ($cars['status'] == "Списана") {
                            echo "<td><a href='restore_cars.php?cars_id=" . $cars['id_cars'] . "' class='restore'>Восстановить</a></td>";
                        } else {
                            echo "<td><a href='block_cars.php?cars_id=" . $cars['id_cars'] . "' class='block'>Списать</a></td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Машины не найдены.</td></tr>";
                }
                ?>
            </table>
        </section>
    </div>

</body>

</html>