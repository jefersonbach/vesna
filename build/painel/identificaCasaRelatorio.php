<?php
include 'includes/class.banco.php';
$resulSeo = new connect();

$casa = $_POST['casa'];
$casaColunaId = $resulSeo->lista('casas', "id = '".$casa."'");
$casaColunaId = $casaColunaId[0]['colunaId'];

if($casaColunaId and $casaColunaId != 'e'){
	echo '<span class="spanMini" style="font-size:13px; line-height:16px; text-align:center; margin:20px auto; display:block; width:100%">A identificação do parceiro <br />será feita usando o valor da coluna: <br /><strong style="font-size:17px">'.$casaColunaId.'</strong></span>';
}else{?>
	<label>
		<strong>Parceiro</strong>
		<select name="empresa">
			<option value="" style="color:#777; padding:5px 5px 5px 20px"> <strong><i>-- Nenhuma --</i></strong> </option>
			<? 
				$prodsa = $resulSeo->lista('parceiros',"ativo != 'Nao'",'','nome asc');
				foreach($prodsa as $pais){
					?>
					<option value="<?=$pais['id']?>"  <? if($empresa == $pais['id']){echo 'selected';}?> style="color:#333; padding:5px 5px 5px 20px"><?=$pais['nome']?></option>
					<?
				} 
			?>
		</select>
	</label>
	<div class="controle">&nbsp;</div>
<? } ?>