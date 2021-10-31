<?php
    $servername = 'localhost';
    $username = 'f32ee';
    $password = 'f32ee';
    $dbname = 'f32ee';

    # simulate user input
    $x = 1;


    $db = mysqli_connect($servername, $username, $password, $dbname);

    $query = "SELECT * FROM BOOKINGS WHERE booking_id=$x";

    $result = $db->query($query);
    $row = $result->fetch_assoc();
    echo $row['email'];
?>