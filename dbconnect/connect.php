<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'waste_mainframe_db';

    $connection = mysqli_connect($hostname, $username, $password);

    if(!$connection){
        echo "Not Connected";
    }
?>