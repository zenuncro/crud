<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
include_once __DIR__ . '../../../templates/header.php';

$title = ' - Sign In';
?>
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
  <form action="/crud/controllers/auth/signin.php" method="post">
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
                          <h2>Olá, </h2>
                          <p>Bem-vindo novamente!</p>
                      </div>
                      <div class="input-group mb-3">
                          <input type="email" class="form-control form-control-lg bg-light fs-6" id="email" name="email" placeholder="Email" 
                          value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>">       
                      </div>
                      <div class="input-group mb-1">
                          <input type="password" class="form-control form-control-lg bg-light fs-6" id="password" name="password" placeholder="Palavra-passe"
                          value="<?= isset($_REQUEST['password']) ? $_REQUEST['password'] : null ?>">
                      </div>
                      <div class="input-group mb-5 d-flex justify-content-between"></div>
                      <div class="input-group mb-3">
                          <button class="btn btn-lg btn-primary w-100 fs-6" type="submit" name="user" value="login">Login</button>
                      </div>
                      <div class="row">
                          <small>Não tens conta? <a href="/crud/pages/public/signup.php">Sign Up</a></small>
                      </div>
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
