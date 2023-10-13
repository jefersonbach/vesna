<?php
session_start();
//error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
header('Cache-Control: no-cache');
header('Pragma: no-cache');
header("Content-Type: text/html; charset=utf-8",true);
setlocale(LC_MONETARY, 'pt_BR');
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');


include('painel/includes/class.banco.php');	


$banco = new connect();
$connect = $banco->getConnection();


$pag = str_replace('/build/','',$_SERVER['REQUEST_URI']);
$pag = str_replace('.php','',$pag);

if($pag == '/'){$pag = 'login';}


$cookie_host = $_SERVER['HTTP_HOST'];

$globals = $banco->lista('seo', "id = '1'");

if($pag == 'identificacao' and $cliente['nome'] != ''){
    //header('location:/checkout');
    //exit;
}

if($_POST['login'] == 'Acessar minha conta'){
    $post = $_POST;
    unset($post['login']);
    $existe = $banco->lista('logins',"user = '".$post['user']."' and senha = '".$post['senha']."'");
    if($existe[0]['id'] and $existe != 'erro'){
        setcookie('cliente_id', $existe[0]['id'], 0, '/');
        setcookie('cliente_nome', $existe[0]['nome'], 0, '/');
        setcookie('cliente_email', $existe[0]['email'], 0, '/');
        setcookie('cliente_usuario', $existe[0]['usuario'], 0, '/');
        setcookie('cliente_empresa', $existe[0]['empresa'], 0, '/');

        header('location:/home');
        exit;
    }else{
        $alerta['titulo'] = 'Essa conta já existe';
        $alerta['mensagem'] = '<strong>Parece que você já é nosso cliente!</strong><br /><a href="/esqueceu-senha">clique aqui</a> caso tenha esquecido sua senha.';
        $alerta['link'] = '/esqueceu-senha';
        $alerta['btn'] = 'Esqueceu sua senha?';
        $alerta['cor'] = '#56dd2c';
        $msg = 'Parece que você já é nosso cliente, '; 


        ?>
        <script>
            alert('Verifique se o usuário e a senha foram preenchidos corretamente!');
        </script>
        <?

    }
    
}








if($pag == 'login'){
    if($retorno[1] == 'sair'){
        setcookie(md5('cliente_id'), null, -1, '/', '/'.$cookie_host);
        setcookie(md5('cliente_nome'), null, -1, '/', '/'.$cookie_host);
        setcookie(md5('cliente_email'), null, -1, '/', '/'.$cookie_host);
        unset($_COOKIE[md5('cliente_id')]);
        unset($_COOKIE[md5('cliente_nome')]);
        unset($_COOKIE[md5('cliente_email')]);
        $cliente = '';
        header('location:/login');
        exit;
    }else{
        if(isset($_COOKIE[md5('cliente_id')])){
            header('location:/login');
            exit;
        }
    }
}else{

    if($_COOKIE['cliente_id'] == ''){
        //header('location:/login');
        //exit;
    }
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php
        include('includes/html/metatags.php');
        include('includes/html/css.php');
    ?>
</head>
<body>
    <?php
        // Pages
	 	include('core/pages.php');
	
        // Scripts
        include('includes/html/scripts.php');
    ?>
</body>
</html>