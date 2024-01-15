<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
include_once __DIR__ . '../../../templates/header.php';

$title = ' - Sign In';
?>
<style>
  .form-floating label {
    position: absolute;
    top: 0;
    left: 0;
    margin-left: 0.5rem;
    padding-left: 1.5rem;
    pointer-events: none;
    transition: all 0.3s ease;
  }
</style>


<body style="background-image: linear-gradient(to right, #FFA200 , #FFC300)">
  <main>
  <section>
    <?php
    if (isset($_SESSION['errors'])) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
      foreach ($_SESSION['errors'] as $error) {
        echo $error . '<br>';
      }
      echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
      unset($_SESSION['errors']);
    }
    ?>
  </section>
  <form action="/crud/controllers/auth/signup.php" method="post">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
      <div class="row border rounded-5 p-3 bg-white shadow box-area"> 
        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background-image: linear-gradient(to right, #101010 , #313131)">
          <div>
            <a href="/crud/index.php">
              <img src="/crud/assets/images/uploads/logo3-rmbg.png" alt="logo" style="max-width:448px; max-height:470px; width: auto; height: auto;">
            </a>
          </div>
        </div> 
        <div class="col-md-6 right-box">
          <div class="row align-items-center">
            <div class="header-text mb-4">
              <h2>Regista-te</h2>
            </div>
            <div class="form-floating mb-2">
              <input type="text" class="form-control" name="name" placeholder="name" maxlength="100" size="100"
                value="<?= isset($_REQUEST['name']) ? $_REQUEST['name'] : null ?>" required>
              <label for="name"> Nome</label>
            </div>
            <div class="form-floating mb-2">
            <input type="text" class="form-control" name="lastname" placeholder="lastname" maxlength="100" size="100"
                value="<?= isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : null ?>" required>
              <label for="lastname">Apelido</label>
            </div>
            <div class="form-floating mb-2">
            <input type="text" class="form-control" name="phoneNumber" placeholder="phone" maxlength="100" size="100"
                value="<?= isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : null ?>" required>
              <label for="phone">Telefone</label>
            </div>          
            <div class="form-floating mb-2">
              <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com"
                value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>">
              <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-2">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                value="<?= isset($_REQUEST['password']) ? $_REQUEST['password'] : null ?>">
              <label for="password">Password</label>
            </div>
            <div class="form-floating mb-2">
              <input type="password" class="form-control" id="confirmar_palavra_passe" name="confirmar_palavra_passe"placeholder="Confirm password"
                value="<?= isset($_REQUEST['confirm_password']) ? $_REQUEST['confirm_password'] : null ?>">
              <label for="confirmar_palavra_passe">Confirm Password</label>
            </div>
            <button class="btn btn-lg btn-primary w-100 fs-6 mt-2" type="submit" name="user" value="signUp">Registar</button>
          </div>
          <div class="row mt-1">
            <small>Já tens conta? <a href="/crud/pages/public/signin.php">Sign In</a></small>
          </div>
        </div>
      </div>
    </div>
  </form>
</main>
</body>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>
