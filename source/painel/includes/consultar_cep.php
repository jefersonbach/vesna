<?php
$cep = $_POST['cep'];

function webClient ($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    $url = sprintf('https://viacep.com.br/ws/%s/json/ ', $cep);
    $reg = json_decode(webClient($url));

    //var_dump($result);

$dados['sucesso'] = (string) $reg->resultado;
$dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
$dados['bairro']  = (string) $reg->bairro;
$dados['cidade']  = (string) $reg->localidade;
$dados['estado']  = (string) $reg->uf;
$dados['ddd']  = (string) $reg->ddd;
 
echo json_encode($dados);
 
?>