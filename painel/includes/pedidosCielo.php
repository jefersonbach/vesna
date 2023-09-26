<?
session_start();
include('class.banco.php');
$resulSeo = new connect();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY, 'pt_BR');
?>
<div style="float:right; text-align:right; width:90px">
    <h2 style="color:#666; font-size:11px; margin:10px 0 0; padding:0; line-height:16px">Informações da</h2>
    <h1 style="color:#666; margin:0px 0 0; padding:0; line-height:25px; font-size:25px">Cielo</h1>
</div>



<?

echo 'asd'.$_POST['tid'];

if($respostaCielo['Payment']['Status'] == '2'){
$respostaCielo = $resulSeo->consultaCielo($_POST['tid']);
?>

<div style="float:left">
    
    <img src="https://www.trazpracaclub.com.br/images/<? if($respostaCielo['Payment']['CreditCard']['Brand']){ echo strtolower($respostaCielo['Payment']['CreditCard']['Brand']);}else{ echo 'card';}?>.png" width="75px" />
                                    
</div>
<div style="float:left; width:110px; margin-left:10px">
                                    <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">Valor Recebido</span>
                                    <strong style="margin:0; line-height:11px; color:#76d411;font:20px/20px 'opensans-regular';"><?=money_format('%n',substr_replace($respostaCielo['Payment']['CapturedAmount'],'.',-2,0))?></strong>
    <span style="color:#888; line-height:11px; margin:0px 0px"><?=$respostaCielo['Payment']['Type']?> <?=$respostaCielo['Payment']['Installments']?>x</span>
                                </div>

<table style="width:100%; margin:0 auto">
				
                <tr>
					<td style="vertical-align: top; padding-bottom:10px; color:#fff;">
						<table>
							<tr>
								<td><h4 style="color:#777; font-size:16px; margin:15px 0 10px">Informações do Pagamento</h4></td>
							</tr>
                            <tr>
                                <td colspan="2">
                                    <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">Status</span>
                                    
                                    <? if($respostaCielo['Payment']['Status'] == '0'){?>
                                        <strong style="margin:0; line-height:11px">Aguardando atualização de status</strong>
                                    <?}elseif($respostaCielo['Payment']['Status'] == '2'){?>
                                        <strong style="margin:0; line-height:11px; color:#76d411">Pagamento confirmado e finalizado</strong>
                                    
                                    <?}elseif($respostaCielo['Payment']['Status'] == '10' or $respostaCielo['Payment']['Status'] == '11'){?>
                                        <strong style="margin:0; line-height:11px; color:#ff4f4f">Pagamento EXTORNADO</strong>
                                    
                                    <?}
									
									
									//echo $respostaCielo['Payment']['Status'];
	
	
	
	
									?>
                                    
                                    
                                    
                                    
                                </td>
                                
                            </tr>
                            <?
                            $datt = strtotime($respostaCielo['Payment']['CapturedDate']);
                            ?>
							<tr>    
                                 <td colspan="2">
                                    <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px; padding:10px 0 0">Data do recebimento</span>
                                    <strong style="margin:0; line-height:11px"><?=ucwords(utf8_encode(strftime('%A, %d de %B de %Y',$datt)));?></strong>
                                </td>
                                
                            </tr>
							<tr>
                                <td colspan="2"><span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px; padding:10px 0 0">Títular do Cartão</span>
                                    <strong style="margin:0; line-height:11px"><?=ucwords($respostaCielo['Payment']['CreditCard']['Holder'])?></strong>
                                </td>
							</tr>
                            <tr>
                                
                                <td>
                                    <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px; padding:10px 0 0">Tid</span>
                                    <strong style="margin:0; line-height:11px"><?=$respostaCielo['Payment']['Tid']?></strong>
                                </td>
                                <td>
                                    <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">Código de Autorização</span>
                                    <strong style="margin:0; line-height:11px"><?=$respostaCielo['Payment']['AuthorizationCode']?></strong>
                                </td>
                                
                            
                            </tr>
                             <tr>
                                <td colspan="2" style="padding-top:20px">
									<? if($respostaCielo['Payment']['Status'] == '2' and ($_SESSION['usuario'] == 'trump' or $_SESSION['usuario'] == 'gabriela pedron' or $_SESSION['usuario'] == 'moreira')){?>
                                    <a href="#modalEstorna<?=$_POST['idPedido']?>"  style="background:#fd2626; color:#fff; width:100%; display:block; padding:10px 0; border:0; border-radius:6px; text-align:center"  data-toggle="modal">Cancelar Venda</a>
                                    <?}?>
                                 </td>
                            </tr>
						</table>
					</td>
                </tr>

</table>
<?
}else{
?><div style="color:#fff"><?
    $prods = $resulSeo->lista('pedidos', 'id = '.$_POST['idPedido'].'');
        foreach($prods as $lis){
            
            $rr = explode(':',$lis['retornoCielo']);
            //echo $rr[1];
            
    ?>
    
    
    
    
                                                                                    <div style=" padding:15px;">
                                                                                            <span style="font:14px/14px 'open_sansregular'; color:#555">Código do Erro</span>
                                                                                            <strong style="margin:0; line-height:21px; color:#fd2626; font:38px/38px 'open_sansregular'"><?=substr($rr[1],0,4)?></strong>

                                                                                            <p style="color:#fff; margin-top:20px; font:16px/16px 'open_sansregular'">
                                                                                            <?  if(substr($rr[1],0,4) == '01'){
                                                                                                    echo 'Transação não autorizada. Referida (suspeita de fraude) pelo banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '02'){
                                                                                                    echo 'Transação não autorizada. Referida (suspeita de fraude) pelo banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '03'){
                                                                                                    echo 'Transação não permitida. Estabelecimento inválido. Entre com contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '04'){
                                                                                                    echo 'Transação não autorizada. Cartão bloqueado pelo banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '05'){
                                                                                                    echo 'Transação não autorizada. Não foi possível processar a transação. Questão relacionada a segurança, inadimplencia ou limite do portador.';
                                                                                                }elseif(substr($rr[1],0,4) == '06'){
                                                                                                    echo 'Transação não autorizada. Não foi possível processar a transação. Cartão cancelado permanentemente pelo banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '07'){
                                                                                                    echo 'Transação não autorizada por regras do banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '08'){
                                                                                                    echo 'Transação não autorizada. Código de segurança inválido. Oriente o portador a corrigir os dados e tentar novamente.';
                                                                                                }elseif(substr($rr[1],0,4) == '09'){
                                                                                                    echo 'Transação cancelada parcialmente com sucesso';
                                                                                                }elseif(substr($rr[1],0,4) == '11'){
                                                                                                    echo 'Transação autorizada com sucesso.';
                                                                                                }elseif(substr($rr[1],0,4) == '12'){
                                                                                                    echo 'Não foi possível processar a transação. Solicite ao portador que verifique os dados do cartão e tente novamente.';
                                                                                                }elseif(substr($rr[1],0,4) == '13'){
                                                                                                    echo 'Transação não permitida. Valor inválido. Solicite ao portador que reveja os dados e novamente. Se o erro persistir, entre em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '14'){
                                                                                                    echo 'Transação não autorizada. Cartão inválido. Pode ser bloqueio do cartão no banco emissor, dados incorretos ou tentativas de testes de cartão. Use o Algoritmo de Lhum (Mod 10) para evitar transações não autorizadas por esse motivo. Consulte www.cielo.com.br/desenvolvedores para implantar o Algoritmo de Lhum.';
                                                                                                }elseif(substr($rr[1],0,4) == '15'){
                                                                                                    echo 'Transação não autorizada. Banco emissor indisponível.';
                                                                                                }elseif(substr($rr[1],0,4) == '19'){
                                                                                                    echo 'Não foi possível processar a transação. Refaça a transação ou tente novamente mais tarde. Se o erro persistir, entre em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '21'){
                                                                                                    echo 'Não foi possível processar o cancelamento. Se o erro persistir, entre em contato com a Cielo.'; 
                                                                                                }elseif(substr($rr[1],0,4) == '22'){
                                                                                                    echo 'Não foi possível processar a transação. Número de parcelas inválidas. Se o erro persistir, entre em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '23'){
                                                                                                    echo 'Não foi possível processar a transação. Valor da prestação inválido. Se o erro persistir, entre em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '24'){
                                                                                                    echo 'Não foi possível processar a transação. Quantidade de parcelas inválido. Se o erro persistir, entre em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '25'){
                                                                                                    echo 'Não foi possível processar a transação. Solicitação de autorização não enviou o número do cartão. Se o erro persistir, verifique a comunicação entre loja virtual e Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '28'){
                                                                                                    echo 'Não foi possível processar a transação. Arquivo temporariamente indisponível. Reveja a comunicação entre Loja Virtual e Cielo. Se o erro persistir, entre em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '30'){
                                                                                                    echo 'Não foi possível processar a transação. Solicite ao portador que reveja os dados e tente novamente. Se o erro persistir verifique a comunicação com a Cielo esta sendo feita corretamente';
                                                                                                }elseif(substr($rr[1],0,4) == '39'){
                                                                                                    echo 'Transação não autorizada. Erro no banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '41'){
                                                                                                    echo 'Transação não autorizada. Cartão bloqueado por perda.';
                                                                                                }elseif(substr($rr[1],0,4) == '43'){
                                                                                                    echo 'Transação não autorizada. Cartão bloqueado por roubo.';
                                                                                                }elseif(substr($rr[1],0,4) == '51'){
                                                                                                    echo 'Transação não autorizada. Limite excedido/sem saldo.';
                                                                                                }elseif(substr($rr[1],0,4) == '52'){
                                                                                                    echo 'Não foi possível processar a transação. Cartão com dígito de controle inválido.';
                                                                                                }elseif(substr($rr[1],0,4) == '53'){
                                                                                                    echo 'Transação não permitida. Cartão poupança inválido.';
                                                                                                }elseif(substr($rr[1],0,4) == '54'){
                                                                                                    echo 'Transação não autorizada. Cartão vencido.';
                                                                                                }elseif(substr($rr[1],0,4) == '55'){
                                                                                                    echo 'Transação não autorizada. Senha inválida.';
                                                                                                }elseif(substr($rr[1],0,4) == '57'){
                                                                                                    echo 'Transação não autorizada. Transação não permitida para o cartão.';
                                                                                                }elseif(substr($rr[1],0,4) == '58'){
                                                                                                    echo 'Transação não permitida. Opção de pagamento inválida. Reveja se a opção de pagamento escolhida está habilitada no cadastro';
                                                                                                }elseif(substr($rr[1],0,4) == '59'){
                                                                                                    echo 'Transação não autorizada. Suspeita de fraude.';
                                                                                                }elseif(substr($rr[1],0,4) == '60'){
                                                                                                    echo 'Transação não autorizada. Tente novamente. Se o erro persistir o portador deve entrar em contato com o banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '61'){
                                                                                                    echo 'Transação não autorizada. Banco emissor indisponível.';
                                                                                                }elseif(substr($rr[1],0,4) == '62'){
                                                                                                    echo 'Transação não autorizada. Cartão restrito para uso doméstico.';
                                                                                                }elseif(substr($rr[1],0,4) == '63'){
                                                                                                    echo 'Transação não autorizada. Violação de segurança.';
                                                                                                }elseif(substr($rr[1],0,4) == '64'){
                                                                                                    echo 'Transação não autorizada. Entre em contato com seu banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '65'){
                                                                                                    echo 'Transação não autorizada. Excedida a quantidade de transações para o cartão.';
                                                                                                }elseif(substr($rr[1],0,4) == '67'){
                                                                                                    echo 'Transação não autorizada. Cartão bloqueado para compras hoje. Bloqueio pode ter ocorrido por excesso de tentativas inválidas. O cartão será desbloqueado automaticamente à meia noite.';
                                                                                                }elseif(substr($rr[1],0,4) == '70'){
                                                                                                    echo 'Transação não autorizada. Limite excedido/sem saldo.';
                                                                                                }elseif(substr($rr[1],0,4) == '72'){
                                                                                                    echo 'Cancelamento não efetuado. Saldo disponível para cancelamento insuficiente. Se o erro persistir, entre em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '74'){
                                                                                                    echo 'Transação não autorizada. A senha está vencida.';
                                                                                                }elseif(substr($rr[1],0,4) == '75'){
                                                                                                    echo 'Transação não autorizada.';
                                                                                                }elseif(substr($rr[1],0,4) == '76'){
                                                                                                    echo 'Cancelamento não efetuado. Banco emissor não localizou a transação original';
                                                                                                }elseif(substr($rr[1],0,4) == '77'){
                                                                                                    echo 'Cancelamento não efetuado. Não foi localizado a transação original';
                                                                                                }elseif(substr($rr[1],0,4) == '78'){
                                                                                                    echo 'Transação não autorizada. Cartão bloqueado primeiro uso. Solicite ao portador que desbloqueie o cartão diretamente com seu banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '80'){
                                                                                                    echo 'Transação não autorizada. Data da transação ou data do primeiro pagamento inválida.';
                                                                                                }elseif(substr($rr[1],0,4) == '82'){
                                                                                                    echo 'Transação não autorizada. Cartão Inválido. Solicite ao portador que reveja os dados e tente novamente.';
                                                                                                }elseif(substr($rr[1],0,4) == '83'){
                                                                                                    echo 'Transação não autorizada. Erro no controle de senhas';
                                                                                                }elseif(substr($rr[1],0,4) == '85'){
                                                                                                    echo 'Transação não permitida. Houve um erro no processamento.Solicite ao portador que digite novamente os dados do cartão, se o erro persistir pode haver um problema no terminal do lojista, nesse caso o lojista deve entrar em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '86'){
                                                                                                    echo 'Transação não permitida. Houve um erro no processamento.Solicite ao portador que digite novamente os dados do cartão, se o erro persistir pode haver um problema no terminal do lojista, nesse caso o lojista deve entrar em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '88'){
                                                                                                    echo 'Falha na criptografia dos dados.';
                                                                                                }elseif(substr($rr[1],0,4) == '89'){
                                                                                                    echo 'Transação não autorizada. Erro na transação. O portador deve tentar novamente e se o erro persistir, entrar em contato com o banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == '90'){
                                                                                                    echo 'Transação não permitida. Houve um erro no processamento.Solicite ao portador que digite novamente os dados do cartão, se o erro persistir pode haver um problema no terminal do lojista, nesse caso o lojista deve entrar em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '91'){
                                                                                                    echo 'Transação não autorizada. Banco emissor temporariamente indisponível.';
                                                                                                }elseif(substr($rr[1],0,4) == '92'){
                                                                                                    echo 'Transação não autorizada. Tempo de comunicação excedido.';
                                                                                                }elseif(substr($rr[1],0,4) == '93'){
                                                                                                    echo 'Transação não autorizada. Violação de regra - Possível erro no cadastro.';
                                                                                                }elseif(substr($rr[1],0,4) == '94'){
                                                                                                    echo 'Transação duplicada enviado para autorização/captura.';
                                                                                                }elseif(substr($rr[1],0,4) == '96'){
                                                                                                    echo 'Não foi possível processar a transação. Falha no sistema da Cielo. Se o erro persistir, entre em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == '97'){
                                                                                                    echo 'Transação não autorizada. Valor não permitido para essa transação.';
                                                                                                }elseif(substr($rr[1],0,4) == '98'){
                                                                                                    echo 'Transação não autorizada. Sistema do emissor sem comunicação. Se for geral, verificar SITE, GATEWAY e/ou Conectividade.';
                                                                                                }elseif(substr($rr[1],0,4) == '99'){
                                                                                                    echo 'Transação não autorizada. Sistema do emissor sem comunicação. Tente mais tarde. Pode ser erro no SITE, favor verificar !';
                                                                                                }elseif(substr($rr[1],0,4) == '475'){
                                                                                                    echo 'A aplicação não respondeu dentro do tempo esperado.';
                                                                                                }elseif(substr($rr[1],0,4) == '999'){
                                                                                                    echo 'Transação não autorizada. Sistema do emissor sem comunicação. Tente mais tarde. Pode ser erro no SITE, favor verificar !';
                                                                                                }elseif(substr($rr[1],0,4) == 'AA'){
                                                                                                    echo 'Tempo excedido na comunicação com o banco emissor. Oriente o portador a tentar novamente, se o erro persistir será necessário que o portador contate seu banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'AC'){
                                                                                                    echo 'Transação não permitida. Cartão de débito sendo usado com crédito. Solicite ao portador que selecione a opção de pagamento Cartão de Débito.';
                                                                                                }elseif(substr($rr[1],0,4) == 'AE'){
                                                                                                    echo 'Tempo excedido na comunicação com o banco emissor. Oriente o portador a tentar novamente, se o erro persistir será necessário que o portador contate seu banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'AF'){
                                                                                                    echo 'Transação não permitida. Houve um erro no processamento.Solicite ao portador que digite novamente os dados do cartão, se o erro persistir pode haver um problema no terminal do lojista, nesse caso o lojista deve entrar em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == 'AG'){
                                                                                                    echo 'Transação não permitida. Houve um erro no processamento.Solicite ao portador que digite novamente os dados do cartão, se o erro persistir pode haver um problema no terminal do lojista, nesse caso o lojista deve entrar em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == 'AH'){
                                                                                                    echo 'Transação não permitida. Cartão de crédito sendo usado com débito. Solicite ao portador que selecione a opção de pagamento Cartão de Crédito.';
                                                                                                }elseif(substr($rr[1],0,4) == 'AI'){
                                                                                                    echo 'Transação não autorizada. Autenticação não foi realizada. O portador não concluiu a autenticação. Solicite ao portador que reveja os dados e tente novamente. Se o erro persistir, entre em contato com a Cielo informando o BIN (6 primeiros dígitos do cartão)';
                                                                                                }elseif(substr($rr[1],0,4) == 'AJ'){
                                                                                                    echo 'Transação não permitida. Transação de crédito ou débito em uma operação que permite apenas Private Label. Solicite ao portador que tente novamente selecionando a opção Private Label. Caso não disponibilize a opção Private Label verifique na Cielo se o seu estabelecimento permite essa operação.';           
                                                                                                }elseif(substr($rr[1],0,4) == 'AV'){
                                                                                                    echo 'Falha na validação dos dados da transação. Oriente o portador a rever os dados e tentar novamente.';
                                                                                                }elseif(substr($rr[1],0,4) == 'BD'){
                                                                                                    echo 'Transação não permitida. Houve um erro no processamento. Solicite ao portador que digite novamente os dados do cartão, se o erro persistir pode haver um problema no terminal do lojista, nesse caso o lojista deve entrar em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == 'BL'){
                                                                                                    echo 'Transação não autorizada. Limite diário excedido. Solicite ao portador que entre em contato com seu banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'BM'){
                                                                                                    echo 'Transação não autorizada. Cartão inválido. Pode ser bloqueio do cartão no banco emissor ou dados incorretos. Tente usar o Algoritmo de Lhum (Mod 10) para evitar transações não autorizadas por esse motivo.';
                                                                                                }elseif(substr($rr[1],0,4) == 'BN'){
                                                                                                    echo 'Transação não autorizada. O cartão ou a conta do portador está bloqueada. Solicite ao portador que entre em contato com seu banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'BO'){
                                                                                                    echo 'Transação não permitida. Houve um erro no processamento. Solicite ao portador que digite novamente os dados do cartão, se o erro persistir, entre em contato com o banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'BP'){
                                                                                                    echo 'Transação não autorizada. Não possível processar a transação por um erro relacionado ao cartão ou conta do portador. Solicite ao portador que entre em contato com o banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'BP176'){
                                                                                                    echo 'Parceiro deve checar se o processo de integração foi concluído com sucesso.';
                                                                                                }elseif(substr($rr[1],0,4) == 'BV'){
                                                                                                    echo 'Transação não autorizada. Cartão vencido.';
                                                                                                }elseif(substr($rr[1],0,4) == 'CF'){
                                                                                                    echo 'Transação não autorizada. Falha na validação dos dados. Solicite ao portador que entre em contato com o banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'CG'){
                                                                                                    echo 'Transação não autorizada. Falha na validação dos dados. Solicite ao portador que entre em contato com o banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'DA'){
                                                                                                    echo 'Transação não autorizada. Falha na validação dos dados. Solicite ao portador que entre em contato com o banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'DF'){
                                                                                                    echo 'Transação não permitida. Falha no cartão ou cartão inválido. Solicite ao portador que digite novamente os dados do cartão, se o erro persistir, entre em contato com o banco';
                                                                                                }elseif(substr($rr[1],0,4) == 'DM'){
                                                                                                    echo 'Transação não autorizada. Limite excedido/sem saldo.';
                                                                                                }elseif(substr($rr[1],0,4) == 'DQ'){
                                                                                                    echo 'Transação não autorizada. Falha na validação dos dados. Solicite ao portador que entre em contato com o banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'DS'){
                                                                                                    echo 'Transação não autorizada. Transação não permitida para o cartão.';
                                                                                                }elseif(substr($rr[1],0,4) == 'EB'){
                                                                                                    echo 'Transação não autorizada. Limite diário excedido. Solicite ao portador que entre em contato com seu banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'EE'){
                                                                                                    echo 'Transação não permitida. Valor da parcela inferior ao mínimo permitido. Não é permitido parcelas inferiores a R$ 5,00. Necessário rever calculo para parcelas.';
                                                                                                }elseif(substr($rr[1],0,4) == 'EK'){
                                                                                                    echo 'Transação não autorizada. Transação não permitida para o cartão.';
                                                                                                }elseif(substr($rr[1],0,4) == 'FA'){
                                                                                                    echo 'Transação não autorizada AmEx.';
                                                                                                }elseif(substr($rr[1],0,4) == 'FC'){
                                                                                                    echo 'Transação não autorizada. Oriente o portador a entrar em contato com o banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'FD'){
                                                                                                    echo 'Transação não autorizada por regras do banco emissor.';
                                                                                                }elseif(substr($rr[1],0,4) == 'FE'){
                                                                                                    echo 'Transação não autorizada. Data da transação ou data do primeiro pagamento inválida.';
                                                                                                }elseif(substr($rr[1],0,4) == 'FF'){
                                                                                                    echo 'Transação de cancelamento autorizada com sucesso. ATENÇÂO: Esse retorno é para casos de cancelamentos e não para casos de autorizações.';
                                                                                                }elseif(substr($rr[1],0,4) == 'FG'){
                                                                                                    echo 'Transação não autorizada. Oriente o portador a entrar em contato com a Central de Atendimento AmEx.';
                                                                                                }elseif(substr($rr[1],0,4) == 'GA'){
                                                                                                    echo 'Transação não autorizada. Referida pelo Lynx Online de forma preventiva.';
                                                                                                }elseif(substr($rr[1],0,4) == 'GD'){
                                                                                                    echo 'Transação não permitida. Entre em contato com a Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == 'HJ'){
                                                                                                    echo 'Transação não permitida. Código da operação Coban inválido.';
                                                                                                }elseif(substr($rr[1],0,4) == 'IA'){
                                                                                                    echo 'Transação não permitida. Indicador da operação Coban inválido.';
                                                                                                }elseif(substr($rr[1],0,4) == 'JB'){
                                                                                                    echo 'Transação não permitida. Valor da operação Coban inválido.';
                                                                                                }elseif(substr($rr[1],0,4) == 'KA'){
                                                                                                    echo 'Transação não permitida. Houve uma falha na validação dos dados. Solicite ao portador que reveja os dados e tente novamente. Se o erro persistir verifique a comunicação entre loja virtual e Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == 'KB'){
                                                                                                    echo 'Transação não permitida. Selecionado a opção incorreta. Solicite ao portador que reveja os dados e tente novamente. Se o erro persistir deve ser verificado a comunicação entre loja virtual e Cielo.';
                                                                                                 }elseif(substr($rr[1],0,4) == 'KE'){
                                                                                                    echo 'Transação não autorizada. Falha na validação dos dados. Opção selecionada não está habilitada. Verifique as opções disponíveis para o portador.';
                                                                                                }elseif(substr($rr[1],0,4) == 'N7'){
                                                                                                    echo 'Transação não autorizada. Código de segurança inválido. Oriente o portador corrigir os dados e tentar novamente.';
                                                                                                }elseif(substr($rr[1],0,4) == 'R1'){
                                                                                                    echo 'Transação não autorizada. Não foi possível processar a transação. Questão relacionada a segurança, inadimplencia ou limite do portador.';
                                                                                                }elseif(substr($rr[1],0,4) == 'U3'){
                                                                                                    echo 'Transação não permitida. Houve uma falha na validação dos dados. Solicite ao portador que reveja os dados e tente novamente. Se o erro persistir verifique a comunicação entre loja virtual e Cielo.';
                                                                                                }elseif(substr($rr[1],0,4) == 'GD'){
                                                                                                    echo 'Transação não permitida';
                                                                                                }else{?>
                                                                                                
                                                                                                <?=preg_replace("/[^A-Za-z]/", " ", $rr[2]);}?></p>
    
    
    
    
            <?
			}
    
?>
</div>

<?}


?>


