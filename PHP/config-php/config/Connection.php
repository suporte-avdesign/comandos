<?php
/**
 * @return PDO
 */
function getConnection() {
    $dsn = 'mysql:host=localhost;dbname=pdo;charset=utf8';
    $user = 'root';
    $pass = 'server';

    try {
        $pdo = new PDO($dsn, $user, $pass);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erro: {$e->getMessage()}<br>";
        echo "Linha:{$e->getLine()}";
    }
}
