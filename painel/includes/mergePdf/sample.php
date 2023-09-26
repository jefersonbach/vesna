<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/painel/css/base.css" type="text/css" media="screen" />
</head>
<body>

<div style="padding:80px 40px">
<?php
set_time_limit(0);
include 'PDFMerger.php';
include '../class.banco.php';
$resulSeo = new conect();
$pdf = new PDFMerger;


$dir    = '../../../pdf/'.$_GET['familia'];
$files2 = scandir($dir);

$i=0;
$a=0;

$prodsa = $resulSeo->lista('familias',"id ='".$_GET['familia']."'");
foreach($prodsa as $pais){ 
	echo '<h1>Gerado catálogo da família - '.$pais['nome'].'</h1>';
	
	
	$pdf->addPDF('../../../pdf/'.$_GET['familia'].'/capa.pdf', 'all');
	
	$produto = $resulSeo->lista('produtos',"familia ='".$_GET['familia']."' and ativo != 'Nao'",'','ordem ASC');
	foreach($produto as $pp){ 
		$nomeProduto = explode(' ',$pp['nome']);
				$ref = strtolower($resulSeo->clean_url($nomeProduto[0]));
		//echo '<br />'.$ref.'.pdf';
		$i++;
	}

echo '<h3>Total de Produtos: '.$i.'</h3>';
echo "<h4>Total de PDF'S gerados: ".$a."</h4>";
	
	
	foreach($produto as $ppp){ 
	$a++;
		$nomeProduto = explode(' ',$ppp['nome']);
				$ref = strtolower($resulSeo->clean_url($nomeProduto[0]));
		echo '<br />'.$ref.'.pdf';
		
		$pdf->addPDF('../../../pdf/'.$_GET['familia'].'/'.$ref.'.pdf', 'all');
		
	}
		
	$pdf->addPDF('../../../pdf/contraCapa.pdf', 'all');
	$pdf->merge('file', '../../../pdf/'.$_GET['familia'].'/BakelitSul-'.$pais['clean_url'].'.pdf');



}


	
	//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
	//You do not need to give a file path for browser, string, or download - just the name.
	?>
</div>
</body></html>