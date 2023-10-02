<?
include('class.banco.php');
$resulSeo = new conect();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');







if($_POST['id']){ 
			$prods = $resulSeo->lista('notas', 'idPedido = '.$_POST['id'].'');
			foreach($prods as $lis){
				
	
} } ?>		


   <h2 style="color:#666; font-size:11px; margin:10px 0 0; padding:0; line-height:16px">Informar </h2>
    <h1 style="color:#666; margin:0px 0 0; padding:0; line-height:25px; font-size:25px">NOTA FISCAL</h1>
</div>

		
<div class="controle">&nbsp;</div>
		<div id="contentTitu" style="margin:0 5px; text-align: left;color:#fff;">
			<form method="post" action="/painel/pedidos.php" enctype="multipart/form-data">
				<input type="hidden" value="<?=$_POST['id']?>" name="idPedido" />
				<input type="hidden" value="<?=$lis['id']?>" name="id" />
				<table style="width:100%; margin:0 auto">

					
					
					
					<tr>
						<td style="vertical-align: top; padding-bottom:10px; padding-top:15px">
							<table>
								
								<tr>
									<td>
										<input type="radio" name="nota" value="Sim" style="float:left" <? if($lis['nota'] !=  'Sem Nota'){ $opacit=1;?>checked<?}else{$opacit=0.2;}?> onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" />
										<h4 style="color:#777; font-size:16px; margin:0px 10px 10px; float:left">Informar nota fiscal</h4>
										<div class="controle">&nbsp;</div>
										<span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px; padding:10px 0 0">Ao salvar a nota fiscal é enviada automaticamente para o cliente.</span>
										
									</td>
								</tr>
								<tbody  id="ifYes" style="opacity:<?=$opacit?>; padding-bottom:15px">
								<tr>
									<td>
										<h4 style="color:#777; font-size:16px; margin:15px 0 10px">XML da Nota</h4>
										<textarea name="xml" style="width:100%; font-size:9px; line-height:12px"><?=$lis['xml']?></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<h4 style="color:#777; font-size:16px; margin:15px 0 10px">Anexar Nota (PDF)</h4>
										<input type="file" name="arquivo" />
									</td>
								</tr>
									</tbody>
								<tr>
									<td style="padding-top:15px; border-top:1px solid #555">
										<input type="radio" name="nota" value="Sem Nota" style="float:left" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" <? if($lis['nota'] ==  'Sem Nota'){?>checked<?}?>   />
										<h4 style="color:#777; font-size:16px; margin:0px 10px 10px; float:left">Não informar nota fiscal</h4>
										<div class="controle">&nbsp;</div>
										<span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px; padding:10px 0 0">Usar apenas a declaração de conteúdo (gerada automáticamente)</span>
										<span style="width:100%; display:block; color:#555; font-size:11px; line-height:11px; padding:10px 0 0">Usar esta opção pode impossibilitar a compra do frete na Jadlog e Transportes Rodoviários</span>

									</td>
								</tr>
							</table>
						</td>
					</tr>


				</table>
			<input type="submit" name="cadNota" id="btnSalvaNota" class="btn" style="display:inline-block; background:#000; color:#fff; line-height:12px; border:0; width:100%; padding:13px 0px; width:100%;" value="Anexar Nota Fiscal ao pedido" />
			</form>
</div>
