<? session_start();


  if($_SERVER['HTTP_HOST'] == 'bakelitsul.dev:8888'){
			$host = '127.0.0.1';		//servidor
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


	if($_SESSION['token'])
	{
		$token = $_SESSION['token'];
	}
	else
	{
		$token = $_SESSION['id_ficha'];
	}
	//echo "<li><a href='upload/img/".$Total['img']."'>".$_SESSION['token']."</a> <span data-id='".$Total['id']."'></span></li>";
	$Sql = "SELECT * FROM ".$_SESSION['pagina']."imagens where familia = '".$_SESSION['familia']."' ORDER BY img ASC";
	//$Sql = "SELECT * FROM produtosimagens ORDER BY id DESC";
	$Query = mysqli_query($conn,$Sql);
	while($Total = mysqli_fetch_array($Query))
	{?>
		<li style="text-align:center; width:50px">
        	
            	<a href="/painel/arquivos/<?=$_SESSION['pagina']?>/<?=$Total['img']?>" class="fancybox" style="text-align:center;height:40px;" title="<?=$Total['legenda']?>">
                	 
                	<img src="/images/downloadVerde.svg" style="margin:0 auto 5px" />
				
                </a>
            <div style="text-align:center; margin:0 auto; display:inline-block">
                <span data-id="<?=$Total['id']?>" data-token="<?=$Total['token']?>" class="icon-remove excluD" style="cursor:pointer" >&nbsp;</span>
				<a href="/painel/arquivos/3D/<?=$Total['img']?>"><?=$Total['img']?></a>
                
            </div>
        </li>
	
    

    
	<?
	
    }

?>