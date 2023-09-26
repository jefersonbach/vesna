<?
	require_once("analycts/gapi.class.php");
$ga = new gapi('jeef.bach@gmail.com','jJ30627598');

	// ID do perfil do site
	$id = '84085210';
	$inicio = date('2014-01-01'); // 1° dia do mês passado
	$fim = date('Y-m-t'); // Último dia do mês passado
	$filter = 'pagePath=@/noticias/'.$_POST['cleanPagt'];
	$ga->requestReportData($id, 'pagePath', array('pageviews'), null, $filter, $inicio, $fim, null);
			foreach ($ga->getResults() as $dados) {
				echo $dados->getPageviews();
			}
		
    ?>
