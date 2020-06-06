<?php
    //Connect to DB
    $connect = mysqli_connect('localhost','sk','1234test','registration');

    //check the connection
    if(!$connect){
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>