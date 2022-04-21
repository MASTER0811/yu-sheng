<?php

require_once 'db-connect.php';

$query_1 = mysqli_query($db_connection, "SELECT * FROM `comment`");


if (mysqli_num_rows($query_1) > 0) {

  
  while ($rows_1 = mysqli_fetch_assoc($query_1)) {

    if (isset($_COOKIE['sct'])) {
      $is_users = $rows_1['unique_id'] == $_COOKIE['sct'] ? '<span class="ms-1">(你)</span>' : '';
    } else {
      $is_users = '';
    }

    echo '<div class="d-flex align-items-center comment-container">
    <div class="pic me-2 mb-auto">
      <img src="users-image-avatar/'.$rows_1['image_avatar'].'" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" />
    </div>
    <div class="w-100">
      <div class="mb-2">
        <h6 class="mb-0 logo-font pb-1">'.$rows_1['user_name'].$is_users.'</h6>
        <p class="mb-0 overflow-auto comment-content" style="max-height: 190px; font-weight: 500;">'.$rows_1['content'].'</p>
      </div>
      <div>
        <span>'.$rows_1['date'].'</span>
      </div>
    </div>
  </div>';

  }
} else {
  echo '<div class="text-center p-2 my-3">
  <i class="far fa-comment-dots mb-3" style="font-size: 7rem;"></i>
  <h4 class="logo-font">评论是空的</h4>
</div>';
}