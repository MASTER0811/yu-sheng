<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  function setMessages($content) {
    $_SESSION['register_failed'] = $content;
  }
  
  if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['create_password']) && isset($_POST['confirm_password'])) {
  
    session_start();
    include_once 'op-php/db-connect.php';
    include_once 'op-php/function.php';
    $mlpr = new Mlpr();
  
    $first_name = mysqli_real_escape_string($db_connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db_connection, $_POST['last_name']);
    $email = mysqli_real_escape_string($db_connection, $_POST['email']);
    $create_password = mysqli_real_escape_string($db_connection, $_POST['create_password']);
    $confirm_password = mysqli_real_escape_string($db_connection, $_POST['confirm_password']);
    $avatar = array('astronaut.webp', 'dog.webp', 'jerry.webp', 'tom.jpg', 'white.webp');
    $finally_avatar = $avatar[rand(0, 4)];
  
    if (mb_strlen($first_name) < 1 || mb_strlen($last_name) < 1 || mb_strlen($email) < 1 || mb_strlen($create_password) < 1 || mb_strlen($confirm_password) < 1) {
      setMessages('全部都必须填写');
    } else {
      if (ctype_space($first_name) || ctype_space($last_name)) {
        setMessages('请输入您的姓和名字');
      } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 255) {
          setMessages('这个电子邮箱地址格式无效');
        } else {
          $query_1 = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `email` = '{$email}' LIMIT 1");
          if (mysqli_num_rows($query_1) > 0) {
            setMessages('这个电子邮箱地址已存在');
          } else {
            $password_space = preg_match('/\s/', $create_password);
            if ($password_space || mb_strlen($create_password) < 8 || mb_strlen($create_password) > 100) {
              setMessages('密码最少需要8个字符不能超过100个字符且不能存在空格');
            } else {
              if ($confirm_password != $create_password) {
                setMessages('密码与您创建的密码不符合');
              } else {
                $date = date('Y-m-d H:i:s A');
                $unique_id = $mlpr->createRandomChar(100);
                $account_id = $mlpr->createRandomChar(12);
                $query_2 = mysqli_query($db_connection, "INSERT INTO `users`
                (`unique_id`, `account_id`, `first_name`, `last_name`, `email`, `password`, `image_avatar`, `date`)
                VALUES ('{$unique_id}', '{$account_id}', '{$first_name}', '{$last_name}', '{$email}', '{$confirm_password}', '{$finally_avatar}', '{$date}')");
                if (!$query_2) {
                  setMessages('出现未知错误, 请稍后在试');
                } else {
                  session_destroy();
                  setcookie('sct', $unique_id, time() + 99999999, '/');
                  mysqli_close($db_connection);
                  header('Location: home.php');
                }
              }
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
  <title>Register</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="style/style.css" />

  <script src="https://kit.fontawesome.com/302a9d014d.js" crossorigin="anonymous" defer></script>
  
</head>
<body>

  <?php require_once 'header.php'; ?>
  <div class="w-100 p-3 bg-white shadow-sm mx-auto my-4 rounded-3" style="max-width: 550px">
    <header class="text-center mb-2 pb-3 mb-2" style="border-bottom: .1rem solid #d6d6d6;">
      <h1 class="logo-font mb-0 animate__animated animate__bounce animate__slow animate__repeat-3">注册</h1>
    </header>
    <?php
      if (isset($_SESSION['register_failed'])) {
        echo '
        <div class="messages-box active mb-2">
          <i class="fas fa-exclamation-circle me-2" style="font-size: 1.4rem;"></i>
          <span>'.$_SESSION['register_failed'].'</span>
        </div>
        ';
      }
    ?>
    <form action="" method="POST">
      <div class="mb-2">
        <label for="" class="mb-1">姓</label>
        <input type="text" name="first_name" class="form-control input" />
      </div>
      <div class="mb-2">
        <label for="" class="mb-1">名字</label>
        <input type="text" name="last_name" class="form-control input" />
      </div>
      <div class="mb-2">
        <label for="" class="mb-1">电子邮箱地址</label>
        <input type="text" name="email" class="form-control input" />
      </div>
      <div class="mb-1">
        <label for="" class="mb-1">创建密码</label>
        <input type="password" name="create_password" class="form-control type-password input" />
      </div>
      <div class="mb-1">
        <label for="" class="mb-1">确认密码</label>
        <input type="password" name="confirm_password" class="form-control type-password input" />
      </div>
      <div class="mb-2 form-check">
        <input type="checkbox" class="form-check-input" onclick="showPassword()" id="checked-password" />
        <label for="checked-password" class="form-check-label">显示密码</label>
      </div>
      <div class="mb-2">
        <button type="submit" class="btn btn-dark w-100 fw-500">注册</button>
      </div>
      <div class="text-center fw-500">
        <span>已经有账户 ? <a href="login.php">登入</a></span>
      </div>
    </form>
  </div>
  
  <script src="javascript/logout.js"></script>
  <script src="javascript/open-menu.js"></script>
  <script src="javascript/show-password.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
</body>
</html>