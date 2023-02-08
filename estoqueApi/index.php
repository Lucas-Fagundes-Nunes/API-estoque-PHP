<?php
//Cabecalhos obrigatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'conexao.php';


$sql = $pdo->prepare('SELECT * FROM produtos ORDER BY id DESC ');
$sql->execute();

if($sql->rowCount() != 0)
{
    while($lista = $sql->fetch(PDO::FETCH_ASSOC))
    {
        extract($lista);
        //$lista_produtos["produtos"][$id]
        $lista_produtos["produtos"][] = [
            'id' => $id,
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
    }
        //Resposta com status 200
        http_response_code(200);

        //Retornar os produtos em formato json
        echo json_encode($lista_produtos);
}

?>