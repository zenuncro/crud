<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
include_once __DIR__ . '../../../../templates/header.php';
@require_once __DIR__ . '/../../../helpers/session.php';
require_once __DIR__ . '/../../../infra/repositories/expenseRepository.php';


$expense_id = isset($_GET['id']) ? $_GET['id'] : null;

$expense = getByExpenseId($expense_id);

?>
<!DOCTYPE html>
<html lang="en">
<style>
    .image-container {
        position: relative;
        width: 100%;
        height: 70%;
        overflow: hidden;
        border-radius: 10px;
        background-color: #cfdbd5;
        transition: transform 0.3s ease-in-out;
    }

    .image-container:hover {
        transform: scale(1.1);
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/crud/styles.css">
    
    <title>Detalhes da Despesa</title>
</head>
<body style="background-image: linear-gradient(to right, #FFA200 , #FFC300);">
    <header class="pb-3 mb-4 border-bottom d-flex justify-content-between align-items-center">
        <a href="/crud/pages/secure/" class="text-dark text-decoration-none logo">
            <img src="/crud/assets/images/uploads/logo.png" alt="ESTG" class="mw-100">
        </a>
        <div class="header-text mb-4 text-center">
            <h1 class="display-5 fw-bold">Detalhes da Despesa</h1>
        </div>
        <form action="/crud/pages/secure/user/listExpense.php" method="post">
            <button class="btn btn-lg px-4 border-dark" type="submit" name="user" value="logout" style="">Voltar</button>
        </form>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="border-radius: 10px; box-shadow: 5px 5px 10px #888888; background-color:#cfdbd5;">
                    <div class="card-body">
                        <h1>Detalhes da Despesa</h1>
                        <div class="detailsSection" id="detailsSection">
                            <div class="receipt">
                                <div class="receipt-details">
                                    <p><strong>ID:</strong> <?php echo $expense['id']; ?></p>
                                    <p><strong>Categoria:</strong> <?php echo $expense['categoria']; ?></p>
                                    <p><strong>Descrição:</strong> <?php echo $expense['descricao']; ?></p>
                                    <p><strong>Valor:</strong> <?php echo $expense['valor']; ?>€</p>
                                    <p><strong>Estado:</strong> <?php echo $expense['estado']; ?></p>
                                    <p><strong>Método de Pagamento:</strong> <?php echo $expense['metodoPagamento']; ?></p>
                                    <p><strong>Data da Despesa:</strong> <?php echo $expense['dataDespesa']; ?></p>
                                </div>
                                <div class="receipt-footer">
                                    <button class="btn btn-warning" onclick="editDetails(<?= $expense['id']; ?>)">Editar Detalhes</button>
                                </div>
                            </div>
                        </div>
                        <form id="editDetailsForm" action="/crud/controllers/auth/updateExpense.php" method="POST" enctype="multipart/form-data" style="display: none;">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $expense['id']; ?>">
                                <label for="editCategoria">Nova Categoria:</label>
                                <input type="text" class="form-control" id="editCategoria" name="novaCategoria" style="background-color: #e8eddf;" value="<?= $expense['categoria']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="editDescricao">Nova Descrição:</label>
                                <textarea class="form-control" id="editDescricao" name="novaDescricao" style="background-color: #e8eddf;"><?= $expense['descricao']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editValor">Novo Valor:</label>
                                <input type="number" class="form-control" id="editValor" name="novoValor" step="0.01" style="background-color: #e8eddf;" value="<?= $expense['valor']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="editExpenseDate">Nova Data da Despesa:</label>
                                <input type="date" class="form-control" id="editExpenseDate" name="novaDataDespesa" style="background-color: #e8eddf;" value="<?= $expense['dataDespesa']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="editPaymentStatus">Novo Estado do Pagamento:</label>
                                <select class="form-control" id="editPaymentStatus" name="novoEstado" style="background-color: #e8eddf;">
                                    <option value="" disabled selected>Selecione um Estado</option>
                                    <option value="Não Pago" <?= ($expense['estado'] === "Não Pago") ? "selected" : ""; ?>>Não Pago</option>
                                    <option value="Pago" <?= ($expense['estado'] === "Pago") ? "selected" : ""; ?>>Pago</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editPaymentMethod">Novo Método de Pagamento:</label>
                                <select class="form-control" id="editPaymentMethod" name="novoMetodoPagamento" style="background-color: #e8eddf;">
                                    <option value="" disabled selected>Selecione um Método</option>
                                    <option value="Cartão de Crédito/Débito" <?= ($expense['metodoPagamento'] === "Cartão de Crédito/Débito") ? "selected" : ""; ?>>Cartão de Crédito/Débito</option>
                                    <option value="Dinheiro" <?= ($expense['metodoPagamento'] === "Dinheiro") ? "selected" : ""; ?>>Dinheiro</option>
                                    <option value="Transferência Bancária" <?= ($expense['metodoPagamento'] === "Transferência Bancária") ? "selected" : ""; ?>>Transferência Bancária</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editFoto">Nova Foto:</label>
                                <input type="file" class="form-control" id="editFoto" name="novaFoto" accept="image/*">
                                <input type="hidden" name="fotoAtual" value="<?= $expense['foto']; ?>">
                            </div>
                            <button type="submit" class="btn btn-success mt-2" name="expense" value="updateExpense">Guardar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php if (!empty($expense['foto'])) : ?>
                    <div class="image-container">
                        <a href="#" onclick="openModal('<?= htmlspecialchars('/crud/assets/images/expenseImages/' . $expense['foto']); ?>')">
                            <img src="<?= htmlspecialchars('/crud/assets/images/expenseImages/' . $expense['foto']); ?>" alt="Foto da Despesa"
                                style="width: 100%; height: 100%; object-fit: cover; margin-bottom: 10px; cursor: pointer;"
                                data-toggle="modal" data-target="#photoModal">
                        </a>
                        <div style="text-align: center;">
                            <p style="font-size: 16px; margin-bottom: 5px;">Descrição</p>
                            <p style="font-weight: bold;"><?= htmlspecialchars($expense['descricao']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel"><?php echo $expense['descricao']; ?></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="#" alt="Imagem da Despesa" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editDetails(expenseId) {
            document.getElementById('detailsSection').style.display = 'none';
            document.getElementById('editDetailsForm').style.display = 'block';
            document.getElementById('editDetailsForm').setAttribute('data-expense-id', expenseId);
        }

        function openModal(imageSrc) {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }
    </script>
</body>
</html>

<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>