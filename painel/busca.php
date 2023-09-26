<?
include('includes/topo.php');
$busc = $_GET['busca'];


?>
<script>
	$(document).ready(function(){
		<?
		if($diag == "sim"){?>Dialogo("sim", "<?=$p?> cadastrado com sucesso!");<?
		}elseif($diag == "nao"){ ?>Dialogo("nao", "Erro ao cadastrar <?=$p?>!");<?
		}elseif($diag == "sime"){?>Dialogo("sim", "<?=$p?> editado com sucesso!");<?
		}elseif($diag == "naoe"){?>Dialogo("nao", "Erro ao editar <?=$p?>.");<? } 
		
		$delP = $emp->deleta($_GET['excluir'], 'lojas');
		if($delP == "sim"){?>Dialogo("sim", "<?=$p?> excluído com sucesso!");<?
		}elseif($delP == "nao"){?>Dialogo("nao", "Erro ao excluir <?=$p?>s.");<?
		}
		?>
	});
</script>
<style>
.help-inline{font-size:11px}
</style>

<div id="contentLists">


<?

if($busc == 'todos' or $busc == ''){
	//$Busca = array('codigo');
	
	//if($teste){
?>
<div id="contentTitu">
	<h1>Buscando por: <?=$_GET['whe']?></h1>
	
	<div class="controle">&nbsp;</div>
</div>
  
<div class="caixa-conteudo" style="margin:0px 0px 0 0 !important; color:#fff; top:90px; right:0px" data-spy="affix" data-offset-top="135" affix-top="0">
    	<table class="table table-striped" width="100%" cellpadding="0" style="margin-top:0 !important">
             <thead style="background:#444 url(images/bgTable.png); padding:40px 30px !important; color:#fff">
                <tr>
                	<td style="padding:0 !important" width="5px"></td>
                    <td style="padding:10px 30px !important;"><a href="?ordem=nome&a=<? if($_GET['a'] == 'ASC'){echo 'DESC';}else{echo 'ASC';}?>"><span class="tituTab" style="float:left"></span><? if($_GET['ordem'] == 'nome' and $_GET['a'] == 'ASC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-down icon-white">&nbsp;</span>';}elseif($_GET['ordem'] == 'nome' and $_GET['a'] == 'DESC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-up icon-white">&nbsp;</span>';}?></a></td>
                	<td style="padding:10px 30px !important; text-align:center" width="20%"><a href="?ordem=titulo&a=<? if($_GET['a'] == 'ASC'){echo 'DESC';}else{echo 'ASC';}?>"><span style="float:left" class="tituTab">Nome da loja</span><? if($_GET['ordem'] == 'nome' and $_GET['a'] == 'ASC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-down icon-white">&nbsp;</span>';}elseif($_GET['ordem'] == 'titulo	' and $_GET['a'] == 'DESC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-up icon-white">&nbsp;</span>';}?></a></td>
					<td style="padding:10px 30px !important; text-align:center" width="15%"><a href="?ordem=titulo&a=<? if($_GET['a'] == 'ASC'){echo 'DESC';}else{echo 'ASC';}?>"><span style="float:left" class="tituTab">Dono / Responsavel</span><? if($_GET['ordem'] == 'nome' and $_GET['a'] == 'ASC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-down icon-white">&nbsp;</span>';}elseif($_GET['ordem'] == 'titulo	' and $_GET['a'] == 'DESC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-up icon-white">&nbsp;</span>';}?></a></td>
					<td style="padding:10px 30px !important; text-align:center" width="15%"><a href="?ordem=titulo&a=<? if($_GET['a'] == 'ASC'){echo 'DESC';}else{echo 'ASC';}?>"><span style="float:left" class="tituTab">Vendas</span><? if($_GET['ordem'] == 'nome' and $_GET['a'] == 'ASC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-down icon-white">&nbsp;</span>';}elseif($_GET['ordem'] == 'titulo	' and $_GET['a'] == 'DESC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-up icon-white">&nbsp;</span>';}?></a></td>
					<td style="padding:10px 30px !important; text-align:center" width="15%"><a href="?ordem=titulo&a=<? if($_GET['a'] == 'ASC'){echo 'DESC';}else{echo 'ASC';}?>"><span style="float:left" class="tituTab">Cartãos</span><? if($_GET['ordem'] == 'nome' and $_GET['a'] == 'ASC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-down icon-white">&nbsp;</span>';}elseif($_GET['ordem'] == 'titulo	' and $_GET['a'] == 'DESC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-up icon-white">&nbsp;</span>';}?></a></td>

                    <td style="padding:10px 30px !important; text-align:center" width="10%"></td>
                </tr>
            </thead>
        </table>
        </div> 
	<table class="table table-striped" width="100%" style="margin-top:30px" cellpadding="0">
		<thead style="background: url(images/bgTable.png); padding:40px 30px !important; color:#fff">
			<tr>
				<td style="padding:0 !important" width="5px"></td>
				<td style="padding:10px 30px !important; text-align:center" width="5%"><span class="tituTab">Nome</span></td>
				<td style="padding:10px 30px !important;"><span class="tituTab" width="35%">Descrição</span></td>
				<td style="padding:10px 30px !important; text-align:center" width="45%"><span class="tituTab">Família</span></td>
				<td style="padding:10px 30px !important; text-align:center" width="10%"></td>
			</tr>
		</thead>
		
	  <tbody>
		<? 
			//$prods = $bus->lista('produtos',$fam);
			$teste = $emp->lista('lojas', "nome like '%".$_GET['whe']."%' or email like '%".$_GET['whe']."%' or celular like '%".$_GET['whe']."%'");
			foreach($teste as $lis){
				$lojaConfig = $emp->lista('lojas_configuracoes',"id_lj = '".$lis['id_lj']."'");
				?>
					<tr class="item" style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
						<td style="background:<? if($lis['ativo']=='Sim'){echo '#038800';}else{echo '#a80000';}?> !important; padding:0"></td>
						<td><?
						//$prodsImg = $resulSeo->lista($p.'imagens','token = "'.$lis['token'].'"');
						?>
							<a href="cad_<?=$p?>.php?editar=<?=$lisImg['id']?>" class="thumbnail">
								<img src="http://www.trazpracaclub.com.br/painel/storage/users/<?=$lis['id_lj']?>/logotipo.png" style=" width:50px" alt="<?=$lisImg['legenda']?>" class="img-rounded img-polaroid" />
							</a>
						
						</td>
						<td style="padding:0"><div style="border-right:1px solid #ccc; line-height:13px; padding:0 10px">
						<strong><?=$lojaConfig[0]['title']?></strong><br />
						<span style="font-size:11px"><?=$lis['data']?></span>
						<? if($lis['indicado']){?><br /><span style="font-size:11px">Indicado: <strong><?=$lis['indicado']?></strong></span><?}?><br />
						<? if($lojaConfig[0]['dominio']){?><a href="<?=$lojaConfig[0]['dominio']?>"><?=$lojaConfig[0]['dominio']?></a>
						<? }else{?>
							<a href="http://<?=$lojaConfig[0]['dominioTemp']?>.trazpracaclub.com.br" style="font-size:11px"><?=$lojaConfig[0]['dominioTemp']?>.trazpracaclub.com.br</a>
							
						<?} ?>
						</div></td>
						<td style="padding:0"><div style="border-right:1px solid #ccc; padding:15px 10px">
							<strong><?=$lis['nome']?></strong><br />
							<a href="mailto:<?=$lis['email']?>" style="font-size:11px"><?=$lis['email']?></a><br />
							<a href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?=$lis['celular']?>" class="wp-fixed" target="_blank" style="font-size:11px; padding:3px 12px; background:#34af23; color:#fff; font-weight:900; border-radius:30px"><?=$lis['celular']?></a>
						
						</div></td>
						<td style="padding:0">
							<div style="border-right:1px solid #ccc; padding:30px 25px; font-size:12px">
									<strong>0</strong> <span>Vendas</span><br />
									<span>Total vendido </span><strong> R$0,00 </strong><br />
									<span>Comissão total </span></span><strong> R$0,00</strong>
		
							</div>
						</td>
						<td style="padding:0">
							<div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
							<?=$lis['creditos']?> dias pagos<br />
							<? if($lis['card_number']){?>
									<span style="font-size:11px">Cartão preenchido</span> <div style="float:left;margin:8px 5px 0 0; width:12px; height:12px; background:#65ff60; border-radius:50%; border:2px solid #fff; box-shadow:0 4px 8px rgba(0,0,0,0.15)"></div>
							<? }else{?>
								<span style="font-size:11px">Cartão não cadastrado</span> <div style="float:left; margin:8px 5px 0 0; width:12px; height:12px; background:#ff6060; border-radius:50%; border:2px solid #fff; box-shadow:0 4px 8px rgba(0,0,0,0.15)"></div>
							<?}?>
								
							</div>
						</td>
						<td style="text-align:center;padding:0">
							<div style="border-left:1px solid #fff">
								<div style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
									<a href="cad_<?=$p?>.php?editar=<?=$lis['id']?>&token=<?=$lis['token']?>" class="icon-edit">&nbsp;</a>
									<a href="#modalExcl<?=$lis['id']?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
								</div>
							</div>
						</td>
					</tr>

			<div id="modalExcl<?=$lis['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<h3 id="myModalLabel" style="color:#099209">Excluir</h3>
				</div>
				<div class="modal-body2" style="padding:20px">
					<p>Tem certeza que deseja excluir este registro?</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
					<a href="<? if($p == 'news'){echo 'newsletter';}else{echo $p;}?>.php?excluir=<?=$lis['id']?>&table=<?=$p?>&familia=<?=$_GET['familia']?>" class="btn btn-primary">Confirmar</a>
				  </div>
			</div>
		  <? } } ?>
		</tbody>
	</table>
</div>
<? include('includes/rodape.php') ?>     
