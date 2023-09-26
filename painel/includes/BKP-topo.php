<? 
ini_set('session.gc_maxlifetime', 6*60*60); // 3 hours
//ini_set("session.save_path","/home/baquelitebrasil/tmp");
session_start(); 
if(!isset($_GET['editar']))
{
	$_SESSION['id_ficha'] = "";
	$_SESSION['token'] = "";
}else{
	if(isset($_GET['token'])){
		$_SESSION['token'] = $_GET['token'];
	}
}

$post = $_POST;
include('includes/class.banco.php');
	if($_SESSION['usuario'] && $_SESSION['senha']){
	}else{
		header('location:/painel/index.php');
	}
$emp = new conect();
$prods = $emp->lista('seo', '0');
?>
<!DOCTYPE html>
<html lang="pt"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Painel de Gerenciamento - <?	foreach($prods as $lis){echo $lis['empresa'];}?></title>


<link rel="apple-touch-icon" href="/painel/img/icon2.png" />


<link rel="stylesheet" href="/painel/css/base.css" type="text/css" media="screen" />
<link href="/painel/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="/painel/bootstrap/color/css/colorpicker.css" rel="stylesheet" media="screen" />



<link rel='stylesheet' href="/painel/uploader/css/style.css" type='text/css' media='screen' />
<link rel="stylesheet" type="text/css" href="/painel/includes/fancy/source/jquery.fancybox.css?v=2.1.4" media="screen" />



<script src="/painel/js/jquery-1.8.3.js"></script>
<script src="/painel/bootstrap/js/bootstrap.min.js"></script>
<script src="/painel/bootstrap/color/js/bootstrap-colorpicker.js"></script>



<script type="text/javascript" src="/painel/includes/fancy/source/jquery.fancybox.js?v=2.1.4"></script>
	
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<?
if(substr($_SERVER['REQUEST_URI'], 8, 4) == 'cad_' or substr($_SERVER['REQUEST_URI'], 8, 4) == 'edit'){
?>
<link rel="stylesheet" type="text/css" href="/painel/bootstrap/calendar/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="/painel/bootstrap/calendar/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="/painel/includes/textarea/website/css/stylesheet.css">
<script src="/painel/includes/textarea/parser_rules/advanced.js" ></script>
<script src="/painel/includes/textarea/dist/wysihtml5-0.3.0.js" ></script>

<meta name="ckeditor-sample-required-plugins" content="sourcearea">
<script src="/painel/editorTxt/nicEdit.js"></script>
<script src="/painel/uploader/js/jquery.ui.widget.js" type="text/javascript"></script>
<script src="/painel/uploader/js/jquery.fileupload.js" type="text/javascript"></script>
<script type="text/javascript" src="/painel/uploader/js/script.upload.js"></script>	
<?php /*?><script type="text/javascript" src="/painel/uploader/js/script.uploadD.js"></script>	<?php */?>
<?
}
?>
<? include('js/scripts.php');?>
</head>
<body>
<div>
	<? if(substr($_SERVER['REQUEST_URI'], 8, 7) != 'cad_new'){include('includes/menu-top.php');} ?>
    <div id="menua"><? include('includes/menu-lateral.php') ?></div>
  	<? if(substr($_SERVER['REQUEST_URI'], 8, 7) != 'cad_new'){?><div class="caixa-conteudo">  <? } ?>  