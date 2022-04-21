<?php

$db_connection = mysqli_connect('localhost', 'root', '', 'yusheng');

if (mysqli_connect_errno()) {
  die('Failed to connect database '.mysqli_connect_error().'Error code: '.mysqli_connect_errno().'');
}

mysqli_set_charset($db_connection, "UTF8");