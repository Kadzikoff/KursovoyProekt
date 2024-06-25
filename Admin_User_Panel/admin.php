
<?php
include 'db_connect.php';

// Обработка отправки формы для сохранения изменений
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Обновление мероприятий
    if (!empty($_POST['event_id'])) {
        $event_id = $_POST['event_id'];
        $event_name = $_POST['event_name'];
        $event_date = $_POST['event_date'];
        $event_seats = $_POST['event_seats'];

        foreach ($event_id as $key => $id) {
            $name = $mysqli->real_escape_string($event_name[$key]);
            $date = $mysqli->real_escape_string($event_date[$key]);
            $seats = $mysqli->real_escape_string($event_seats[$key]);
            $query = "UPDATE мероприятия SET Название_мероприятия='$name', Дата_начала='$date', Количество_мест='$seats' WHERE ID_Мероприятия='$id'";
            $mysqli->query($query);
        }
    }

    // Вставка новых мероприятий
    if (!empty($_POST['new_event_name'])) {
        $new_event_name = $_POST['new_event_name'];
        $new_event_date = $_POST['new_event_date'];
        $new_event_seats = $_POST['new_event_seats'];

        foreach ($new_event_name as $key => $name) {
            $name = $mysqli->real_escape_string($name);
            $date = $mysqli->real_escape_string($new_event_date[$key]);
            $seats = $mysqli->real_escape_string($new_event_seats[$key]);
            $query = "INSERT INTO мероприятия (Название_мероприятия, Дата_начала, Количество_мест) VALUES ('$name', '$date', '$seats')";
            $mysqli->query($query);
        }
    }

    // Удаление мероприятий
    if (!empty($_POST['delete_event_id'])) {
        $delete_event_ids = $_POST['delete_event_id'];
        
        foreach ($delete_event_ids as $id) {
            $id = $mysqli->real_escape_string($id);
            $query = "DELETE FROM мероприятия WHERE ID_Мероприятия='$id'";
            $mysqli->query($query);
        }
    }

    // Обновление городов
    if (!empty($_POST['city_id'])) {
        $city_id = $_POST['city_id'];
        $city_name = $_POST['city_name'];

        foreach ($city_id as $key => $id) {
            $name = $mysqli->real_escape_string($city_name[$key]);
            $query = "UPDATE город SET Название_Городов='$name' WHERE ID_Города='$id'";
            $mysqli->query($query);
        }
    }

    // Вставка новых городов
    if (!empty($_POST['new_city_name'])) {
        $new_city_name = $_POST['new_city_name'];

        foreach ($new_city_name as $name) {
            if (!empty($name)) {
                $name = $mysqli->real_escape_string($name);
                $query = "INSERT INTO город (Название_Городов) VALUES ('$name')";
                $mysqli->query($query);
            }
        }
    }

    // Удаление городов
    if (!empty($_POST['delete_city_id'])) {
        $delete_city_ids = $_POST['delete_city_id'];

        foreach ($delete_city_ids as $id) {
            $id = $mysqli->real_escape_string($id);
            $query = "DELETE FROM город WHERE ID_Города='$id'";
            $mysqli->query($query);
        }
    }


// Обновление организаций
if (!empty($_POST['organization_id'])) {
    $organization_id = $_POST['organization_id'];
    $organization_name = $_POST['organization_name'];
    $organization_abbr = $_POST['organization_abbr'];
    $organization_city = $_POST['organization_city'];
    $organization_address = $_POST['organization_address'];
    $organization_phone = $_POST['organization_phone'];
    $organization_email = $_POST['organization_email'];
    $organization_site = $_POST['organization_site'];
    $organization_link = $_POST['organization_link'];

    foreach ($organization_id as $key => $id) {
        $name = $mysqli->real_escape_string($organization_name[$key]);
        $abbr = $mysqli->real_escape_string($organization_abbr[$key]);
        $city = $mysqli->real_escape_string($organization_city[$key]);
        $address = $mysqli->real_escape_string($organization_address[$key]);
        $phone = $mysqli->real_escape_string($organization_phone[$key]);
        $email = $mysqli->real_escape_string($organization_email[$key]);
        $site = $mysqli->real_escape_string($organization_site[$key]);
        $link = $mysqli->real_escape_string($organization_link[$key]);
        $query = "UPDATE организация SET Название_Организации='$name', Аббревиатура_Организации='$abbr', Город='$city', Адрес_Организации='$address', Телефон_Организации='$phone', Почта_Организации='$email', Сайт_Организации='$site', Ссылка_Адрес='$link' WHERE ID_Организации='$id'";
        $mysqli->query($query);
    }
}

