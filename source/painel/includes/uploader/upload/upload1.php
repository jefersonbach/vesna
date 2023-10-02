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
		
		
		$Sql = "SELECT * FROM ".$_SESSION['pagina']."imagens WHERE token = '".$token."'";
		$Query = mysql_query($Sql);
		
		if(mysql_num_rows($Query) > 0){
			$Sql = "UPDATE ".$_SESSION['pagina']."imagens SET img = '".$nome.".".$ext."', legenda = '".$legenda."' WHERE token = '".$token."'";
			$Query = mysql_query($Sql);
			if(move_uploaded_file($img['tmp_name'],$_SESSION['caminho'].$nome.".".$ext)){ return true; } 
		}else{
			$Sql = "INSERT INTO ".$_SESSION['pagina']."imagens (img, token, legenda) VALUES ('".$nome.".".$ext."', '".$token."', '".$legenda."')";
			$Query = mysql_query($Sql);
			if(move_uploaded_file($img['tmp_name'],$_SESSION['caminho'].$nome.".".$ext)){ return true; }
		}
	}
}

?>