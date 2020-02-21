<?php 
    /* Data for Bar Graph */

    header('Content-Type: application/json');

    include("connect.php");

    $db_selected = mysqli_select_db($connection, $database);
    if (!$db_selected) {
        die ('Can\'t use db : ' . mysqli_error());
    }

    $query = "select loc.country, count(*) from waste_details w inner join waste_product_details p on w.refid = p.refid inner join waste_location_details loc on loc.refid = p.refid group by loc.country;";

//execute query
    $result = mysqli_query($connection, $query);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

//loop through the returned data
    $data = array();
    foreach ($result as $row) {
        $data[] = array("label" => $row["country"], "y" => $row["count(*)"]);
    }

    print json_encode($data, JSON_NUMERIC_CHECK);
    
?>
