<section id="tarifs">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Taxi-kurshach";

            $connect = new mysqli($servername, $username, $password, $dbname);

            if ($connect->connect_error) {
                die("Ошибка подключения: " . $connect->connect_error);
            }

            $sql = "SELECT * FROM tarifs";
            $result = $connect->query($sql);

            if ($result === false) {
                die("Ошибка выполнения запроса: " . $connect->error);
            }

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Ваш код для вывода данных
                    echo "<div id='tarif-card' style='width: 20rem;'>";
                    echo " <div class='card-body'>";    
                    echo " <h1 class='card-title'>" . $row['title_tarif'] . "</h1>";        
                    echo "<p class='card-text-info'>" . $row['description_tarif'] . "</р>";        
                    echo "<div id='price-and-btn-content'>";        
                    echo " <h5>Цена: " . $row['price_tarif'] . "₽" . "</h5>";            
                    echo " <a href='/tarifs/tarif_info.php?tariff=1' class='btn btn-primary' id='button-more'>Читать подробнее</a>";           
                    echo " </div>";        
                    echo " </div>";   
                    echo " </div>";
                }
            } else {
                echo "0 результатов";
            }

            $connect->close();
        ?>
    </section>