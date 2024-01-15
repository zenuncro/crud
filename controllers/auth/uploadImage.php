<?php

if ($_FILES['novaFoto']['error'] !== UPLOAD_ERR_OK) {
    echo 'Erro ao carregar a imagem. Código do erro: ' . $_FILES['novaFoto']['error'];
    exit;
}

$uploadDir = __DIR__ . '/crud/assets/images/expenseImages/';
$originalFileName = basename($_FILES['novaFoto']['name']);
$fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

$newFileName = 'expense_' . time() . '.' . $fileExtension;

$uploadFile = $uploadDir . $newFileName;

if (move_uploaded_file($_FILES['novaFoto']['tmp_name'], $uploadFile)) {
    echo 'Imagem carregada com sucesso. Novo nome do arquivo: ' . $newFileName;
} else {
    echo 'Falha ao mover o arquivo para o diretório de upload.';
}

?>
