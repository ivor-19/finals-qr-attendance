<?php include "partials/header.php" ?>

<div class="container mt-5">

  <form action="" method="POST" class="w-50 mx-auto">
    <h2 class="login-title">Login</h2>

    <?php if (isset($_SESSION['errorEmailorPass']) && $_SESSION['errorEmailorPass'] === true): ?>
        <div id="addErrorMsg" class="alert alert-warning alert-dismissible fade show addErrorMsg" role="alert" style="display:'block';">
            Email or Password is Incorrect.
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['errorEmailorPass']);
    endif; ?>

    <div class="mb-2">
      <label for="">Email</label>
      <input type="text" name="adminEmail" value="<?= get_var('adminEmail') ?>" class="form-control">
    </div>
    <div class="mb-2">
      <label for="">Password</label>
      <input type="adminPassword" name="adminPassword" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>

</div>

<?php include "partials/footer.php" ?>