<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Attendance</title>
  <link rel="icon" type="image/jpg" sizes="32x32" href="images/favicon.jpg">
  <link rel="stylesheet" type="text/css" href="../css/login.css?v=<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <svg class="s1" id="sw-js-blob-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" version="1.1"><defs><linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0"><stop id="stop1" stop-color="rgba(236.893, 228.65, 255, 0.61)" offset="0%"></stop><stop id="stop2" stop-color="rgba(251, 168, 31, 1)" offset="100%"></stop></linearGradient></defs><path fill="rgba(236.893, 228.65, 255, 0.61)" d="M20.7,-28.8C23.4,-26.6,19.8,-15.9,22.4,-7.4C24.9,1.1,33.7,7.5,34.6,13.2C35.4,18.9,28.3,24,21.2,24.3C14.1,24.5,7.1,20,1.1,18.5C-4.9,17,-9.8,18.7,-12.7,17C-15.5,15.4,-16.3,10.5,-20.2,5.1C-24,-0.4,-30.9,-6.3,-29.5,-9.2C-28,-12.1,-18.3,-11.9,-12,-12.9C-5.7,-14,-2.8,-16.2,3.1,-20.5C9,-24.8,18,-31,20.7,-28.8Z" width="100%" height="100%" transform="translate(50 50)" stroke-width="0" style="transition: all 0.3s ease 0s;" stroke="url(#sw-gradient)"></path></svg>
  <svg class="s2" id="sw-js-blob-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" version="1.1"><defs><linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0"><stop id="stop1" stop-color="rgba(236.893, 228.65, 255, 0.61)" offset="0%"></stop><stop id="stop2" stop-color="rgba(251, 168, 31, 1)" offset="100%"></stop></linearGradient></defs><path fill="rgba(236.893, 228.65, 255, 0.61)" d="M12.6,-13.5C18.9,-9.7,28.4,-8.2,28.7,-5.2C29.1,-2.2,20.3,2.2,16.2,9.5C12.2,16.7,12.8,26.7,9.6,28.9C6.5,31.1,-0.4,25.5,-9.2,23.2C-18,20.9,-28.7,21.8,-34.6,17.2C-40.5,12.6,-41.7,2.5,-38.4,-5.1C-35.1,-12.8,-27.3,-18,-20.1,-21.7C-13,-25.4,-6.5,-27.5,-1.7,-25.5C3.1,-23.5,6.3,-17.4,12.6,-13.5Z" width="100%" height="100%" transform="translate(50 50)" stroke-width="0" style="transition: all 0.3s ease 0s;" stroke="url(#sw-gradient)"></path></svg>

  <nav>
    <section class="outer">
      <section class="inner">
        <section class="main-nav">
          <ul>
            <li><a href="<?= ROOT ?>/login">Home</a></li>
            <li><a href="<?= ROOT ?>/about">About</a></li>
          </ul>
        </section>
      </section>
    </section>
  </nav>

  <main>
    <section class="wrapper">
      <section class="con-left">
        <section>
          <img src="../image/qr-4.png" alt="" class="qr-image">
        </section>
      </section>
      <section class="con-right">
        <section class="box">
          <section class="con-title">
            <h2 class="login-title">Welcome!</h2>
          </section>
          <hr>
          <section class="con-form">
            <form action="" method="POST" class="">
              <?php if (isset($_SESSION['errorEmailorPass']) && $_SESSION['errorEmailorPass'] === true): ?>
                <div id="addErrorMsg" class="alert alert-warning alert-dismissible fade show addErrorMsg" role="alert" style="display:'block';">
                  Email or Password is Incorrect.
                  <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['errorEmailorPass']);
              endif; ?>

              <div class="mb-2 con-email">
                <label for="">Email</label>
                <input type="text" name="adminEmail" value="<?= get_var('adminEmail') ?>" class="form-control">
              </div>
              <div class="mb-2 con-password">
                <label for="">Password</label>
                <input type="adminPassword" name="adminPassword" class="form-control">
              </div>
              <div class="mt-4 con-button">
                <button type="submit" class="loginBtn">LOGIN</button>
              </div>
            </form>
          </section>
        </section>
      </section>
    </section>
  </main>
</body>

<?php include "partials/footer.php" ?>