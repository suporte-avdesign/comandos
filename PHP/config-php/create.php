<?php
include 'config/Connection.php';

$conn = getConnection();

return createExec($conn);

function bindValue($conn) {

    $sql = 'INSERT INTO produto (descricao, qtd, valor) VALUES (?,?,?)';

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, 'Produto Código:'.rand(1677, 9896));
    $stmt->bindValue(2, rand(1,99));
    $stmt->bindValue(3, rand(13.77, 99.47));

    if ($stmt->execute()) {
        print json_encode(['success' => true, 'message' => 'Salvo com sucesso!']);
    } else {
        print json_encode(['success' => false, 'message' => 'Erro ao registrar o produto.']);
    }
}

/**
 * VALUES (Pode ser qualque nome) desde que bindParam seja igual.
 *
 * @param $conn
 */
function bindParam($conn) {

    $sql = 'INSERT INTO produto (descricao, qtd, valor) VALUES (:desc,:qtd,:valor)';

    $qtd = (int) rand(1,99);
    $value = (float) rand(13.77, 99.47);
    $descricao = 'Produto Código:'.rand(1677, 9896);

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':desc', $descricao);
    $stmt->bindParam(':qtd', $qtd);
    $stmt->bindParam(':valor', $value);

    if ($stmt->execute()) {
        print json_encode(['success' => true, 'message' => 'Salvo com sucesso!']);
    } else {
        print json_encode(['success' => false, 'message' => 'Erro ao registrar o produto.']);
    }
}

/**
 * Exect (Não recomendado)
 *
 * @param $conn
 */
function createExec($conn) {

    $qtd = (int) rand(1,99);
    $value = (float) rand(13.77, 99.47);
    $descricao = 'Produto Código:'.rand(1677, 9896);

    $sql = "INSERT INTO produto (descricao, qtd, valor) VALUES ('{$descricao}',{$qtd},{$value})";

    if ($conn->exec($sql)) {
        print json_encode(['success' => true, 'message' => 'Salvo com sucesso!']);
    } else {
        print json_encode(['success' => false, 'message' => 'Erro ao registrar o produto.']);
    }
}
//echo phpinfo();