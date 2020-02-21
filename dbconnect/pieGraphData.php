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

    function percentCal($value, $total){
        $ans = ($value / $total) * 100;
        return $ans;
    }

    $db_selected = mysqli_select_db($connection, $database);
    if (!$db_selected) {
        die ('Can\'t use db : ' . mysqli_error());
    }

    $query = "select waste_char, count(*) as value from waste_details group by waste_char";

//execute query
    $result = mysqli_query($connection, $query);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

//loop through the returned data
    $data = array();
    $total = 0;

    foreach($result as $row){
        $total += $row["value"];
    }

    foreach ($result as $row) {
        $data[] = array("label" => wasteShape($row["waste_char"]), "y" => percentCal($row["value"], $total));
    }

    print json_encode($data, JSON_NUMERIC_CHECK);
    
?>
