<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гость</title>
    <style>
        .popup {
            display: none; /* Initially hide the popup */
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            animation: slideDown 0.5s ease-in-out, slideUp 0.5s ease-in-out 2.5s;
        }
        .popup.error {
            background-color: #f44336;
        }
        @keyframes slideDown {
            from {
                top: -100px;
            }
            to {
                top: 0;
            }
        }
        @keyframes slideUp {
            from {
                top: 0;
            }
            to {
                top: -100px;
            }
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form h2 {
            margin-bottom: 10px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="text"],
        form input[type="date"],
        form input[type="number"],
        form input[type="email"],
        form input[type="url"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }
        form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        form button:hover {
            background-color: #45a049;
        }
        .admin-panel {
            margin-top: 30px;
        }
        .admin-panel table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .admin-panel table th,
        .admin-panel table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .admin-panel table th {
            background-color: #f2f2f2;
        }
        .admin-panel table tr:hover {
            background-color: #f9f9f9;
        }
        .admin-panel .btn-container {
            margin-top: 10px;
        }
        .admin-panel .btn-container button {
            margin-right: 10px;
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
    <script>
        function showPopup(message, isError = false) {
            var popup = document.getElementById('popup');
            var popupMessage = document.getElementById('popupMessage');
            popupMessage.innerText = message;
            if (isError) {
                popup.classList.add('error');
            } else {
                popup.classList.remove('error');
            }
            popup.classList.add('show');
            popup.style.display = 'block';
            setTimeout(function() {
                popup.style.display = 'none';
            }, 3000);
        }
    </script>
</head>
<body>
    <a href="/landing.php" class="ButtonNav">Главная</a>
    <div class="user-panel">
        <form id="userForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h1>Форма ввода данных</h1>
            <h2>Мероприятия</h2>
            <label for="event_name">Название мероприятия:</label>
            <input type="text" id="event_name" name="event_name" required><br>
            <label for="event_date">Дата начала:</label>
            <input type="date" id="event_date" name="event_date" required><br>
            <label for="event_seats">Количество мест:</label>
            <input type="number" id="event_seats" name="event_seats" required><br>
            
            <h2>Организация</h2>
            <label for="org_name">Название организации:</label>
            <input type="text" id="org_name" name="org_name" required><br>
            <label for="org_abbr">Аббревиатура организации:</label>
            <input type="text" id="org_abbr" name="org_abbr" required><br>
            <label for="org_city">Город:</label>
            <input type="text" id="org_city" name="org_city" required><br>
            <label for="org_address">Адрес организации:</label>
            <input type="text" id="org_address" name="org_address" required><br>
            <label for="org_phone">Телефон организации:</label>
            <input type="text" id="org_phone" name="org_phone" required><br>
            <label for="org_email">Почта организации:</label>
            <input type="email" id="org_email" name="org_email" required><br>
            <label for="org_website">Сайт организации:</label>
            <input type="url" id="org_website" name="org_website" required><br>
            <label for="org_maplink">Ссылка адрес:</label>
            <input type="url" id="org_maplink" name="org_maplink" required><br>
            
            <h2>Спортивные сооружения</h2>
            <label for="facility_city">ID города:</label>
            <input type="number" id="facility_city" name="facility_city" required><br>
            <label for="facility_address">Адрес:</label>
            <input type="text" id="facility_address" name="facility_address" required><br>
            <label for="facility_name">Название:</label>
            <input type="text" id="facility_name" name="facility_name" required><br>
            <label for="facility_abbr">Аббревиатура:</label>
            <input type="text" id="facility_abbr" name="facility_abbr" required><br>
            <label for="facility_activity">Вид деятельности:</label>
            <input type="text" id="facility_activity" name="facility_activity" required><br>
            <label for="facility_area">Площадь:</label>
            <input type="number" id="facility_area" name="facility_area" required><br>
            <label for="facility_capacity">Вместительность:</label>
            <input type="number" id="facility_capacity" name="facility_capacity" required><br>
            <label for="facility_hours">График работы:</label>
            <input type="text" id="facility_hours" name="facility_hours" required><br>
            
            <button type="submit">Отправить на проверку</button>
        </form>
    </div>

    <div id="popup" class="popup">
        <p id="popupMessage"></p>
    </div>

    <?php
    // Обработка формы пользователя и вывод панели администратора
    include 'db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Обработка данных формы пользователя
        $event_name = $_POST['event_name'];
        $event_date = $_POST['event_date'];
        $event_seats = $_POST['event_seats'];
        $org_name = $_POST['org_name'];
        $org_abbr = $_POST['org_abbr'];
        $org_city = $_POST['org_city'];
        $org_address = $_POST['org_address'];
        $org_phone = $_POST['org_phone'];
        $org_email = $_POST['org_email'];
        $org_website = $_POST['org_website'];
        $org_maplink = $_POST['org_maplink'];
        $facility_city = $_POST['facility_city'];
        $facility_address = $_POST['facility_address'];
        $facility_name = $_POST['facility_name'];
        $facility_abbr = $_POST['facility_abbr'];
        $facility_activity = $_POST['facility_activity'];
        $facility_area = $_POST['facility_area'];
        $facility_capacity = $_POST['facility_capacity'];
        $facility_hours = $_POST['facility_hours'];

        $query = "INSERT INTO requests (event_name, event_date, event_seats, org_name, org_abbr, org_city, org_address, org_phone, org_email, org_website, org_maplink, facility_city, facility_address, facility_name, facility_abbr, facility_activity, facility_area, facility_capacity, facility_hours)
                VALUES ('$event_name', '$event_date', '$event_seats', '$org_name', '$org_abbr', '$org_city', '$org_address', '$org_phone', '$org_email', '$org_website', '$org_maplink', '$facility_city', '$facility_address', '$facility_name', '$facility_abbr', '$facility_activity', '$facility_area', '$facility_capacity', '$facility_hours')";

        if ($mysqli->query($query) === TRUE) {
            echo "<script>showPopup('Данные успешно отправлены на проверку!');</script>";
        } else {
            echo "<script>showPopup('Ошибка: " . $query . "<br>" . $mysqli->error . "', true);</script>";
        }
    }
    ?>
</body>
</html>
