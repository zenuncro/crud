<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Perfil';
$user = user();
?>

<body style="background-image: linear-gradient(to right, #FFA200 , #FFC300);">
    <header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
        <a href="/crud/pages/secure/" class="text-dark text-decoration-none logo">
            <img src="/crud/assets/images/uploads/logo.png" alt="ESTG" class="mw-100">
        </a>
        <div class="header-text mb-4 text-center">
            <h1 class="display-5 fw-bold">Perfil</h1>
        </div>
        <form action="/crud/pages/secure/" method="post">
            <button class="btn btn-lg px-4 border-dark" type="submit" name="user" value="logout">Voltar</button>
        </form>
    </header>
    <main class="container mt-4">
        <section class="container">
            <div class="card"
                style="background-color: #cfdbd5; border-radius: 10px; box-shadow: 5px 5px 10px #888888; padding: 10px">
                <form enctype="multipart/form-data" action="/crud/controllers/admin/user.php" method="post"
                    class="row g-3">
                    <div class="col-md-12">
                        <?php if (!empty($user['foto'])) : ?>
                            <div style="border: 2px solid #fff; border-radius: 50%; overflow: hidden; width: 150px; height: 150px; margin: 0 auto;">
                                <img src="<?= htmlspecialchars('/crud/assets/images/profileImages/' . $user['foto']); ?>"
                                    alt="Foto de Perfil Atual" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        <?php else : ?>
                            <div style="border: 2px solid #fff; border-radius: 50%; overflow: hidden; width: 150px; height: 150px; margin: 0 auto; background-color: #e8eddf;">
                                <img src="<?= htmlspecialchars('/crud/assets/images/profileImages/default-profile.jpg'); ?>"
                                    alt="Foto de Perfil Padrão" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nome" maxlength="100"
                            value="<?= isset($_REQUEST['name']) ? $_REQUEST['name'] : $user['name'] ?>"
                            required style="background-color: #e8eddf;">
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="form-label fw-bold">Sobrenome</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Sobrenome" maxlength="100"
                            value="<?= isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : $user['lastname'] ?>"
                            required style="background-color: #e8eddf;">
                    </div>
                    <div class="col-md-6">
                        <label for="phoneNumber" class="form-label fw-bold">Número de Telefone</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" maxlength="9"
                            value="<?= isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : $user['phoneNumber'] ?>"
                            required style="background-color: #e8eddf;">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="255"
                            value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : $user['email'] ?>"
                            required style="background-color: #e8eddf;">
                    </div>
                    <div class="col-md-3">
                        <label for="alterarFoto" class="fw-bold">Alterar Foto</label>
                        <input accept="image/*" type="file" class="form-control" id="inputGroupFile01" name="foto"
                            style="background-color: #e8eddf;" />
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success" type="submit" name="user" value="profile">Atualizar Perfil</button>
                    </div>
                </form>
                <div class="col-md-6 mt-2">
                    <a href="/crud/pages/secure/user/password.php"><button class="btn btn-success">Alterar Password</button></a>
                </div>
            </div>
        </section>
    </main>
</body>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>