// Вставка новых организаций
if (!empty($_POST['new_organization_name'])) {
    $new_organization_name = $_POST['new_organization_name'];
    $new_organization_abbr = $_POST['new_organization_abbr'];
    $new_organization_city = $_POST['new_organization_city'];
    $new_organization_address = $_POST['new_organization_address'];
    $new_organization_phone = $_POST['new_organization_phone'];
    $new_organization_email = $_POST['new_organization_email'];
    $new_organization_site = $_POST['new_organization_site'];
    $new_organization_link = $_POST['new_organization_link'];

    foreach ($new_organization_name as $key => $name) {
        if (!empty($name)) {
            $abbr = $mysqli->real_escape_string($new_organization_abbr[$key]);
            $city = $mysqli->real_escape_string($new_organization_city[$key]);
            $address = $mysqli->real_escape_string($new_organization_address[$key]);
            $phone = $mysqli->real_escape_string($new_organization_phone[$key]);
            $email = $mysqli->real_escape_string($new_organization_email[$key]);
            $site = $mysqli->real_escape_string($new_organization_site[$key]);
            $link = $mysqli->real_escape_string($new_organization_link[$key]);
            $query = "INSERT INTO организация (Название_Организации, Аббревиатура_Организации, Город, Адрес_Организации, Телефон_Организации, Почта_Организации, Сайт_Организации, Ссылка_Адрес) VALUES ('$name', '$abbr', '$city', '$address', '$phone', '$email', '$site', '$link')";
            $mysqli->query($query);
        }
    }
}

