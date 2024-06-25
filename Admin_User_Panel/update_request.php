<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $data = json_decode($_POST['data'], true);

    $update_query = "UPDATE requests SET 
        event_name = '" . $mysqli->real_escape_string($data['event_name']) . "',
        event_date = '" . $mysqli->real_escape_string($data['event_date']) . "',
        event_seats = '" . $mysqli->real_escape_string($data['event_seats']) . "',
        org_name = '" . $mysqli->real_escape_string($data['org_name']) . "',
        org_abbr = '" . $mysqli->real_escape_string($data['org_abbr']) . "',
        org_city = '" . $mysqli->real_escape_string($data['org_city']) . "',
        org_address = '" . $mysqli->real_escape_string($data['org_address']) . "',
        org_phone = '" . $mysqli->real_escape_string($data['org_phone']) . "',
        org_email = '" . $mysqli->real_escape_string($data['org_email']) . "',
        org_website = '" . $mysqli->real_escape_string($data['org_website']) . "',
        org_maplink = '" . $mysqli->real_escape_string($data['org_maplink']) . "',
        facility_city = '" . $mysqli->real_escape_string($data['facility_city']) . "',
        facility_address = '" . $mysqli->real_escape_string($data['facility_address']) . "',
        facility_name = '" . $mysqli->real_escape_string($data['facility_name']) . "',
        facility_abbr = '" . $mysqli->real_escape_string($data['facility_abbr']) . "',
        facility_activity = '" . $mysqli->real_escape_string($data['facility_activity']) . "',
        facility_area = '" . $mysqli->real_escape_string($data['facility_area']) . "',
        facility_capacity = '" . $mysqli->real_escape_string($data['facility_capacity']) . "',
        facility_hours = '" . $mysqli->real_escape_string($data['facility_hours']) . "'
        WHERE id = '$id'";

    $mysqli->query($update_query);
}
$mysqli->close();
?>
