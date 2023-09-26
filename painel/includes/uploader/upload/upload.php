<? session_start();
if(strpos($_SERVER['HTTP_HOST'], '.test') !== false) {
	$Host = 'localhost';		//servidor
	$User = 'root';				//usuario
	$senha = 'qweasd';				//senha
	$banco = 'vesna'; 
	$port = 3306;
}else{
	$banco = 'maisapos_vesna'; 			//nome do banco
	$Host = 'localhost';
	$User = 'maisapos_vesna';				//usuario
	$senha = 'MoMoney3434-';			//senha
	$port = 3306;
}

$conn = mysqli_connect($Host, $User, $senha, $banco, $port) or die(mysqli_error());
mysqli_query($conn,"set names 'utf8'");
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');
mysqli_query($conn,'SET lc_time_names=pt_BR');




if($_SESSION['token'])
{
	$token = $_SESSION['token'];
}
else
{
	$token = $_SESSION['id_ficha'];
}

echo $token;
$upload = $_FILES['files'];
$nome = md5(uniqid(rand(), true));

if($upload){
	$temp = array();
	foreach ($_FILES['files'] as $key => $value) {
		foreach($value as $index => $val){
			$temp[$index][$key] = $val;
		}
	}
	
	foreach($temp as $img){
		$ext = explode('.',$img['name']);
		
		$sql = "CREATE TABLE IF NOT EXISTS `casasimagens` (`id` int(255) NOT NULL AUTO_INCREMENT, `img` varchar(255), `token` varchar(255), `legenda` varchar(255), `cor` varchar(255), `principal` varchar(255), PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0";
		
		$query = mysqli_query( $conn, $sql);
		echo $Sql = "INSERT INTO casasimagens (img, token, principal, cor) VALUES ('".$nome.".".end($ext)."', '".$token."', '0','".$cor."')";
		$Query = mysqli_query( $conn, $Sql);
		
		if (!file_exists($_REQUEST['pag'])) {
			mkdir('../../../arquivos/casas/', 0755, true);
		}
		
		if(move_uploaded_file($img['tmp_name'],'../../../arquivos/casas/'.$nome.".".end($ext))){ return true; }
	}
}

?>