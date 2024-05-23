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

  <style>
    *{

      }
      .navbar{
        background-color: transparent !important;
        background-image: url('../image/grid3.jpeg') !important;
        background-repeat: repeat !important;
        background-size: 200px;
        

      }
      .btnLog{
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        padding: 10px 10px;
        font-size: 14px;
        letter-spacing: 1px;
        border: none;
        background-color: rgb(52, 0, 172);
        color: whitesmoke;
      }
      .btnLog:hover{
        background-color: rgb(52, 0, 172);
        color: whitesmoke;
      }
      .btnNav{
        color: rgb(200, 200, 200, 0.5);
      }
      ul{
        margin-left: 20px;
        gap: 30px;
      }
      a{
        text-decoration: none;
        color: whitesmoke;
      }
  </style>  
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    
    <div class="container">
      <a class="navbar-brand" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="whitesmoke" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-codesandbox"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="7.5 4.21 12 6.81 16.5 4.21"/><polyline points="7.5 19.79 7.5 14.6 3 12"/><polyline points="21 12 16.5 14.6 16.5 19.79"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" x2="12" y1="22.08" y2="12"/></svg></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php if (!empty($_SESSION['USER'])): ?>
            <li class="nav-item">
              <a class="btnNav home" aria-current="page" href="<?= ROOT ?>/home">Home</a>
            </li>
            <li class="nav-item">
              <a class="btnNav users" aria-current="page" href="<?= ROOT ?>/users">Users</a>
            </li>
          <?php endif; ?>
        </ul>
        <div class = "d-flex align-items-center gap-3">
            <div>
              <?php if (empty($_SESSION['USER'])): ?>

                  <a href="<?= ROOT ?>/login" class="btnLog">Login</a>
                  <?php else: ?>
                  <a href="<?= ROOT ?>/logout" class="btnLog">Logout</a>

              <?php endif; ?>
            </div>
            
        </div>

      </div>
    </div>
  </nav>
  <script>
    const home = document.querySelector('.home');
    const users = document.querySelector('.users');

    function setActiveLink(activeLink) {
      home.style.color = activeLink === 'home' ? 'white' : 'rgb(200, 200, 200, 0.5)';
      home.style.fontWeight = activeLink === 'home' ? '600' : 'normal';
      users.style.color = activeLink === 'users' ? 'white' : 'rgb(200, 200, 200, 0.5)';
      users.style.fontWeight = activeLink === 'users' ? '600' : 'normal';
    }

    window.addEventListener('load', function() {
      const currentPage = window.location.pathname.split('/').pop();
      if (currentPage === 'home') {
        setActiveLink('home');
      } else if (currentPage === 'users') {
        setActiveLink('users');
      }
    });

    home.addEventListener('click', function() {
      setActiveLink('home');
    });

    users.addEventListener('click', function() {
      setActiveLink('users');
    });
  </script>