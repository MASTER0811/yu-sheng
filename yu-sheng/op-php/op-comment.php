<?php

if (isset($_COOKIE['sct'])) {

  if (isset($_POST['comment'])) {

    include_once 'db-connect.php';

    $query_1 = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `unique_id` = '{$_COOKIE['sct']}' LIMIT 1");
    
    if (mysqli_num_rows($query_1) > 0) {
      $rows_1 = mysqli_fetch_assoc($query_1);
    } 

    $date = date('Y-m-d H:i:s A');
    $comment = mysqli_real_escape_string($db_connection, $_POST['comment']);
    $user_name = $rows_1['first_name'] . ' ' . $rows_1['last_name'];

    if (mb_strlen($comment) < 1 || ctype_space($comment)) {
      echo '不能输入空的内容';
    } else {

      if (mb_strlen($comment) > 200) {
        echo '不能超过200个字符';
      } else {
        $finally_comment = ltrim(htmlspecialchars($comment));
        $query_2 = mysqli_query($db_connection, "INSERT INTO `comment`
      (`user_name`, `image_avatar`, `content`, `unique_id`, `date`)
      VALUES ('{$user_name}', '{$rows_1['image_avatar']}', '{$finally_comment}', '{$_COOKIE['sct']}', '{$date}')");
        if (!$query_2) {
          echo '出现未知错误, 请稍后在试';
        } else {

          $query_3 = mysqli_query($db_connection, "SELECT * FROM `comment`");
          if (mysqli_num_rows($query_3) > 0) {

            while ($rows_2 = mysqli_fetch_assoc($query_3)) {

              echo '<div class="d-flex align-items-center comment-container">
              <div class="pic me-2 mb-auto">
                <img src="users-image-avatar/'.$rows_2['image_avatar'].'" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" />
              </div>
              <div class="w-100">
                <div class="mb-2">
                  <h6 class="mb-0 logo-font pb-1">'.$rows_2['user_name'].'</h6>
                  <p class="mb-0 overflow-auto comment-content" style="max-height: 190px;">'.$rows_2['content'].'</p>
                </div>
                <div>
                  <span>'.$rows_2['date'].'</span>
                </div>
              </div>
            </div>';
            }
          }
        }
      }
    }
  }
} else {
  echo '请先登入';
}
