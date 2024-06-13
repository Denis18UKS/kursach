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

<body style="background-color: gold; color: black   ">
    <div class="sidebar">
        <a href="admin.php">Управление тарифами</a>
        <a href="control-users.php">Управление пользователями</a>
        <a href="control-drivers.php">Управление водителями</a>
        <a href="control-cars.php">Управление машинами</a>
        <a href="control-city.php">Управление городами</a>
        <a href="../">На главную</a>
    </div>

    <div class="content" id="content-tariffs">
        <!-- Контент для управления тарифами -->
        <h2>Управление тарифами</h2>


        <!-- Button trigger modal -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить
            тариф</button>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Добавление тарифа</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="tariff-form" action="insert_tarif.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="img" class="form-label">Изображение:</label>
                                <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Название:</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Название" required minlength="5" maxlength="20">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Описание:</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Описание" rows="3" required minlength="5" maxlength="500"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Цена:</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Цена" required min="300" max="1500">
                            </div>
                            <button type="submit" class="btn btn-dark">Добавить тариф</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <section id="tarifs-control">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Стоимость</th>
                    <th>Статус</th>
                    <th>Действие</th>
                    <th>Действие</th>
                </tr>
                <?php
                include("../database/connectDB.php");

                $tariff_control = "SELECT * FROM `tarifs`";
                $tariff_result = mysqli_query($connect, $tariff_control);

                if (mysqli_num_rows($tariff_result) > 0) {
                    while ($tariff = mysqli_fetch_assoc($tariff_result)) {
                        echo "<tr>";
                        echo "<td>" . $tariff['id'] . "</td>";
                        echo "<td>" . $tariff['title_tarif'] . "</td>";
                        echo "<td>" . $tariff['description_tarif'] . "</td>";
                        echo "<td>" . $tariff['price_tarif'] . "₽" . "</td>";
                        echo "<td>" . $tariff['status_tarif'] . "</td>";
                        if ($tariff['status_tarif'] == 'активен') {
                            echo "<td><a href='change-status-tarif.php?id=" . $tariff['id'] . "&status=активен' onclick='confirmRemove()' class='remove'>Скрыть</a></td>";
                        } else {
                            echo "<td><a href='change-status-tarif.php?id=" . $tariff['id'] . "&status=неактивен' onclick='confirmRestore()' class='restore'>Восстановить</a></td>";
                        }



                ?>



                        <td><a href='delete-tarif.php?id=<?php echo $tariff['id']; ?>' onclick='return confirmDelete()' class='delete'>Удалить</a></td>

                <?php echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Нет тарифов для отображения.</td></tr>";
                }
                ?>
            </table>
        </section>
    </div>

    <script>
        function confirmRemove() {
            return confirm("Вы уверена что хотите Скрыть тариф?");
        }

        function confirmRestore() {
            return confirm("Вы уверена что хотите восстановить тариф?");
        }

        function confirmDelete() {
            return confirm("Вы уверены что точно хотите Скрыть тариф навсегда без возможности восстановления?");
        }
    </script>

</body>

</html>