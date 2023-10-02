<?
$stringUsuarioId   = str_replace("&", "", $_GET["usuarioId"]);
$arrayUsuarioId     = array_slice(explode("id[]=", $stringUsuarioId), 1);
$count = 1;
foreach($arrayUsuarioId as $usuarioId) {
mysql_query("UPDATE produtos SET ordem = '".$count."' WHERE id = '".$usuarioId."'");

echo "UPDATE produtos SET ordem = '".$count."' WHERE id = '".$usuarioId."'";

$count++;

}
?>