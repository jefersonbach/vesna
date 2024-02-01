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


if($_POST['criarConta'] == 'Criar conta'){
    $post = $_POST;
    $emailTemplate = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Criar Conta - Vesna Partners</title>
        <style type="text/css">
        html,
        body {
            font-size: 14pt;
            font-family: Helvetica, arial, sans-serif;
            background: #97e9c5;
        }
        </style>
    </head>
    <body bgcolor="#97E9C5" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">
        <table  bgcolor="#97E9C5" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
                <td align="center" style="background:#fff"  bgcolor="#ffffff">
                    <br />
                    <a href="https://www.vesna.partners" title="Vesna"  align="center" style="margin:30px auto 0px">
                        <img src="https://www.vesna.partners/assets/images/favico.jpeg" alt="Vesna" style="width: 75px; margin:0 auto; text-align:center; border-radius:14px; overflow:hidden;  box-shadow: 0 10px 20px rgba(0,0,0,0.1)">
                    
                    </a>
                    <h2 align="center" style="color:#777; font-size:22pt">Solicitação para criar conta.</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                    <!-- Wrapper -->
                    <table bgcolor="#ffffff" width="600" cellpadding="16" cellspacing="10" align="center" style="border: 0; border-radius: 16px;">
                        
                        <!-- Conteúdo -->
                        <tr>
                            <td align="right" style="border-bottom: 1px solid rgba(0,0,0,0.1); opacity:0.7">Nome</td>
                            <td width="60%" nowrap style="border-bottom: 1px solid rgba(0,0,0,0.1); font-weight:700">'.$_POST['nome'].'</td>
                        </tr>

                        <tr>
                            <td align="right" style="border-bottom: 1px solid rgba(0,0,0,0.1); opacity:0.7">Nome da Empresa</td>
                            <td width="60%" nowrap style="border-bottom: 1px solid rgba(0,0,0,0.1); font-weight:700">'.$_POST['empresa'].'</td>
                        </tr>
                        <tr>
                            <td align="right" style="border-bottom: 1px solid rgba(0,0,0,0.1); opacity:0.7">Site</td>
                            <td width="60%" nowrap style="border-bottom: 1px solid rgba(0,0,0,0.1); font-weight:700">'.$_POST['site'].'</td>
                        </tr>
                        <tr>
                            <td align="right" style="border-bottom: 1px solid rgba(0,0,0,0.1);opacity:0.7">E-mail</td>
                            <td width="60%" nowrap style="border-bottom: 1px solid rgba(0,0,0,0.1);font-weight:700">'.$_POST['email'].'</td>
                        </tr>
                        <tr>
                            <td align="right" style="opacity:0.7">Telefone</td>
                            <td width="60%" nowrap style="font-weight:700">'.$_POST['celular'].'</td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td width="60%" nowrap></td>
                        </tr>
                        
                    </table>
                    <!-- End: Wrapper -->
                    <br>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <a href="https://www.vesna.partners" title="Vesna" align="center" style="margin: 15px auto 50px; color:#333; font-weight:700; text-decoration:none; text-transform:uppercase; font-size:11pt">
                        vesna.partners
                    </a>
                </td>
            </tr>
        </table>
    </body>
    </html>
';





	$envia1 = mandaEmail('partners@vesnapubli.com', 'Vesna Partners', 'Criar Conta', $emailTemplate);
    $envia2 = mandaEmail('jeferson@agtp.com.br', 'Vesna Partners', 'Criar Conta', $emailTemplate);

    ?>
    <script>
        alert('Recebemos o seu contato, em breve alguém entrará em contato.');
    </script>
    <?

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

        header('location:/dashboard');
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
        setcookie(md5('cliente_usuario'), null, -1, '/', '/'.$cookie_host);
        setcookie(md5('cliente_empresa'), null, -1, '/', '/'.$cookie_host);
        setcookie(md5('cliente_nome'), null, -1, '/', '/'.$cookie_host);
        setcookie(md5('cliente_email'), null, -1, '/', '/'.$cookie_host);
        unset($_COOKIE[md5('cliente_id')]);
        unset($_COOKIE[md5('cliente_nome')]);
        unset($_COOKIE[md5('cliente_email')]);
        unset($_COOKIE[md5('cliente_empresa')]);
        unset($_COOKIE[md5('cliente_usuario')]);
        $cliente = '';
        header('location:/');
        exit;
    }else{
        if(isset($_COOKIE[md5('cliente_id')])){
            header('location:/');
            exit;
        }
    }
}else{
    if($_COOKIE['cliente_id'] == '' and $pag != 'criar-conta'){
        //header('location:/');
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