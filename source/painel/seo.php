<?
include('includes/topo.php');
if ($_GET['salva'] == 1) {
	$ss = $resulSeo->cadastros($post, 'seo');
	?>
	<script>
		$(document).ready(function () {
				<?
				if ($ss == "sim") { ?>Dialogo("sim", "Configurações cadastradas com sucesso!");<?
				} elseif ($ss == "nao") { ?>Dialogo("nao", "Erro ao cadastrar configurações!");<?
				} elseif ($ss == "sime") { ?>Dialogo("sim", "Configurações editadas com sucesso!");<?
				} elseif ($ss == "naoe") { ?>Dialogo("nao", "Erro ao editar configurações.");<? }
				?>
		});
	</script>
	<?
	include('includes/cria.php');
}
$prods = $resulSeo->lista('seo');
extract($prods[0]);
?>
<style>
	.help-inline {
		font-size: 11px
	}
</style>
<div id="contentTitu">
	<h1>Configurações Gerais - <?=$empresa ?></h1>
	<div class="controle">&nbsp;</div>
</div>
<form method="post" action="?salva=1">

	<div class="contentCad">
		<div class="alignCenter" style="max-width: calc(100% - 60px); margin-left: 60px">
			<strong>Acordos Padrões</strong>
			<br />
			<label style="width: calc(100% - 0px); margin:0 0px 0px">
				<textarea name="acordosDefault" id="mytextarea" style="height:400px;"><?= $acordosDefault ?></textarea>
			</label>
			<div class="controle"></div>
			<br />
			<strong>Links Úteis</strong>
			<br />
			<label style="width: calc(100% - 0px); margin:0 0px">
				<textarea name="linksDefault" id="mytextarea2" style="height:400px;"><?= $linksDefault ?></textarea>
			</label>

		</div>
	</div>
	<div class="contentCadr">
		<div class="alignCenter">
			<? if($_SESSION['adm'] == '1'){?>
			<h2>Páginas</h2>
			<div class="well span3" style="margin:0; padding:8px 0">
				<ul class="nav nav-list">
					<li class="nav-header">Páginas</li>
					<div id="list-pag">
						<?
						if ($pag) {
							$pag2 = substr($pag, 1);
							$pagina = explode(',', $pag2);

							$i = 0;
							foreach ($pagina as $pagi) {
								?>
								<li class="ll">
									<label class="checkbox" style="padding:2px; margin-bottom:2px">
										<?= $resulSeo->maiuscula($pagi) ?>
										<a class="btn btn-mini right tira" style="float:right" href="#" id="<?= $pagi ?>"><i
												class="icon-minus"></i></a>
									</label>
								</li>
								<?
							}
						}
						?>
					</div>
					<li class="divider"></li>
					<li class="nav-header">Ou Nova</li>
					<li>
						<input type="text" name="paginas" class="span2" id="pag" style="margin-bottom:0 !important" />
						<input type="hidden" value="<?= $id ?>" id="id-atual" />
						<a href="#" class="btn" id="maisPag" style=" display:inline;">+</a>
					</li>
				</ul>
			</div>
			<?}?>

			<div id="form-paginas">
				<?
				$pagCria = explode(',', $post['pag']);
				unset($pagCria[0]);
				$p = end($pagCria);
				if ($p) {
					if (!file_exists($p . '.php')) {
						copy('includes/lista.php', $p . '.php');
						copy('includes/cadastra.php', 'cad_' . $p . '.php');
					}
				}

				if ($_POST['add']) {
					unset($post['add']);
					echo $ss = $resulSeo->cadastros($post, 'seo');

				} ?>
			</div>

			<div id="tira-paginas">
				<?
				if ($_POST['exc']) {
					unset($post['exc']);
					$post['pag'] = str_replace("," . $_POST['pag'], '', $pag);
					$ss = $resulSeo->cadastros($post, 'seo');
				}
				?>
			</div>
			<div id="refrash"><input type="hidden" value="<?= $pag ?>" id="pag-atual" /></div>


			<script type="text/javascript">
				$(document).ready(function () {
					tinymce.init({
						selector: '#mytextarea',
						plugins: [
							'advlist autolink lists link image charmap print preview anchor',
							'searchreplace visualblocks code fullscreen',
							'insertdatetime media table paste imagetools wordcount'
						],
						toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
						content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
						automatic_uploads: true,
					});

					tinymce.init({
						selector: '#mytextarea2',
						plugins: [
							'advlist autolink lists link image charmap print preview anchor',
							'searchreplace visualblocks code fullscreen',
							'insertdatetime media table paste imagetools wordcount'
						],
						toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
						content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
						automatic_uploads: true,
					});


					function atualiza() {
						$('a.tira').each(function () {
							$(this).click(function (e) {
								e.preventDefault();
								$('#tira-paginas').load('seo.php #tira-paginas', { id: $('#id-atual').val(), pag: $(this).attr('id'), exc: true }, function () {
									$('#tira-paginas').load('seo.php #tira-paginas');
									$('#pag').val('');
									$('#list-pag').load('seo.php #list-pag', function () { atualiza(); $('#refrash').load('seo.php #refrash'); });

								});

							});
						});

					}


					$('a#maisPag').click(function (e) {
						e.preventDefault();
						if ($('#pag-atual').val() == '') {
							novo = ',' + $('#pag').val();
						} else {
							novo = $('#pag-atual').val() + ',' + $('#pag').val();
						}

						$('#form-paginas').load('seo.php #form-paginas', { pag: novo, id: $('#id-atual').val(), add: true }, function () {
							$('#pag').val('');
							$('#list-pag').load('seo.php #list-pag', function () { atualiza(); $('#refrash').load('seo.php #refrash'); });
						});

					});


					$('a.tira').each(function () {
						$(this).click(function (e) {
							e.preventDefault();
							$('#tira-paginas').load('seo.php #tira-paginas', { id: $('#id-atual').val(), pag: $(this).attr('id'), exc: true }, function () {
								$('#tira-paginas').load('seo.php #tira-paginas');
								$('#pag').val('');
								$('#list-pag').load('seo.php #list-pag', function () { atualiza(); $('#refrash').load('seo.php #refrash'); });
							});

						});
					});


				});
			</script>


			<div class="controle">&nbsp;</div><br /><br />
		</div>
	</div>
	<div class="controle">&nbsp;</div>
	<div style="margin:20px 0 0; text-align:right">
		<div class="form-actions">
			<? if ($id) { ?><input type="hidden" name="id" value="<?= $id ?>" />
			<? } ?>
			<input type="submit" class="btn btn-primary" value="Salvar alterações" />
			<a href="/painel/produtos.php"><button type="button" class="btn">Cancelar</button></a>
		</div>
	</div>
</form>

<? include('includes/rodape.php') ?>