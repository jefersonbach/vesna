<?
ini_set('display_errors', 0);
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

require('phpThumb/phpthumb.class.php');
//require('phpqrcode/qrlib.php');
require("phpmailer/class.phpmailer.php");



function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    //$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $q );
}

function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    //$qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $q );
}

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  




function mandaEmail($para, $nomePara, $assunto, $mensagem){
	 	$mail             = new PHPMailer(true);
		$mail->CharSet    = 'UTF-8';
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->Host       = "smtp.agtp.com.br";
		$mail->Username   = "jeferson@agtp.com.br";
		$mail->Password   = "fF011235813";
		$mail->Port       = 587;
		$mail->SMTPDebug = false;
		
		$mail->From       = "jeferson@agtp.com.br";
		$mail->FromName   = "Vesna Partners";	
		
		$mail->MsgHTML($mensagem);
		$mail->Subject    = '=?UTF-8?B?'.base64_encode($assunto).'?=';
		$mail->AddAddress($para, $nomePara);
		
		return $mail->Send();
 	}





class connect extends phpThumb{
	function getConnection(){
		//echo $_SERVER['HTTP_HOST'];
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
		
			$conn = mysqli_connect($Host, $User, $senha, $banco, $port);
			mysqli_query($conn,"set names 'utf8'");
            mysqli_query($conn,"SET NAMES 'utf8'");
            mysqli_query($conn,'SET character_set_connection=utf8');
            mysqli_query($conn,'SET character_set_client=utf8');
            mysqli_query($conn,'SET character_set_results=utf8');
            mysqli_query($conn,'SET lc_time_names=pt_BR');
		
			return $conn;
        }
	
	
 	function conect(){	
		 //echo $_SERVER['HTTP_HOST'];
		 if(strpos($_SERVER['HTTP_HOST'], '.test') !== false) {
			$Host = 'localhost';		//servidor
			$User = 'root';				//usuario
			$senha = 'qweasd';				//senha
			$banco = 'vesna'; 
			$port = 3306;
		}else{
			//https://www.maisaposta.com:2083
			$banco = 'maisapos_vesna'; 			//nome do banco
				$Host = 'localhost';
				$User = 'maisapos_vesna';				//usuario
				$senha = 'MoMoney3434-';			//senha
				$port = 3306;
		}
		
 		$conn = mysqli_connect($Host, $User, $senha, $banco, $port) or die("Não foi possível a conexão com o Banco21!");
		
		mysqli_query($conn, "SET character_set_results=utf8");
		mb_language('uni'); 
		mb_internal_encoding('UTF-8');
		mysqli_select_db($conn, $banco);
		mysqli_query($conn, "set names 'utf8'");
		mysqli_query($conn, "SET NAMES 'utf8'");
		mysqli_query($conn, 'SET character_set_connection=utf8');
		mysqli_query($conn, 'SET character_set_client=utf8');
		mysqli_query($conn, 'SET character_set_results=utf8');
 	}
	
