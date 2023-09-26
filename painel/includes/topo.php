<? session_start();
$nPag = explode('/',$_SERVER['PHP_SELF']);
$p = substr($nPag[2],0,-4);
$_SESSION['pagina'] = $p;
$_SESSION['caminho'] = '../../arquivos/'.$p.'/';


ini_set('default_charset','UTF-8');
ini_set('max_execution_time', 0);
set_time_limit(0);
ini_set('session.gc_maxlifetime', 6*60*60); // 3 hours

if($_SESSION['usuario'] && $_SESSION['senha'] OR substr($_SERVER['REQUEST_URI'], 0, 23) == '/painel/importador2.php'){}else{
	header('location:/painel/index.php');
}

if(!isset($_GET['editar'])){
	$_SESSION['id_ficha'] = "";
	$_SESSION['token'] = "";
}else{
	if(isset($_GET['token'])){
		$_SESSION['token'] = $_GET['token'];
	}
}

if($_SESSION['id_ficha']){
	 $_SESSION['id_ficha'] = md5(uniqid(rand(), true));
}

$post = $_POST;
include('includes/class.banco.php');

$emp = new connect();
$rProd = $emp;
$resulSeo = $emp;
$banco = $emp;
$prods = $emp->lista('seo', '0');

?>
<!DOCTYPE html>
<html lang="pt"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Painel de Gerenciamento - <?	foreach($prods as $lis){echo $lis['empresa'];}?></title>
<meta name="viewport" content="width=980px,initial-scale=1">
<link rel="apple-touch-icon" href="assets/images/iconApplePainel.png" />
<link rel="stylesheet" href="/painel/assets/css/base.css" type="text/css" media="screen" />
<link href="/painel/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />

<link rel='stylesheet' href="/painel/includes/uploader/css/style.css" type='text/css' media='screen' />
<script src="/painel/assets/js/jquery-1.8.3.js"></script>
<script src="/painel/includes/bootstrap/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="/painel/includes/daterangepicker.css" />

<link rel="stylesheet" href="/painel/includes/textarea/website/css/stylesheet.css">
<script src="/painel/includes/textarea/parser_rules/advanced.js" ></script>
<script src="/painel/includes/textarea/dist/wysihtml5-0.3.0.js" ></script>
<meta name="ckeditor-sample-required-plugins" content="sourcearea">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script type="text/javascript" src="/painel/includes/daterangepicker.js"></script>


<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  
<script src="/painel/includes/editorTxt/nicEdit.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="includes/ed/js/sample.js"></script>
<link rel="stylesheet" href="includes/ed/css/samples.css">
<link rel="stylesheet" href="includes/ed/toolbarconfigurator/lib/codemirror/neo.css">
<script type="text/javascript" src="/painel/includes/uploader/js/script.upload.js"></script>
<?
if(substr($_SERVER['REQUEST_URI'], 8, 4) == 'cad_' or substr($_SERVER['REQUEST_URI'], 8, 4) == 'edit'){
	/*?><script src="/painel/includes/textarea/parser_rules/advanced.js" ></script>
	<script src="/painel/includes/textarea/dist/wysihtml5-0.3.0.js" ></script><?php */?>
	<meta name="ckeditor-sample-required-plugins" content="sourcearea">
	<script src="/painel/includes/uploader/js/jquery.ui.widget.js" type="text/javascript"></script>
	<script src="/painel/includes/uploader/js/jquery.fileupload.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="/painel/includes/tags/src/jquery.tagsinput.css" />
	<script type="text/javascript" src="/painel/includes/tags/src/jquery.tagsinput.js"></script>
<?
}
include('assets/js/scripts.php');?>

</head>
<body <? if(substr($_SERVER['REQUEST_URI'], 0, 24) == '/painel/cad_produtos.php'){?>style="background:#f4f4f4 !important" <?}?>>
<div>
	<? //if(substr($_SERVER['REQUEST_URI'], 8, 7) != 'cad_new'){include('includes/menu-top.php');} echo substr($_SERVER['REQUEST_URI'], 0, 24)
	include('includes/menu-top.php'); ?>
    <div id="menua" style="<? if($_SERVER['REQUEST_URI'] == '/painel/pedidos.php'){ echo 'display:none';} ?>" ><? include('includes/menu-lateral.php');?></div>
	 <div <? if($_SERVER['REQUEST_URI'] != '/painel/pedidos.php'){ ?> class="caixa-conteudo"<? }else{?>style="padding-top:45px"<?} ?> >