<?
include('class.banco.php');
$resulSeo = new conect();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>
<div style="float:none; text-align:right; width:100%">
    <h2 style="color:#666; font-size:11px; margin:10px 0 0; padding:0; line-height:16px">Acompanhamento de </h2>
    <h1 style="color:#666; margin:0px 0 0; padding:0; line-height:25px; font-size:25px">Entrega</h1>
</div>
<div style="color:#fff">
<? if($_POST['id']){
			$ords['orders'][] = $_POST['id'];
    //print_r($ords);
    $asd = $resulSeo->acompanhaEntrega('www', $ords);
    
   //var_dump($asd);
    
		}
?>
    
    </div>