<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';
require_once __DIR__ . '/../../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../../infra/repositories/expenseRepository.php';


$title = ' - Partilhar Despesas';
$user = user();

$expensesResult = getExpensesByUserId($user['id']);
$users = getAllUsersExceptLoggedInUser($user['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/crud/styles.css">
    <title>Lista de Despesas e Usuários</title>
</head>
<body style="background-image: linear-gradient(to right, #FFA200 , #FFC300);">
    <header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
        <a href="/crud/pages/secure/" class="text-dark text-decoration-none logo">
            <img src="/crud/assets/images/uploads/logo.png" alt="ESTG" class="mw-100">
        </a>
        <div class="header-text mb-4 text-center">
            <h1 class="display-5 fw-bold">Partilhar Despesa</h1>
        </div>
        <form action="/crud/pages/secure/" method="post">
            <button class="btn btn-lg px-4 border-dark" type="submit" name="user" value="logout" style="">Voltar</button>
        </form>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="border-radius: 10px; box-shadow: 5px 5px 10px #888888; background-color:#cfdbd5;">
                    <div class="card-body">
                        <h3 class="card-title"><strong>Partilhar Despesa</strong></h3>
                        <form id="shareForm" method="post" action="/crud/controllers/auth/shareExpense.php">
                            <div class="form-group">
                                <label for="selectedExpense" class="fw-bold">Selecionar Despesa:</label>
                                <select class="form-control" id="selectedExpense" name="selectedExpense" style="background-color: #e8eddf;">
                                    <option value="" disabled selected>Selecione uma Despesa</option>
                                    <?php foreach ($expensesResult as $expense): ?>
                                        <option value="<?= $expense['id'] ?>">
                                            ID: <?= $expense['id'] ?> | Categoria: <?= $expense['categoria'] ?> | Descrição: <?= $expense['descricao'] ?> | Valor: <?= $expense['valor'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sharedUserId" class="fw-bold">Compartilhar com:</label>
                                <select class="form-control" id="sharedUserId" name="sharedUserId" style="background-color: #e8eddf;">
                                    <option value="" disabled selected>Selecione um Usuário</option>
                                    <?php foreach ($users as $user): ?>
                                        <?php if ($user['id'] != $user['id_do_usuario_logado']): ?>
                                            <option value="<?= $user['id'] ?>">
                                                <?= $user['email'] ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" name="loggedInUserId" value="<?= $user['id'] ?>">
                            <button type="submit" class="btn btn-success">Partilhar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>

