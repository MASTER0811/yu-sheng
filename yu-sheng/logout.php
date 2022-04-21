<?php

if (isset($_COOKIE['sct'])) {
  setcookie('sct', '', time() - 99999999, '/');
  header('Location: home.php');
} else {
  header('Location: home.php');
}