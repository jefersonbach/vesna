<?php 
    // Simulate
    if(isset($_POST['emailSend'])) {
        // Define Assunto
        $emailSubject = $_POST['assunto'];

        // Define Mensagem do E-mail
        switch($emailSubject) {
            case 'Lojista > Bem vindo' :
                $emailMessage = '
                    <p>
                        <strong>Olá, {{ nome }}!</strong><br>
                        Você acaba de criar a sua loja <strong>TrazPraCá.Club</strong>.<br>
                    </p>
                    <p>
                        <strong>Seus dados de acesso ao painel de gerenciamento.</strong><br>
                        E-mail: <strong>{{ email }}</strong><br>
                        Senha: <strong>{{ senha }}</strong><br>
                    </p>
                    <p>
                        A partir de agora você poderá acessar nosso painel administrativo, selecionar seus produtos e customizar a sua loja virtual.<br>
                        <strong>Boas vendas!</strong>
                    </p>
                ';
                break;

            case 'Lojista > Esqueci minha senha' :
                $emailMessage = '
                    <p>
                        <strong>Olá, {{ nome }}!</strong><br>
                        Segue o link para recuperar a sua senha.
                    </p>
                    <p>
                        <a style="background-color: {{cor}}; border-radius: 4px; color: #fff; display: inline-block; font-weight: bold; padding: 12px 24px; text-decoration: none;" href="#">Recuperar senha</a>
                    </p>
                    <p>
                        Caso não tenha sido você que solicitou a recuperação de senha, ignore este e-mail.
                    </p>
                ';
                break;

            case 'Lojista > Venda na loja' :
                $emailMessage = '
                    <p>
                        <strong>Olá, {{ nome }}!</strong><br>
                        Um novo pedido foi realizado em sua loja virtual!<br>
                        Confira o resumo do pedido:
                    </p>

                    <table width="100%" cellspacing="0" cellpadding="1" border="0" style="font-size: 0.95em; line-height: 1.5em;">
                        <caption style="background: #393939; color: #fff; margin: 0 0 4px; padding: 12px; text-align: left; border-radius: 2px;">Detalhes do pedido #41</caption>
                        <tr>
                            <td>Nome: Jeferson Bach</td>
                        </tr>
                        <tr>
                            <td>E-mail: jeferson@agtp.com.br</td>
                        </tr>
                    </table>
                    <br>

                    <table width="100%" cellspacing="0" cellpadding="1" border="0" style="font-size: 0.95em; line-height: 1.5em;">
                        <caption style="background: #393939; color: #fff; margin: 0 0 4px; padding: 12px; text-align: left; border-radius: 2px;">Itens do Pedido</caption>
                        <tr>
                            <td>Garrafa com Alça - Leve só o que é bom</td>
                            <td width="10%" align="right" nowrap>R$ 25,00</td>
                        </tr>
                        <tr>
                            <td>Copo para Viagem - Floresta</td>
                            <td width="10%" align="right" nowrap>R$ 25,00</td>
                        </tr>
                        <tr>
                            <td>Sacola Institucional Uatt - Rosé Gold</td>
                            <td width="10%" align="right" nowrap>R$ 260,00</td>
                        </tr>
                    </table>
                    <br>

                    <table width="100%" cellspacing="0" cellpadding="1" border="0" style="font-size: 0.95em; line-height: 1.5em;">
                        <caption style="background: #393939; color: #fff; margin: 0 0 4px; padding: 12px; text-align: left; border-radius: 2px;">Pedido #123</caption>
                        <tr>
                            <td>Total dos itens</td>
                            <td width="10%" align="right" nowrap>R$ 170,00</td>
                        </tr>
                        <tr>
                            <td>Frete</td>
                            <td width="10%" align="right" nowrap>+ R$ 50,00</td>
                        </tr>
                        <tr>
                            <td>Desconto</td>
                            <td width="10%" align="right" nowrap>R$ -25,00</td>
                        </tr>
                        <tr>
                            <td>Valor total</td>
                            <td width="10%" align="right" nowrap>R$ 500.00</td>
                        </tr>
                        <tr>
                            <td><strong style="color: {{cor}}">Comissão</strong></td>
                            <td width="10%" align="right" nowrap><strong>R$ 48,75</strong></td>
                        </tr>
                    </table>
                    <br>

                    <p>
                        <a style="color: {{cor}};" href="#">Confira o pedido</a> em seu painel de gerenciamento.
                    </p>
                ';
                break;

            case 'Lojista > Resumo semanal' :
                $emailMessage = '
                    <p>
                        <strong>Olá, lojista!</strong><br>
                        Confira o seu resumo semanal na TrazPraCá.Club:
                    </p>

                    <table width="100%" cellspacing="8" cellpadding="8" border="0">
                        <tr>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="4" border="0" bgcolor="{{cor}}" style="background-color: {{cor}}; color: #fff; border-radius: 4px; font-size: 1.25em; line-height: 1.5em; padding: 12px;">
                                    <tr>
                                        <th align="left">15 Vendas</th>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="4" border="0" bgcolor="{{cor}}" style="background-color: {{cor}}; color: #fff; border-radius: 4px; font-size: 1.25em; line-height: 1.5em; padding: 12px;">
                                    <tr>
                                        <th align="left">15 Vendas</th>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="4" border="0" bgcolor="{{cor}}" style="background-color: {{cor}}; color: #fff; border-radius: 4px; font-size: 1.25em; line-height: 1.5em; padding: 12px;">
                                    <tr>
                                        <th align="left">15 Vendas</th>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="4" border="0" bgcolor="{{cor}}" style="background-color: {{cor}}; color: #fff; border-radius: 4px; font-size: 1.25em; line-height: 1.5em; padding: 12px;">
                                    <tr>
                                        <th align="left">15 Vendas</th>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="4" border="0" bgcolor="{{cor}}" style="background-color: {{cor}}; color: #fff; border-radius: 4px; font-size: 1.25em; line-height: 1.5em; padding: 12px;">
                                    <tr>
                                        <th align="left">15 Vendas</th>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="4" border="0" bgcolor="{{cor}}" style="background-color: {{cor}}; color: #fff; border-radius: 4px; font-size: 1.25em; line-height: 1.5em; padding: 12px;">
                                    <tr>
                                        <th align="left">15 Vendas</th>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <br>
                ';
                break;

            case 'Cliente > Conta criada com sucesso' :
                $emailMessage = '
                    <p>
                        <strong>Olá, {{ nome }}!</strong><br>
                        Sua conta foi criada com sucesso!<br>
                    </p>
                    <p>
                        <strong>Seus dados de acesso:</strong><br>
                        E-mail: <strong>{{ email }}</strong><br>
                        Senha: <strong>{{ senha }}</strong><br>
                    </p>
                    <p>
                        Faça suas compras em nossa loja virtual e acompanhe os seus pedidos através dos e-mails de notificação.
                    </p>
                ';
                break;

            case 'Cliente > Pedido finalizado' :
                $emailMessage = '
                    <p>
                        <strong>Olá, {{ nome }}!</strong><br>
                        Seu pedido foi realizado com sucesso!
                        Confira o resumo do pedido:
                    </p>

                    <table width="100%" cellspacing="0" cellpadding="1" border="0" style="font-size: 0.95em; line-height: 1.5em;">
                        <caption style="background: #393939; color: #fff; margin: 0 0 4px; padding: 12px; text-align: left; border-radius: 2px;">Detalhes do pedido #41</caption>
                        <tr>
                            <td>Nome: Jeferson Bach</td>
                        </tr>
                        <tr>
                            <td>E-mail: jeferson@agtp.com.br</td>
                        </tr>
                    </table>
                    <br>

                    <table width="100%" cellspacing="0" cellpadding="1" border="0" style="font-size: 0.95em; line-height: 1.5em;">
                        <caption style="background: #393939; color: #fff; margin: 0 0 4px; padding: 12px; text-align: left; border-radius: 2px;">Itens do Pedido</caption>
                        <tr>
                            <td>Garrafa com Alça - Leve só o que é bom</td>
                            <td width="10%" align="right" nowrap>R$ 25,00</td>
                        </tr>
                        <tr>
                            <td>Copo para Viagem - Floresta</td>
                            <td width="10%" align="right" nowrap>R$ 25,00</td>
                        </tr>
                        <tr>
                            <td>Sacola Institucional Uatt - Rosé Gold</td>
                            <td width="10%" align="right" nowrap>R$ 260,00</td>
                        </tr>
                    </table>
                    <br>

                    <table width="100%" cellspacing="0" cellpadding="1" border="0" style="font-size: 0.95em; line-height: 1.5em;">
                        <caption style="background: #393939; color: #fff; margin: 0 0 4px; padding: 12px; text-align: left; border-radius: 2px;">Pedido #123</caption>
                        <tr>
                            <td>Total dos itens</td>
                            <td width="10%" align="right" nowrap>R$ 170,00</td>
                        </tr>
                        <tr>
                            <td>Frete</td>
                            <td width="10%" align="right" nowrap>+ R$ 50,00</td>
                        </tr>
                        <tr>
                            <td>Desconto</td>
                            <td width="10%" align="right" nowrap>R$ -25,00</td>
                        </tr>
                        <tr>
                            <td><strong>Valor total</strong></td>
                            <td width="10%" align="right" nowrap><strong>R$ 500.00</strong></td>
                        </tr>
                    </table>
                    <br>

                    <p>
                        Em caso de dúvidas, entre em contato conosco!
                    </p>
                ';
                break;

            case 'Cliente > Rastreio' :
                $emailMessage = '';
                break;

            case 'Cliente > Esqueci minha senha' :
                $emailMessage = '
                    <p>
                        <strong>Olá, {{ nome }}!</strong><br>
                        Segue o link para recuperar a sua senha.
                    </p>
                    <p>
                        <a style="background-color: {{cor}}; border-radius: 4px; color: #fff; display: inline-block; font-weight: bold; padding: 12px 24px; text-decoration: none;" href="#">Recuperar senha</a>
                    </p>
                    <p>
                        Caso não tenha sido você que solicitou a recuperação de senha, ignore este e-mail.
                    </p>
                ';
                break;

        }

        // E-mail Template
        $highlightColor = '#'.$post['cores'];
        
        // Modifica a cor dos links
        $emailMessage = str_replace('{{cor}}', $highlightColor, $emailMessage);
        $emailMessage = str_replace('{{ nome }}', $post['nome'], $emailMessage);
        $emailMessage = str_replace('{{ email }}', $post['email'], $emailMessage);
        $emailMessage = str_replace('{{ senha }}', $post['senha'], $emailMessage);

        $emailTemplate = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                <title>'.$emailSubject.' | TrazPraCá.Club</title>
                <style type="text/css">
                html,
                body {
                    font-size: 10pt;
                    font-family: "sans-serif";
                }
                </style>
            </head>
            <body bgcolor="#fafafa" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">
                <table bgcolor="#fafafa" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr>
                        <td>
                            <br><br>
                            <!-- Wrapper -->
                            <table bgcolor="#ffffff" width="600" cellpadding="24" cellspacing="0" align="center" style="border: 0; border-radius: 6px;">
                                <!-- Cabeçalho -->
                                <tr>
                                    <td bgcolor="'.$highlightColor.'" style="border-bottom: 1px solid #e57f27; text-align: center; border-radius: 6px 6px 0 0;">
                                        {{ logotipo }}
                                    </td>
                                </tr>
                                <!-- Conteúdo -->
                                <tr>
                                    <td>
                                        <h1 style="color: #393939; font-size: 2em; line-height: 2em; font-family: sans-serif; font-weight: bold; margin: 0 0 1em; padding: 0;">
                                            '.$emailSubject.'
                                        </h1>
                                        <div style="color: #757575; font-size: 1.05em; line-height: 1.85em; font-family: sans-serif; margin: 0; padding: 0;">
                                            '.$emailMessage.'
                                        </div>
                                    </td>
                                </tr>
                                <!-- Rodapé -->
                                <tr>
                                    <td bgcolor="#fff" style="border-top: 1px solid #f0f0f0; border-radius: 0 0 6px 6px">
                                        <div style="color: #757575; font-size: 1.05em; line-height: 1.85em; font-family: sans-serif; margin: 0; padding: 0;">
                                            <p style="margin: 0; padding: 0;">
                                                <a style="color: '.$highlightColor.'; text-decoration: none;" href="http://'.$_SERVER['HTTP_HOST'].'">
                                                    <strong>Enviado por TrazPraCá.Club</strong><br>
                                                </a>
                                                Se tiver alguma dúvida ou sugestão entre em contato através do email <strong>suporte@trazpraca.club</strong>.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <!-- End: Wrapper -->
                            <br><br>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
        ';

        $emailTemplate = str_replace('{{ logotipo }}', $post['logotipo'], $emailTemplate);
        
       // echo $emailTemplate;
        //exit;
    }
    /* 
?>
<div class="main">
	<header>
		<div class="header-title">
			<h1>E-mails</h1>
			<h4>Tipos de e-mails</h4>
		</div>
		<div class="header-btns">
		</div>
    </header>
    <div class="content">
        <div class="section cf">
            <form method="post" action="#">
                <div class="form">
                    <label>
                        <span>Selecione o assunto</span>
                        <select class="text fields select" name="assunto">
                            <?php 
                                $subjects = array(
                                    'Lojista > Bem vindo',
                                    'Lojista > Esqueci minha senha',
                                    'Lojista > Venda na loja',
                                    'Lojista > Resumo semanal',
                                    'Cliente > Conta criada com sucesso',
                                    'Cliente > Pedido finalizado',
                                    'Cliente > Rastreio',
                                    'Cliente > Esqueci minha senha',
                                );

                                foreach ($subjects as $key => $value) {
                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                            ?>
                        </select>
                    </label>
                </div>
                <div class="buttons">
                    <input class="btn c-primary" type="submit" name="emailSend" value="Enviar">
                </div>
            </form>
		</div>        
    </div>
</div>
<?*/