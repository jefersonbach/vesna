<?
session_start();

include('includes/class.banco.php');
$log = new connect();
$prods = $log->lista('seo','id = "1"');
if($_GET['sair'] && $_SESSION['usuario'] != ''){
	$_SESSION['usuario'] ='';
	$_SESSION['senha'] =''; 
}elseif($_POST['logar']){
	$_REQUEST['usuario'] = str_replace("'", "",$_REQUEST['usuario']);
	$_REQUEST['senha'] = str_replace("'", "",$_REQUEST['senha']);
	$_REQUEST['usuario'] = str_replace("\"", "",$_REQUEST['usuario']);
	$_REQUEST['senha'] = str_replace("\"", "",$_REQUEST['senha']);
	$loga = $log->lista('usuarios', "usuario = '".$_REQUEST['usuario']."' AND senha = MD5('".$_REQUEST['senha']."') AND ativo = 'Sim'");
	
	if($_REQUEST['usuario'] != "' or 1=1 or '" OR $_REQUEST['usuario'] != "'or 1=1 or'" OR $_REQUEST['usuario'] != "'or 1=1 or'"){
		if($loga != 'erro'){
			$lis='';
			$erro='';
			foreach($loga as $lis){
				$_SESSION['usuario'] = $lis['usuario'];
				//$_SESSION['nome'] = $lis['nome'];
				$_SESSION['senha'] = $lis['senha']; 
				$_SESSION['adm'] = $lis['adm'];
				$_SESSION['id'] = $lis['id'];
				
				if($_SESSION['usuario'] == 'emailmkt'){
					header("location: envio.php");
					//echo '2';
				
				}else{
					header("location: /painel/home.php");
				}
			}
		}else{
			$erro = 'Usuário ou senha errados';
		}
	}else{
		$erro = 'Vai tentando...';
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Painel de gerenciamento - <?=$prods[0]['empresa']?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="apple-touch-icon" href="/painel/assets/images/icon2.png" />
	<link rel="stylesheet" href="/painel/assets/css/base.css" type="text/css" />
	<link href="/painel/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<script src="/painel/assets/js/jquery-1.8.3.js"></script>
	<script src="/painel/includes/bootstrap/js/bootstrap.min.js"></script>
</head>

<body id="body">
	<h1>Painel de gerenciamento<br /><strong><?=$lis['empresa']?></strong></h1>
	<div id="formIndex">
    	<div class="center">
        	<h4 style="text-align:center; color:#920909"><?=$erro?></h4><br />
            <form class="form-horizontal" method="post">
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Login</label>
                    <div class="controls">
                        <input type="text" name="usuario" id="inputEmail">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Senha</label>
                    <div class="controls">
                        <input type="password" name="senha" id="inputPassword">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php /*?><label class="checkbox">
                            <input type="checkbox"> Remember me
                        </label><?php */?>
                        <input type="submit" name="logar" class="btn" value="logar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>