<div class="bg-dark px-4 py-2 d-flex align-items-center justify-content-between text-white header">
  <div>
    <h2 class="logo-font animate__animated animate__bounceInLeft animate__slow">Yu sheng</h2>
  </div>
  <i class="fas fa-bars menu-icons"></i>
  <div class="nav-menu">
    <header class="mb-2 text-center header">
      <h1 class="text-dark mb-0">欢迎 !</h1>
    </header>
    <ul class="m-0 p-0 d-flex align-items-center justify-content-center flex-wrap">
      <li><a href="home.php" class="me-2 text-decoration-none fw-bold nav-text">主页</a></li>
      <li><a href="contact.php" class="me-3 text-decoration-none fw-bold nav-text">联络</a></li>
      <?php
      if (!isset($_COOKIE['sct'])) {
        echo '
        <li><a href="login.php" class="me-2 text-decoration-none fw-bold nav-button">登入</a></li>
        <li><a href="register.php" class="me-2 text-decoration-none fw-bold nav-button">注冊</a></li>
        ';
      } else {
        echo '
        <li><a href="my-profile.php" class="me-2 text-decoration-none fw-bold nav-button">账户</a></li>
        <li><a href="" class="me-2 text-decoration-none fw-bold nav-button logout-button">登出</a></li>
        ';
      }
      ?>
    </ul>
  </div>
</div>
<div class="overlay"></div>
<script>
  window.addEventListener("scroll", () => {
    document.querySelector(".header").classList.toggle("active", window.scrollY > 500);
  });
</script>