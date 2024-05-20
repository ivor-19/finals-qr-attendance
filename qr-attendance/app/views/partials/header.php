<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Attendance</title>
  <link rel="icon" type="image/jpg" sizes="32x32" href="images/favicon.jpg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php if (!empty($_SESSION['USER'])): ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= ROOT ?>/home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= ROOT ?>/users">Users</a>
            </li>
          <?php endif; ?>
        </ul>
        <div class = "d-flex align-items-center gap-3">
            <div>
              <?php if (empty($_SESSION['USER'])): ?>

                  <a href="<?= ROOT ?>/login" class="btn btn-secondary">Login</a>
                  <?php else: ?>
                  <a href="<?= ROOT ?>/logout" class="btn btn-secondary">Logout</a>

              <?php endif; ?>
            </div>
            
        </div>

      </div>
    </div>
  </nav>