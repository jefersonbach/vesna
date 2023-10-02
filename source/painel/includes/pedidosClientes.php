<?
include('class.banco.php');
$resulSeo = new connect();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>
<div style="float:right; text-align:right; width:90px">
    <h2 style="color:#666; font-size:11px; margin:10px 0 0; padding:0; line-height:16px">Informações do</h2>
    <h1 style="color:#666; margin:0px 0 0; padding:0; line-height:25px; font-size:25px">Cliente</h1>
</div>

<? if($_POST['cliente']){ 
			$prods = $resulSeo->lista('lojas_clientes', 'id = '.$_POST['cliente'].'');
			foreach($prods as $lis){
				extract($lis);
			}
		
		}
?><? $nomeCliente = $nome; ?>
			<div style="float:left; text-align:left; max-width: calc(100% - 100px)">
    <h1 style="font-size:21px; line-height:21px; color:#fff; float:none; margin:15px 5px 0"><?=$nome?></h1>
                <a href="mailto:<?=$email?>" style="margin:0 5px"><?=$email?></a>
</div>
<div class="controle">&nbsp;</div>
		<div id="contentTitu" style="margin:0 5px; text-align: left;color:#fff;">
			<table style="width:100%; margin:0 auto">
				
                <tr>
					<td style="vertical-align: top; padding-bottom:10px">
						<table>
							<tr>
								<td><h4 style="color:#777; font-size:16px; margin:15px 0 10px">Informações Pessoais</h4></td>
							</tr>
							<tr>
								<td>
									<span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">Celular</span><strong style="margin:0; line-height:11px"><?=$celular?></strong>
								</td>
                                <td><span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">CPF</span><strong style="margin:0; line-height:11px"><?=$cpf?></strong></td>
							</tr>
						</table>
					</td>
                </tr>
                <tr>
					<td style="vertical-align: top; padding:5px 0 15px 0; border-top:1px solid #444; border-bottom:1px solid #444;">
						<table>
                            <tr>
                                <td width="180">
                                    <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">Endereço</span>
                                    <strong style="margin:0; line-height:11px"><?=$rua?>, <?=$numero?></strong>
                                </td>
                                <td width="100" style="padding:8px 0 0">
                                    <a href="#" class="btn" style="background:#000; color:#fff; line-height:12px; border:0; padding:7px 15px; font-size:11px">Ver no Mapa</a>
                                </td>
							</tr>
                        </table>
                        <table style="width:100%">
							<tr>
                                <td width="80" style="padding: 10px 0 0">
                                    <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">CEP</span>
                                    <strong style="margin:0; line-height:11px"><?=$cep?></strong>
                                </td>
                                <td style="padding: 10px 20px 0">
                                    <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">Cidade</span>
                                    <strong style="margin:0; line-height:11px"><?=$cidade?></strong>
                                </td>
                                <td style="padding: 10px 0 0">
                                    <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">Estado</span>
                                    <strong style="margin:0; line-height:11px"><?=$estado?></strong>
                                </td>
							</tr>
						</table>
					</td>
                </tr>
                <tr>
					<td style="vertical-align: top">
						<table style="width:100%">
							<tr>
								<td><h4 style="color:#777; font-size:16px">Informações</h4></td>
							</tr>
							<tr>
                                                            <td>	
                                                                <?
                                                                $date = strtotime(str_replace('/', '-', $clienteDesde));
                                                                ?>
                                                                <span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px">Cliente desde </span>
                                                                <strong style="margin:0; line-height:11px"><?=date('d M \d\e o', $date);?></strong>
                                                            </td>
                                                            
                                            <strong <? if($perfilCompleto == 'sim'){?>style="display:inline-block; background:#92dd00; color:#444; padding:5px 10px; margin:3px; border-radius:5px"<?}else{?>style="display:inline-block;background:#FF4649; border-radius:5px; color:#ffffff; padding:8px 15px; margin:3px;"<?}?>>
                                            <? if($perfilCompleto == 'sim'){?>
                                                Perfil Completo
                                            <?}else{?>
                                                Perfil Imcompleto
                                            <?}?></strong>

									<? if($confirmEmail == 'sim'){?>
										<strong style="display:inline-block; background:#92dd00; color:#444; padding:5px 10px; margin:3px; border-radius:5px">E-mail Confirmado</strong><br />
									<?}else{?>
										<strong style="display:inline-block;background:#FF4649; border-radius:5px; color:#444; padding:5px 10px; margin:3px;">Não confirmou E-mail</strong><br />
									<?}?>
								</td>
                            </tr>
							<tr>
                                <td>
                                    <a href="/painel/cad_clientes.php?cliente=<?=$id?>" class="btn" style="display:inline-block; background:#000; color:#fff; line-height:12px; border:0; width:100%; padding:13px 0px; width:100%;">Ver Perfil Completo</a>
                                </td>
							</tr>
						</table>
					</td>
					
				</tr>
			
			</table>
			
			
			
</div>