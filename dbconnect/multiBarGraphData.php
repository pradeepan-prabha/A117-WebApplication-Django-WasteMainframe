<?php 
    /* Data for Bar Graph */

    header('Content-Type: application/json');

    include("connect.php");

    $db_selected = mysqli_select_db($connection, $database);
    if (!$db_selected) {
        die ('Can\'t use db : ' . mysqli_error());
    }

    $query = "select loc.country, count(*) from waste_details w inner join waste_product_details p on w.refid = p.refid inner join waste_location_details loc on loc.refid = p.refid group by w.waste_char;";

    function percentCal($value, $total){
        $ans = ($value / $total) * 100;
        return $ans;
    }
//execute query
    $result = mysqli_query($connection, $query);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

//loop through the returned data
    $data = array();
    $total = 0;

    foreach($result as $row){
        $total += $row["count(*)"];
    }

    foreach ($result as $row) {
        $data[] = array("label" => $row["country"], "y" => percentCal($row["count(*)"], $total));
    }

    print json_encode($data, JSON_NUMERIC_CHECK);
    
?>
