<?php 
    /* Data for Bar Graph */

    header('Content-Type: application/json');

    include("connect.php");

    function wasteShape($value){
        if($value == 1)
            return 'Cover';
        elseif($value == 2)
            return 'Cup';
        elseif($value == 3)
            return 'Bucket';
        elseif($value == 4)
            return 'Sheet';
        elseif($value == 5)
            return 'Rod';
        elseif($value == 6)
            return 'Tube';
        elseif($value == 7)
            return 'Film';
    }

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
        $data[] = array("label" => wasteShape($row["waste_char"]), "y" => $row["count(*)"]);
    }

//now print the data
    print json_encode($data, JSON_NUMERIC_CHECK);

?>
