<?php

//Cabecalhos obrigatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Incluir a conexao
include_once 'conexao.php';

//$id = 3;
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$response = "";

$sql = $pdo->prepare("SELECT * FROM produtos WHERE id=:id LIMIT 1");
$sql ->bindParam(':id', $id, PDO::PARAM_INT);
$sql ->execute();

if(($sql) AND ($sql->rowCount() != 0)){
    $lista = $sql->fetch(PDO::FETCH_ASSOC);
    extract($lista);

    $produto = [
        'codigo' => $codigo,
        'nome' => $nome,
        'detalhe' => $detalhe,
        'quantidade' => $quantidade,
        'serie' => $serie,
        'valor' => $valor,
        'fornecedor' => $fornecedor,
        'status' => $status,
        'data_inicio' => $data_inicio,
        'data_atualizada' => $data_atualizada
    ];

    $response = [
        "erro"=> false,
        "produto" => $produto
    ];
}else{
    $response = [
        "erro"=> true,
        "messagem" => "Produto não encontrado!"
    ];
}
http_response_code(200);
echo json_encode($response);
