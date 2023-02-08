<?php

//Cabecalhos obrigatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT");

//Incluir a conexao
include_once 'conexao.php';

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);

if($dados){
    $id = $dados['id'];
    $img = $dados['img'];


    $codigo = $dados['codigo'];
    $nome = $dados['nome'];
    $detalhe = $dados['detalhe'];
    $quantidade = $dados['quantidade'];
    $serie = $dados['serie'];
    $valor = $dados['valor'];
    $fornecedor = $dados['fornecedor'];
    $status = $dados['status'];
    //$data_inicio = $dados['data_inicio'];
    //$data_atualizada = $dados['data_atualizada'];
    $inativo = $dados['inativo'];

    
    $sql = $pdo->prepare("UPDATE produtos SET img=:i, codigo=:cd, nome=:n, detalhe=:d, quantidade=:q, serie=:s, valor=:v, fornecedor=:f, status=:st, data_atualizada=:da, inativo=:inativo WHERE id=:id");
/*
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->bindParam(':i', $img, PDO::PARAM_STR);
    $sql->bindParam(':cd', $codigo, PDO::PARAM_STR);
    $sql->bindParam(':n', $nome, PDO::PARAM_STR);
    $sql->bindParam(':d', $detalhe, PDO::PARAM_STR);
    $sql->bindParam(':q', $quantidade, PDO::PARAM_INT);
    $sql->bindParam(':s', $serie, PDO::PARAM_STR);
    $sql->bindParam(':v', $valor, PDO::PARAM_);
    $sql->bindParam(':f', $fornecedor, PDO::PARAM_STR);
    $sql->bindParam(':st', $status, PDO::PARAM_STR);
    $sql->bindParam(':di', $data_inicio, PDO::PARAM_STR);
    $sql->bindParam(':da', $data_atualizada, PDO::PARAM_STR);
    $sql->bindParam(':inativo', $inativo, PDO::PARAM_INT);
*/
    
    $sql->bindValue(':id', $id);
    $sql->bindValue(':i', $img);
    $sql->bindValue(':cd', $codigo);
    $sql->bindValue(':n', $nome);
    $sql->bindValue(':d', $detalhe);
    $sql->bindValue(':q', $quantidade);
    $sql->bindValue(':s', $serie);
    $sql->bindValue(':v', $valor);
    $sql->bindValue(':f', $fornecedor);
    $sql->bindValue(':st', $status);
    $sql->bindValue(':da', $data);
    $sql->bindValue(':inativo', $inativo);
    
    $sql->execute();

    if($sql->rowCount()){
        $response = [
            "erro" => false,
            "mensagem" => "Produto editado com sucesso!"
        ];
    }else{
        $response = [
            "erro" => false,
            "mensagem" => "Produto não editado !"
        ];
    }
}else{
    $response = [
        "erro" => false,
        "mensagem" => "Produto não editado !"
    ];
}

http_response_code(200);
echo json_encode($response);