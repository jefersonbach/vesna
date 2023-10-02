<?
set_time_limit(0);
ini_set('max_execution_time', 0);

require_once('pdf/html2pdf/html2pdf.class.php');
include 'class.banco.php';
$resulSeo = new conect();
?>
<html>
<head>



<script src="../js/jquery-1.8.3.js"></script>
<script>
$(document).ready(function(){
	$('.click').click(function(){
		$(this).each(function(index){
			var cont = $(this).attr('data-id');
			var fam = $(this).attr('data-fam');
			$("#load").load("geradorPdf.php", {clean: cont, familia: fam} );
		});
 	});  
 });

</script>
</head>

<body>
<?php



$dir    = '../../../pdf/'.$_GET['familia'];
$files2 = scandir($dir, 1);



$prodsa = $resulSeo->lista('familias',"id ='".$_GET['familia']."'");
foreach($prodsa as $pais){ 
	echo $pais['nome'].'<br />';
	$prodsa = $resulSeo->lista('produtos',"familia ='".$_GET['familia']."'");
	foreach($prodsa as $pprod){
			if($pprod['nome'] != 'Capa'){
				echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$pprod['nome'].'<div style="background:#e1e1e1; display:inline-block; padding:5px 20px" class="click" data-id="'.$pprod['clean_url'].'" data-fam="'.$pprod['familia'].'">Gerar PDF</div><br />';
				
				
				
			
						$prodsImg = $resulSeo->lista($pais['clean_url'].'imagens','token = "'.$pprod['token'].'" && (principal = "1" OR principal = "")');
						$resulSeo->crop('/painel/arquivos/'.$pais['clean_url'].'/'.$prodsImg[0]['img'],'250','113','far', true);
							
			
			
				$_GET['famm'] = $_GET['familia'];
				$_GET['proo'] = $pprod['clean_url'];
				
			
			
				ob_start();
				include('pdf/html2pdf/examples/res/exemple02.php');
				$content = ob_get_clean();
				
				
				
			
				// convert in PDF
				
				
				
				 /*?> try
				{
					$html2pdf = new HTML2PDF('P','A4','pt', true, 'ISO-8859-1', 0);
					$html2pdf->AddFont('montserrat', 'normal', 'montserrat.php'); 
					$html2pdf->AddFont('montlight', 'normal', 'montlight.php'); 
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
					
					
						$nomeProduto = explode(' ',$pprod['clean_url']);
							$ref = strtolower($nomeProduto[0]);
							unset($nomeProduto[0]);
							$nomeProduto = implode(' ',$nomeProduto);
							
					
					
					
					$html2pdf->Output('../../pdf/'.$_GET['familia'].'/'.$ref.'-'.$pprod['id'].'.pdf', 'F');
				}
				catch(HTML2PDF_exception $e) {
					echo $e;
					exit;
				}<?php */
			
		}
	}
}

?>

<div id="load">

</div>

</body>
</html>
