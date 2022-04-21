<?php

if (isset($_COOKIE['sct'])) {

  include_once 'op-php/db-connect.php';

  $query_1 = mysqli_query($db_connection, "DELETE FROM `users` WHERE `unique_id` = '{$_COOKIE['sct']}'");

  if (!$query_1) {
    header('Location: home.php');
  } else {
    header('Location: home.php');
    setcookie('sct', '', time() - 99999999, '/');
  }

} else {
  header('Location: home.php');
}