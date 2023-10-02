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

$SqlVer = "SELECT * FROM 3Dimagens WHERE id = '".$_POST['id']."' LIMIT 1";
$QueryVer = mysqli_query($conn,$SqlVer);

while($totalimg = mysqli_fetch_array($QueryVer)){


	if(unlink('../../arquivos/3D/'.$totalimg['img'])){
		$Sql = "DELETE FROM 3Dimagens WHERE id = '".$_POST['id']."'";
		$Query = mysqli_query($conn,$Sql);
	}
}
?>