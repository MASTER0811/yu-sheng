<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  function setMessages($content)
  {
    $_SESSION['login_failed'] = $content;
  }

  if (isset($_POST['email']) && isset($_POST['password'])) {

    session_start();
    include_once 'op-php/db-connect.php';
    include_once 'op-php/function.php';
    $mlpr = new Mlpr();

    $email = mysqli_real_escape_string($db_connection, $_POST['email']);
    $password = mysqli_real_escape_string($db_connection, $_POST['password']);

    if (mb_strlen($email) < 1 || mb_strlen($password) < 1) {
      setMessages('全部都必须填写');
    } else {
      if (ctype_space($email)) {
        setMessages('请输入您的电子邮箱地址');
      } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 255) {
          setMessages('这个电子邮箱地址格式无效');
        } else {
          if (ctype_space($password)) {
            setMessages('请输入您的密码');
          } else {
            $query_1 = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `email` = '{$email}' LIMIT 1");
            if (mysqli_num_rows($query_1) > 0) {
              $rows_1 = mysqli_fetch_assoc($query_1);
              if ($email != $rows_1['email'] || $password != $rows_1['password']) {
                setMessages('电子邮箱地址错误或密码错误, 请重试');
              } else {
                session_destroy();
                setcookie('sct', $rows_1['unique_id'], time() + 99999999, '/');
                mysqli_close($db_connection);
                header('Location: home.php');
              }
            } else {
              setMessages('电子邮箱地址错误或密码错误, 请重试');
            }
          }
        }
      }
    }
  } else {
    setMessages('出现未知错误, 请稍后在试');
  }
}

if (isset($_COOKIE['sct'])) {
  header('Location: home.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="style/style.css" />

  <script src="https://kit.fontawesome.com/302a9d014d.js" crossorigin="anonymous" defer></script>

</head>

<body class="w-100 min-vh-100">

  <?php require_once 'header.php'; ?>
  <div class="w-100 p-3 bg-white shadow-sm mx-auto my-4 rounded-3" style="max-width: 550px">
    <header class="text-center mb-2 pb-3 mb-2" style="border-bottom: .1rem solid #d6d6d6;">
      <h1 class="logo-font mb-0 animate__animated animate__bounce animate__slow animate__repeat-3">登入</h1>
    </header>
    <?php
    if (isset($_SESSION['login_failed'])) {
      echo '
        <div class="messages-box active mb-2">
          <i class="fas fa-exclamation-circle me-2" style="font-size: 1.4rem;"></i>
          <span>' . $_SESSION['login_failed'] . '</span>
        </div>
        ';
    }
    ?>
    <form action="" method="POST">
      <div class="mb-2">
        <label for="" class="mb-1">电子邮箱地址</label>
        <input type="text" name="email" class="form-control input" />
      </div>
      <div class="mb-1">
        <label for="" class="mb-1">密码</label>
        <input type="password" name="password" class="form-control type-password input" />
      </div>
      <div class="mb-2 form-check">
        <input type="checkbox" class="form-check-input" onclick="showPassword()" id="checked-password" />
        <label for="checked-password" class="form-check-label">显示密码</label>
      </div>
      <div class="mb-2">
        <button type="submit" class="btn btn-dark w-100 fw-500">登入</button>
      </div>
      <div class="text-center fw-500">
        <span>没有账户 ? <a href="register.php">注册</a></span>
      </div>
    </form>
  </div>

  <script src="javascript/logout.js"></script>
  <script src="javascript/open-menu.js"></script>
  <script src="javascript/show-password.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>