<?php


//Cabecalhos obrigatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
//header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

include_once 'conexao.php';

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);
if($dados){

    $img = $dados['img'];
    $codigo = $dados['codigo'];
    $nome = $dados['nome'];
   /* if($nome == '')
    {
        return http_response_code(404);;
    }else
    {
        return 'ok';
    }
    */
    $detalhe = $dados['detalhe'];
    $quantidade = $dados['quantidade'];
    $serie = $dados['serie'];
    $valor = $dados['valor'];
    $fornecedor = $dados['fornecedor'];
    $status = $dados['status'];
    $data_inicio = $dados['data_inicio'];
    $data_atualizada = $dados['data_atualizada'];

    $sql = $pdo->prepare("INSERT INTO produtos(img, codigo, nome, detalhe, quantidade, serie, valor, fornecedor, status, data_inicio, data_atualizada) VALUES  
    (:i, :cd, :n, :d, :q, :s, :v, :f, :st, :di, :da)");
    $sql->bindValue(':i', $img);
    $sql->bindValue(':cd', $codigo);
    $sql->bindValue(':n', $nome);
    $sql->bindValue(':d', $detalhe);
    $sql->bindValue(':q', $quantidade);
    $sql->bindValue(':s', $serie);
    $sql->bindValue(':v', $valor);
    $sql->bindValue(':f', $fornecedor);
    $sql->bindValue(':st', $status);
    $sql->bindValue(':di', $data);
    $sql->bindValue(':da',$data);
    $sql->execute();

    if($sql->rowCount()){
        $response = [
            "erro" => false,
            "messagem" => "Produto cadastrado sucesso!"
        ];
    }else{
        $response = [
            "erro" => true,
            "messagem" => "Produto não cadastrado !"
        ];
    }
    
    
}else{
    $response = [
        "erro" => true,
        "messagem" => "Produto não cadastrado !"
    ];
}

http_response_code(200);
echo json_encode($response);