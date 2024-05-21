<main class = "con">
  <div class = "wrapper">
      <section class = "qr-image">
        <img src="../image/qr-1.jpg" alt="">
      </section>
      <section class="box">
        <section class = "con-title">
          <h2 class="login-title">Welcome!</h2>
        </section>
        <hr>
        <section class = "con-form">
          <form action="" method="POST" class="">
            <?php if (isset($_SESSION['errorEmailorPass']) && $_SESSION['errorEmailorPass'] === true): ?>
                <div id="addErrorMsg" class="alert alert-warning alert-dismissible fade show addErrorMsg" role="alert" style="display:'block';">
                    Email or Password is Incorrect.
                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['errorEmailorPass']);
            endif; ?>

            <div class = "mb-2 con-email">
              <label for="">Email</label>
              <input type="text" name="adminEmail" value="<?= get_var('adminEmail') ?>" class="form-control">
            </div>
            <div class = "mb-2 con-password">
              <label for="">Password</label>
              <input type="adminPassword" name="adminPassword" class="form-control">
            </div>
            <div class = "mt-4 con-button">
              <button type="submit" class="loginBtn">LOGIN</button>
            </div>
          </form>
        </section>
      </section>
  </div>
</main>