<?php
    session_start();
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'yoshi';
    $conn = mysqli_connect($host, $user, $pass, $dbname) or die('Error connecting to database.');
