<?
include('includes/topo.php');
$nPag = explode('/',$_SERVER['PHP_SELF']);
$p = substr($nPag[2],0,-4);
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


if($_POST){
	$post['clean_url'] = $resulSeo->clean_url($_POST['nome']);
	unset($post['casa']);

	if(isset($_POST["pai"])){
		// Retrieving each selected option
		foreach ($_POST['pai'] as $paiall){
			$pai[] = $paiall;
		}
		$post['pai'] = implode(',', $pai);
	}


	//echo "<pre>";
	//print_r($post["pai"]);
	//echo "</pre>";
	
	$post['regras'] = serialize($_POST['casa']);
	
	$diag = $resulSeo->cadastros($post, $p);
}
?>
<script>
	$(document).ready(function(){
		<?
		if($diag == "sim"){?>Dialogo("sim", "<?=$p?> cadastrado com sucesso!");<?
		}elseif($diag == "nao"){ ?>Dialogo("nao", "Erro ao cadastrar <?=$p?>!");<?
		}elseif($diag == "sime"){?>Dialogo("sim", "<?=$p?> editado com sucesso!");<?
		}elseif($diag == "naoe"){?>Dialogo("nao", "Erro ao editar <?=$p?>.");<? } 
		
		$delP = $resulSeo->deleta($_GET['excluir'], $p);
		if($delP == "sim"){?>Dialogo("sim", "<?=$p?> excluído com sucesso!");<?
		}elseif($delP == "nao"){?>Dialogo("nao", "Erro ao excluir <?=$p?>s.");<?
		}
		?>
	});
</script>
<div id="contentTitu">
	<h1><?=$resulSeo->maiuscula($p)?></h1>
	 <div id="btnF">
			<a href="<?=$p?>.php" class="btngSel">Listar <?=$p?></a>
			<a href="cad_<?=$p?>.php" class="btng">Cadastrar <?=$p?></a>
		</div>
	<div class="controle">&nbsp;</div>
