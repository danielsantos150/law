<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 06/03/2019
 * Time: 20:07
 */


    $host="127.0.0.1";
    $port=3306;
    $socket="";
    $user="admin";
    $password="dF%%bb0791";
    $dbname="law";

    $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
    or die ('Could not connect to the database server' . mysqli_connect_error());

    //$con->close();