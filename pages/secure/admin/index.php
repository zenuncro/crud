<?php
require_once __DIR__ . '/../../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '/../../../templates/header.php';

$users = getAll();
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-2 card" style="border-radius: 10px; box-shadow: 5px 5px 10px #888888; background-color:#cfdbd5; padding: 10px;">
            <div>
                <div class="card-body">
                    <h2 class="mb-4">Utilizadores</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Sobrenome</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Administrador</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $user) {
                                    ?>
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['lastname'] ?></td>
                                        <td><?= $user['phoneNumber'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['administrator'] == '1' ? 'Sim' : 'Não' ?></td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <a href="/crud/controllers/admin/user.php?<?= 'user=update&id=' . $user['id'] ?>" class="btn btn-sm btn-primary me-2">Atualizar</a>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#delete<?= $user['id'] ?>">Eliminar</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delete<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Utilizador</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem a certeza de que pretende eliminar este utilizador?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    <a href="/crud/controllers/admin/user.php?<?= 'user=delete&id=' . $user['id'] ?>"><button type="button" class="btn btn-danger btn-block">Confirmar</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<?php
include_once __DIR__ . '/../../../templates/footer.php';
?>
