<?php
require_once __DIR__ . '../../db/connection.php';

#GET EXPENSES BY USER ID
function getExpensesByUserId($user_id)
{
    try {
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'sir-crud';
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $tableName = "expenses";

        $getExpensesQuery = "SELECT * FROM $tableName WHERE user_id = :user_id";
        $stmt = $pdo->prepare($getExpensesQuery);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Erro ao obter despesas: " . $e->getMessage();
        return array(); 
    }
}

#GET EXEPENSE BY ID
function getByExpenseId($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM expenses WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function updateExpense($id, $novaCategoria, $novaDescricao, $novoValor)
{
    try {
        $tableName = "expenses";

        $sql = "UPDATE $tableName SET 
                categoria = :novaCategoria, 
                descricao = :novaDescricao, 
                valor = :novoValor 
                WHERE id = :id";

        $stmt = $GLOBALS['pdo']->prepare($sql);

        $stmt->bindParam(':novaCategoria', $novaCategoria);
        $stmt->bindParam(':novaDescricao', $novaDescricao);
        $stmt->bindParam(':novoValor', $novoValor);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return true; 

    } catch (PDOException $e) {
        echo "Erro ao atualizar despesa: " . $e->getMessage();
        return false; 
    }
}


#GET SHARED EXPENSES BY USER ID
function getSharedExpensesByUserId($userId)
{
    global $pdo;

    try {
        $tableName = "sharedExpenses";

        $sql = "SELECT e.id, e.categoria, e.descricao, e.valor, e.dataDespesa, u.name as shared_by, se.viewed
                FROM $tableName se
                JOIN expenses e ON se.expense_id = e.id
                JOIN users u ON se.shared_by = u.id
                WHERE se.user_id = :userId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao obter despesas compartilhadas: " . $e->getMessage());
    }
}


#GET EXPENSES THAT DATE IS TODAY
function getTodayExpenses($id){
    $insertQuery = "
    SELECT *
    FROM scheduledExpenses
    WHERE user_id = :id
    AND (dataDespesa = CURDATE() OR dataDespesa = DATE_ADD(CURDATE(), INTERVAL 1 DAY));";

    $stmt = $GLOBALS['pdo']->prepare($insertQuery);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $expenses;
}


#MOBVE SCHEDULE_EXPENSE TO EXPENSES
function moveExpenseToExpenses($expenseId) {
    try {

        $expenseDetails = getExpenseDetails($expenseId);
        insertIntoExpenses($expenseDetails);
        deleteFromScheduledExpenses($expenseId);
        
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function getExpenseDetails($expenseId) {
    $selectQuery = "SELECT * FROM scheduledExpenses WHERE id = :id";
    $stmt = $GLOBALS['pdo']->prepare($selectQuery);
    $stmt->bindParam(':id', $expenseId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertIntoExpenses($expenseDetails) {
    $insertQuery = "
        INSERT INTO expenses (categoria, descricao, valor, estado, dataDespesa, metodoPagamento, foto, user_id)
        VALUES (:categoria, :descricao, :valor, :estado, :dataDespesa, :metodoPagamento, :foto, :user_id)
    ";

    $stmt = $GLOBALS['pdo']->prepare($insertQuery);
    $stmt->bindParam(':categoria', $expenseDetails['categoria']);
    $stmt->bindParam(':descricao', $expenseDetails['descricao']);
    $stmt->bindParam(':valor', $expenseDetails['valor']);
    $stmt->bindParam(':estado', $expenseDetails['estado']);
    $stmt->bindParam(':dataDespesa', $expenseDetails['dataDespesa']);
    $stmt->bindParam(':metodoPagamento', $expenseDetails['metodoPagamento']);
    $stmt->bindParam(':foto', $expenseDetails['foto']);
    $stmt->bindParam(':user_id', $expenseDetails['user_id']);

    $stmt->execute();
}

function deleteFromScheduledExpenses($expenseId) {
    try {
        $deleteQuery = "DELETE FROM scheduledExpenses WHERE id = :id";
        $stmt = $GLOBALS['pdo']->prepare($deleteQuery);
        $stmt->bindParam(':id', $expenseId);
        $stmt->execute();

        $errorInfo = $stmt->errorInfo();
        if ($errorInfo[0] !== '00000') {
            echo "Erro ao excluir da tabela scheduledExpenses: " . $errorInfo[2];
        }
    } catch (PDOException $e) {
        echo "Erro ao excluir da tabela scheduledExpenses: " . $e->getMessage();
    }
}

function getNumberOfTodayExpenses($id){
    $selectQuery = "
    SELECT COUNT(*) as num_expenses
    FROM scheduledExpenses
    WHERE user_id = :id
    AND (dataDespesa = CURDATE() OR dataDespesa = DATE_ADD(CURDATE(), INTERVAL 1 DAY));";

    $stmt = $GLOBALS['pdo']->prepare($selectQuery);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result['num_expenses'];
}


#GET UNVIEWED EXPENSES
function getNumberOfUnviewedExpenses($userId)
{
    global $pdo;

    try {
        $tableName = "sharedExpenses";

        $sql = "SELECT COUNT(*) as num_unviewed
                FROM $tableName se
                JOIN expenses e ON se.expense_id = e.id
                WHERE se.user_id = :userId AND se.viewed = 0";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['num_unviewed'];
    } catch (PDOException $e) {
        die("Erro ao obter número de despesas não visualizadas: " . $e->getMessage());
    }
}

