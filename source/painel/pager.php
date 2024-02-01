teste
<?php
include 'includes/class.banco.php';
$resulSeo = new connect();


$row = $_POST['rows'];
$tabela = $_POST['tabela'];
$filtro = $_POST['filt'];
$colunas = $_POST['cols'].',id';
$rowperpage = 40;



//echo "SELECT * FROM ".$tabela." limit ".$row.",".$rowperpage;

//echo $_GET['filtro'];
//if($filtro){$filtro = "familia = '".$filtro."'";}else{$filtro = '';}
$filtro = '';
			$prodss = $resulSeo->lista($tabela, $filtro,'','',' limit '.$row.",".$rowperpage);
			foreach($prodss as $lis){
				$cas = '';
				$cas = $resulSeo->lista('casas', "id = '" . $lis['casa'] . "'");
				$periodo = str_replace("/", "-", $lis['periodo']);
				$periodo = implode('/',array_reverse(explode('-',$periodo)));
				$empe = $resulSeo->lista('parceiros', "id = '" . $lis['empresa'] . "'");
		?>
			
			<tr class="item" style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
				<td
					style="background:<? if ($empe and $empe[0]['nome'] != 'e') {
						echo '#038800';
					} else {
						echo '#a80000';
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