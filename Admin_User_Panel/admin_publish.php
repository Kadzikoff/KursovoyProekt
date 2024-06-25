<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .request-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            gap: 15px;
        }
        .request-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        .request-item:hover {
            background-color: #f2f2f2;
        }
        .request-item div {
            margin-bottom: 5px;
        }
        .btn-container {
            margin-top: 10px;
        }
        .btn-container button {
            margin-right: 10px;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-container button:hover {
            background-color: #45a049;
        }
        .ButtonNav {
            padding: 15px;
            color: white;
            background-color: #7b6358;
            border-radius: 5px;
            text-decoration: none;
            font-size: 15px;
        }
        .ButtonNav:hover {
            background-color: transparent;
            border: 2px solid #7b6358;
            color: black;
        }
        .request-block {
            display: flex;
            justify-content: space-between;
        }
    </style>
    <script>
        function enableEditing(rowId) {
            var row = document.getElementById('row_' + rowId);
            var divs = row.getElementsByTagName('div');
            for (var i = 0; i < divs.length - 1; i++) {
                var div = divs[i];
                var strong = div.getElementsByTagName('strong')[0];
                var textNode = div.childNodes[1];
                var value = textNode ? textNode.nodeValue.trim() : '';
                div.innerHTML = '<strong>' + strong.innerHTML + '</strong> <input type="text" value="' + value + '">';
            }
            var actionsDiv = divs[divs.length - 1];
            actionsDiv.innerHTML = '<button onclick="saveChanges(' + rowId + ')">Сохранить</button>';
        }

        function saveChanges(rowId) {
            var row = document.getElementById('row_' + rowId);
            var divs = row.getElementsByTagName('div');
            var data = {};
            for (var i = 0; i < divs.length - 1; i++) {
                var div = divs[i];
                var input = div.getElementsByTagName('input')[0];
                data[div.getAttribute('data-field')] = input.value;
            }

            // Отправка данных на сервер
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_request.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send('id=' + rowId + '&data=' + JSON.stringify(data));
        }
    </script>
</head>
<body>
    <a href="admin.php" class="ButtonNav">Назад</a>
    <a href="/landing.php" class="ButtonNav">Главная</a>  
    <h1>Панель запросов</h1>

    <?php
    // Подключение к базе данных
    include 'db_connect.php';

    // Обработка действий администратора (публикация или отклонение)
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
        $action = $_POST['action'];
        list($action_type, $request_id) = explode('_', $action);
        
        if ($action_type === 'publish') {
            $publish_query = "INSERT INTO мероприятия (Название_мероприятия, Дата_начала, Количество_мест)
                            SELECT event_name, event_date, event_seats FROM requests WHERE id='$request_id'";
            $mysqli->query($publish_query);

            $publish_query = "INSERT INTO организация (Название_Организации, Аббревиатура_Организации, Город, Адрес_Организации, Телефон_Организации, Почта_Организации, Сайт_Организации, Ссылка_Адрес)
                            SELECT org_name, org_abbr, org_city, org_address, org_phone, org_email, org_website, org_maplink FROM requests WHERE id='$request_id'";
            $mysqli->query($publish_query);

            $publish_query = "INSERT INTO спортивные_сооружения (ID_Города, Адрес, Название, Аббревиатура, Вид_деятельности, Площадь, Вместительность, График_работы)
                            SELECT facility_city, facility_address, facility_name, facility_abbr, facility_activity, facility_area, facility_capacity, facility_hours FROM requests WHERE id='$request_id'";
            $mysqli->query($publish_query);
        }
        
        $delete_query = "DELETE FROM requests WHERE id='$request_id'";
        $mysqli->query($delete_query);

        echo "<script>window.location = '$_SERVER[PHP_SELF]';</script>";
    }

    // Вывод списка запросов на публикацию
    $admin_query = "SELECT * FROM requests";
    $result = $mysqli->query($admin_query);

    if ($result->num_rows > 0) {
        echo '<ul class="request-list">';
        while($row = $result->fetch_assoc()) {
            echo '<li class="request-item" id="row_' . $row['id'] . '">';
            echo '<div class="request-block" data-field="event_name"><strong>Название мероприятия:</strong> ' . $row['event_name'] . '</div>';
            echo '<div class="request-block" data-field="event_date"><strong>Дата начала:</strong> ' . $row['event_date'] . '</div>';
            echo '<div class="request-block" data-field="event_seats"><strong>Количество мест:</strong> ' . $row['event_seats'] . '</div>';
            echo '<div class="request-block" data-field="org_name"><strong>Название организации:</strong> ' . $row['org_name'] . '</div>';
            echo '<div class="request-block" data-field="org_abbr"><strong>Аббревиатура организации:</strong> ' . $row['org_abbr'] . '</div>';
            echo '<div class="request-block" data-field="org_city"><strong>Город:</strong> ' . $row['org_city'] . '</div>';
            echo '<div class="request-block" data-field="org_address"><strong>Адрес организации:</strong> ' . $row['org_address'] . '</div>';
            echo '<div class="request-block" data-field="org_phone"><strong>Телефон организации:</strong> ' . $row['org_phone'] . '</div>';
            echo '<div class="request-block" data-field="org_email"><strong>Почта организации:</strong> ' . $row['org_email'] . '</div>';
            echo '<div class="request-block" data-field="org_website"><strong>Сайт организации:</strong> ' . $row['org_website'] . '</div>';
            echo '<div class="request-block" data-field="org_maplink"><strong>Ссылка адрес:</strong> ' . $row['org_maplink'] . '</div>';
            echo '<div class="request-block" data-field="facility_city"><strong>ID города:</strong> ' . $row['facility_city'] . '</div>';
            echo '<div class="request-block" data-field="facility_address"><strong>Адрес:</strong> ' . $row['facility_address'] . '</div>';
            echo '<div class="request-block" data-field="facility_name"><strong>Название:</strong> ' . $row['facility_name'] . '</div>';
            echo '<div class="request-block" data-field="facility_abbr"><strong>Аббревиатура:</strong> ' . $row['facility_abbr'] . '</div>';
            echo '<div class="request-block" data-field="facility_activity"><strong>Вид деятельности:</strong> ' . $row['facility_activity'] . '</div>';
            echo '<div class="request-block" data-field="facility_area"><strong>Площадь:</strong> ' . $row['facility_area'] . '</div>';
            echo '<div class="request-block" data-field="facility_capacity"><strong>Вместительность:</strong> ' . $row['facility_capacity'] . '</div>';
            echo '<div class="request-block" data-field="facility_hours"><strong>График работы:</strong> ' . $row['facility_hours'] . '</div>';
            echo '<div class="btn-container">';
            echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="POST">';
            echo '<button type="submit" name="action" value="publish_' . $row['id'] . '">Опубликовать</button>';
            echo '<button type="submit" name="action" value="reject_' . $row['id'] . '">Отклонить</button>';
            echo '<button type="button" onclick="enableEditing(' . $row['id'] . ')">Редактировать</button>';
            echo '</form>';
            echo '</div>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p style="color:red; font-size:20px; font-weight:bold;">Нет запросов на публикацию</p>';
    }

    $mysqli->close();
    ?>
</body>
</html>
