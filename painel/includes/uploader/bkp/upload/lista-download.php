<?
include('../../includes/class.banco.php');
$imgg = new conect();
session_start();
	if($_SESSION['token'])
	{
		$token = $_SESSION['token'];
	}
	else
	{
		$token = $_SESSION['id_ficha'];
	}
	//echo "<li><a href='upload/img/".$Total['img']."'>".$_SESSION['token']."</a> <span data-id='".$Total['id']."'></span></li>";
	$Sql = "SELECT * FROM ".$_SESSION['pagina']."imagens WHERE token = '".$token."' ORDER BY id DESC";
	//$Sql = "SELECT * FROM produtosimagens ORDER BY id DESC";
	$Query = mysql_query($Sql);
	while($Total = mysql_fetch_array($Query))
	{?>
		<li style="text-align:center">
        	<label style="display:block; width:100%;min-height:190px; text-align:center; margin-top:3px">
            	<div style="text-align:center;min-height:150px;">
                	<a href="/painel/arquivos/<?=$_SESSION['pagina']?>/<?=$Total['img']?>" class="fancybox" rel="Imoveis"><img src="includes/phpThumb/phpThumb.php?src=/painel/arquivos/<?=$_SESSION['pagina']?>/<?=$Total['img']?>&w=150&h=153&zc=1" style=" margin:0 auto 8px" /></a>
                </div>
                <div style="text-align:center; margin:0 auto; display:inline-block">
            		<input data-id="<?=$Total['id']?>" id="legenda" type="text" class="span2" style="margin:0 auto" placeholder="Legenda" value="<?=$Total['legenda']?>" />
                </div>
                <div class="controle">&nbsp;</div>
            </label>
            <div style="text-align:center; margin:0 auto; display:inline-block">
                <span class="icon-star estrela <? if($Total['principal']){echo 'starCel';}?>" data-id="<?=$Total['id']?>" style="cursor:pointer" id="estrela"></span>
                <span data-id="<?=$Total['id']?>" class="icon-remove exclu" style="cursor:pointer" >&nbsp;</span>
            </div>
        </li>
	
    

    
	<?
	
    }

/*
if($_SESSION['token']){
	$Sql = "SELECT * FROM produtosimagens WHERE token = '".$_SESSION['token']."' ORDER BY id DESC";
	//$Sql = "SELECT * FROM produtosimagens ORDER BY id DESC";
	$Query = mysql_query($Sql);
	while($Total = mysql_fetch_array($Query))
	{
		echo "<li><a href='upload/img/".$Total['img']."'>".$Total['img']."</a> <span data-id='".$Total['id']."'></span></li>";
	}

	
}else{
	$Sql = "SELECT * FROM produtosimagens WHERE token = '".$_SESSION['id_ficha']."' ORDER BY id DESC";
	//$Sql = "SELECT * FROM produtosimagens ORDER BY id DESC";
	$Query = mysql_query($Sql);
	while($Total = mysql_fetch_array($Query))
	{
		echo "<li><a href='upload/img/".$Total['img']."'>".$Total['img']."</a> <span data-id='".$Total['id']."'></span></li>";
	}
}
*/
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.icon-star').click(function(){
		$('.icon-star').removeClass('starCel');
		$(this).toggleClass('starCel');
		});
});
</script>