<?php

session_start();
require_once __DIR__ . '/../../infra/db/connection.php';

function markExpenseAsViewed($expenseId)
{
    global $pdo;

    try {
        $tableName = "sharedExpenses";

        $sql = "UPDATE $tableName SET viewed = 1 WHERE expense_id = :expenseId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':expenseId', $expenseId, PDO::PARAM_INT);
        $stmt->execute();

        header('location: /crud/pages/secure/user/viewSharedExpenses.php');
    } catch (PDOException $e) {
        die("Erro ao marcar despesa como vista: " . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $expenseId = $_GET['id'];
    markExpenseAsViewed($expenseId);
}