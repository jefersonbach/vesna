<?php
include 'includes/class.banco.php';
$resulSeo = new connect();

$casa = $_POST['casa'];
$allCasas = $resulSeo->lista('casas', "id = '".$casa."'");

$casaColunaId = $allCasas[0]['colunaId'];
$casaColunaData = $allCasas[0]['colunaData'];

if($casaColunaId and $casaColunaId != 'e'){
	echo '<label><strong>Parceiro</strong></label> <label><span class="spanMini" style="font-size:13px; line-height:16px; text-align:left; margin:0px auto 0px; display:block; width:100%">Definido usando o valor da coluna: <br /><strong style="font-size:20px; margin:0; line-height:20px">'.$casaColunaId.'</strong></span></label>';
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
<? } ?>

<div class="controle">&nbsp;</div>

<?
	if($casaColunaData and $casaColunaData != 'e'){
		echo '<label><strong>Data</strong></label> <label><span class="spanMini" style="font-size:13px; line-height:16px; text-align:left; margin: 10px auto; display:block; width:100%">Definida usando o valor da coluna: <br /><strong style="font-size: 20px; margin:0; line-height:20px">'.$casaColunaData.'</strong></span></label>';
	}else{?>
		<label><strong>Período</strong></label>    
		<label><input type="text" class="span2" name="periodo" value="<?=$periodo?>" placeholder="10/05/2023" /></label>   
<? 
	} 
?>
<div class="controle">&nbsp;</div>