// Удаление организаций
if (!empty($_POST['delete_organization_id'])) {
    $delete_organization_ids = $_POST['delete_organization_id'];

    foreach ($delete_organization_ids as $id) {
        $id = $mysqli->real_escape_string($id);
        $query = "DELETE FROM организация WHERE ID_Организации='$id'";
        $mysqli->query($query);
    }
}

    // Обновление спортивных сооружений
    if (!empty($_POST['facility_id'])) {
        $facility_id = $_POST['facility_id'];
        $facility_city = $_POST['facility_city'];
        $facility_address = $_POST['facility_address'];
        $facility_name = $_POST['facility_name'];
        $facility_abbr = $_POST['facility_abbr'];
        $facility_activity = $_POST['facility_activity'];
        $facility_area = $_POST['facility_area'];
        $facility_capacity = $_POST['facility_capacity'];
        $facility_schedule = $_POST['facility_schedule'];

        foreach ($facility_id as $key => $id) {
            $city = $mysqli->real_escape_string($facility_city[$key]);
            $address = $mysqli->real_escape_string($facility_address[$key]);
            $name = $mysqli->real_escape_string($facility_name[$key]);
            $abbr = $mysqli->real_escape_string($facility_abbr[$key]);
            $activity = $mysqli->real_escape_string($facility_activity[$key]);
            $area = $mysqli->real_escape_string($facility_area[$key]);
            $capacity = $mysqli->real_escape_string($facility_capacity[$key]);
            $schedule = $mysqli->real_escape_string($facility_schedule[$key]);
            $query = "UPDATE спортивные_сооружения SET ID_Города='$city', Адрес='$address', Название='$name', Аббревиатура='$abbr', Вид_деятельности='$activity', Площадь='$area', Вместительность='$capacity', График_работы='$schedule' WHERE ID_Сооружения='$id'";
            $mysqli->query($query);
        }
    }

    // Вставка новых спортивных сооружений
    if (!empty($_POST['new_facility_city'])) {
        $new_facility_city = $_POST['new_facility_city'];
        $new_facility_address = $_POST['new_facility_address'];
        $new_facility_name = $_POST['new_facility_name'];
        $new_facility_abbr = $_POST['new_facility_abbr'];
        $new_facility_activity = $_POST['new_facility_activity'];
        $new_facility_area = $_POST['new_facility_area'];
        $new_facility_capacity = $_POST['new_facility_capacity'];
        $new_facility_schedule = $_POST['new_facility_schedule'];

        foreach ($new_facility_city as $key => $city) {
            $city = $mysqli->real_escape_string($city);
            $address = $mysqli->real_escape_string($new_facility_address[$key]);
            $name = $mysqli->real_escape_string($new_facility_name[$key]);
            $abbr = $mysqli->real_escape_string($new_facility_abbr[$key]);
            $activity = $mysqli->real_escape_string($new_facility_activity[$key]);
            $area = $mysqli->real_escape_string($new_facility_area[$key]);
            $capacity = $mysqli->real_escape_string($new_facility_capacity[$key]);
            $schedule = $mysqli->real_escape_string($new_facility_schedule[$key]);
            $query = "INSERT INTO спортивные_сооружения (ID_Города, Адрес, Название, Аббревиатура, Вид_деятельности, Площадь, Вместительность, График_работы) VALUES ('$city', '$address', '$name', '$abbr', '$activity', '$area', '$capacity', '$schedule')";
            $mysqli->query($query);
        }
    }

    // Удаление спортивных сооружений
    if (!empty($_POST['delete_facility_id'])) {
        $delete_facility_ids = $_POST['delete_facility_id'];
        
        foreach ($delete_facility_ids as $id) {
            $id = $mysqli->real_escape_string($id);
            $query = "DELETE FROM спортивные_сооружения WHERE ID_Сооружения='$id'";
            $mysqli->query($query);
        }
    }

    // Обновление спорткомплексов
    if (!empty($_POST['complex_id'])) {
        $complex_id = $_POST['complex_id'];
        $complex_organization = $_POST['complex_organization'];
        $complex_facility = $_POST['complex_facility'];
        $complex_event = $_POST['complex_event'];

        foreach ($complex_id as $key => $id) {
            $organization = $mysqli->real_escape_string($complex_organization[$key]);
            $facility = $mysqli->real_escape_string($complex_facility[$key]);
            $event = $mysqli->real_escape_string($complex_event[$key]);
            $query = "UPDATE спорткомплекс SET ID_Организации='$organization', ID_Сооружения='$facility', ID_Мероприятия='$event' WHERE ID_Комплекса='$id'";
            $mysqli->query($query);
        }
    }

    // Вставка новых спорткомплексов
    if (!empty($_POST['new_complex_organization'])) {
        $new_complex_organization = $_POST['new_complex_organization'];
        $new_complex_facility = $_POST['new_complex_facility'];
        $new_complex_event = $_POST['new_complex_event'];

        foreach ($new_complex_organization as $key => $organization) {
            $organization = $mysqli->real_escape_string($organization);
            $facility = $mysqli->real_escape_string($new_complex_facility[$key]);
            $event = $mysqli->real_escape_string($new_complex_event[$key]);
            $query = "INSERT INTO спорткомплекс (ID_Организации, ID_Сооружения, ID_Мероприятия) VALUES ('$organization', '$facility', '$event')";
            $mysqli->query($query);
        }
    }

    // Удаление спорткомплексов
    if (!empty($_POST['delete_complex_id'])) {
        $delete_complex_ids = $_POST['delete_complex_id'];
        
        foreach ($delete_complex_ids as $id) {
            $id = $mysqli->real_escape_string($id);
            $query = "DELETE FROM спорткомплекс WHERE ID_Комплекса='$id'";
            $mysqli->query($query);
        }
    }

    // Перенаправление после обработки POST данных для избежания проблем с повторной отправкой формы
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Получение данных о мероприятиях
$query_events = "SELECT * FROM мероприятия";
$result_events = $mysqli->query($query_events);

