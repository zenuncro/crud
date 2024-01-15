<?php
require_once __DIR__ . '/../../../helpers/session.php';
require_once __DIR__ . '/../../../infra/repositories/expenseRepository.php';
include_once __DIR__ . '/../../../templates/header.php';

$user = user(); 
$sharedExpenses = getSharedExpensesByUserId($user['id']); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Despesas Compartilhadas</title>
</head>
<body style="background-image: linear-gradient(to right, #FFA200 , #FFC300);">
    <header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
        <a href="/crud/pages/secure/" class="text-dark text-decoration-none logo">
            <img src="/crud/assets/images/uploads/logo.png" alt="ESTG" class="mw-100">
        </a>
        <div class="header-text mb-4 text-center">
            <h1 class="display-5 fw-bold">Despesas Partilhadas</h1>
        </div>
        <form action="/crud/pages/secure/" method="post">
            <button class="btn btn-lg px-4 border-dark" type="submit" name="user" value="logout" style="">Voltar</button>
        </form>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-radius: 10px; box-shadow: 5px 5px 10px #888888; background-color:#cfdbd5;">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Despesas Partilhadas</strong></h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($sharedExpenses)): ?>
                            <p>Nenhuma despesa partilhada encontrada.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Categoria</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                            <th>Data</th>
                                            <th>Partilhado por:</th>
                                            <th>Ações</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sharedExpenses as $expense): ?>
                                            <tr>
                                                <td><?= $expense['categoria'] ?></td>
                                                <td><?= $expense['descricao'] ?></td>
                                                <td><?= $expense['valor'] ?></td>
                                                <td><?= $expense['dataDespesa'] ?></td>
                                                <td><?= $expense['shared_by'] ?></td>
                                                <td>
                                                    <?php if ($expense['viewed'] == 0): ?>
                                                        <button class="btn btn-success" onclick="markAsViewed(<?= $expense['id'] ?>)">Marcar como lida</button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
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

<script>
    function markAsViewed(expenseId) {
        if (confirm('Tem certeza de que deseja marcar esta despesa como lida?')) {
            window.location.href = '/crud/controllers/auth/markAsViewed.php?id=' + expenseId;
        }
    }
</script>

<?php
include_once __DIR__ . '/../../../templates/footer.php';
?>
