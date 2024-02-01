<?
include('includes/topo.php');

$nPag = explode('/', $_SERVER['PHP_SELF']);
$p = substr($nPag[2], 0, -4);

if ($_POST) {
	$post['clean_url'] = $resulSeo->clean_url($_POST['nome']);
	$diag = $resulSeo->cadastros($post, $p);

	$parc['id'] = $_POST['empresa'];
	$parc['atualizado'] = date("Y-m-d H:i:s");
	echo $resulSeo->cadastro($parc, 'parceiros');
}


$prods = $resulSeo->conta($p);
$prodss = $resulSeo->lista($p, '', '', '', ' limit 40');
?>
<script>
	$(document).ready(function () {
		<?
		if ($diag == "sim") { ?>Dialogo("sim", "<?= $p ?> cadastrado com sucesso!");<?
		} elseif ($diag == "nao") { ?>Dialogo("nao", "Erro ao cadastrar <?= $p ?>!");<?
		} elseif ($diag == "sime") { ?>Dialogo("sim", "<?= $p ?> editado com sucesso!");<?
		} elseif ($diag == "naoe") { ?>Dialogo("nao", "Erro ao editar <?= $p ?>.");<? }

		$delP = $resulSeo->deleta($_GET['excluir'], $p);
		if ($delP == "sim") { ?>Dialogo("sim", "<?= $p ?> excluído com sucesso!");<?
		} elseif ($delP == "nao") { ?>Dialogo("nao", "Erro ao excluir <?= $p ?>s.");<?
		}
		?>
	});
</script>
<div id="contentTitu">
	<h1><?= $resulSeo->maiuscula($p) ?></h1>
	<div id="btnF">
		<a href="<?= $p ?>.php" class="btngSel">Listar
			<?= $p ?>
		</a>
		<a href="cad_<?= $p ?>.php" class="btng">Cadastrar
			<?= $p ?>
		</a>
	</div>
	<div class="controle">&nbsp;</div>
</div>
<div id="contentLists">
	<table class="table table-striped" width="100%" style="margin-top:30px" cellpadding="0">
		<thead style="background: #222; padding:40px 30px !important; color:#fff">
			<tr>
				<td style="padding:0 !important" width="5px"></td>
				<td style="padding:10px 10px !important; text-align:left" width="20%"><span class="tituTab">Parceiro</span></td>
				<td style="padding:10px 30px !important;" width="15%"><span class="tituTab">Casa</span></td>
				<td style="padding:10px 30px !important; text-align:center"><span class="tituTab">Período</span></td>
				<td style="padding:10px 30px !important; text-align:center" width="10%"></td>
			</tr>
		</thead>

		<tbody>
			<?
			foreach ($prodss as $lis) {
				$empe = $resulSeo->lista('parceiros', "id = '" . $lis['empresa'] . "'");
				$cas = '';
				$cas = $resulSeo->lista('casas', "id = '" . $lis['casa'] . "'");
				$periodo = str_replace("/", "-", $lis['periodo']);
				$periodo = implode('/',array_reverse(explode('-',$periodo)));
				?>
				<tr class="item" style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
					<td
						style=" width:5px; <? if($empe and $empe[0]['nome'] != 'e'){echo 'background:#038800';
						} else {
							echo 'background:#a80000';
						} ?> !important; padding:0">
					</td>
					<td>
						<a href="cad_parceiros.php?editar=<?=$empe[0]['id']?>">
							<?=$empe[0]['nome']?>
						</a>
					</td>
					<td>
						<a href="cad_casas.php?editar=<?=$cas[0]['id']?>">
							<div style="width: 100px; height: 25px; background: #f5f5f5 url(https://vesna.partners/painel/arquivos/casas/<?=$cas[0]['img']?>) center center no-repeat; background-size: 80% auto">

							</div>
						</a>
					</td>
					<td>
						<?=$periodo?>
					</td>
					
					<td style="text-align:center;padding:0">
						<div style="border-left:1px solid #fff">
							<div
								style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
								<a href="cad_<?= $p ?>.php?editar=<?= $lis['id'] ?>&token=<?= $lis['token'] ?>"
									class="icon-edit">&nbsp;</a>
								<a href="#modalExcl<?= $lis['id'] ?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
							</div>
						</div>
					</td>
				</tr>
				<div id="modalExcl<?= $lis['id'] ?>" class="modal hide fade" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<h3 id="myModalLabel" style="color:#099209">Excluir</h3>
					</div>
					<div class="modal-body2" style="padding:20px">
						<p>Tem certeza que deseja excluir este registro?</p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
						<a href="<? if ($p == 'news') {
							echo 'newsletter';
						} else {
							echo $p;
						} ?>.php?excluir=<?= $lis['id'] ?>&table=<?= $p ?>&familia=<?= $_GET['familia'] ?>"
							class="btn btn-primary">Confirmar</a>
					</div>
				</div>
			<? } ?>
		</tbody>
	</table>
</div>



<input type="hidden" id="filtro" value="<?= $_GET['filtro'] ?>">

<input type="hidden" id="row" value="0">
<input type="hidden" id="all" value="<?php echo $prods; ?>">


<? include_once('includes/rodape.php'); ?>



<script>


	$(document).ready(function () {

		

		$(window).scroll(function () {

			var table = 'relatorios';
			var position = $(window).scrollTop();
			var bottom = $(document).height() - $(window).height();

			if (position == bottom) {
				

				//var filtro = $('#filtro').val();
				var row = Number($('#row').val());
				var allcount = Number($('#all').val());
				var rowperpage = 40;
				row = row + rowperpage;

				var colunas = '*';
				//alert(row+'asd'+allcount);
				if (row <= allcount) {
					$('#row').val(row);
					//alert('asd');
					$.ajax({
						url: 'pager.php',
						type: 'post',
						data: { rows: row, tabela: table, cols: colunas },
						success: function (response) {
							
							//alert(bottom+' teste'+ position);

							$(".item:last").after(response).show().fadeIn("slow");
						}
					});
				}
			}

		});

	});


</script>