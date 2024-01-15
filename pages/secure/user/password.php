<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Alterar Senha';
$user = user();
?>

<body style="background-image: linear-gradient(to right, #FFA200 , #FFC300);">
    <header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
        <a href="/crud/pages/secure/" class="text-dark text-decoration-none logo">
            <img src="/crud/assets/images/uploads/logo.png" alt="ESTG" class="mw-100">
        </a>
        <div class="header-text mb-4 text-center">
            <h1 class="display-5 fw-bold">Alterar Password</h1>
        </div>
        <form action="/crud/pages/secure/user/profile.php" method="post">
            <button class="btn btn-lg px-4 border-dark" type="submit" name="user" value="logout" style="">Voltar</button>
        </form>
    </header>

    <main class="container mt-4">
        <section class="container">
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
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    unset($_SESSION['errors']);
                }
                ?>                
        </section>

        <section class="container">
        <div class="card" style="background-color: #cfdbd5; border-radius: 10px; box-shadow: 5px 5px 10px #888888; padding: 10px">
            <form action="/crud/controllers/admin/user.php" method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" name="password" maxlength="255" required style="background-color: #e8eddf;">
                </div>
                <div class="col-md-6">
                    <label for="confirm_password" class="form-label fw-bold">Confirmar Password</label>
                    <input type="password" class="form-control" name="confirm_password" maxlength="255" required style="background-color: #e8eddf;">
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success" type="submit" name="user" value="password">Alterar Password</button>
                </div>
            </form>
        </div>
    </section>
    </main>
</body>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>
