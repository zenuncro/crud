<?php
#EASY DATABASE SETUP
require __DIR__ . '/infra/db/connection.php';

#DROP TABLE
$pdo->exec('DROP TABLE IF EXISTS users;');

echo 'table users deleted!' . PHP_EOL;

#CREATE TABLE
$pdo->exec(
    'CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    name varchar(50)	, 
    lastname varchar(50)	, 
    phoneNumber varchar(50)	, 
    email varchar(50)	 NOT NULL, 
    foto varchar(50)	 NULL, 
    administrator bit, 
    password varchar(200)	);'
);

echo 'Tabela users created!' . PHP_EOL;

#DEFAULT USER TO ADD
$user = [
    'name' => 'João',
    'lastname' => 'Lima Araújo',
    'phoneNumber' => '987654321',
    'email' => 'jocaaraujo07@gmail.com',
    'foto' => null,
    'administrator' => true,
    'password' => '123456'
];

#HASH PWD
$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

#INSERT USER
$sqlCreate = "INSERT INTO 
    users (
        name, 
        lastname, 
        phoneNumber, 
        email, 
        foto, 
        administrator, 
        password) 
    VALUES (
        :name, 
        :lastname, 
        :phoneNumber, 
        :email, 
        :foto, 
        :administrator, 
        :password
    )";

#PREPARE QUERY
$PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

#EXECUTE
$success = $PDOStatement->execute([
    ':name' => $user['name'],
    ':lastname' => $user['lastname'],
    ':phoneNumber' => $user['phoneNumber'],
    ':email' => $user['email'],
    ':foto' => $user['foto'],
    ':administrator' => $user['administrator'],
    ':password' => $user['password']
]);

echo 'Default user created!';


#CREATE TABLE EXPENSES
$pdo->exec('DROP TABLE IF EXISTS expenses;');
echo 'table expenses deleted!' . PHP_EOL;

$pdo->exec(
    'CREATE TABLE expenses (
    id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    categoria varchar(50)	, 
    descricao varchar(50)	, 
    valor decimal(10,2)	, 
    estado ENUM ("Pago", "Não Pago")  ,
    dataDespesa date NOT NULL,
    metodoPagamento varchar(50)	, 
    foto varchar(50)	, 
    user_id INTEGER, 
    FOREIGN KEY (user_id) REFERENCES users(id));'
);


#CREATE TABLE TO SHARE EXPENSES
$pdo->exec('DROP TABLE IF EXISTS sharedExpenses;');
echo 'table sharedExpenses deleted!' . PHP_EOL;

$pdo->exec(
    'CREATE TABLE sharedExpenses (
    id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    user_id INTEGER, 
    expense_id INTEGER, 
    shared_by INTEGER,
    viewed BOOLEAN,
    FOREIGN KEY (shared_by) REFERENCES users(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (expense_id) REFERENCES expenses(id));'
);

echo 'Tabela sharedExpenses created!' . PHP_EOL;

#CREATE TABLE TO SCHEDULE EXPENSES
$pdo->exec('DROP TABLE IF EXISTS scheduledExpenses;');
echo 'table scheduledExpenses deleted!' . PHP_EOL;

$pdo->exec(
    'CREATE TABLE scheduledExpenses (
    id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    categoria varchar(50)	, 
    descricao varchar(50)	, 
    valor decimal(10,2)	, 
    estado ENUM ("Pago", "Não Pago")  ,
    dataDespesa date NOT NULL,
    metodoPagamento varchar(50)	, 
    foto varchar(50)	, 
    user_id INTEGER, 
    FOREIGN KEY (user_id) REFERENCES users(id));'
);

echo 'Tabela scheduledExpenses created!' . PHP_EOL;


