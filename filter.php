<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=u2709968_SportComplex; charset=utf8', 'u2709968_Admin', '545432481373qwe');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $activityType = $_POST['activityType'];
    $area = $_POST['area'];
    $capacity = $_POST['capacity'];
    $city = $_POST['city'];
    $search = $_POST['search'];

    $query = "SELECT * FROM организация JOIN спортивные_сооружения ON ID_Организации = ID_Сооружения WHERE 1=1";

    if ($activityType != 'Вид деятельности') {
        $query .= " AND Вид_деятельности = :activityType";
    }
    if (!empty($area)) {
        $query .= " AND Площадь = :area";
    }
    if (!empty($capacity)) {
        $query .= " AND Вместительность = :capacity";
    }
    if ($city != 'Город') {
        $query .= " AND Город = :city";
    }
    if (!empty($search)) {
        $query .= " AND (Название LIKE :search OR
         Адрес LIKE :search OR
         Аббревиатура LIKE :search OR
         График_работы LIKE :search OR
         Название_Организации LIKE :search OR
         Аббревиатура_Организации LIKE :search OR
         Адрес_Организации LIKE :search OR
         Телефон_Организации LIKE :search OR
         Почта_Организации LIKE :search
         )";
    }

    $stmt = $db->prepare($query);

    // Привязываем параметры
    if ($activityType != 'Вид деятельности') {
        $stmt->bindParam(':activityType', $activityType);
    }
    if (!empty($area)) {
        $stmt->bindParam(':area', $area);
    }
    if (!empty($capacity)) {
        $stmt->bindParam(':capacity', $capacity);
    }
    if ($city != 'Город') {
        $stmt->bindParam(':city', $city);
    }
    if (!empty($search)) {
        $search = "%$search%";
        $stmt->bindParam(':search', $search);
    }

    // Выполняем запрос и получаем результаты
    $stmt->execute();
    $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($info as $index => $data) {
        echo '<div class="ResultBlock">';
        echo '<div class="ResultHeadText">';
        echo '<div class="WidgetHeader">';
        echo '<span class="WidgetHeaderTitle">' . $data['Название'] . '</span>';
        echo '<span class="WidgetHeaderMeta">' . $data['Вид_деятельности'] . '</span>';
        echo '<span class="WidgetHeaderLocation">' . $data['Город'] . ' ' . $data['Адрес'] . '</span>';
        echo '</div>';
        echo '<div class="WidgetSpec">';
        if (!empty($data['Телефон_Организации'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Телефон</span>';
            echo '<a href="tel:' . $data['Телефон_Организации'] . '" class="SpecValue">' . $data['Телефон_Организации'] . '</a>';
            echo '</div>';
        }
        if (!empty($data['График_работы'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Режим работы</span>';
            echo '<span class="SpecValue">' . $data['График_работы'] . '</span>';
            echo '</div>';
        }
        if (!empty($data['Сайт_Организации'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Сайт</span>';
            echo '<a href="' . $data['Сайт_Организации'] . '" target="_blank" class="SpecValue">' . $data['Сайт_Организации'] . '</a>';
            echo '</div>';
        }
        echo '</div>';
        echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-' . $index . '">Подробнее</button>';
        echo '</div>';
        echo '</div>';

        // Добавление модального окна
        echo '<div class="modal fade" id="modal-' . $index . '" tabindex="100" aria-labelledby="exampleModalLabel" aria-hidden="false">';
        echo '<div class="modal-dialog modal-dialog-scrollable">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h1 class="modal-title fs-4" id="exampleModalLabel">' . $data['Название'] . '</h1>';
        echo '<h2 class="modal-title fs-3" id="exampleModalLabel">' . $data['Вид_деятельности'] . '</h2>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<div class="InfoSport">';
        echo '<h2 class="modal-title fs-2" id="exampleModalLabel">Информация о спортивном сооружение</h2>';
        echo '<hr style="width: 100%; border-top: 4px solid black; margin-top: 2px; margin-bottom: 2px;">';
        echo '<div class="Spec">';
        echo '<span class="SpecIndex">Адрес</span>';
        echo '<a href="' . $data['Ссылка_Адрес'] . '" target="_blank" class="SpecValue">' . $data['Город'] . ' ' . $data['Адрес'] . '</a>';
        echo '</div>';
        if (!empty($data['Телефон_Организации'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Телефон</span>';
            echo '<a href="tel:' . $data['Телефон_Организации'] . '" class="SpecValue">' . $data['Телефон_Организации'] . '</a>';
            echo '</div>';
        }
        if (!empty($data['График_работы'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Режим работы</span>';
            echo '<span class="SpecValue">' . $data['График_работы'] . '</span>';
            echo '</div>';
        }
        if (!empty($data['Сайт_Организации'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Сайт</span>';
            echo '<a href="' . $data['Сайт_Организации'] . '" target="_blank" class="SpecValue">' . $data['Сайт_Организации'] . '</a>';
            echo '</div>';
        }
        if (!empty($data['Площадь'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Площадь</span>';
            echo '<span class="SpecValue">' . $data['Площадь'] . 'м²</span>';
            echo '</div>';
        }
        if (!empty($data['Вместительность'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Вместительность</span>';
            echo '<span class="SpecValue">' . $data['Вместительность'] . ' чел.</span>';
            echo '</div>';
        }
        echo '</div>';

        echo '<div class="InfoOrganization">';
        echo '<h2 class="modal-title fs-2" id="exampleModalLabel">Информация об организации</h2>';
        echo '<hr style="width: 100%; border-top: 4px solid black; margin-top: 2px; margin-bottom: 2px;">';
        if (!empty($data['Название_Организации'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Наименование организации</span>';
            echo '<span class="SpecValue">' . $data['Название_Организации'] . '</span>';
            echo '</div>';
        }
        echo '<div class="Spec">';
        echo '<span class="SpecIndex">Адрес</span>';
        echo '<a href="' . $data['Ссылка_Адрес'] . '" target="_blank" class="SpecValue">' . $data['Город'] . ' ' . $data['Адрес'] . '</a>';
        echo '</div>';
        if (!empty($data['Телефон_Организации'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Телефон</span>';
            echo '<a href="tel:' . $data['Телефон_Организации'] . '" class="SpecValue">' . $data['Телефон_Организации'] . '</a>';
            echo '</div>';
        }
        if (!empty($data['Почта_Организации'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Почта</span>';
            echo '<a href="mailto:' . $data['Почта_Организации'] . '" class="SpecValue">' . $data['Почта_Организации'] . '</a>';
            echo '</div>';
        }
        if (!empty($data['Сайт_Организации'])) {
            echo '<div class="Spec">';
            echo '<span class="SpecIndex">Сайт</span>';
            echo '<a href="' . $data['Сайт_Организации'] . '" target="_blank" class="SpecValue">' . $data['Сайт_Организации'] . '</a>';
            echo '</div>';
        }
        echo '</div>';

        echo '<div class="Events">';
        echo '<h2 class="modal-title fs-2" id="exampleModalLabel">Мероприятия</h2>';
        echo '<hr style="width: 100%; border-top: 4px solid black; margin-top: 2px; margin-bottom: 2px;">';
        echo '<div class="Spec">';
        echo '<span class="SpecIndex">Наименование</span>';
        echo '<span class="SpecValue">' . $data['Мероприятия'] . '</span>';
        echo '</div>';
        echo '</div>';

        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '</div>';
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
