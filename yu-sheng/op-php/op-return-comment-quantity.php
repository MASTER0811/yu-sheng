<?php

require_once 'db-connect.php';

$query_1 = mysqli_query($db_connection, "SELECT * FROM `comment`");

echo mysqli_num_rows($query_1);