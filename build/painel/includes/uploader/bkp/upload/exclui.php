<?
include('../../includes/class.banco.php');
$novs = new conect();
session_start();
$SqlVer = "SELECT * FROM ".$_SESSION['pagina']."imagens WHERE id = '".$_POST['id']."' LIMIT 1";
$QueryVer = mysql_query($SqlVer);
$TotalVer = mysql_fetch_array($QueryVer);

//if(@unlink("img/".$TotalVer['nome']))
//{
	$Sql = "DELETE FROM ".$_SESSION['pagina']."imagens WHERE id = '".$_POST['id']."' LIMIT 1";
	$Query = mysql_query($Sql);
//}
?>