	function criaBanco($Host, $User, $senha = false){
		$pasta[3] = 'vesna';
		$conn = mysqli_connect($Host, $User, $senha) or die("Não foi possível a conexão com o Banco 2222222222222 - ".$pasta[3]." - ".$Host." - ".$User.' - '.$senha);
		
		//$db_selected = mysqli_select_db($this->getConnection(), $pasta[3]);
		
		if (!$db_selected){
			
			$sql = "CREATE DATABASE `".$banc."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
			mysqli_query($this->getConnection(), $sql);
			
			$db = mysqli_select_db($this->getConnection(), $pasta[3]) or die("Não foi possível selecionar o Banco ".$pasta[3]);
			
			$criaTable = "
				CREATE TABLE IF NOT EXISTS `usuarios` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`usuario` varchar(255),
					`senha` varchar(255),
					`adm` int(11),
					`ativo` varchar(255),
					PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=0";
			mysqli_query($this->getConnection(), $criaTable);
			
			$criaTable = "
				CREATE TABLE IF NOT EXISTS `seo` (
					`id` int(255) NOT NULL AUTO_INCREMENT,
					`empresa` varchar(255) DEFAULT NULL,
					`email` varchar(255) DEFAULT NULL,
					`telefone` varchar(255) DEFAULT NULL,
					`rua` varchar(255) DEFAULT NULL,
					`regiao` varchar(255) DEFAULT NULL,
					`es` varchar(255) DEFAULT NULL,
					`cidade` varchar(255) DEFAULT NULL,
					`description` varchar(255) DEFAULT NULL,
					`keywords` varchar(255) DEFAULT NULL,
					`abstract` varchar(255) DEFAULT NULL,
					`after` varchar(255) DEFAULT NULL,
					`pag` text NOT NULL,
					`bkp` varchar(255) DEFAULT NULL,
  					PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci AUTO_INCREMENT=0";
			mysqli_query($this->getConnection(), $criaTable);
			
			mysqli_query($this->getConnection(), "INSERT into `usuarios` (`usuario`, `senha`, `adm`, `ativo`) VALUES ('trump','".md5('qweasd')."', 1, 'Sim')");	
			mysqli_query($this->getConnection(), "INSERT into `seo` (`empresa`) VALUES ('".$pasta[3]."')");
			//mysqli_query("INSERT into `seo` (`pag`) VALUES ('produtos,banners,representantes')");
			
				
			return $pasta[3];
		}else{
			return $pasta[3];	
		}
 	}
	

	//setlocale(LC_ALL, 'en_US.UTF8');
function clean_url($str, $delimiter='-') {
	$clean = mb_strtolower(trim($str, '-'));
	$clean = str_replace(
		array(' ','ă','â','ä','á','à','ã','é','è','ê','ë','í','ì','î','ó','ò','õ','ô','ú','ù','ü','ç','"'),
		array('-','a','a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','u','u','u','c',''),
	$clean);
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}

	
	function maiuscula($string){
		return ucfirst($string);
		
	}




	function geraCaminho($id){
		$id = explode(',',$id);
		//foreach($id as $key => $cat){
			$sql = "SELECT * from categorias WHERE id = '".$id[0]."'";
			$query = mysqli_query($this->getConnection(), $sql) or die(mysqli_error($this->getConnection()));
			$row = mysqli_fetch_array($query);
			if($row['categoria']){
				$sql2 = "SELECT * from categorias WHERE id = '".$row['categoria']."'";
				$query2 = mysqli_query($this->getConnection(), $sql2) or die(mysqli_error($this->getConnection()));
				$row2 = mysqli_fetch_array($query2);
				$caminho = '/'.$row2['clean_url'].'/'.$row['clean_url'].'/';
			}else{
				$caminho = '/'.$row['clean_url'].'/';
			}
		//}
		return $caminho;
		
	}
	



	function url_exists($url) {

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
	
		return ($code == 200); // verifica se recebe "status OK"
	}
	


	function cp($d, $w, $h, $c, $pasta = 'false'){
		
		$ext = end(explode(".", $d));
		$nome = str_replace('.'.$ext,'',end(explode("/", $d)));
		$ds = str_replace(end(explode("/", $d)), '', $d);
		$caminho = explode('/',$d);
		if($pasta){
			$caminho = $caminho[1].'/'.$pasta;
		}else{
			$caminho = $caminho[1];
		}
		$output_filename = '../../storage/users/'.$caminho.'/'.$nome.'_'.$w.'_'.$h.'.'.$ext;
		if(file_exists('../../storage/users/'.$caminho.'/'.$nome.'_'.$w.'_'.$h.'.'.$ext) == false){
			//return 'CRIOU arquivos/'.$caminho[3].'/'.$nome.'_'.$w.'_'.$h.'.'.$ext;
			if(($c == 'ZC') || ($c == 'zc')){ $c = "zc"; }else{ $c = "far"; }
			$phpThumb = new phpThumb();
			$phpThumb->setSourceFilename($output_filename);
			$phpThumb->setParameter('w', $w);
			$phpThumb->setParameter('h', $h);
			$phpThumb->setParameter('f', $ext);
			$phpThumb->setParameter($c, 1);
			$phpThumb->setParameter('bg','FFFFFF');
			$phpThumb->setParameter('q', 100);
			if ($phpThumb->GenerateThumbnail()){
				if ($phpThumb->RenderToFile($output_filename)) {
					return $output_filename;
				}else{return var_dump($phpThumb->debugmessages);}
			}else{
				return $output_filename;
			}
		}else{
			return $output_filename;
		}
	}






	function crop($d, $w, $h, $c, $painel = 'false'){
		$ext = end(explode(".", $d));
		$nome = str_replace('.'.$ext,'',end(explode("/", $d)));
		$ds = str_replace(end(explode("/", $d)), '', $d);
		$output_filename = $ds.$nome.'_'.$w.'_'.$h.'.'.$ext;
		$caminho = explode('/',$d);
		
		if($painel == 'painel'){
			$painel = '';
		}else{
			$painel = 'painel/';
			}
		if(file_exists($painel.'arquivos/'.$caminho[3].'/'.$nome.'_'.$w.'_'.$h.'.'.$ext) == false){
			//return 'CRIOU arquivos/'.$caminho[3].'/'.$nome.'_'.$w.'_'.$h.'.'.$ext;
			if(($c == 'ZC') || ($c == 'zc')){ $c = "zc"; }else{ $c = "far"; }
			$phpThumb = new phpThumb();
			$phpThumb->setSourceFilename($d);
			$phpThumb->setParameter('w', $w);
			$phpThumb->setParameter('h', $h);
			$phpThumb->setParameter('f', $ext);
			$phpThumb->setParameter($c, 1);
			$phpThumb->setParameter('bg','FFFFFF');
			$phpThumb->setParameter('q', 100);
			if ($phpThumb->GenerateThumbnail()){
				if ($phpThumb->RenderToFile("../../../".$output_filename)) {
					return $output_filename;
				}else{return var_dump($phpThumb->debugmessages);}
			}else{
				return '/storage/none.png';
			}
		}else{
			return $output_filename;
		}
	}
	
		
	function validaCPF($cpf) {
 
		// Extrai somente os números
		$cpf = preg_replace( '/[^0-9]/is', '', $cpf );

		// Verifica se foi informado todos os digitos corretamente
		if (strlen($cpf) != 11) {
			return false;
		}

		// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}

		// Faz o calculo para validar o CPF
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				return false;
			}
		}
		return true;

	}

	
	
	
	
	function cropTexto($x, $length){
		  if(strlen($x)<=$length){
			return $x;
		  }else{
			$y=substr($x,0,$length) . '...';
			return $y;
		  }
		}
	
	
	
	
	function Show($table, $k){
		$query = ("SHOW COLUMNS FROM ".$table." LIKE ".$k);
		$result = mysqli_query($this->getConnection(), $query);
		//if($result){
			$rarray = mysqli_fetch_array($this->getConnection(), $result);
		//}
		return $rarray;
	}
	



	function cadastro($post, $table){
		$sql = "CREATE TABLE IF NOT EXISTS `".$table."` (`id` int(11) NOT NULL AUTO_INCREMENT,	PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci";
		$query = mysqli_query($this->getConnection(),$sql);
		if($post){
			if($post['id']){
				$editar = $post['id'];
				foreach ($post as $k => $v) {
					if($k != 'id'){
						$show = $this->Show($table, $k);
						if (NULL == $show[0]) {
							$sql = "ALTER TABLE ".$table." ADD COLUMN ".$k." VARCHAR(255)";
							mysqli_query($this->getConnection(), $sql);
						}
						$campos2 	.= "`".$k."` = '".addslashes($v)."', ";
					}
				}
			}else{
				foreach ($post as $k => $v) {
					if($k != 'id' and $k != 'files'){
						$show = $this->Show($table, $k);
						if (NULL == $show[0]) {
							$sql = "ALTER TABLE ".$table." ADD COLUMN ".$k." VARCHAR(255)";
							mysqli_query($this->getConnection(), $sql);
						}
						$campos 	.= "`".$k."`, ";
						$valores 	.= "'".addslashes($v)."', ";
						$editar		 = '';
					}else{
						foreach ($post as $k => $v) {
							if($k != 'id'){
								$campos2 	.= "`".$k."` = '".addslashes($v)."', ";
							}
						}
							
					}
				}
			}
			$campos = substr($campos, 0 , -2);
			$campos2 = substr($campos2, 0 , -2);
			$valores = substr($valores, 0 , -2);
			
			if($editar){
				echo $edit = 'UPDATE '.$table.' SET '.$campos2.' WHERE id ='.$editar.';';
				$edit = mysqli_query($this->getConnection(), $edit);
				if($edit){
					$result = $this->lista($table,'','','',' limit 1');
					return $result;
				}else{
					return 'naoe2';
				}
			}else{
				echo $insert = 'INSERT INTO '.$table.' ('.$campos.') VALUES ('.$valores.');';
				$insert = mysqli_query($this->getConnection(), $insert);
				if($insert){
					$result = $this->lista($table,'','','',' limit 1');
					return $result;
				}else{
					return 'naoasd';
				}
			}
		}
	}







	function cadastros($post, $table){
		$sql = "CREATE TABLE IF NOT EXISTS `".$table."` (`id` int(11) NOT NULL AUTO_INCREMENT,	PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci";
		$query = mysqli_query($this->getConnection(),$sql);
		if($post){
			
				if($post['id'])
				{
					$editar = $post['id'];
					
					foreach ($post as $k => $v) {
						if($k != 'id'){
							$show = $this->Show($table, $k);
							
							if (NULL == $show[0]) {
								$sql = "ALTER TABLE ".$table." ADD COLUMN ".$k." VARCHAR(255)";
								mysqli_query($this->getConnection(), $sql);
							}
							
							$campos2 	.= "`".$k."` = '".addslashes($v)."', ";
						}
					}
				}
				else
				{
					foreach ($post as $k => $v) {
				
						if($k != 'id' and $k != 'files'){
							$show = $this->Show($table, $k);
							
							if (NULL == $show[0]) {
								$sql = "ALTER TABLE ".$table." ADD COLUMN ".$k." VARCHAR(255)";
								mysqli_query($this->getConnection(), $sql);
							}
							$campos 	.= "`".$k."`, ";
							$valores 	.= "'".addslashes($v)."', ";
							$editar		 = '';
							
						}else{
							
							foreach ($post as $k => $v) {
								if($k != 'id'){
									$campos2 	.= "`".$k."` = '".addslashes($v)."', ";
								}
							}
							
						}
					}
				}
			$campos = substr($campos, 0 , -2);
			$campos2 = substr($campos2, 0 , -2);
			$valores = substr($valores, 0 , -2);
			
			if($editar){
				$edit = 'UPDATE '.$table.' SET '.$campos2.' WHERE id ='.$editar.';';
				$edit = mysqli_query($this->getConnection(), $edit);
				if($edit){
					return 'sime';
				}else{
					return 'naoe';
					}
			}else{
				$insert = 'INSERT INTO '.$table.' ('.$campos.') VALUES ('.$valores.');';
				$insert = mysqli_query($this->getConnection(), $insert);
				if($insert){
					return 'sim';
				}else{
					return 'nao';
				}
			}
		}
	}
	
	/**
	 * @Listagem Mysql
	 */
	function lista($table, $id = false, $val = false, $ordem = false, $lim = false, $coluns = false){
		$list = '';
		if($coluns){ $coluns = $coluns; }else{ $coluns = "*"; }
		if($ordem){ $ordem = $ordem; }else{ $ordem = "id DESC"; }
		if($val)
		{
			$sql = "";
			$i = 0;
			foreach($val as $ba)
			{
				if($i == 0)
				{
					$sql = "(SELECT ".$coluns." from ".$table." WHERE ".$ba." LIKE '%".$id."%' order BY ".$ordem.")";
				}
				else
				{
					$sql .= "UNION DISTINCT (SELECT * from ".$table." WHERE ".$ba." LIKE '%".$id."%')";
				}
				$i++;
			}
		}
		else
		{
			if($id){
				$sql = "SELECT ".$coluns." from ".$table." WHERE ".$id." order BY ".$ordem." ".$lim."";
			}else{
				$sql = "SELECT ".$coluns." from ".$table." order BY ".$ordem."".$lim."";
			}	
		}
		
		
		
		$query = mysqli_query($this->getConnection(), $sql) or die(mysqli_error($this->getConnection()));
		
		$numer = mysqli_num_rows($query);
		
		if($numer > 0){
			$list = array();
			while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
				$teste = array();
				foreach($row as $pos => $val){
						 $teste[$pos] = $val;
				}
				$list[] = $teste;
			}
			return $list;
		}else{
			return 'erro';
		}
	}
	
	
        
	function conta($table, $id = false, $val = false, $ordem = false, $lim = false){
		$list = '';
		if($ordem){ $ordem = $ordem; }else{ $ordem = "id DESC"; }
		if($val){
			$sql = "";
			$i = 0;
			foreach($val as $ba){
				if($i == 0){
					$sql = "(SELECT * from ".$table." WHERE ".$ba." LIKE '%".$id."%' order BY ".$ordem.")";
				}else{
					$sql .= "UNION DISTINCT (SELECT * from ".$table." WHERE ".$ba." LIKE '%".$id."%')";
				}
				$i++;
			}
		}else{
			if($id){
				$sql = "SELECT count(id) as total from ".$table." WHERE ".$id."";
			}else{
				$sql = "SELECT count(id) as total from ".$table." order BY ".$ordem."".$lim."";
			}	
		}
		$numer = mysqli_query($this->getConnection(), $sql);
		$numer = mysqli_fetch_assoc($numer);
		//print_r($numer);
		//if($numer['num_rows'] > 0){
			return $numer['total'];
		//}else{
			//return '0';
		//}
	}
        
        
        
        
        
        
        
        
        
        
	
	
	function listaDebug($table, $id = false, $val = false, $ordem = false, $lim = false){
		$list = '';
		if($ordem){ $ordem = $ordem; }else{ $ordem = "id DESC"; }
		if($val)
		{
			$sql = "";
			$i = 0;
			foreach($val as $ba)
			{
				if($i == 0)
				{
					$sql = "(SELECT * from ".$table." WHERE ".$ba." LIKE '%".$id."%' order BY ".$ordem.")";
				}
				else
				{
					$sql .= "UNION DISTINCT (SELECT * from ".$table." WHERE ".$ba." LIKE '%".$id."%')";
				}
				$i++;
			}
		}else{
			if($id){
				echo $sql = "SELECT * from ".$table." WHERE ".$id." order BY ".$ordem." ".$lim."";
			}else{
				echo $sql = "SELECT * from ".$table." order BY ".$ordem."".$lim."";
			}	
		}
		
		$query = mysqli_query($this->getConnection(),$sql);
		$numer = mysqli_num_rows($query);
		
		if($numer > 0){
			$list = array();
			while($row = mysqli_fetch_array($query)){
				$teste = array();
				foreach($row as $pos => $val){
						 $teste[$pos] = $val;
				}
				$list[] = $teste;
			}
			return $list;
		}else{
			return false;
		}
	}
	
	
	
	
	
	
	
	/**
	 * @Deletar Mysql
	 */
	function deleta($excluir, $table){
		if($excluir && $table){
			
			
			
			
			
			 $sql = "SELECT * from ".$table." WHERE id = '".$excluir."'";
			$img = mysqli_query($this->getConnection(),$sql);
			$total = mysqli_fetch_assoc($img);
			
			if($table == 'produtos'){
				unlink('../../pdfs/'.$total['clean_url']);
			}
			$sql = "SELECT * from ".$table."imagens WHERE token = '".$total['token']."'";
			$imgt = mysqli_query($this->getConnection(), $sql);
			while($totalimg = mysqli_fetch_array($this->getConnection(),$imgt)){
				 unlink('arquivos/'.$table.'/'.$totalimg['img']);
				 $tb = substr($totalimg['img'],0,32);
				 $tbext = substr($totalimg['img'],-4,4);
				 
				  $aa = scandir('arquivos/'.$table.'/');
				foreach($aa as $lis){
					if(strripos($lis,$tb) === 0){
						//echo strripos($lis,'417a854c976d6e7904bc93fab869b9d3').' - Exclui<br />';	
						
						unlink('arquivos/'.$table.'/'.$lis);
						
					}
				}
				}
			
			
			
			//$edit = "DELETE from ".$table."imagens WHERE token = '".$excluir."'";
			//$edit = mysql_query($edit);
			
			$edit = "DELETE from ".$table." WHERE id = '".$excluir."'";
			$edit = mysqli_query($this->getConnection(),$edit);
			
			
			if($edit){
				return 'sim';
			}else{
				return 'nao';
			}
		}
	}
	
	/**
	 * @Lista de categorias Mysql
	 */
	function listaCategorias($id){
		$list = '';
		if($id){
			$sql = "SELECT * from categorias WHERE id = '".$id."'";
		}else{
			$sql = "SELECT * from categorias";
		}	
		$query = mysql_query($sql);
		echo '<ul class="listCat">';
		while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
			if($row['pai'] == '')
				{
					if($_GET['par1'] == str_replace(' ', '-', $row['nome'])){$display = 'block'; $cla = 'bg';}else{$display = 'none'; $cla = '';}
			echo "<li ><a class=\"tit ".$cla."\" id=\"".$row['id']."\">".$row['nome']."</a>";
			
				$SqlSub = "SELECT * FROM categorias WHERE pai = '".$row['id']."'";
				$QuerySub = mysql_query($SqlSub);
				$NumerSub = mysql_num_rows($QuerySub);
				
				if($NumerSub > 0)
				{
					echo "<ul style=\"list-style:none; margin:0; padding:0;display:".$display." !important\" class=\"".$row['id']."\">";
					while($TotalSub = mysql_fetch_array($QuerySub))
					{
						$pai = str_replace(' ', '-', $row['nome']);
						$filho = str_replace(' ', '-', $TotalSub['nome']);
						echo "<li><a class=\"inner\" href=\"/produtos/".$pai."/".$filho."\">".$TotalSub['nome']."</a>";
						
						
						
						$SqlSubS = "SELECT * FROM categorias WHERE pai = '".$TotalSub['id']."'";
							$QuerySubS = mysql_query($SqlSubS);
							$NumerSubS = mysql_num_rows($QuerySubS);
							if($NumerSubS > 0)
							{
								echo "<ul style=\"list-style:none; margin:0; padding:0;display:".$display." !important\" class=\"".$row['id']."\">";
								while($TotalSubS = mysql_fetch_array($QuerySubS))
								{
									$pai = str_replace(' ', '-', $row['nome']);
									$filho = str_replace(' ', '-', $TotalSubS['nome']);
									echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class=\"inner\" href=\"/produtos/".$pai."/".$filho."\">".$TotalSubS['nome']."</a></li>";
								}
								echo "</ul>";
							}
						
						
						echo "</li>";
						
					}
					echo "</ul>";
				}
			
			echo "</li>";
				}
		}
		echo '</ul>';
		
	}
        
        
    
    
    
    
    
    
    
    
    
