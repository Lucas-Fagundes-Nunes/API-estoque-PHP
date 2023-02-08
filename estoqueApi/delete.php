<?php

//Cabecalhos obrigatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT, DELETE");

//Incluir a conexao
include_once 'conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$response = "";

$sql = $pdo->prepare("DELETE FROM produtos WHERE id=:id LIMIT 1");
$sql->bindValue(':id', $id);

if($sql->execute()){
    $response = [
        "erro" => false,
        "mensagem" => "Produto apagado com sucesso!"
    ];
}else{
    $response = [
        "erro" => true,
        "mensagem" => "Erro: Produto não apagado !"
    ];
}

http_response_code(200);
echo json_encode($response);
