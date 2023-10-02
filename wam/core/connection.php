<?php
	session_start();
	//error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	header('Cache-Control: no-cache');
 	header('Pragma: no-cache');
	header("Content-Type: text/html; charset=utf-8",true);
	setlocale(LC_MONETARY, 'pt_BR');
	setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	date_default_timezone_set('America/Sao_Paulo');

	include('../../painel/includes/class.banco.php');
	$subdomain = array_shift((explode('.', $_SERVER['HTTP_HOST'])));

	if(strpos($_SERVER['HTTP_HOST'], '.test') !== false) {
		$storageUrl = '//storage.trazpracaclub.test';
	} else {
		$storageUrl = '//'.$subdomain.'.trazpracaclub.com.br/painel/storage';
	}

	
	$banco = new connect();
	$connect = $banco->getConnection();


	