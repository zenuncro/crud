<?php

require_once __DIR__ . '/../../infra/db/connection.php';
require_once __DIR__ . '/../../infra/repositories/expenseRepository.php';


function payExpense($id)
{
    try {
        $sqlPay = "UPDATE scheduledExpenses SET estado = 'Pago' WHERE id = :id";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlPay);

        $success = $PDOStatement->execute([
            ':id' => $id
        ]);

        moveExpenseToExpenses($id);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);


        if ($success) {
            header('Location: /crud/pages/secure/user/viewExpensesToPay.php');
            exit();
        } else {
            echo "Erro ao pagar despesa.";
        }
    } catch (PDOException $e) {
        echo "Erro ao pagar despesa: " . $e->getMessage();
    }
}


if (isset($_GET['id'])) {
    $expenseId = $_GET['id'];
    payExpense($expenseId);
} else {
    echo "ID da despesa não fornecido.";
}
?>