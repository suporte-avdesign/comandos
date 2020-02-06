<?php
include 'config/Connection.php';

$conn = getConnection();

return setId($conn, 1, 'html');


function getAll($conn, $opc) {

    $sql = 'SELECT * FROM produto';

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($opc == 'json') {
        resultJson($result);
    } else {
        resultHtml($result);
    };
}

function setId($conn, $id, $opc) {
    $sql = "SELECT * FROM produto WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $result = $stmt->fetchAll();

    if ($opc == 'json') {
        resultJson($result);
    } else {
        resultHtml($result);
    };
}


function resultHtml($result)
{
    foreach ($result as $value) {
        echo "Descrição:{$value['descricao']}<br>";
    }
}


function resultJson($result)
{
    print_r(json_encode(['data' => $result]));
}


