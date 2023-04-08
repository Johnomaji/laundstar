<?php
    // variable names for connection: these can be modified according to choice
    $server = "localhost";
    $user = "root";
    $pwd = "";
    $dbName = "db_laundstar";

    // the connection function is below and must be followed strictly
    $conn = mysqli_connect($server, $user, $pwd, $dbName);
?>