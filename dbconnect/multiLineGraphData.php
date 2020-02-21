<?php 
    /* Data for Bar Graph */

    header('Content-Type: application/json');

    include("connect.php");

    $db_selected = mysqli_select_db($connection, $database);
    if (!$db_selected) {
        die ('Can\'t use db : ' . mysqli_error());
    }

    $query = "select waste_char, count(*) from waste_details group by waste_char";

//execute query
    $result = mysqli_query($connection, $query);

//loop through the returned data
    $data = array();
    foreach ($result as $row) {
     $data[] = $row;
    }

//now print the data
    print json_encode($data);

?>
