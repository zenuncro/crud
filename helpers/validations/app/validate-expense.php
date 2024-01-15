<?php

function validateExpense($req) {
    $errors = [];

    // Trim whitespace from all input fields
    foreach ($req as $key => $value) {
        $req[$key] = trim($value);
    }

    // Validate 'categoria'
    if (empty($req['categoria']) || strlen($req['categoria']) < 3 || strlen($req['categoria']) > 255) {
        $errors['categoria'] = 'The categoria field cannot be empty and must be between 3 and 255 characters.';
    }

    // Validate 'descricao'
    if (empty($req['descricao']) || strlen($req['descricao']) < 3 || strlen($req['descricao']) > 255) {
        $errors['descricao'] = 'The descricao field cannot be empty and must be between 3 and 255 characters.';
    }

    // Validate 'valor'
    if (!is_numeric($req['valor']) || strlen($req['valor']) !== 9) {
        $errors['valor'] = 'The valor field must be a numeric value and exactly 9 characters.';
    }

    // Return errors if any, otherwise return the sanitized input
    return !empty($errors) ? ['invalid' => $errors] : $req;
}

?>