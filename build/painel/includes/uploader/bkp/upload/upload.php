<?
include('../../includes/class.banco.php');
$novs = new conect();

session_start();
//$upload = $_FILES;
$upload = $_FILES['files'];

if($upload){
	$temp = array();
	foreach ($_FILES['files'] as $key => $value) {
		foreach($value as $index => $val){
			$temp[$index][$key] = $val;
		}
	}
	$nome = md5(uniqid(rand(), true));
	
	foreach($temp as $img)
	{
		$ext = substr($img['name'],-3, 3);
		
		if($_SESSION['token'])
		{
			$token = $_SESSION['token'];
		}
		else
		{
			$token = $_SESSION['id_ficha'];
		}
		
		
		
		$Sql = "INSERT INTO ".$_SESSION['pagina']."imagens (img, token, legenda) VALUES ('".$nome.".".$ext."', '".$token."', '".$legenda."')";
		$Query = mysql_query($Sql);
		if(move_uploaded_file($img['tmp_name'],$_SESSION['caminho'].$nome.".".$ext)){ return true; }
	}
}

?>