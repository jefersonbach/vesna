<div style="background:#eee; width:100%; height:270px; display:none" id="content"><?
include ('analycts/gapi.class.php');
$ga = new gapi('bakelitsul-145318@appspot.gserviceaccount.com','cert.p12');
include('class.banco.php');
$resulSeo = new conect();

	
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
	
	
$prods = $resulSeo->lista('produtos',"id = '".$_GET['prod']."'",'','', 'limit 1');
foreach($prods as $goog){
	$nomeProduto = explode(' ',$goog['nome']);
					$ref = strtolower($resulSeo->clean_url($nomeProduto[0]));
				unset($nomeProduto[0]);
				$nomeProduto = $resulSeo->clean_url(implode(' ',$nomeProduto));
	
	
	$fam = $resulSeo->lista('familias',"id = '".$goog['familia']."'",'','', 'limit 1');
	foreach($fam as $familia){
	

		}
	// Define o periodo do relatório
	$inicio = date('Y-m-01'); // 1° dia do mês passado
	$fim = date('Y-m-t'); // Último dia do mês passado
	
    $filter = 'pagePath=@/'.$familia['clean_url'].'/'.$nomeProduto.'/'.$_GET['prod'];
	
	
    $ga->requestReportData('104714041', 'month', array('pageviews', 'visits'), null, $filter, $inicio, $fim,1);
        foreach ($ga->getResults() as $dados) {
			?>
           <div style="float:left; width:50%; border-right:1px solid #fff; text-align:center;border-bottom:1px solid #ccc; padding:20px 0">
				<span>Mês</span>
				<h3 style="margin-top:0; padding-top:0; line-height:26px" id="<?=$_GET['prod']?>mes5"><?=$dados->getPageviews()?></h3>
			</div>
           <?
        }
	$ga->requestReportData('104714041', 'month', array('pageviews', 'visits'), null, $filter, date('Y-m-d'), date('Y-m-d'),1);
        foreach ($ga->getResults() as $dados) {
			?>
           <div style="float:left; text-align:center; width:49%; border-bottom:1px solid #ccc; padding:20px 0">
				<span>Hoje</span>
				<h3 style="margin-top:0; padding-top:0; line-height:26px"><?=$dados->getPageviews()?></h3>
			</div>
           <?
        }
	
	
	
		$prodsImg = $resulSeo->lista('produtosimagens','token = "'.$goog['token'].'" && (principal = "1" OR principal = "")');
		?>
	<div style="background:white; border-radius:60px; width:60px; height:60px; position:absolute; left:50%; bottom:230px; margin-left:-45px; text-align:center; padding:15px">
		<img src="<?=$resulSeo->crop('/painel/arquivos/produtos/'.$prodsImg[0]['img'],'150','113','far', true)?>" alt="<?=$lisImg['legenda']?>"  style="max-height:60px; max-width:60px" />
	</div>
 		


            <div style="background:white;height:160px; position:absolute; bottom:0; padding:8px 8px" >
            	<canvas id="canvas<?=$_GET['prod']?>" height="130" width="227px"></canvas>
            </div>
<?
	$inicio1 = date('Y-m-01', strtotime('-1 month')); // 1° dia do mês passado
	$fim1 = date('Y-m-t', strtotime('-1 month')); // Último dia do mês passado
	
    $filter = 'pagePath=@/'.$familia['clean_url'].'/'.$nomeProduto.'/'.$_GET['prod'];
	
	
    $ga->requestReportData('104714041', 'month', array('pageviews', 'visits'), null, $filter, $inicio1, $fim1,1);
        foreach ($ga->getResults() as $dados) {
			?>
            <div id="<?=$_GET['prod']?>mes4" >
            	<?=$dados->getPageviews()?>
            </div>
           <?
        }
	?>
        <?
	$inicio2 = date('Y-m-01', strtotime('-2 month')); // 1° dia do mês passado
	$fim2 = date('Y-m-t', strtotime('-2 month')); // Último dia do mês passado
	
    $filter = 'pagePath=@/'.$familia['clean_url'].'/'.$nomeProduto.'/'.$_GET['prod'];
	
	
    $ga->requestReportData('104714041', 'month', array('pageviews', 'visits'), null, $filter, $inicio2, $fim2,1);
        foreach ($ga->getResults() as $dados) {
			?>
            <div id="<?=$_GET['prod']?>mes3" >
            	<?=$dados->getPageviews()?>
            </div>
           <?
        }
	?>
        <?
	$inicio3 = date('Y-m-01', strtotime('-3 month')); // 1° dia do mês passado
	$fim3 = date('Y-m-t', strtotime('-3 month')); // Último dia do mês passado
	
    $filter = 'pagePath=@/'.$familia['clean_url'].'/'.$nomeProduto.'/'.$_GET['prod'];
	
	
    $ga->requestReportData('104714041', 'month', array('pageviews', 'visits'), null, $filter, $inicio3, $fim3,1);
        foreach ($ga->getResults() as $dados) {
			?>
            <div id="<?=$_GET['prod']?>mes2" >
            	<?=$dados->getPageviews()?>
            </div>
           <?
        }
	?>
        <?
	$inicio4 = date('Y-m-01', strtotime('-4 month')); // 1° dia do mês passado
	$fim4 = date('Y-m-t', strtotime('-4 month')); // Último dia do mês passado
	
    $filter = 'pagePath=@/'.$familia['clean_url'].'/'.$nomeProduto.'/'.$_GET['prod'];
	
	
    $ga->requestReportData('104714041', 'month', array('pageviews', 'visits'), null, $filter, $inicio4, $fim4,1);
        foreach ($ga->getResults() as $dados) {
			?>
            <div id="<?=$_GET['prod']?>mes1" >
            	<?=$dados->getPageviews()?>
            </div>
           <?
        }
	
	?>
         <div id="<?=$_GET['prod']?>nmes1" ><?=substr(strftime('%B', strtotime('-4 month')),0,3);?>.</div>
         <div id="<?=$_GET['prod']?>nmes2" ><?=substr(strftime('%B', strtotime('-3 month')),0,3);?>.</div>
         <div id="<?=$_GET['prod']?>nmes3" ><?=substr(strftime('%B', strtotime('-2 month')),0,3);?>.</div>
         <div id="<?=$_GET['prod']?>nmes4" ><?=substr(strftime('%B', strtotime('-1 month')),0,3);?>.</div>
         <div id="<?=$_GET['prod']?>nmes5" ><?=substr(strftime('%B', strtotime('today')),0,3);?>.</div>






<? } ?>
</div>