<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';


$title = ' - Categorizar Despesas';
$user = user();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Despesa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/crud/styles.css">
</head>

<body style="background-image: linear-gradient(to right, #FFA200, #FFC300);">
<header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
    <a href="/crud/pages/secure/" class="text-dark text-decoration-none logo">
        <img src="/crud/assets/images/uploads/logo.png" alt="ESTG" class="mw-100">
    </a>
    <div class="header-text mb-4 text-center">
        <h1 class="display-5 fw-bold">Adicionar Despesa</h1>
    </div>
    <form action="/crud/pages/secure/index.php" method="post">
        <button class="btn btn-lg px-4 border-dark" type="submit" name="user" value="logout" style="">Voltar</button>
    </form>
</header>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card" style="border-radius: 10px; box-shadow: 5px 5px 10px #888888; background-color:#cfdbd5; ">
                <div class="card-body">
                <h3 class="card-title"><strong>Adicionar Despesa</strong></h3>
                    <form class="form-addExpense" action="/crud/controllers/auth/addExpense.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="categoria" class="fw-bold">Categoria:</label>
                            <input type="text" class="form-control" id="categoria" name="categoria" required
                                value="<?= isset($_REQUEST['categoria']) ? $_REQUEST['categoria'] : null ?>" style="background-color: #e8eddf;">
                        </div>
                        <div class="form-group">
                            <label for="descricao" class="fw-bold">Descrição:</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" required style="background-color: #e8eddf;"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="valor" class="fw-bold">Valor:</label>
                            <input type="number" class="form-control" id="valor" name="valor" step="0.01" required style="background-color: #e8eddf;"
                                value="<?= isset($_REQUEST['valor']) ? $_REQUEST['valor'] : null ?>">
                        </div>
                        <div class="form-group">
                            <label for="expenseDate" class="fw-bold">Data da Despesa:</label>
                            <input type="date" class="form-control" id="expenseDate" name="expenseDate" required style="background-color: #e8eddf;">
                        </div>
                        <div class="form-group">
                            <label for="paymentStatus" class="fw-bold">Estado do Pagamento:</label>
                            <select class="form-control" id="paymentStatus" name="paymentStatus" style="background-color: #e8eddf;">
                                <option value="" disabled selected>Selecione um Estado</option>
                                <option value="Não Pago">Não Pago</option>
                                <option value="Pago">Pago</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paymentMethod" class="fw-bold">Método de Pagamento:</label>
                            <select class="form-control" id="paymentMethod" name="paymentMethod" style="background-color: #e8eddf;">
                                <option value="" disabled selected>Selecione um Método</option>
                                <option value="Cartão de Crédito">Cartão de Crédito/Débito</option>
                                <option value="Dinheiro">Dinheiro</option>
                                <option value="Transferência Bancária">Transferência Bancária</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="expenseImage" class="fw-bold">Anexar Foto:</label>
                            <input accept="image/*" type="file" class="form-control" id="inputGroupFile01" name="foto" style="background-color: #e8eddf;" />
                        </div>
                        <button type="submit" class="btn btn-success" name="expense" value="addExpense">Adicionar Despesa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>


