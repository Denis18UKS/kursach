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
        <h2>Управление городами</h2>


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить город
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление города</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="drivers" action="add_city.php" method="post">

                            <label for="cityname">Название города:</label>
                            <input type="text" id="cityname" name="cityname" required><br><br>

                            <label for="cityprice">Цена до города:</label>
                            <input type="text" id="cityprice" name="cityprice" required><br><br>

                            <button type="submit" class="btn btn-dark">Добавить город</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section id="drivers-control">
            <table>
                <tr>
                    <th>ID города</th>
                    <th>Название города</th>
                    <th>Цена</th>
                </tr>
                <?php
                include("../database/connectDB.php");

                $city_control = "SELECT * FROM `city`";
                $city_result = mysqli_query($connect, $city_control);

                if (mysqli_num_rows($city_result) > 0) {
                    while ($city = mysqli_fetch_assoc($city_result)) {
                        echo "<tr>";
                        echo "<td>" . $city['id_city'] . "</td>";
                        echo "<td>" . $city['name_city'] . "</td>";
                        echo "<td>" . $city['price_travel'] . ' ₽' . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Города не добавлены.</td></tr>";
                }
                ?>
            </table>
        </section>
    </div>

</body>

</html>