function consultaCielo($id){
             $curl = curl_init();
		

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://apiquery.cieloecommerce.cielo.com.br/1/sales/".$id,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "MerchantId: b93c1a12-823b-4d1b-ae55-fe62b6fbff5c",
                "MerchantKey: 0h4U4ubkGTNeDM9IhjuhuSNnUVjYiJbZDoBMm1se"
              ),
            ));

            $response = curl_exec($curl);

                    //echo $response;
            $responses =  json_decode($response, true);


            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {



                     return $responses;
            }
         
         
}

    
    
    
    
    
    
    
    
    
    
    
    function acompanhaEntrega($sandbox, $id){
             $ss = $this->lista('seo', "id = 1");
             $curl = curl_init();
                             
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://".$sandbox.".melhorenvio.com.br/api/v2/me/shipment/tracking",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS => json_encode($id),
                              CURLOPT_HTTPHEADER => array(
                                "Accept: application/json",
                                "Content-Type: application/json",
                                "Authorization: Bearer ".$ss[0]['access_token']
                              ),
                            ));

                            $responsess = curl_exec($curl);
                            $err = curl_error($curl);

                        curl_close($curl);



                            if ($err) {
                              echo "cURL Error #:" . $err;
                            } else {

                                return json_decode($responsess, true);
                            }
             
         }
    
    
    
    
    
    
    
        
        function addFreteCarrinho($postss, $sandbox){
             $ss = $this->lista('seo', "id = 1");
             $curl = curl_init();
			
                             
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://".$sandbox.".melhorenvio.com.br/api/v2/me/cart",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS => $postss,
                              CURLOPT_HTTPHEADER => array(
                                "Accept: application/json",
                                "Content-Type: application/json",
                                "Authorization: Bearer ".$ss[0]['access_token']
                              ),
                            ));

                            $responsess = curl_exec($curl);
                            $err = curl_error($curl);

                        curl_close($curl);


                            if ($err) {
                              return "cURL Error #:" . $err;
                            } else {

                                return json_decode($responsess, true);
                            }
             
         }
        
        
        function listaLojasFrete($sandbox){
             $ss = $this->lista('seo', "id = 1");
             $curl = curl_init();
                             
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://".$sandbox.".melhorenvio.com.br/api/v2/me/companies",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "GET",
                              CURLOPT_HTTPHEADER => array(
                                "Accept: application/json",
                                "Content-Type: application/json",
                                "Authorization: Bearer ".$ss[0]['access_token']
                              ),
                            ));

                            $responsess = curl_exec($curl);
                            $err = curl_error($curl);

                        curl_close($curl);



                            if ($err) {
                              echo "cURL Error #:" . $err;
                            } else {

                                return json_decode($responsess, true);
                            }
             
         }
        
        
        function listaInfoLojasFrete($id, $sandbox){
             $ss = $this->lista('seo', "id = 1");
             $curl = curl_init();
                             
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://".$sandbox.".melhorenvio.com.br/api/v2/me/companies/".$id."/addresses",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "GET",
                              CURLOPT_HTTPHEADER => array(
                                "Accept: application/json",
                                "Content-Type: application/json",
                                "Authorization: Bearer ".$ss[0]['access_token']
                              ),
                            ));

                            $responsess = curl_exec($curl);
                            $err = curl_error($curl);

                        curl_close($curl);



                            if ($err) {
                              echo "cURL Error #:" . $err;
                            } else {

                                return json_decode($responsess, true);
                            }
             
         }
        
         
         
         
         function cadastraLojasFrete($nome, $email, $description, $company_name, $document ,$state_register , $sandbox){
             $ss = $this->lista('seo', "id = 1");
             $curl = curl_init();
             
             
             $postss = "{\n    \"name\": \"".$nome."\"',\n    \"email\": ".$email.",\n    \"description\": ".$description.",\n    \"company_name\": ".$company_name.",\n    \"document\": ".$document.",\n    \"state_register\": ".$state_register."\n}";
             
             
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://".$sandbox.".melhorenvio.com.br/api/v2/me/companies",
                             CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS =>"{\n    \"name\": \"".$nome."\",\n    \"email\": \"".$email."\",\n    \"description\": \"".$description."\",\n    \"company_name\": \"Nome da Loja\",\n    \"document\": \"89.157.108/0001-04\",\n    \"state_register\": \"476.210.979.481\"\n}",
                              CURLOPT_HTTPHEADER => array(
                                "Accept: application/json",
                                "Content-Type: application/json",
                                "Authorization: Bearer ".$ss[0]['access_token']
                              ),
                            ));

                            $responsess = curl_exec($curl);
                            $err = curl_error($curl);

                        curl_close($curl);



                            if ($err) {
                              echo "cURL Error #:" . $err;
                            } else {

                                return json_decode($responsess, true);
                            }
             
         }
         
         
         
         function cadastraEnderecoLojasFrete($id, $cep, $rua, $numero, $complemento ,$cidade, $estado , $sandbox){
             $ss = $this->lista('seo', "id = 1");
             $curl = curl_init();
             
             
             $postss = "{\n    \"postal_code\": \"".str_replace('-','',$cep)."\",\n    \"address\": \"".$rua."\",\n    \"number\": \"".$numero."\",\n    \"complement\": \"".$complemento."\",\n    \"city\": \"".$cidade."\",\n    \"state\": \"".$estado."\"\n}";
             
             
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://".$sandbox.".melhorenvio.com.br/api/v2/me/companies/".$id."/addresses",
                             CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS => "{\n    \"postal_code\": \"".str_replace('-','',$cep)."\",\n    \"address\": \"".$rua."\",\n    \"number\": \"".$numero."\",\n    \"complement\": \"".$complemento."\",\n    \"city\": \"".$cidade."\",\n    \"state\": \"".$estado."\"\n}",
                              CURLOPT_HTTPHEADER => array(
                                "Accept: application/json",
                                "Content-Type: application/json",
                                "Authorization: Bearer ".$ss[0]['access_token']
                              ),
                            ));

                            $responsess = curl_exec($curl);
                            $err = curl_error($curl);

                        curl_close($curl);



                            if ($err) {
                              echo "cURL Error #:" . $err;
                            } else {

                                return json_decode($responsess, true);
                            }
             
         }
         
         
         
         
         
         function autenticaBoy(){
             
            $cht = curl_init();
            
             $userBoy = utf8_encode('teste-api@motoboy.com');  //$userBoy = utf8_encode('jenifer@veredars.com.br');
            curl_setopt($cht, CURLOPT_URL, "https://www.motoboy.com/apiV1/login?username=".$userBoy."&apiKey=eJNQ6DPGKFr521zwshtNxntVembCJ2qu");
            curl_setopt($cht, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($cht, CURLOPT_HEADER, FALSE);
            curl_setopt($cht, CURLOPT_POST, TRUE);
            curl_setopt($cht, CURLOPT_COOKIESESSION, true);
            curl_setopt($cht, CURLOPT_COOKIEJAR, 'motoboyt');  //could be empty, but cause problems on some hosts
            curl_setopt($cht, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp');

            $response = curl_exec($cht);

            return $response;
         }
        
        
         
         
         function orcaBoy($cidade, $cepOrigem, $cepDestino){
             
             $cidade = utf8_encode($cidade);
             $cepOrigem = utf8_encode($cepOrigem);
             $cepDestino = utf8_encode($cepDestino);
             
             
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://www.motoboy.com/apiV1/orcamento?cidade=".$cidade."&endereco1_cep=".$cepOrigem."&endereco2_cep=".$cepDestino);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            $response = curl_exec($ch);
            curl_close($ch);

            return json_decode($response, true);
             
             
             
         }
         
         
         
         
         
         function chamaBoy($cidade, $cepOrigem, $ruaOrigem, $numeroOrigem, $complementoOrigem = false, $nomeOrigem = false, $telefoneOrigem = false, $cepDestino, $ruaDestino, $numeroDestino, $complementoDestino = false, $nomeDestino = false, $telefoneDestino = false){
             
             

//exit;
             
             //if($auth['success'] == '1'){
             
                $ss = $this->lista('seo', "id = 1");




                $cidade = $cidade;
                $forma_pagamento = 'DINHEIRO';
                $momento_cobranca = 'COLETA';
                $necessidade_entrega= 'IMEDIATO';
                $datahora_agendamento = '';
                $endereco1_cep = str_replace('-','',$cepOrigem);
                $endereco1_rua = urlencode($ruaOrigem);
                $endereco1_numero = $numeroOrigem;
                $endereco1_complemento = urlencode($complementoOrigem);
                $endereco1_nome = urlencode($nomeOrigem);
                $endereco1_telefone = urlencode($telefoneOrigem);
                $endereco1_comentario = '';
                $endereco2_cep = str_replace('-','',$cepDestino);
                $endereco2_rua = urlencode($ruaDestino);
                $endereco2_numero = urlencode($numeroDestino);
                $endereco2_complemento = urlencode($complementoDestino);
                $endereco2_nome = urlencode($nomeDestino);
                $endereco2_telefone = urlencode($telefoneDestino);



           $url = "https://www.motoboy.com/apiV1/confirmarPedido?cidade=".$cidade."&forma_pagamento=".$forma_pagamento."&momento_cobranca=".$momento_cobranca."&necessidade_entrega=".$necessidade_entrega."&endereco1_cep=".$endereco1_cep."&endereco1_rua=".$endereco1_rua."&endereco1_numero=".$endereco1_numero."&endereco1_complemento=".$endereco1_complemento."&endereco1_nome=".$endereco1_nome."&endereco1_telefone=".$endereco1_telefone."&endereco2_cep=".$endereco2_cep."&endereco2_rua=".$endereco2_rua."&endereco2_numero=".$endereco2_numero."&endereco2_complemento=".$endereco2_complemento."&endereco2_nome=".$endereco2_nome."&endereco2_telefone=".$momento_telefone;

              
            
            //curl_close($ch);

            $ch = curl_init();
            
             $userBoy = utf8_encode('teste-api@motoboy.com');  //$userBoy = utf8_encode('jenifer@veredars.com.br');
            curl_setopt($ch, CURLOPT_URL, "https://www.motoboy.com/apiV1/login?username=".$userBoy."&apiKey=eJNQ6DPGKFr521zwshtNxntVembCJ2qu");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_COOKIESESSION, true);
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'motoboyt');  //could be empty, but cause problems on some hosts
            curl_setopt($ch, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp');

            $response = curl_exec($ch);
             
             
            $auth = json_decode($response, true);
             echo $auth['success'];
           //if($auth['success'] == '1'){
            //$ch = curl_init();

             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
             curl_setopt($ch, CURLOPT_HEADER, FALSE);

             curl_setopt($ch, CURLOPT_POST, TRUE);

             $response2 = curl_exec($ch);
             curl_close($ch);

             return json_decode($response2, true);

             //}
             
             
             
             
             
         }
         
         







function consultaBoy($ids){
             $ch = curl_init();
            
             $userBoy = utf8_encode('teste-api@motoboy.com');  //$userBoy = utf8_encode('jenifer@veredars.com.br');
            curl_setopt($ch, CURLOPT_URL, "https://www.motoboy.com/apiV1/login?username=".$userBoy."&apiKey=eJNQ6DPGKFr521zwshtNxntVembCJ2qu");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_COOKIESESSION, true);
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'motoboyt');  //could be empty, but cause problems on some hosts
            curl_setopt($ch, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp');

            $response = curl_exec($ch);
            

curl_setopt($ch, CURLOPT_URL, "https://www.motoboy.com/apiV1/detalhesPedido?entrega=".$ids);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

$response2 = curl_exec($ch);
curl_close($ch);

//var_dump($response2);

             return json_decode($response2, true);

             //}
             
             
             
             
             
         
         
         
}



