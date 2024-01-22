<?php
session_start();
require_once __DIR__ . '/../../infra/db/connection.php';

function removeExpense($id)
{
    try {
        // Verifica se há dependências na tabela sharedExpenses
        $sqlCheckDependencies = "SELECT COUNT(*) FROM sharedExpenses WHERE expense_id = :id";
        $stmtCheckDependencies = $GLOBALS['pdo']->prepare($sqlCheckDependencies);
        $stmtCheckDependencies->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtCheckDependencies->execute();
        $dependencyCount = $stmtCheckDependencies->fetchColumn();

        if ($dependencyCount > 0) {
            // Remove as dependências da tabela sharedExpenses
            $sqlRemoveDependencies = "DELETE FROM sharedExpenses WHERE expense_id = :id";
            $stmtRemoveDependencies = $GLOBALS['pdo']->prepare($sqlRemoveDependencies);
            $stmtRemoveDependencies->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtRemoveDependencies->execute();
        }

        // Remove a despesa da tabela expenses
        $sqlRemove = "DELETE FROM expenses WHERE id = :id";
        $stmtRemove = $GLOBALS['pdo']->prepare($sqlRemove);
        $success = $stmtRemove->execute([':id' => $id]);

        if ($success) {
            header('Location: ../../pages/secure/user/listExpense.php');
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
