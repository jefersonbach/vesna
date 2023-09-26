<?php 
	



	// Pages
	$_SESSION['xpag'] = $pag;
	$pageDir = 'includes/pages/';
	$pg = explode('/',$pag);

	$pgGet = explode('?',$pg[2]);
	//echo $pag = '/'.$pag;

	include('includes/html/header.php');
	if($pg[1] == ''){
		$pg[1] = 'login';
	}
	//echo $pageDir.$pg[1].'.php';

	include((isset($pag)) ? $pageDir.$pg[1].'.php' : $pageDir.'home.php');
	if(file_exists($pageDir.$pg[1].'.php')){
		
	} else {
		//include($pageDir.'erro.php');
	}

	// Footer
	//if(!in_array($pag, $notInclude)) {
		include('includes/html/footer.php');
	//}