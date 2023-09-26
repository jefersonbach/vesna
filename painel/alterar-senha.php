<? 
include('includes/topo.php');
$rProd = new conect();

if($_SERVER['HTTP_HOST'] == 'unik.dev:8888'){
    $Host = 'localhost';		//servidor
    $User = 'root';				//usuario
    $senha = 'qweasd';				//senha
    $banco = '4unik'; 
    $port = 8888;
    }else{
        $banco = 'unik_loja'; 			//nome do banco
        $Host = 'localhost';
        $User = 'unik_site';				//usuario
        $senha = '4Un1qu33';			//senha
        $port = 3306;
    }
		
		
 		$conn = mysqli_connect($Host, $User, $senha, $banco) or die(mysqli_error());
			mysqli_query($conn,"set names 'utf8'");
		mysqli_query($conn,"SET NAMES 'utf8'");
		mysqli_query($conn,'SET character_set_connection=utf8');
		mysqli_query($conn,'SET character_set_client=utf8');
		mysqli_query($conn,'SET character_set_results=utf8');



if(isset($_POST['alterar'])){
	$usu = $rProd->lista('usuarios','id = '.$_SESSION['id']); 
	if(md5($_POST['senhaA']) == $usu[0]['senha']){
		
		if($_POST['senhaN1'] == $_POST['senhaN2']){
			$edit = 'UPDATE usuarios SET senha = \''.md5($_POST['senhaN2']).'\' WHERE usuario = \''.$_SESSION['usuario'].'\';';
			$edit = mysqli_query($conn,$edit);
			if($edit){
				$editSenha = 'sim';
			}else{
				$editSenha = 'nao';
			}
		}else{
			$editSenha = 'dife';
		}
		
	}else{
		$editSenha = 'antigaE';
	}
}
?>

<script>
$(document).ready(function(){
	<?
if($editSenha == "sim"){?>Dialogo("sim", "Senha editada com sucesso!");<?
}elseif($editSenha == "nao"){ ?>Dialogo("nao", "Erro ao cadastrar senha!");<?
}elseif($editSenha == "dife"){?>Dialogo("nao", "As senhas estão diferentes. Tente novamente.");<?
}elseif($editSenha == "antigaE"){?>Dialogo("nao", "A senha antiga esta incorreta.");<? } 

?>
});
</script>
<div style="width:100%;">
    <div id="contentTitu">
        <h1>Alterar senha do usuário <strong style="text-transform:uppercase"><?=$_SESSION['usuario']?></strong></h1>
        <div class="controle">&nbsp;</div>
    </div>    
    <form method="post">
        <div class="contentCad">
            <div class="alignCenter">
                <label>
                    <strong>Senha Antiga</strong>
                    <input type="password" id="inputPassword" class="span5" name="senhaA" value="" />
                </label>
                <label>
                    <strong>Nova senha</strong>
                    <input type="password" id="inputPassword" class="span5" name="senhaN1" value="" />
                </label>
                <label>
                    <strong>Novamente</strong>
                    <input type="password" id="inputPassword" class="span5" name="senhaN2" value="" />
                </label>
            </div>
        </div>
        <div class="controle">&nbsp;</div>
        <div style="margin:20px 0 0; text-align:right">
            <div class="form-actions" style="margin-bottom:0 !important;">
                <input type="submit" class="btn btn-primary" value="Alterar Senha" name="alterar" />
                <a href="/painel/home.php"><button type="button" class="btn">Cancelar</button></a>
            </div>
        </div>
    </form>
</div>
<? include('includes/rodape.php') ?>   