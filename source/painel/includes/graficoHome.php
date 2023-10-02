<?
include ('analycts/gapi.class.php');
$ga = new gapi('pain-622@unik-302819.iam.gserviceaccount.com','cert.p12');

//header("Content-Type: application/json");
//setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
//date_default_timezone_set('America/Sao_Paulo');


$ga = new gapi('pain-622@unik-302819.iam.gserviceaccount.com','/cert.p12');


	

	
	$inicio = date('Y-m-01', strtotime('-1 month')); // 1° dia do mês passado
	$fim = date('Y-m-d', strtotime('-1 month')); // Último dia do mês passado
	
    $filter = 'medium==organic';
	
	

	 $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio, $fim,1);

        foreach ($ga->getResults() as $dados) {
			$mesAnt = $dados->getVisits();
        }
	
	
	// Define o periodo do relatório
	$inicio = date('Y-m-01'); // 1° dia do mês passado
	$fim = date('Y-m-t'); // Último dia do mês passado
	
    $filter = 'medium==organic';
	
	
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio, $fim,1);
        foreach ($ga->getResults() as $dados) {
			$mesAtu = $dados->getVisits();
        }
	?>
	<div style="float:left; width:50%; border-right:1px solid #fff; text-align:center;border-bottom:1px solid #ccc; padding:0 0px 20px; background: rgb(34,185,255,0.2) url(/painel/images/organicBg.png) 10px 60px no-repeat">
		<div style="padding:15px; background:; border-bottom:1px solid #e1e1e1;">
			Calculando do dia 1 até <?=date('d')?>
		</div>
		<h2 style="opacity:0.9; margin-top:40px">Acessos Orgânicos</h2>
		<div style="float:left; width:45%; text-align: right">
			<span style="opacity:0.5; font-size:11px">Mês passado</span>
			<h3 style="margin:0 0 20px 0; padding-top:0; line-height:16px; opacity:0.5; font-size:16px"><?=number_format($mesAnt, -3, '.', '.')?></h3>
		</div>
		<div style="float:right; width:45%; text-align: left">
			<span>Este Mês</span>
			<h3 style="margin-top:0; padding-top:0; line-height:26px" id="mes5"><?=number_format($mesAtu, -3, '.', '.')?></h3>
		</div>		
		<div class="controle">&nbsp;</div>
	</div>
	<div style="float:left; text-align:center; width:49%; border-bottom:1px solid #ccc; padding:20px 0">
	<?
			$filter = '';
			$ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, date('Y-m-d'), date('Y-m-d'),1);
				foreach ($ga->getResults() as $dados) {
			?>
           <div style=" margin: 31px 45px; text-align: left"><h2 style="opacity:0.9">Hoje - <?=number_format($dados->getVisits(), -3, '.', '.')?> Acessos</h2></div>
				
           <?  } ?>
		
			<?
			$filter = 'medium==organic';
			$ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, date('Y-m-d'), date('Y-m-d'),1);
				foreach ($ga->getResults() as $dados) {
			?>
           
			   	<div style="float:left; width: 50px; margin-left:45px">
					<img src="images/organic.png" width="40px" />
					<h3 style="margin-top:0; padding-top:0; line-height:26px"><?=number_format($dados->getVisits(), -3, '.', '.')?></h3>
				</div>
				
           <?  } 
			$filter = 'medium==cpc';
			$ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, date('Y-m-d'), date('Y-m-d'),1);
				foreach ($ga->getResults() as $dados) {
			?>
			   	<div style="float:left; width: 50px; margin:0 30px">
					<img src="images/pay.png" width="40px" />
					<h3 style="margin-top:0; padding-top:0; line-height:26px"><?=number_format($dados->getVisits(), -3, '.', '.')?></h3>
				</div>
				
           <?  } 
			 $filter = 'medium==referral';
			$ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, date('Y-m-d'), date('Y-m-d'),1);
				foreach ($ga->getResults() as $dados) {
			?>
			   	<div style="float:left; width: 50px">
					<img src="images/direta.png" width="40px" />
					<h3 style="margin-top:0; padding-top:0; line-height:26px"><?=number_format($dados->getVisits(), -3, '.', '.')?></h3>
				</div>
				
           <?  
				}
           $filter = 'medium==display';
			$ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, date('Y-m-d'), date('Y-m-d'),1);
				foreach ($ga->getResults() as $dados) {
			?>
			   	<div style="float:left; width: 50px; margin:0 30px">
					<img src="/painel/images/mail.png" width="40px" />
					<h3 style="margin-top:0; padding-top:0; line-height:26px"><?=number_format($dados->getVisits(), -3, '.', '.')?></h3>
				</div>
				
           <?  } 
			
			$filter1 = 'source==facebook.com';
			$filter2 = 'source==m.facebook.com';
			$filter3 = 'source==l.facebook.com';
			$ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter1, date('Y-m-d'), date('Y-m-d'),1);
				foreach ($ga->getResults() as $dados) {
					$fb1 = $dados->getVisits();
					} 
			$ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter2, date('Y-m-d'), date('Y-m-d'),1);
				foreach ($ga->getResults() as $dados) {
					$fb2 = $dados->getVisits();
					} 
			$ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter3, date('Y-m-d'), date('Y-m-d'),1);
				foreach ($ga->getResults() as $dados) {
					$fb3 = $dados->getVisits();
					} 
			?>
			   	<div style="float:left; width: 50px">
					<img src="/painel/images/face.png" width="40px" />
					<h3 style="margin-top:0; padding-top:0; line-height:26px"><?=number_format($fb1+$fb2+$fb3, -3, '.', '.')?></h3>
				</div>
				
           
           
           
				
				
				
			<div class="controle">&nbsp;</div>
		</div>
	<div class="controle">&nbsp;</div>
	<div>
            <div style="width:100%; padding:35px;" >
		<canvas id="canvass" height="200px" width="870px"></canvas>
            </div>
            <div class="controle">&nbsp;</div>

        </div>
        
        <?




	$inicio1 = date('Y-m-01', strtotime('-1 month')); // 1° dia do mês passado
	$fim1 = date('Y-m-t', strtotime('-1 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio1, $fim1,1);
        foreach ($ga->getResults() as $dados) {
			$mes11 = $dados->getVisits();
        }
	
	$inicio2 = date('Y-m-01', strtotime('-2 month')); // 1° dia do mês passado
	$fim2 = date('Y-m-t', strtotime('-2 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio2, $fim2,1);
        foreach ($ga->getResults() as $dados) {
			$mes10 = $dados->getVisits();
        }
	
	$inicio3 = date('Y-m-01', strtotime('-3 month')); // 1° dia do mês passado
	$fim3 = date('Y-m-t', strtotime('-3 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio3, $fim3,1);
        foreach ($ga->getResults() as $dados) {
			$mes9 = $dados->getVisits();
        }
	
	$inicio4 = date('Y-m-01', strtotime('-4 month')); // 1° dia do mês passado
	$fim4 = date('Y-m-t', strtotime('-4 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio4, $fim4,1);
        foreach ($ga->getResults() as $dados) {
			$mes8 = $dados->getVisits();
        }
	
	$inicio5 = date('Y-m-01', strtotime('-5 month')); // 1° dia do mês passado
	$fim5 = date('Y-m-t', strtotime('-5 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio5, $fim5,1);
        foreach ($ga->getResults() as $dados) {
			$mes7 = $dados->getVisits();
        }
	
	$inicio6 = date('Y-m-01', strtotime('-6 month')); // 1° dia do mês passado
	$fim6 = date('Y-m-t', strtotime('-6 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio6, $fim6,1);
        foreach ($ga->getResults() as $dados) {
			$mes6 = $dados->getVisits();
        }
	
	$inicio7 = date('Y-m-01', strtotime('-7 month')); // 1° dia do mês passado
	$fim7 = date('Y-m-t', strtotime('-7 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio7, $fim7,1);
        foreach ($ga->getResults() as $dados) {
			$mes5 = $dados->getVisits();
        }
	
	$inicio8 = date('Y-m-01', strtotime('-8 month')); // 1° dia do mês passado
	$fim8 = date('Y-m-t', strtotime('-8 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio8, $fim8,1);
        foreach ($ga->getResults() as $dados) {
			$mes4 = $dados->getVisits();
        }
	
	$inicio9 = date('Y-m-01', strtotime('-9 month')); // 1° dia do mês passado
	$fim9 = date('Y-m-t', strtotime('-9 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio9, $fim9,1);
        foreach ($ga->getResults() as $dados) {
			$mes3 = $dados->getVisits();
        }
	
	$inicio10 = date('Y-m-01', strtotime('-10 month')); // 1° dia do mês passado
	$fim10 = date('Y-m-t', strtotime('-10 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio10, $fim10,1);
        foreach ($ga->getResults() as $dados) {
			$mes2 = $dados->getVisits();
        }
	
	$inicio11 = date('Y-m-01', strtotime('-11 month')); // 1° dia do mês passado
	$fim11 = date('Y-m-t', strtotime('-11 month')); // Último dia do mês passado
    $filter = 'medium==organic';
    $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio11, $fim11,1);
        foreach ($ga->getResults() as $dados) {
			$mes1 = $dados->getVisits();
        }
	
	?>  	

        
        <script>
        
        
        
                var lineChartDatas = {
			labels : ['<?=substr(strftime('%B', strtotime('-11 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-10 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-9 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-8 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-7 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-6 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-5 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-4 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-3 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-2 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('-1 month')),0,3);?>.','<?=substr(strftime('%B', strtotime('today')),0,3);?>.'],
			datasets : [
				{
					borderColor: "rgba(0,0,0,1)",
					label: "Acessos deste mês",
					fillColor : "rgb(34,185,255,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "#2091f9",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : ['<?=$mes1?>','<?=$mes2?>','<?=$mes3?>','<?=$mes4?>','<?=$mes5?>','<?=$mes6?>','<?=$mes7?>','<?=$mes8?>','<?=$mes9?>','<?=$mes10?>','<?=$mes11?>','<?=$mesAtu?>']
				}
			]

		};
		
		var ctxs = document.getElementById("canvass").getContext("2d");
		
		var myLineChart = new Chart(ctxs).Line(lineChartDatas, {
			responsive: false
		});
        
        </script>