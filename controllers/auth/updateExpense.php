<?php

session_start();

require_once __DIR__ . '/../../infra/db/connection.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-expense.php';

function updateExpense($data)
{
    try {
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'sir-crud';
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $tableName = "expenses";
        $formattedDataDespesa = date('Y-m-d', strtotime($data['novaDataDespesa']));

        $novoEstado = isset($data['novoEstado']) ? $data['novoEstado'] : null;

        $novoMetodoPagamento = isset($data['novoMetodoPagamento']) ? $data['novoMetodoPagamento'] : null;

        if ($_FILES['novaFoto']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../assets/images/expenseImages/';
            $originalFileName = basename($_FILES['novaFoto']['name']);
            $uploadFile = $uploadDir . $originalFileName;

            move_uploaded_file($_FILES['novaFoto']['tmp_name'], $uploadFile);
            $finalFoto = $originalFileName;
        } else {
            $finalFoto = $data['fotoAtual'];
        }

        $updateQuery = "UPDATE $tableName SET 
                categoria = :novaCategoria, 
                descricao = :novaDescricao, 
                valor = :novoValor,
                estado = :novoEstado,
                metodoPagamento = :novoMetodoPagamento,
                foto = :finalFoto,
                dataDespesa = :novaDataDespesa 
                WHERE id = :id";

        $stmt = $pdo->prepare($updateQuery);

        $stmt->bindParam(':novaCategoria', $data['novaCategoria']);
        $stmt->bindParam(':novaDescricao', $data['novaDescricao']);
        $stmt->bindParam(':novoValor', $data['novoValor']);
        $stmt->bindParam(':novoEstado', $novoEstado);
        $stmt->bindParam(':novoMetodoPagamento', $novoMetodoPagamento);
        $stmt->bindParam(':finalFoto', $finalFoto);
        $stmt->bindParam(':novaDataDespesa', $data['novaDataDespesa']);
        $stmt->bindParam(':id', $data['id']);

        $stmt->execute();

        $successMessage = "Despesa atualizada com sucesso.";
        echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
        header('location: /crud/pages/secure/user/listExpense.php' . $params);

    } catch (PDOException $e) {
        $errorMessage = "Erro ao atualizar despesa: " . $e->getMessage();
        echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['expense']) && $_POST['expense'] == 'updateExpense') {
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }

    $data = [
        'id' => $_POST['id'],
        'novaCategoria' => $_POST['novaCategoria'],
        'novaDescricao' => $_POST['novaDescricao'],
        'novoValor' => $_POST['novoValor'],
        'novoEstado' => isset($_POST['novoEstado']) ? $_POST['novoEstado'] : $expense['estado'],
        'novoMetodoPagamento' => isset($_POST['novoMetodoPagamento']) ? $_POST['novoMetodoPagamento'] : $expense['metodoPagamento'],
        'novaFoto' => $_FILES['novaFoto'],
        'novaDataDespesa' => $_POST['novaDataDespesa'],
        'user_id' => $user_id,
        'fotoAtual' => $_POST['fotoAtual'],
    ];
    
    updateExpense($data);
} else {
    $errorMessage = "Erro ao atualizar despesa: método de requisição inválido.";
    echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
}
