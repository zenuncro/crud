<?php
require_once __DIR__ . '/../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '/../../../templates/header.php';

$title = ' - Gestão de Utilizadores';
?>

<body style="background-image: linear-gradient(to right, #FFA200 , #FFC300);">
  <header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
    <a class="text-dark text-decoration-none logo">
      <img src="/crud/assets/images/uploads/logo.png" alt="ESTG" class="mw-100">
    </a>
    <div class="header-text mb-4 text-center">
      <h1 class="display-5 fw-bold">Gestão de Utilizadores</h1>
    </div>
    <form action="/crud/pages/secure/" method="post">
      <button class="btn btn-lg px-4 border-dark" type="submit" name="user" value="logout">Voltar</button>
    </form>
  </header>

  <main class="container">
    <section>
      <?php
      if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo $_SESSION['success'] . '<br>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        unset($_SESSION['success']);
      }
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
    <section class="pb-4">
      <form enctype="multipart/form-data" action="/crud/controllers/admin/user.php" method="post"
        class="form-control py-3 card" style="background-color: #cfdbd5; border-radius: 10px; box-shadow: 5px 5px 10px #888888; padding: 10px">
        <div class="input-group mb-3">
          <span class="input-group-text">Nome</span>
          <input type="text" class="form-control" name="name" maxlength="100" size="100"
            value="<?= isset($_REQUEST['name']) ? $_REQUEST['name'] : null ?>" required style="background-color: #e8eddf;" >
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Sobrenome</span>
          <input type="text" class="form-control" name="lastname" maxlength="100" size="100"
            value="<?= isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : null ?>" required style="background-color: #e8eddf;">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Número de Telefone</span>
          <input type="tel" class="form-control" name="phoneNumber" maxlength="9"
            value="<?= isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : null ?>" required style="background-color: #e8eddf;">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">E-mail</span>
          <input type="email" class="form-control" name="email" maxlength="255"
            value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>" required style="background-color: #e8eddf;">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Password</span>
          <input type="password" class="form-control" name="password" maxlength="255" required style="background-color: #e8eddf;">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Confirmar Password</span>
          <input type="password" class="form-control" name="confirm_password" maxlength="255" required style="background-color: #e8eddf;">
        </div>
        <div class="input-group mb-3">
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="administrator" role="switch"
              id="flexSwitchCheckChecked" <?= isset($_REQUEST['administrator']) && $_REQUEST['administrator'] == true ? 'checked' : null ?>>
            <label class="form-check-label" for="flexSwitchCheckChecked">Administrador</label>
          </div>
        </div>
        <div class="d-grid col-4 mx-auto">
          <input type="hidden" name="id" value="<?= isset($_REQUEST['id']) ? $_REQUEST['id'] : null ?>">
          <input type="hidden" name="foto" value="<?= isset($_REQUEST['foto']) ? $_REQUEST['foto'] : null ?>">
          <button type="submit" class="btn btn-success"
            name="user" <?= isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' ? 'value="update"' : 'value="create"' ?>>Atualizar</button>
        </div>
      </form>
    </section>
  </main>
</body>

<?php
require_once __DIR__ . '/../../../templates/footer.php';
?>
