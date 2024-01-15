<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';
require_once __DIR__ . '/../../../infra/repositories/expenseRepository.php';

$title = ' - Lista de Despesas';
$user = user();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/crud/styles.css">
    <title>Lista de Despesas</title>
</head>

<body style="background-image: linear-gradient(to right, #FFA200 , #FFC300);">
    <header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
        <a href="/crud/pages/secure/" class="text-dark text-decoration-none logo">
            <img src="/crud/assets/images/uploads/logo.png" alt="ESTG" class="mw-100">
        </a>
        <div class="header-text mb-4 text-center">
            <h1 class="display-5 fw-bold">Lista de Despesas</h1>
        </div>
        <form action="/crud/pages/secure/" method="post">
            <button class="btn btn-lg px-4 border-dark" type="submit" name="user" value="logout" style="">Voltar</button>
        </form>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-2">
                <div class="card" style="border-radius: 10px; box-shadow: 5px 5px 10px #888888; background-color:#cfdbd5;">
                    <div class="card-body">
                        <h3 class="card-title"><strong>Lista de Despesas</strong></h3>
                    <div>
                        <div class="table-responsive">
                            <table id="expenseTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Categoria</th>
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user_id = $_SESSION['id'];
                                    $expenses = getExpensesByUserId($user_id);
                                    foreach ($expenses as $expense) {
                                        echo '<tr>';
                                        echo '<td>' . $expense['id'] . '</td>';
                                        echo '<td>' . $expense['categoria'] . '</td>';
                                        echo '<td>' . $expense['descricao'] . '</td>';
                                        echo '<td>' . $expense['valor'] . '</td>';
                                        echo '<td>' . $expense['dataDespesa'] . '</td>';
                                        echo '<td>
                                            <button class="btn btn-sm btn-danger" onclick="removeExpense(' . $expense['id'] . ')">Remover</button>
                                            <a href="./viewExpense.php?id=' . $expense['id'] . '" class="btn btn-sm btn-info">Detalhes</a>
                                            <!-- Adicione outras ações conforme necessário -->
                                        </td>';
                                        echo '</tr>';
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

    <script>
        function removeExpense(expenseId) {
            if (confirm('Tem certeza de que deseja remover esta despesa?')) {
                window.location.href = '/crud/controllers/auth/removeExpense.php?id=' + expenseId;
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>


<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>