function cancelaBoy($ids){
            $cht = curl_init();
            
             $userBoy = utf8_encode('teste-api@motoboy.com');  //$userBoy = utf8_encode('jenifer@veredars.com.br');
            curl_setopt($cht, CURLOPT_URL, "https://www.motoboy.com/apiV1/login?username=".$userBoy."&apiKey=eJNQ6DPGKFr521zwshtNxntVembCJ2qu");
            curl_setopt($cht, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($cht, CURLOPT_HEADER, FALSE);
            curl_setopt($cht, CURLOPT_POST, TRUE);
            curl_setopt($cht, CURLOPT_COOKIESESSION, true);
            curl_setopt($cht, CURLOPT_COOKIEJAR, 'motoboyt');  //could be empty, but cause problems on some hosts
            curl_setopt($cht, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp');

            $response = curl_exec($cht);
            
            
curl_setopt($cht, CURLOPT_URL, "https://www.motoboy.com/apiV1/alterarPedido?entrega=".$ids."&tipo=CANCELAR");
curl_setopt($cht, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($cht, CURLOPT_HEADER, FALSE);

curl_setopt($cht, CURLOPT_POST, TRUE);

$response2 = curl_exec($cht);
curl_close($cht);

//var_dump($response2);

             return json_decode($response2, true);

             //}
             
             
             
             
             
         
         
         
}




		function atualizaBoy($ids){
            $cht = curl_init();
            
             $userBoy = utf8_encode('teste-api@motoboy.com');  //$userBoy = utf8_encode('jenifer@veredars.com.br');
            curl_setopt($cht, CURLOPT_URL, "https://www.motoboy.com/apiV1/login?username=".$userBoy."&apiKey=eJNQ6DPGKFr521zwshtNxntVembCJ2qu");
            curl_setopt($cht, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($cht, CURLOPT_HEADER, FALSE);
            curl_setopt($cht, CURLOPT_POST, TRUE);
            curl_setopt($cht, CURLOPT_COOKIESESSION, true);
            curl_setopt($cht, CURLOPT_COOKIEJAR, 'motoboyt');  //could be empty, but cause problems on some hosts
            curl_setopt($cht, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp');

            $response = curl_exec($cht);
            
            
			curl_setopt($cht, CURLOPT_URL, "https://www.motoboy.com/apiV1/alterarPedido?entrega=".$ids."&tipo=TESTE_ROTACIONAR_STATUS");
curl_setopt($cht, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($cht, CURLOPT_HEADER, FALSE);

curl_setopt($cht, CURLOPT_POST, TRUE);

$response2 = curl_exec($cht);
curl_close($cht);

//var_dump($response2);

             return json_decode($response2, true);

             //}
             
             
             
             
             
         
         
         
}

function listaBoy(){
                 $cht = curl_init();
            
             $userBoy = utf8_encode('teste-api@motoboy.com');  //$userBoy = utf8_encode('jenifer@veredars.com.br');
            curl_setopt($cht, CURLOPT_URL, "https://www.motoboy.com/apiV1/login?username=".$userBoy."&apiKey=eJNQ6DPGKFr521zwshtNxntVembCJ2qu");
            curl_setopt($cht, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($cht, CURLOPT_HEADER, FALSE);
            curl_setopt($cht, CURLOPT_POST, TRUE);
            curl_setopt($cht, CURLOPT_COOKIESESSION, true);
            curl_setopt($cht, CURLOPT_COOKIEJAR, 'motoboyt');  //could be empty, but cause problems on some hosts
            curl_setopt($cht, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp');

            $response = curl_exec($cht);
            
            curl_setopt($cht, CURLOPT_URL, "https://www.motoboy.com/apiV1/listarPedidos?offset=0");
            curl_setopt($cht, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($cht, CURLOPT_HEADER, FALSE);
            curl_setopt($cht, CURLOPT_POST, TRUE);
            curl_setopt($cht, CURLOPT_COOKIESESSION, true);
            curl_setopt($cht, CURLOPT_COOKIEJAR, 'motoboyt');  //could be empty, but cause problems on some hosts
            curl_setopt($cht, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp');

            $response = curl_exec($cht);
            
            
            


             return json_decode($response, true);

             //}
             
             
             
             
             
         
         
         
}


    

    
    


}