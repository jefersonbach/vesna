<? session_start();


 if($_SERVER['HTTP_HOST'] == 'bakelitsul.dev:8888'){
			//$host = '127.0.0.1';		//servidor
			$user = 'root';				//usuario
			$senha = 'qweasd';				//senha
			//$Banco = $this->criaBanco($Host, $User, $senha); 
			$banco = 'bakelitsul'; 
    }else{
        $banco = 'bakelitsul'; 			//nome do banco
				$host = '186.202.152.246'; //bakelitsul.mysqli.dbaas.com.br
				$user = 'bakelitsul';				//usuario
				$senha = 'b4k3l1t3';			//senha
    }
		
		
 		$conn = mysqli_connect($host, $user, $senha, $banco) or die(mysqli_error());
			mysqli_query($conn,"set names 'utf8'");
		mysqli_query($conn,"SET NAMES 'utf8'");
		mysqli_query($conn,'SET character_set_connection=utf8');
		mysqli_query($conn,'SET character_set_client=utf8');
		mysqli_query($conn,'SET character_set_results=utf8');




//$upload = $_FILES;
$upload = $_FILES['filesD'];

if($upload){
	$temp = array();
	foreach ($_FILES['filesD'] as $key => $value) {
		foreach($value as $index => $val){
			$temp[$index][$key] = $val;
		}
	}
	$nome = md5(uniqid(rand(), true));
	
	foreach($temp as $img)
	{
		$ext = substr($img['name'],-3, 3);
		
		if($_SESSION['token']){
			$token = $_SESSION['token'];
		}else{
			$token = $_SESSION['id_ficha'];
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS `".$_SESSION['pagina']."imagens` (`id` int(255) NOT NULL AUTO_INCREMENT, `img` varchar(255), `token` varchar(255), `legenda` varchar(255), `principal` varchar(255), PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0";
		$query = mysqli_query($conn,$sql);
		
		echo $Sql = "INSERT INTO ".$_SESSION['pagina']."imagens (img, token, familia) VALUES ('".$img['name']."', '".$token."', '".$_SESSION['familia']."')";
		$Query = mysqli_query($conn,$Sql);
		
		if (!file_exists($_SESSION['caminho'])) {
			mkdir($_SESSION['caminho'], 0755, true);
		}
		
		if(move_uploaded_file($img['tmp_name'],$_SESSION['caminho'].$img['name'])){return true; }
	}
}

?>