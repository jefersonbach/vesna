<?  session_start();
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


if($_SESSION['token'])
	{
		$token = $_SESSION['token'];
	}
	else
	{
		$token = $_SESSION['id_ficha'];
	}
	//echo "<li><a href='upload/img/".$Total['img']."'>".$token."</a> <span data-id='".$Total['id']."'></span></li>";
	echo $Sql = "SELECT * FROM casasimagens WHERE token = '".$token."' ORDER BY id DESC";
	//$Sql = "SELECT * FROM produtosimagens ORDER BY id DESC";
	$Query = mysqli_query( $conn, $Sql);
	print_r(mysqli_fetch_array( $Query));
	while($Total = mysqli_fetch_array( $Query))
	{?>
		<li style="text-align:center">
			<a href="/storage/<?=$_REQUEST['pag']?>/<?=$Total['img']?>" class="fancybox" style="text-align:center;min-height:140px; overflow: hidden; display: inline-block" title="<?=$Total['legenda']?>">
				<?
              	if(file_exists('../../arquivos/casas/'.str_replace('.','_150_113.',$Total['img'])) == TRUE){  
				?>
                	<img src="/painel/arquivos/casas/<?=str_replace('.','_150_113.',$Total['img'])?>" style="max-height:113px;margin:0 auto 5px" />
				<? }else{?>
					<img src="/painel/arquivos/casas/<?=$Total['img']?>" width="150" style="max-height:113px;margin:0 auto 5px" />
				<? } ?>
                    
                </a>
            <label style="display:block; width:100%;min-height:50px; text-align:center">
                <div style="text-align:center; margin:0 auto; display:inline-block">
                    
                    <input data-id="<?=$Total['id']?>" id="legenda" type="text" class="span2" style="margin:0 auto" value="<?=$Total['legenda']?>" />
                </div>
                <div class="controle">&nbsp;</div>
            </label>
            <div style="text-align:center; margin:0 auto; display:inline-block">
                <span data-id="<?=$Total['id']?>" data-token="<?=$Total['token']?>" class="icon-remove exclu" style="cursor:pointer" >&nbsp;</span>
                <span class="icon-star estrela <? if($Total['principal'] == '1'){echo 'starCel';}?>" data-id="<?=$Total['id']?>" style="cursor:pointer" id="estrela"></span>
				
				
            </div>
        </li>
	
    

    
	<?
	
    }
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.icon-star').click(function(){
		$('.icon-star').removeClass('starCel');
		$(this).toggleClass('starCel');
	});
	
	$('.icon-cod').click(function(){
		$('.icon-cod').removeClass('cadCel');
		$(this).toggleClass('cadCel');
	});
	
	
});
</script>