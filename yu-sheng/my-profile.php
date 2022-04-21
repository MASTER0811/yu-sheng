<?php

if (!isset($_COOKIE['sct'])) {
  header('Location: login.php');
} else {

  include_once 'op-php/db-connect.php';

  $query_1 = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `unique_id` = '{$_COOKIE['sct']}' LIMIT 1");

  if (mysqli_num_rows($query_1) > 0) {
    $rows_1 = mysqli_fetch_assoc($query_1);
  } else {
    setcookie('sct', '', time() - 99999999, '/');
    header('Location: sign-in.php');
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  function setMessages($content)
  {
    $_SESSION['edit_profile_failed'] = $content;
  }

  if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['account_id'])) {


    $first_name = mysqli_real_escape_string($db_connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db_connection, $_POST['last_name']);
    $account_id = mysqli_real_escape_string($db_connection, $_POST['account_id']);

    if (mb_strlen($first_name) < 1 || mb_strlen($last_name) < 1 || mb_strlen($account_id) < 1) {
      setMessages('全部都需要填写');
    } else {
      if (ctype_space($first_name) || ctype_space($last_name)) {
        setMessages('请输入您的姓和名字');
      } else {
        if (mb_strlen($first_name) > 30 || mb_strlen($last_name) > 30) {
          setMessages('姓或名字不能超过30个字符');
        } else {
          $account_id_space = preg_match('/\s/', $account_id);
          if (mb_strlen($account_id) < 12 || mb_strlen($account_id) > 30 || $account_id_space) {
            setMessages('账户id最少需要12个字符，且不能超过30个字符, 不能存在空格');
          } else {
            $query_2 = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `account_id` = '{$account_id}' AND NOT `unique_id` = '{$_COOKIE['sct']}' LIMIT 1");
            if (mysqli_num_rows($query_2) > 0) {
              setMessages('账户id已存在, 请尝试别的id');
            } else {

              $query_3 = mysqli_query($db_connection, "UPDATE `users` SET `first_name` = '{$first_name}', `last_name` = '{$last_name}', `account_id` = '{$account_id}' WHERE `unique_id` = '{$_COOKIE['sct']}'");
              if (!$query_3) {
                setMessages('出现未知错误, 请稍后在试');
              } else {
                header('Location: my-profile.php');
              }
              
            }
          }
        }
      }
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  function setMessagesSame($content) {
    $_SESSION['change_password_failed'] = $content;
  }

  if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {

    include_once 'op-php/db-connect.php';

    $old_password = mysqli_real_escape_string($db_connection, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($db_connection, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($db_connection, $_POST['confirm_password']);

    if (mb_strlen($old_password) < 1 || mb_strlen($new_password) < 1 || mb_strlen($confirm_password) < 1) {
      setMessagesSame('全部都必须填写');
    } else {
      if (ctype_space($old_password)) {
        setMessagesSame('请输入您的旧密码');
      } else {
        $query_1 = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `unique_id` = '{$_COOKIE['sct']}' LIMIT 1");
        if (mysqli_num_rows($query_1) > 0) {
          $rows_1 = mysqli_fetch_assoc($query_1);
          if ($old_password != $rows_1['password']) {
            setMessagesSame('旧密码错误，请重试');
          } else {
            $password_space = preg_match('/\s/', $new_password);
            if ($password_space || mb_strlen($new_password) < 8 || mb_strlen($new_password) > 100) {
              setMessagesSame('密码最少需要8个字符不能超过100个字符且不能存在空格');
            } else {
              if ($confirm_password != $new_password) {
                setMessagesSame('密码与您创建的新密码不符合');
              } else {
                $query_2 = mysqli_query($db_connection, "UPDATE `users` SET `password` = '{$confirm_password}' WHERE `unique_id` = '{$_COOKIE['sct']}'");
                if (!$query_2) {
                  setMessagesSame('出现未知错误, 请稍后在试');
                } else {
                  echo '<script>alert("更改新密码成功");</script>';
                }
              }
            }
          }
        } else {
          setMessagesSame('出现未知错误, 请稍后在试');
        }
      }
    }

  }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>My profile</title>
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

  <div class="container-xl p-xxl-0 my-3">

    <div class="row">
      <div class="col-12 col-md-6 mb-3">
        <div class="item text-center p-3 shadow-sm rounded-3" style="background: #fff">
          <div class="pic mb-2">
            <img src="users-image-avatar/<?php echo $rows_1['image_avatar']; ?>" alt="" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;" />
          </div>
          <div>
            <h5 class="logo-font"><?php echo $rows_1['first_name'] . ' ' . $rows_1['last_name'] ?></h5>
            <div>
              <div class="p-3 text-start mb-2 fw-500" style="background: #f5f4f4; border-radius: 4px;">
                <label for="">电子邮箱地址:</label>
                <span><?php echo $rows_1['email']; ?></span>
              </div>
              <div class="p-3 text-start mb-2 fw-500" style="background: #f5f4f4; border-radius: 4px;">
                <label for="">账户id:</label>
                <span><?php echo $rows_1['account_id']; ?></span>
              </div>
              <div class="p-3 text-start mb-2 fw-500" style="background: #f5f4f4; border-radius: 4px;">
                <label for="">账户创建日期:</label>
                <span><?php echo $rows_1['date']; ?></span>
              </div>
            </div>
            <div>
              <a href="" class="d-block btn btn-dark fw-bold mb-2 logout-button">登出</a>
              <a href="" class="d-block btn btn-danger fw-bold delete-account-button">删除账户</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6">

        <div class="shadow-sm rounded-3 p-3 mb-2 bg-white">
          <header class="text-center mb-2 pb-3 mb-2" style="border-bottom: .1rem solid #d6d6d6;">
            <h3 class="logo-font mb-0 animate__animated animate__bounce animate__slow animate__repeat-3">编辑个人资料</h3>
          </header>
          <?php
          if (isset($_SESSION['edit_profile_failed'])) {
            echo '
              <div class="messages-box active mb-2">
                <i class="fas fa-exclamation-circle me-2" style="font-size: 1.4rem;"></i>
                <span>' . $_SESSION['edit_profile_failed'] . '</span>
              </div>
              ';
          }
          ?>
          <form action="" method="POST" id="edit-profile">
            <div class="mb-2">
              <label for="" class="mb-1">姓</label>
              <input type="text" name="first_name" value="<?php echo $rows_1['first_name'] ?>" class="form-control input" />
            </div>
            <div class="mb-2">
              <label for="" class="mb-1">名字</label>
              <input type="text" name="last_name" value="<?php echo $rows_1['last_name'] ?>" class="form-control input" />
            </div>
            <div class="mb-2">
              <label for="" class="mb-1">账户id:</label>
              <input type="text" name="account_id" value="<?php echo $rows_1['account_id'] ?>" class="form-control input" />
            </div>
            <div class="">
              <button type="submit" class="btn btn-dark w-100 fw-500 edit-profile-button disabled" style="transition: all .3s ease;">保存</button>
            </div>
          </form>
        </div>

        <div class="p-3 bg-white shadow-sm mx-auto rounded-3">
          <header class="text-center mb-2 pb-3 mb-2" style="border-bottom: .1rem solid #d6d6d6;">
            <h1 class="logo-font mb-0 animate__animated animate__bounce animate__slow animate__repeat-3">更改密码</h1>
          </header>
          <?php
          if (isset($_SESSION['change_password_failed'])) {
            echo '
        <div class="messages-box active mb-2">
          <i class="fas fa-exclamation-circle me-2" style="font-size: 1.4rem;"></i>
          <span>' . $_SESSION['change_password_failed'] . '</span>
        </div>
        ';
          }
          ?>
          <form action="" method="POST">
            <div class="mb-2">
              <label for="" class="mb-1">旧密码</label>
              <input type="password" name="old_password" class="form-control type-password input" />
            </div>
            <div class="mb-1">
              <label for="" class="mb-1">新密码</label>
              <input type="password" name="new_password" class="form-control type-password input" />
            </div>
            <div class="mb-1">
              <label for="" class="mb-1">确认密码</label>
              <input type="password" name="confirm_password" class="form-control type-password input" />
            </div>
            <div class="mb-2 form-check">
              <input type="checkbox" class="form-check-input" onclick="showPassword()" id="checked-password" />
              <label for="checked-password" class="form-check-label">显示密码</label>
            </div>
            <div>
              <button type="submit" class="btn btn-dark w-100 fw-500">更改</button>
            </div>
          </form>
        </div>

      </div>
    </div>

  </div>

  <script src="javascript/edit-profile.js"></script>
  <script src="javascript/logout.js"></script>
  <script src="javascript/delete-account.js"></script>
  <script src="javascript/image-error.js"></script>
  <script src="javascript/open-menu.js"></script>
  <script src="javascript/show-password.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>