<?php 
    /* Data for Bar Graph */

    header('Content-Type: application/json');

    include("connect.php");

    function wasteChar($value){
        if($value == 1)
            return 'Medium';
        elseif($value == 2)
            return 'High';
        elseif($value == 3)
            return 'Low';
        else
            return 'Unknown';
    }

    function percentCal($value, $total){
        $ans = ($value / $total) * 100;
        return $ans;
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
    $total = 0;

    foreach($result as $row){
        $total += $row["count(*)"];
    }

    foreach ($result as $row) {
        $data[] = array("label" => wasteChar($row["waste_char"]), "y" => percentCal($row["count(*)"], $total));
    }

//now print the data
    print json_encode($data, JSON_NUMERIC_CHECK);

?>
