<?php include PATH . "partials/header.php" ?>

<div class="container">

  <form action="" method="POST" class="mt-5 w-50 mx-auto">
    <h2>Delete User</h2>

    <div class="mb-2">
      <label for="">First Name</label>
      <input name="firstname" type="text" class="form-control">
    </div>
    <div class="mb-2">
      <label for="">Last Name</label>
      <input name="lastname" type="text" class="form-control">
    </div>
    <div class="mb-2">
      <label for="">Email</label>
      <input name="email"  type="email" class="form-control">
    </div>
    <div class="mb-2">
      <label for="">Password</label>
      <input name="password"  type="password" class="form-control">
    </div>
    <input type="hidden" name="id" >
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>

</div>

<?php include PATH . "partials/footer.php" ?>