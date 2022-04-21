<?php
require_once 'op-php/db-connect.php';

$query_3 = mysqli_query($db_connection, "SELECT * FROM `comment`");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
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

    <div class="row mb-4">
      <div class="col-12 col-md-6">
        <div class="pic">
          <img src="image/yusheng-logo.jpg" class="img-fluid rounded-3" style="object-fit: cover;" />
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="h-100 d-flex align-items-start flex-column justify-content-center">
          <h1 class="logo-font animate__animated animate__bounce animate__slow">Yu sheng</h1>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum doloremque in cupiditate aliquam unde magnam, tempora quos asperiores inventore officiis atque eveniet similique labore praesentium architecto ipsam accusamus explicabo aliquid, vitae delectus ipsa repellendus incidunt odit commodi. Porro cupiditate eveniet corporis eum? Perferendis ullam iste id praesentium quam cum. Aut, libero eius et veniam maiores modi fugit quasi iure nobis itaque quas fuga, voluptatum deleniti mollitia! Id, impedit praesentium accusamus laudantium molestias neque soluta reprehenderit. Magni labore incidunt et placeat hic, explicabo nemo ipsum. Quam ullam explicabo ipsa reiciendis saepe ratione, numquam molestias voluptates ab alias reprehenderit libero, non aliquam!</p>
        </div>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-12">
        <div>
          <header class="mb-2 pb-2" style="border-bottom: .1rem solid #d6d6d6;">
            <h1 class="logo-font mb-0 animate__animated animate__bounce animate__slow">关注</h1>
          </header>
          <div class="overflow-auto follow-list" style="max-height: 1500px">

            <div class="d-flex align-items-center justify-content-center flex-wrap follow">
              <div class="pic">
                <img src="image/instagram-logo.svg" alt="" class="w-100" style="max-width: 350px" />
              </div>
              <div style="flex: 1 1 40rem;">
                 <h1 class="logo-font">Instagram</h1>
                 <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora ab repellat assumenda error dolore dicta corporis exercitationem minus ad, aliquid animi, dolorum voluptatum hic voluptatibus aspernatur odit? At, quidem! Necessitatibus optio, corrupti maxime unde quidem culpa similique amet consectetur. Aliquam placeat expedita, maiores neque quam ab ipsum vel nemo dicta.</p>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-center flex-wrap follow">
              <div class="pic">
                <img src="image/youtube-logo.svg" alt="" class="w-100" style="max-width: 350px" />
              </div>
              <div style="flex: 1 1 40rem;">
                 <h1 class="logo-font">Youtube</h1>
                 <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora ab repellat assumenda error dolore dicta corporis exercitationem minus ad, aliquid animi, dolorum voluptatum hic voluptatibus aspernatur odit? At, quidem! Necessitatibus optio, corrupti maxime unde quidem culpa similique amet consectetur. Aliquam placeat expedita, maiores neque quam ab ipsum vel nemo dicta.</p>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-center flex-wrap follow">
              <div class="pic">
                <img src="image/facebook-logo.png" alt="" class="w-100" style="max-width: 350px" />
              </div>
              <div style="flex: 1 1 40rem;">
                 <h1 class="logo-font">Facebook</h1>
                 <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora ab repellat assumenda error dolore dicta corporis exercitationem minus ad, aliquid animi, dolorum voluptatum hic voluptatibus aspernatur odit? At, quidem! Necessitatibus optio, corrupti maxime unde quidem culpa similique amet consectetur. Aliquam placeat expedita, maiores neque quam ab ipsum vel nemo dicta.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col-12">
        <header class="mb-2 pb-2 d-flex align-items-center justify-content-between" style="border-bottom: .1rem solid #d6d6d6;">
          <h1 class="logo-font mb-0 animate__animated animate__bounce animate__slow">留言</h1>
          <span class="">共 <strong class="text-primary comment-quantity"><div class="spinner-grow" style="width: 15px; height: 15px;"></div></strong> 条评论</span>
        </header>
        <div>

          <div class="pb-2 mb-2" style="border-bottom: .1rem solid #d6d6d6;">
            <form action="" method="POST" id="comment-form">
              <div class="mb-2">
                <label for="" class="mb-1">输入内容:</label>
                <textarea rows="3" class="form-control" placeholder="说些什么..." name="comment" maxlength="200"></textarea>
              </div>
              <div>
                <button type="submit" class="btn btn-dark w-100" style="max-width: 100px; height: 40px;">留言</button>
              </div>
            </form>
          </div>

          <div class="overflow-auto comment-list text-break" style="max-height: 1200px;">
          
            <div class="spinner-border text-primary"></div>

          </div>

        </div>
      </div>
    </div>

  </div>

  <?php require_once 'footer.php'; ?>

  <script src="javascript/comment.js"></script>
  <script src="javascript/logout.js"></script>
  <script src="javascript/image-error.js"></script>
  <script src="javascript/open-menu.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>