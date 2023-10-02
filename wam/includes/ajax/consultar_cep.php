<?php
$cep = $_POST['cep'];
$var_content = trim(file_get_contents("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep));
$reg =  simplexml_load_string($var_content);
 
$dados['sucesso'] = (string) $reg->resultado;
$dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
$dados['bairro']  = (string) $reg->bairro;
$dados['cidade']  = (string) $reg->cidade;
$dados['estado']  = (string) $reg->uf;
 
echo json_encode($dados);
 
?>