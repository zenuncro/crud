<?php
session_start();
require_once __DIR__ . '/../../infra/db/connection.php';

function removeExpense($id)
{
    try {
        $sqlRemove = "DELETE FROM expenses WHERE id = :id";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlRemove);

        $success = $PDOStatement->execute([
            ':id' => $id
        ]);

        if ($success) {
            header('Location: /crud/pages/secure/user/listExpense.php');
            exit();
        } else {
            echo "Erro ao remover despesa.";
        }
    } catch (PDOException $e) {
        echo "Erro ao remover despesa: " . $e->getMessage();
    }
}

if (isset($_GET['id'])) {
    $expenseId = $_GET['id'];
    removeExpense($expenseId);
} else {
    echo "ID da despesa não fornecido.";
}