</div>
<div id="contentLists">
	<div class="caixa-conteudo" style="margin:0px 0px 0 0 !important; color:#fff; top:90px; right:0px" data-spy="affix" data-offset-top="135" affix-top="0">
    	<table class="table table-striped" width="100%" cellpadding="0" style="margin-top:0 !important">
             <thead style="background:#444 url(images/bgTable.png); padding:40px 30px !important; color:#fff">
                <tr>
                	<td style="padding:0 !important" width="5px"></td>
                    <td style="padding:10px 10px !important;"><a href="?ordem=nome&a=<? if($_GET['a'] == 'ASC'){echo 'DESC';}else{echo 'ASC';}?>"><span class="tituTab" style="float:left">Nome da Empresa</span><? if($_GET['ordem'] == 'nome' and $_GET['a'] == 'ASC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-down icon-white">&nbsp;</span>';}elseif($_GET['ordem'] == 'nome' and $_GET['a'] == 'DESC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-up icon-white">&nbsp;</span>';}?></a></td>
                	<td style="padding:10px 10px !important" width="70px">Regras</td>
					<td style="padding:10px 10px !important" width="70px">Usuários</td>
					
					<td style="padding:10px 10px !important; text-align:center" width="300px"><a href="?ordem=titulo&a=<? if($_GET['a'] == 'ASC'){echo 'DESC';}else{echo 'ASC';}?>"><span style="float:left" class="tituTab">Última atualização de relatório</span><? if($_GET['ordem'] == 'nome' and $_GET['a'] == 'ASC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-down icon-white">&nbsp;</span>';}elseif($_GET['ordem'] == 'titulo	' and $_GET['a'] == 'DESC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-up icon-white">&nbsp;</span>';}?></a></td>
                    <td style="padding:10px 30px !important; text-align:center" width="80px"></td>
                </tr>
            </thead>
        </table>
        </div> 
	<table class="table table-striped" width="100%" style="margin-top:30px" cellpadding="0">
		<thead style="background: url(images/bgTable.png); padding:40px 30px !important; color:#fff">
			<tr>
				<td style="padding:0 !important" width="5px"></td>
				<td style="padding:10px 30px !important;"><span class="tituTab">Nome da empresa</span></td>
				<td style="padding:10px 10px !important" width="70px">Regras</td>
				<td style="padding:10px 10px !important" width="70px">Usuários</td>
				<td style="padding:10px 30px !important; text-align:center" width="260px"><span class="tituTab">Última atual. de relatório</span></td>
				<td style="padding:10px 30px !important; text-align:center" width="80px"></td>
			</tr>
		</thead>
		
		<tbody>
		<? 
			$prods = $resulSeo->lista($p,"afiliado = 'Nao'");
			foreach($prods as $lis){
		?>
			<tr style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
				<td style="background:<? if($lis['ativo']=='Sim'){echo '#038800';}else{echo '#a80000';}?> !important; padding:0"></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><strong><?=$lis['nome']?></strong></div></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
				<strong>
						<? 
						if($lis['col3']){
							echo '3';
						}elseif($lis['col2']){
							echo '2';
						}elseif($lis['col1']){
							echo '1';
						}elseif(!$lis['col1']){
							echo '0';
						}
						?>	

					</strong>
				</div></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
					<strong>
						<? $userTotal = $resulSeo->lista('logins', "empresa = '".$lis['id']."'");
						if($userTotal == 'erro'){echo '0';}else{
							echo count($userTotal);
						}
						?>
					</strong>
				</div></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><span>
					<? if($lis['atualizado']){
						echo strftime('%A, %d de %B de %Y', strtotime($lis['atualizado']));
					}else{
						echo 'Sem atualizacoes';
					}?></span></div></td>
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
			<? 
				$afi = $resulSeo->lista($p,"pai IS NOT NULL");
				$pp = '';
				foreach($afi as $afiliado){
					$pp = explode(',',$afiliado['pai']);
					if(in_array($lis['id'], $pp)){
			?>
			<tr style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
				<td style="background:<? if($lis['ativo']=='Sim'){echo '#038800';}else{echo '#a80000';}?> !important; padding:0"></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; line-height: 16px; padding: 10px 10px 10px 40px; opacity:0.7"><strong><?=$afiliado['nome']?></strong></div></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
				<strong>
						<? 
						if($afiliado['col3']){
							echo '3';
						}elseif($afiliado['col2']){
							echo '2';
						}elseif($afiliado['col1']){
							echo '1';
						}elseif(!$afiliado['col1']){
							echo '0';
						}
						?>	
					</strong>
				</div></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
					<strong>
						<? $userTotal = $rProd->lista('logins', "empresa = '".$afiliado['id']."'");
						if($userTotal == 'erro'){echo '0';}else{
							echo count($userTotal);
						}
						?>
					</strong>
				</div></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><span>
					<? if($afiliado['atualizado']){
						echo strftime('%A, %d de %B de %Y', strtotime($afiliado['atualizado']));
					}else{
						echo 'Sem atualizacoes';
					}?>
				
				</span></div></td>
				<td style="text-align:center;padding:0">
					<div style="border-left:1px solid #fff">
						<div style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
							<a href="cad_<?=$p?>.php?editar=<?=$afiliado['id']?>&token=<?=$afiliado['token']?>" class="icon-edit">&nbsp;</a>
							<a href="#modalExcl<?=$afiliado['id']?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
						</div>
					</div>
				</td>
				<div id="modalExcl<?=$afiliado['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<h3 id="myModalLabel" style="color:#099209">Excluir</h3>
					</div>
					<div class="modal-body2" style="padding:20px">
						<p>Tem certeza que deseja excluir este registro?</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
						<a href="<? if($p == 'news'){echo 'newsletter';}else{echo $p;}?>.php?excluir=<?=$afiliado['id']?>&table=<?=$p?>&familia=<?=$_GET['familia']?>" class="btn btn-primary">Confirmar</a>
					</div>
				</div>
			</tr>

			<? 
				$afi2 = $resulSeo->lista($p,"pai IS NOT NULL");
				$pp2 = '';
				foreach($afi2 as $afiliado2){
					$pp2 = explode(',',$afiliado2['pai']);
					if(in_array($afiliado['id'], $pp2)){
			?>
			<tr style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
				<td style="background:<? if($afiliado2['ativo']=='Sim'){echo '#038800';}else{echo '#a80000';}?> !important; padding:0"></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; line-height: 16px; padding: 10px 10px 10px 80px; opacity:0.7"><strong><?=$afiliado2['nome']?></strong></div></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
				<strong>
						<? 
						if($afiliado2['col3']){
							echo '3';
						}elseif($afiliado2['col2']){
							echo '2';
						}elseif($afiliado2['col1']){
							echo '1';
						}elseif(!$afiliado2['col1']){
							echo '0';
						}
						?>	
					</strong>
				</div></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
					<strong>
						<? $userTotal = $rProd->lista('logins', "empresa = '".$afiliado2['id']."'");
						if($userTotal == 'erro'){echo '0';}else{
							echo count($userTotal);
						}
						?>
					</strong>
				</div></td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><span>
					<? if($afiliado2['atualizado']){
						echo strftime('%A, %d de %B de %Y', strtotime($afiliado2['atualizado']));
					}else{
						echo 'Sem atualizacoes';
					}?>
				
				</span></div></td>
				<td style="text-align:center;padding:0">
					<div style="border-left:1px solid #fff">
						<div style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
							<a href="cad_<?=$p?>.php?editar=<?=$afiliado2['id']?>&token=<?=$afiliado2['token']?>" class="icon-edit">&nbsp;</a>
							<a href="#modalExcl<?=$afiliado2['id']?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
						</div>
					</div>
				</td>
				<div id="modalExcl<?=$afiliado2['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<h3 id="myModalLabel" style="color:#099209">Excluir</h3>
					</div>
					<div class="modal-body2" style="padding:20px">
						<p>Tem certeza que deseja excluir este registro?</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
						<a href="<? if($p == 'news'){echo 'newsletter';}else{echo $p;}?>.php?excluir=<?=$afiliado2['id']?>&table=<?=$p?>&familia=<?=$_GET['familia']?>" class="btn btn-primary">Confirmar</a>
					</div>
				</div>
			</tr>
			<? 
				$afi3 = $resulSeo->lista($p,"pai IS NOT NULL");
				$pp3 = '';
				foreach($afi3 as $afiliado3){
					$pp3 = explode(',',$afiliado3['pai']);
					if(in_array($afiliado2['id'], $pp3)){
			?>
		<tr style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
			<td style="background:<? if($afiliado3['ativo']=='Sim'){echo '#038800';}else{echo '#a80000';}?> !important; padding:0"></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; line-height: 16px; padding: 10px 10px 10px 120px; opacity:0.7"><strong><?=$afiliado3['nome']?></strong></div></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
			<strong>
					<? 
					if($afiliado3['col3']){
						echo '3';
					}elseif($afiliado3['col2']){
						echo '2';
					}elseif($afiliado3['col1']){
						echo '1';
					}elseif(!$afiliado3['col1']){
						echo '0';
					}
					?>	
				</strong>
			</div></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
				<strong>
					<? $userTotal = $rProd->lista('logins', "empresa = '".$afiliado3['id']."'");
					if($userTotal == 'erro'){echo '0';}else{
						echo count($userTotal);
					}
					?>
				</strong>
			</div></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><span>
				<? if($afiliado3['atualizado']){
					echo strftime('%A, %d de %B de %Y', strtotime($afiliado3['atualizado']));
				}else{
					echo 'Sem atualizacoes';
				}?>
			
			</span></div></td>
			<td style="text-align:center;padding:0">
				<div style="border-left:1px solid #fff">
					<div style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
						<a href="cad_<?=$p?>.php?editar=<?=$afiliado3['id']?>&token=<?=$afiliado3['token']?>" class="icon-edit">&nbsp;</a>
						<a href="#modalExcl<?=$afiliado3['id']?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
					</div>
				</div>
			</td>
			<div id="modalExcl<?=$afiliado3['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<h3 id="myModalLabel" style="color:#099209">Excluir</h3>
				</div>
				<div class="modal-body2" style="padding:20px">
					<p>Tem certeza que deseja excluir este registro?</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
					<a href="<? if($p == 'news'){echo 'newsletter';}else{echo $p;}?>.php?excluir=<?=$afiliado3['id']?>&table=<?=$p?>&familia=<?=$_GET['familia']?>" class="btn btn-primary">Confirmar</a>
				</div>
			</div>
		</tr>


		<? 
				$afi4 = $resulSeo->lista($p,"pai IS NOT NULL");
				$pp4 = '';
				foreach($afi4 as $afiliado4){
					$pp4 = explode(',',$afiliado4['pai']);
					if(in_array($afiliado3['id'], $pp4)){
			?>
		<tr style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
			<td style="background:<? if($afiliado4['ativo']=='Sim'){echo '#038800';}else{echo '#a80000';}?> !important; padding:0"></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; line-height: 16px; padding: 10px 10px 10px 160px; opacity:0.7"><strong><?=$afiliado4['nome']?></strong></div></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
			<strong>
					<? 
					if($afiliado4['col3']){
						echo '3';
					}elseif($afiliado4['col2']){
						echo '2';
					}elseif($afiliado4['col1']){
						echo '1';
					}elseif(!$afiliado4['col1']){
						echo '0';
					}
					?>	
				</strong>
			</div></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
				<strong>
					<? $userTotal = $rProd->lista('logins', "empresa = '".$afiliado4['id']."'");
					if($userTotal == 'erro'){echo '0';}else{
						echo count($userTotal);
					}
					?>
				</strong>
			</div></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><span>
				<? if($afiliado4['atualizado']){
					echo strftime('%A, %d de %B de %Y', strtotime($afiliado4['atualizado']));
				}else{
					echo 'Sem atualizacoes';
				}?>
			
			</span></div></td>
			<td style="text-align:center;padding:0">
				<div style="border-left:1px solid #fff">
					<div style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
						<a href="cad_<?=$p?>.php?editar=<?=$afiliado4['id']?>&token=<?=$afiliado4['token']?>" class="icon-edit">&nbsp;</a>
						<a href="#modalExcl<?=$afiliado4['id']?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
					</div>
				</div>
			</td>
			<div id="modalExcl<?=$afiliado4['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<h3 id="myModalLabel" style="color:#099209">Excluir</h3>
				</div>
				<div class="modal-body2" style="padding:20px">
					<p>Tem certeza que deseja excluir este registro?</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
					<a href="<? if($p == 'news'){echo 'newsletter';}else{echo $p;}?>.php?excluir=<?=$afiliado4['id']?>&table=<?=$p?>&familia=<?=$_GET['familia']?>" class="btn btn-primary">Confirmar</a>
				</div>
			</div>
		</tr>


		<? 
				$afi5 = $resulSeo->lista($p,"pai IS NOT NULL");
				$pp5 = '';
				foreach($afi5 as $afiliado5){
					$pp5 = explode(',',$afiliado5['pai']);
					if(in_array($afiliado4['id'], $pp5)){
			?>
		<tr style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
			<td style="background:<? if($afiliado5['ativo']=='Sim'){echo '#038800';}else{echo '#a80000';}?> !important; padding:0"></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; line-height: 16px; padding: 10px 10px 10px 200px; opacity:0.7"><strong><?=$afiliado5['nome']?></strong></div></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
			<strong>
					<? 
					if($afiliado5['col3']){
						echo '3';
					}elseif($afiliado5['col2']){
						echo '2';
					}elseif($afiliado5['col1']){
						echo '1';
					}elseif(!$afiliado5['col1']){
						echo '0';
					}
					?>	
				</strong>
			</div></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px">
				<strong>
					<? $userTotal = $rProd->lista('logins', "empresa = '".$afiliado5['id']."'");
					if($userTotal == 'erro'){echo '0';}else{
						echo count($userTotal);
					}
					?>
				</strong>
			</div></td>
			<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><span>
				<? if($afiliado5['atualizado']){
					echo strftime('%A, %d de %B de %Y', strtotime($afiliado5['atualizado']));
				}else{
					echo 'Sem atualizacoes';
				}?>
			
			</span></div></td>
			<td style="text-align:center;padding:0">
				<div style="border-left:1px solid #fff">
					<div style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
						<a href="cad_<?=$p?>.php?editar=<?=$afiliado5['id']?>&token=<?=$afiliado5['token']?>" class="icon-edit">&nbsp;</a>
						<a href="#modalExcl<?=$afiliado5['id']?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
					</div>
				</div>
			</td>
			<div id="modalExcl<?=$afiliado5['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<h3 id="myModalLabel" style="color:#099209">Excluir</h3>
				</div>
				<div class="modal-body2" style="padding:20px">
					<p>Tem certeza que deseja excluir este registro?</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
					<a href="<? if($p == 'news'){echo 'newsletter';}else{echo $p;}?>.php?excluir=<?=$afiliado5['id']?>&table=<?=$p?>&familia=<?=$_GET['familia']?>" class="btn btn-primary">Confirmar</a>
				</div>
			</div>
		</tr>
		<? }
			}
		 }
			} 
		
		}
			}

		}
	}



			 } } }  ?>
		</tbody>
	</table>
</div>
<?  include_once('includes/rodape.php');?>