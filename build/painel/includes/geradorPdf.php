<?
set_time_limit(0);
ini_set('max_execution_time', 0);
require_once('pdf/html2pdf/html2pdf.class.php');
include 'class.banco.php';
$resulSeo = new conect();
echo $_POST['familia'];


$prodsa = $resulSeo->lista('familias',"id ='".$_POST['familia']."'");
echo $_POST['clean'];
foreach($prodsa as $pais){ 
	echo $pais['nome'].'<br />';
	$prodsa = $resulSeo->lista('produtos',"clean_url ='".$_POST['clean']."'");
	foreach($prodsa as $pprod){
			
			
						$prodsImg = $resulSeo->lista($pais['clean_url'].'imagens','token = "'.$pprod['token'].'" && (principal = "1" OR principal = "")');
						$resulSeo->crop('/painel/arquivos/'.$pais['clean_url'].'/'.$prodsImg[0]['img'],'250','113','far', true);
							
			
ob_start();
include('pdf/html2pdf/examples/res/exemple02.php');
$content = ob_get_clean();


echo '../../pdf/'.$_POST['familia'].'/'.$ref.'-'.$pprod['id'].'.pdf';

// convert in PDF

		try
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
					
			
			
			
			$html2pdf->Output('../../pdf/'.$_POST['familia'].'/'.$ref.'-'.$pprod['id'].'.pdf', 'F');
		}
		catch(HTML2PDF_exception $e) {
			echo $e;
			exit;
		}
	}
}

?>