// Получение данных о городах
$query_cities = "SELECT * FROM город";
$result_cities = $mysqli->query($query_cities);

// Получение данных об организациях
$query_organizations = "SELECT * FROM организация";
$result_organizations = $mysqli->query($query_organizations);

// Получение данных о спортивных сооружениях
$query_facilities = "SELECT * FROM спортивные_сооружения";
$result_facilities = $mysqli->query($query_facilities);

// Получение данных о спорткомплексах
$query_complexes = "SELECT * FROM спорткомплекс";
$result_complexes = $mysqli->query($query_complexes);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактор таблиц</title>
    
    <style>
        /* Общие стили */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 50px;
        }
        
        /* Стили для таблиц */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .table th, .table td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        
        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .table input[type="text"] {
            width: 100%;
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        /* Стили для кнопок */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .btn:hover {
            background-color: transparent;
            border: 2px solid #45a049;
            color: black;
            padding: 8px 18px;
        }

        .BtnEvent {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #7b6358;
        }

        .BtnEvent:hover {
            background-color: transparent;
            border: 2px solid #7b6358;
            color: black;
            padding: 8px 18px;
        }

        .BtnDelete {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .BtnDelete:hover {
            padding: 8px 18px;
            background-color: transparent;
            border: 2px solid #f44336;
            color: black;
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
    </style>
</head>
<body>
    <div class="container">
        <a href="admin_publish.php" class="ButtonNav">Запросы на публикацию</a>
        <a href="/landing.php" class="ButtonNav">Главная</a>    
        <h2>Редактор таблиц</h2>

        <form id="event-form" method="post">
            <h3>Мероприятия</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название мероприятия</th>
                        <th>Дата начала</th>
                        <th>Количество мест</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_events->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ID_Мероприятия']; ?>
                                <input type="hidden" name="event_id[]" value="<?php echo $row['ID_Мероприятия']; ?>"></td>
                            <td><input type="text" name="event_name[]" value="<?php echo $row['Название_мероприятия']; ?>"></td>
                            <td><input type="text" name="event_date[]" value="<?php echo $row['Дата_начала']; ?>"></td>
                            <td><input type="text" name="event_seats[]" value="<?php echo $row['Количество_мест']; ?>"></td>
                            <td><button type="button" onclick="deleteAndSubmit(this)" data-event-id="<?php echo $row['ID_Мероприятия']; ?>" href="#event-form" class="BtnDelete">Удалить</button></td>
                        </tr>
                    <?php endwhile; ?>
                    <tr id="new-event-row" style="display: none;">
                        <td></td>
                        <td><input type="text" name="new_event_name[]"></td>
                        <td><input type="text" name="new_event_date[]"></td>
                        <td><input type="text" name="new_event_seats[]"></td>
                        <td><button type="submit" class="btn" href="#event-form">Сохранить</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="add-event" class="BtnEvent" href="#event-form">Добавить мероприятие</button>
            <button type="submit" class="btn">Сохранить изменения</button>
            <input type="hidden" name="delete_event_id[]" id="delete-event-id">
        </form>

        <form id="city-form" method="post">
            <h3>Города</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название города</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_cities->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ID_Города']; ?>
                                <input type="hidden" name="city_id[]" value="<?php echo $row['ID_Города']; ?>"></td>
                            <td><input type="text" name="city_name[]" value="<?php echo $row['Название_Городов']; ?>"></td>
                            <td><button type="button" onclick="deleteAndSubmit(this)" data-city-id="<?php echo $row['ID_Города']; ?>" href="#city-form" class="BtnDelete">Удалить</button></td>
                        </tr>
                    <?php endwhile; ?>
                    <tr id="new-city-row" style="display: none;">
                        <td></td>
                        <td><input type="text" name="new_city_name[]"></td>
                        <td><button type="submit" class="btn">Сохранить</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="add-city" class="BtnEvent">Добавить город</button>
            <button type="submit" class="btn">Сохранить изменения</button>
            <input type="hidden" name="delete_city_id[]" id="delete-city-id">
        </form>
        </form>

        <form id="organization-form" method="post">
            <h3>Организации</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название организации</th>
                        <th>Аббревиатура</th>
                        <th>Город</th>
                        <th>Адрес</th>
                        <th>Телефон</th>
                        <th>Почта</th>
                        <th>Сайт</th>
                        <th>Ссылка на адрес</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_organizations->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ID_Организации']; ?>
                                <input type="hidden" name="organization_id[]" value="<?php echo $row['ID_Организации']; ?>"></td>
                            <td><input type="text" name="organization_name[]" value="<?php echo $row['Название_Организации']; ?>"></td>
                            <td><input type="text" name="organization_abbr[]" value="<?php echo $row['Аббревиатура_Организации']; ?>"></td>
                            <td><input type="text" name="organization_city[]" value="<?php echo $row['Город']; ?>"></td>
                            <td><input type="text" name="organization_address[]" value="<?php echo $row['Адрес_Организации']; ?>"></td>
                            <td><input type="text" name="organization_phone[]" value="<?php echo $row['Телефон_Организации']; ?>"></td>
                            <td><input type="text" name="organization_email[]" value="<?php echo $row['Почта_Организации']; ?>"></td>
                            <td><input type="text" name="organization_website[]" value="<?php echo $row['Сайт_Организации']; ?>"></td>
                            <td><input type="text" name="organization_link[]" value="<?php echo $row['Ссылка_Адрес']; ?>"></td>
                            <td><button type="button" onclick="deleteAndSubmit(this)" data-organization-id="<?php echo $row['ID_Организации']; ?>" class="BtnDelete">Удалить</button></td>
                        </tr>
                    <?php endwhile; ?>
                    <tr id="new-organization-row" style="display: none;">
                        <td></td>
                        <td><input type="text" name="new_organization_name[]"></td>
                        <td><input type="text" name="new_organization_abbr[]"></td>
                        <td><input type="text" name="new_organization_city[]"></td>
                        <td><input type="text" name="new_organization_address[]"></td>
                        <td><input type="text" name="new_organization_phone[]"></td>
                        <td><input type="text" name="new_organization_email[]"></td>
                        <td><input type="text" name="new_organization_website[]"></td>
                        <td><input type="text" name="new_organization_link[]"></td>
                        <td><button type="submit" class="btn">Сохранить</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="add-organization" class="BtnEvent">Добавить организацию</button>
            <button type="submit" class="btn">Сохранить изменения</button>
            <input type="hidden" name="delete_organization_id[]" id="delete-organization-id">
        </form>

        <form id="facility-form" method="post">
            <h3>Спортивные сооружения</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Город</th>
                        <th>Адрес</th>
                        <th>Название</th>
                        <th>Аббревиатура</th>
                        <th>Вид деятельности</th>
                        <th>Площадь</th>
                        <th>Вместительность</th>
                        <th>График работы</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_facilities->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ID_Сооружения']; ?>
                                <input type="hidden" name="facility_id[]" value="<?php echo $row['ID_Сооружения']; ?>"></td>
                            <td><input type="text" name="facility_city[]" value="<?php echo $row['ID_Города']; ?>"></td>
                            <td><input type="text" name="facility_address[]" value="<?php echo $row['Адрес']; ?>"></td>
                            <td><input type="text" name="facility_name[]" value="<?php echo $row['Название']; ?>"></td>
                            <td><input type="text" name="facility_abbr[]" value="<?php echo $row['Аббревиатура']; ?>"></td>
                            <td><input type="text" name="facility_activity[]" value="<?php echo $row['Вид_деятельности']; ?>"></td>
                            <td><input type="text" name="facility_area[]" value="<?php echo $row['Площадь']; ?>"></td>
                            <td><input type="text" name="facility_capacity[]" value="<?php echo $row['Вместительность']; ?>"></td>
                            <td><input type="text" name="facility_schedule[]" value="<?php echo $row['График_работы']; ?>"></td>
                            <td><button type="button" onclick="deleteAndSubmit(this)" data-facility-id="<?php echo $row['ID_Сооружения']; ?>" class="BtnDelete">Удалить</button></td>
                        </tr>
                    <?php endwhile; ?>
                    <tr id="new-facility-row" style="display: none;">
                        <td></td>
                        <td><input type="text" name="new_facility_city[]"></td>
                        <td><input type="text" name="new_facility_address[]"></td>
                        <td><input type="text" name="new_facility_name[]"></td>
                        <td><input type="text" name="new_facility_abbr[]"></td>
                        <td><input type="text" name="new_facility_activity[]"></td>
                        <td><input type="text" name="new_facility_area[]"></td>
                        <td><input type="text" name="new_facility_capacity[]"></td>
                        <td><input type="text" name="new_facility_schedule[]"></td>
                        <td><button type="submit" class="btn">Сохранить</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="add-facility" class="BtnEvent">Добавить сооружение</button>
            <button type="submit" class="btn">Сохранить изменения</button>
            <input type="hidden" name="delete_facility_id[]" id="delete-facility-id">
        </form>

        <form id="complex-form" method="post">
            <h3>Спорткомплексы</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Организация</th>
                        <th>Сооружение</th>
                        <th>Мероприятие</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_complexes->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ID_Комплекса']; ?>
                                <input type="hidden" name="complex_id[]" value="<?php echo $row['ID_Комплекса']; ?>"></td>
                            <td><input type="text" name="complex_organization[]" value="<?php echo $row['ID_Организации']; ?>"></td>
                            <td><input type="text" name="complex_facility[]" value="<?php echo $row['ID_Сооружения']; ?>"></td>
                            <td><input type="text" name="complex_event[]" value="<?php echo $row['ID_Мероприятия']; ?>"></td>
                            <td><button type="button" onclick="deleteAndSubmit(this)" data-complex-id="<?php echo $row['ID_Комплекса']; ?>" href="#complex-form" class="BtnDelete">Удалить</button></td>
                        </tr>
                    <?php endwhile; ?>
                    <tr id="new-complex-row" style="display: none;">
                        <td></td>
                        <td><input type="text" name="new_complex_organization[]"></td>
                        <td><input type="text" name="new_complex_facility[]"></td>
                        <td><input type="text" name="new_complex_event[]"></td>
                        <td><button type="submit" class="btn">Сохранить</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="add-complex" class="BtnEvent">Добавить спорткомплекс</button>
            <button type="submit" class="btn" href="#complex-form">Сохранить изменения</button>
            <input type="hidden" name="delete_complex_id[]" id="delete-complex-id">
        </form>
    </div>

    <script>
        document.getElementById('add-event').addEventListener('click', function() {
            document.getElementById('new-event-row').style.display = 'table-row';
        });

        document.getElementById('add-city').addEventListener('click', function() {
            document.getElementById('new-city-row').style.display = 'table-row';
        });

        document.getElementById('add-organization').addEventListener('click', function() {
            document.getElementById('new-organization-row').style.display = 'table-row';
        });

        document.getElementById('add-facility').addEventListener('click', function() {
            document.getElementById('new-facility-row').style.display = 'table-row';
        });

        document.getElementById('add-complex').addEventListener('click', function() {
            document.getElementById('new-complex-row').style.display = 'table-row';
        });
        
        function deleteAndSubmit(button) {
            const form = button.closest('form');
            const id = button.getAttribute('data-' + form.id.replace('-form', '') + '-id');
            const hiddenInput = form.querySelector('#delete-' + form.id.replace('-form', '') + '-id');
            hiddenInput.value = id;
            form.submit();
        }
    </script>
</body>
</html>