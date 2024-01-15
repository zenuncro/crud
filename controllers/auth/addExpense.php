<?php
session_start();
require_once __DIR__ . '/../../infra/db/connection.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-expense.php';


function insertExpense($categoria, $descricao, $valor, $estado, $metodoPagamento, $foto, $user_id, $dataDespesa) {
    try {
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'sir-crud';
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $tableName = "expenses";

        $formattedDataDespesa = date('Y-m-d', strtotime($dataDespesa));

        if (!empty($_FILES['foto']['name'])) {
            $uploadDir = __DIR__ . '/../../assets/images/expenseImages/';
            $uploadFile = $uploadDir . basename($_FILES['foto']['name']);
            
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
                $foto = basename($_FILES['foto']['name']);
            } else {
                echo "Erro ao mover o arquivo para o diretório de destino.";
                echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
                return;
            }
        }

        $insertQuery = "
            INSERT INTO $tableName (categoria, descricao, valor, estado, metodoPagamento, foto, user_id, dataDespesa)
            VALUES (:categoria, :descricao, :valor, :estado, :metodoPagamento, :foto, :user_id, :dataDespesa);
        ";

        $stmt = $pdo->prepare($insertQuery);

        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':metodoPagamento', $metodoPagamento);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':dataDespesa', $formattedDataDespesa);

        $stmt->execute();

        $successMessage = "Despesa adicionada com sucesso.";
        echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
        header('location: /crud/pages/secure/user/addPersonalExpense.php');

    } catch (PDOException $e) {
        $errorMessage = "Erro ao adicionar despesa: " . $e->getMessage();
        echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['expense']) && $_POST['expense'] == 'addExpense') {
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    } 

    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $estado = isset($_POST['paymentStatus']) ? $_POST['paymentStatus'] : null;
    $metodoPagamento = $_POST['paymentMethod'];
    $foto = null;
    $dataDespesa = $_POST['expenseDate'];

    insertExpense($categoria, $descricao, $valor, $estado, $metodoPagamento, $foto, $user_id, $dataDespesa);
}


?>
