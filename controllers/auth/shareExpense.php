<?php
require_once __DIR__ . '/../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../infra/db/connection.php';


session_start();

function getExpenseDetails($expenseId)
{
    global $pdo;
    try {
        $tableName = "expenses";

        $sql = "SELECT e.id, e.categoria, e.descricao, e.valor, u.email as user_email
                FROM $tableName e
                JOIN users u ON e.user_id = u.id
                WHERE e.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $expenseId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao obter detalhes da despesa: " . $e->getMessage());
    }
}

function shareExpenseWithUser($expenseId, $userId, $sharedByUserId, $viewed )
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("INSERT INTO sharedExpenses (expense_id, user_id, shared_by, viewed) VALUES (:expenseId, :userId, :sharedByUserId, :viewed)");
        $stmt->bindParam(':expenseId', $expenseId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':sharedByUserId', $sharedByUserId, PDO::PARAM_INT);
        $stmt->bindParam(':viewed', $viewed, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Erro ao compartilhar despesa: " . $e->getMessage());
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedExpense'], $_POST['sharedUserId'], $_POST['loggedInUserId'])) {
    if(isset($_SESSION['id'])){
        $sharedByUserId = $_SESSION['id'];
    } 
    $expenseId = $_POST['selectedExpense'];
    $userId = $_POST['sharedUserId'];
    $viewed = 0;

    shareExpenseWithUser($expenseId, $userId, $sharedByUserId, $viewed);
    header('location: /crud/pages/secure/user/sharePersonalExpense.php');
}


?>