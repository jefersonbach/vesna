
<?php
include ('./gapi.class.php');
$ga = new gapi('pain-622@unik-302819.iam.gserviceaccount.com','cert.p12');

// Define o periodo do relatório
echo $inicio = date('Y-m-01'); // 1° dia do mês passado
echo $fim = date('Y-m-t'); // Último dia do mês passado
echo '<br />';
?>
	<?
    $filter = 'pagePath=@/';
    try {
        $ga->requestReportData('107594294', 'month', array('pageviews', 'visits'), null, $filter, $inicio, $fim,1);

        foreach ($ga->getResults() as $dados) {
            echo '<strong>Mes</strong><br />'.$dados->getPageviews();
        } 
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

?>
