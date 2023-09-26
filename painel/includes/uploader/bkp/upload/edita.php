<?
session_start();
include('../../includes/class.banco.php');
$novs = new conect();

if($_POST['val'] == 'legenda'){
	$SqlVer = "UPDATE ".$_SESSION['pagina']."imagens SET legenda = '".$_POST['legenda']."' WHERE id = '".$_POST['id']."'";
}elseif($_POST['val'] == 'principal'){
	if($_SESSION['token'])
	{
		$token = $_SESSION['token'];
	}
	else
	{
		$token = $_SESSION['id_ficha'];
	}
	
	$sql = "UPDATE ".$_SESSION['pagina']."imagens SET principal = '0' WHERE token = '".$token."'";
	$QueryMuda = mysql_query($sql);
	
	$SqlVer = "UPDATE ".$_SESSION['pagina']."imagens SET principal = '".$_POST['principal']."' WHERE id = '".$_POST['id']."'";
	
	
	
	
}


$QueryVer = mysql_query($SqlVer);
