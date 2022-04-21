<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact</title>
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
    <header class="text-center mb-2 pb-3 mb-3" style="border-bottom: .1rem solid #d6d6d6;">
      <h1 class="logo-font mb-0 animate__animated animate__bounce animate__slow animate__repeat-3">联络</h1>
    </header>
    <div class="messages-box active mb-2">
      <i class="fas fa-exclamation-circle me-2" style="font-size: 1.4rem;"></i>
      <span>该功能未开发</span>
    </div>
    <form action="" method="POST">
      <div class="mb-2">
        <label for="" class="mb-1">标题</label>
        <input type="text" class="form-control input" />
      </div>
      <div class="mb-2">
        <label for="" class="mb-1">内容</label>
        <textarea rows="3" class="form-control"></textarea>
      </div>
      <div class="mb-2">
        <button type="submit" class="btn btn-dark w-100 fw-500">发送</button>
      </div>
      <div class="text-center">
        <a href="home.php" class="text-decoration-none text-dark fw-500">返回</a>
      </div>
    </form>
  </div>

  <script src="javascript/open-menu.js"></script>
  <script src="javascript/logout.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
</body>
</html>