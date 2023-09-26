<?
include('includes/topo.php');
$nPag = explode('/',$_SERVER['PHP_SELF']);
$p = substr($nPag[2],0,-4);

if($_POST){
	$post['clean_url'] = $resulSeo->clean_url($_POST['nome']);
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
                    <td style="padding:10px 30px !important;"><a href="?ordem=nome&a=<? if($_GET['a'] == 'ASC'){echo 'DESC';}else{echo 'ASC';}?>"><span class="tituTab" style="float:left">Imagem</span><? if($_GET['ordem'] == 'nome' and $_GET['a'] == 'ASC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-down icon-white">&nbsp;</span>';}elseif($_GET['ordem'] == 'nome' and $_GET['a'] == 'DESC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-up icon-white">&nbsp;</span>';}?></a></td>
                	<td style="padding:10px 30px !important; text-align:center" width="15%"><a href="?ordem=titulo&a=<? if($_GET['a'] == 'ASC'){echo 'DESC';}else{echo 'ASC';}?>"><span style="float:left" class="tituTab">Título</span><? if($_GET['ordem'] == 'nome' and $_GET['a'] == 'ASC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-down icon-white">&nbsp;</span>';}elseif($_GET['ordem'] == 'titulo	' and $_GET['a'] == 'DESC'){echo '<span style="float:left; margin:6px 0 0 20px" class="icon-chevron-up icon-white">&nbsp;</span>';}?></a></td>
                    <td style="padding:10px 30px !important; text-align:center" width="10%"></td>
                </tr>
            </thead>
        </table>
        </div> 
	<table class="table table-striped" width="100%" style="margin-top:30px" cellpadding="0">
		<thead style="background: url(images/bgTable.png); padding:40px 30px !important; color:#fff">
			<tr>
				<td style="padding:0 !important" width="5px"></td>
				<td style="padding:10px 30px !important; text-align:center" width="1%"><span class="tituTab">Imagem</span></td>
				<td style="padding:10px 30px !important;"><span class="tituTab">Título</span></td>
				<td style="padding:10px 30px !important; text-align:center" width="35%"><span class="tituTab">Família</span></td>
				<td style="padding:10px 30px !important; text-align:center" width="10%"></td>
			</tr>
		</thead>
		
		<tbody>
		<? 
			$prods = $resulSeo->lista($p);
			foreach($prods as $lis){
		?>
			<tr style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
				<td style="background:<? if($lis['ativo']=='Sim'){echo '#038800';}else{echo '#a80000';}?> !important; padding:0"></td>
				<td>
				</td>
				<td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><strong><?=$lis['nome']?></strong></div></td>
				<td style="text-align:center;padding:0">
					<div style="border-left:1px solid #fff">
						<div style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
							<a href="cad_<?=$p?>.php?editar=<?=$lis['id']?>&token=<?=$lis['token']?>" class="icon-edit">&nbsp;</a>
							<a href="#modalExcl<?=$lis['id']?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
						</div>
					</div>
				</td>
			</tr>
			<? } ?>
		</tbody>
	</table>
</div>
<?  include_once('includes/rodape.php');?>