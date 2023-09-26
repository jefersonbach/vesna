
<?
if($_SERVER['HTTP_HOST'] == 'vereda.dev'){
	$Host = '127.0.0.1';		//servidor
	$User = 'root';				//usuario
	$senha = 'qweasd';				//senha
	$Banco = 'vereda'; 

	//$Banco = 'bakelitsul';
}else{
	$Host = '177.52.160.23';		//servidor
	$User = 'trumpdes_vereda';				//usuario
	$senha = 'Bentiti10';				//senha
	$Banco = 'trumpdes_vereda'; 

}

$conn = mysql_connect($Host, $User, $senha) or die("Não foi possível a conexão com o Banco1!");

mysql_query("SET character_set_results=utf8", $conn);
mb_language('uni'); 
mb_internal_encoding('UTF-8');
mysql_select_db($Banco, $conn);
mysql_query("set names 'utf8'",$conn);


$query = mysql_query("Select * FROM etiquetas");
	


?>
        
<page backtop="15mm" backbottom="0mm" backleft="6mm" backright="6mm" style="font-size: 12pt">
	<table cellpadding="0" cellspacing="0" border="0" style="margin:0">
	<tr>
	<?
		$i = 0;
		$count = 0;
		while ($lis = mysql_fetch_array($query, MYSQL_ASSOC)) {
			
			
			if($lis['pp'] > 0){
				while($count < $lis['pp']){
					if($i == '6'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
	?>
	
		<td style="width:33mm; height:69mm;margin:0px;padding:0; text-align:left; vertical-align: bottom;">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:69mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:33mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:33mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:33mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:33mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:33mm; height:85px">
						<table cellpadding="0" cellspacing="0" border="0" style="margin:0;width:33mm;">
					<? if($lis['poliester'] > 0){?><tr><td style="width:33mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliester']?>% Poliester</strong></td></tr><?}
						if($lis['elastano'] > 0){?><tr><td style="width:33mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px "><?=$lis['elastano']?>% Elastano</strong></td></tr><?}
						if($lis['algodao'] > 0){?><tr><td style="width:33mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['algodao']?>% ALGODÃO</strong></td></tr><?}
						if($lis['poliamida'] > 0){?><tr><td style="width:33mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliamida']?>% Poliamida</strong></td></tr><?}
						if($lis['linho'] > 0){?><tr><td style="width:33mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['linho']?>% Linho</strong></td></tr><?}
						if($lis['viscose'] > 0){?><tr><td style="width:33mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['viscose']?>% Viscose</strong></td></tr><?}
						if($lis['poliuretano'] > 0){?><tr><td style="width:33mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliuretano']?>% Poliuretano</strong></td></tr><?}
						if($lis['acrilico'] > 0){?><tr><td style="width:33mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['acrilico']?>% ACRÍLICO</strong></td></tr><?}?>
						</table>
					<table cellpadding="0" cellspacing="0" border="0" style="margin:5px 0 0;width:33mm;">
						<tr>
						<?
						$ic = explode(',',$lis['icon']);
						$a = 0;
						foreach($ic as $icons){
							if($a == '3'){
								$a = 0;
								echo '</tr><tr>';
							}else{
								$a++;
							}
							echo '<td style="text-align:center;padding-top:3px; width:10mm; height:5mm; vertical-align: middle"><img src="http://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:0px auto 0;" /></td>';
						}
						?>
						</tr>
						
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>
						<h4 style="font-size:45px;font-family:hurmegeometricsans4; margin:0">PP</h4>
						<strong style="text-transform: uppercase; font-size:7px; margin:2px 0 0; display: inline-block">Feito no Rio Grande do Sul</strong>
					</td>
				</tr>
			</table>
		</td>
		<?
					$count++;
		}
				}
		if($lis['p'] > 0){
			$count = 0;
			while($count < $lis['p']){
					if($i == '6'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
	?>
	
		<td style="width:31.4mm; height:69mm; max-height:69mm; margin:0px;padding:0; text-align:left; vertical-align: bottom;">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:69mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:31.4mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:31.4mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:31.4mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:33mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:31.4mm; height:85px">
						<table cellpadding="0" cellspacing="0" border="0" style="margin:0;width:31.4mm;">
					<? if($lis['poliester'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliester']?>% Poliester</strong></td></tr><?}
						if($lis['elastano'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px "><?=$lis['elastano']?>% Elastano</strong></td></tr><?}
						if($lis['algodao'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['algodao']?>% ALGODÃO</strong></td></tr><?}
						if($lis['poliamida'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliamida']?>% Poliamida</strong></td></tr><?}
						if($lis['linho'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['linho']?>% Linho</strong></td></tr><?}
						if($lis['viscose'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['viscose']?>% Viscose</strong></td></tr><?}
						if($lis['poliuretano'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliuretano']?>% Poliuretano</strong></td></tr><?}
						if($lis['acrilico'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['acrilico']?>% ACRÍLICO</strong></td></tr><?}?>
						</table>
					<table cellpadding="0" cellspacing="0" border="0" style="margin:5px 0 0;width:30mm;">
						<tr>
						<?
						$ic = explode(',',$lis['icon']);
						$a = 0;
						foreach($ic as $icons){
							if($a == '3'){
								$a = 0;
								echo '</tr><tr>';
							}else{
								$a++;
							}
							echo '<td style="text-align:center;padding-top:3px; width:9mm; height:5mm; vertical-align: middle"><img src="http://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:auto;" /></td>';
						}
						?>
						</tr>
						
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>
						<h4 style="font-size:45px;font-family:hurmegeometricsans4; margin:0">P</h4>
						<strong style="text-transform: uppercase; font-size:7px; margin:2px 0 0; display: inline-block">Feito no Rio Grande do Sul</strong>
					</td>
				</tr>
			</table>
		</td>
		<?
				$count++;
		}
		}
			
			if($lis['m'] > 0){
				$count = 0;
				while($count < $lis['m']){
					if($i == '6'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
				
	?>
	
		<td style="width:31.4mm; max-height:69mm;height:69mm; margin:0px;padding:0; text-align:left; vertical-align: bottom;">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:69mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:31.4mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:31.4mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:31.4mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:31.4mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:31.4mm; height:85px">
						<table cellpadding="0" cellspacing="0" border="0" style="margin:0;width:31.4mm;">
					<? if($lis['poliester'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliester']?>% Poliester</strong></td></tr><?}
						if($lis['elastano'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px "><?=$lis['elastano']?>% Elastano</strong></td></tr><?}
						if($lis['algodao'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['algodao']?>% ALGODÃO</strong></td></tr><?}
						if($lis['poliamida'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliamida']?>% Poliamida</strong></td></tr><?}
						if($lis['linho'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['linho']?>% Linho</strong></td></tr><?}
						if($lis['viscose'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['viscose']?>% Viscose</strong></td></tr><?}
						if($lis['poliuretano'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliuretano']?>% Poliuretano</strong></td></tr><?}
						if($lis['acrilico'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['acrilico']?>% ACRÍLICO</strong></td></tr><?}?>
						</table>
					<table cellpadding="0" cellspacing="0" border="0" style="margin:5px 0 0;width:30mm;">
						<tr>
						<?
						$ic = explode(',',$lis['icon']);
						$a = 0;
						foreach($ic as $icons){
							if($a == '3'){
								$a = 0;
								echo '</tr><tr>';
							}else{
								$a++;
							}
							echo '<td style="text-align:center;padding-top:3px; width:9mm; height:5mm; vertical-align: middle"><img src="http://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:0px auto 0;" /></td>';
						}
						?>
						</tr>
						
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>
						<h4 style="font-size:45px;font-family:hurmegeometricsans4; margin:0">M</h4>
						<strong style="text-transform: uppercase; font-size:7px; margin:2px 0 0; display: inline-block">Feito no Rio Grande do Sul</strong>
					</td>
				</tr>
			</table>
		</td>
		<?
					$count++;
		}
		}
		
			
		if($lis['g'] > 0){
			$count = 0;
				while($count < $lis['g']){
					if($i == '6'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
	?>
	
		<td style="width:31.4mm; height:69mm;max-height:69mm; margin:0px;padding:0; text-align:left; vertical-align: top;">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:69mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:31.4mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:31.4mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:31.4mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:31.4mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:31.4mm; height:85px">
						<table cellpadding="0" cellspacing="0" border="0" style="margin:0;width:31.4mm;">
					<? if($lis['poliester'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliester']?>% Poliester</strong></td></tr><?}
						if($lis['elastano'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px "><?=$lis['elastano']?>% Elastano</strong></td></tr><?}
						if($lis['algodao'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['algodao']?>% ALGODÃO</strong></td></tr><?}
						if($lis['poliamida'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliamida']?>% Poliamida</strong></td></tr><?}
						if($lis['linho'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['linho']?>% Linho</strong></td></tr><?}
						if($lis['viscose'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['viscose']?>% Viscose</strong></td></tr><?}
						if($lis['poliuretano'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliuretano']?>% Poliuretano</strong></td></tr><?}
						if($lis['acrilico'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['acrilico']?>% ACRÍLICO</strong></td></tr><?}?>
						</table>
					<table cellpadding="0" cellspacing="0" border="0" style="margin:5px 0 0;width:31.4mm">
						<tr>
						<?
						$ic = explode(',',$lis['icon']);
						$a = 0;
						foreach($ic as $icons){
							if($a == '3'){
								$a = 0;
								echo '</tr><tr>';
							}else{
								$a++;
							}
							echo '<td style="text-align:center;padding-top:3px; width:9mm; height:5mm; vertical-align: middle"><img src="http://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:0px auto 0;" /></td>';
						}
						?>
						</tr>
						
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>
						<h4 style="font-size:45px;font-family:hurmegeometricsans4; margin:0">G</h4>
						<strong style="text-transform: uppercase; font-size:7px; margin:2px 0 0; display: inline-block">Feito no Rio Grande do Sul</strong>
					</td>
				</tr>
			</table>
		</td>
		<?
					$count++;
		}
		}
			
			
		if($lis['u'] > 0){
			$count = 0;
				while($count < $lis['u']){
					if($i == '6'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
	?>
	
		<td style="width:31.4mm; height:69mm; margin:0px;padding:0; text-align:left; vertical-align: top">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:69mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:31.4mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:31.4mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:31.4mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:31.4mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:31.4mm; height:85px">
						<table cellpadding="0" cellspacing="0" border="0" style="margin:0;width:31.4mm;">
					<? if($lis['poliester'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliester']?>% Poliester</strong></td></tr><?}
						if($lis['elastano'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px "><?=$lis['elastano']?>% Elastano</strong></td></tr><?}
						if($lis['algodao'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['algodao']?>% ALGODÃO</strong></td></tr><?}
						if($lis['poliamida'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliamida']?>% Poliamida</strong></td></tr><?}
						if($lis['linho'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['linho']?>% Linho</strong></td></tr><?}
						if($lis['viscose'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['viscose']?>% Viscose</strong></td></tr><?}
						if($lis['poliuretano'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['poliuretano']?>% Poliuretano</strong></td></tr><?}
						if($lis['acrilico'] > 0){?><tr><td style="width:31.4mm;"><strong style="text-transform: uppercase; font-size:10px;font-family:hurmegeometricsans4; line-height:10px"><?=$lis['acrilico']?>% ACRÍLICO</strong></td></tr><?}?>
						</table>
					<table cellpadding="0" cellspacing="0" border="0" style="margin:5px 0 0;width:31.4mm;">
						<tr>
						<?
						$ic = explode(',',$lis['icon']);
						$a = 0;
						foreach($ic as $icons){
							if($a == '3'){
								$a = 0;
								echo '</tr><tr>';
							}else{
								$a++;
							}
							echo '<td style="text-align:center;padding-top:3px; width:9mm; height:5mm; vertical-align: middle"><img src="http://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:0px auto 0;" /></td>';
						}
						?>
								
						</tr>
						
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>
						<h4 style="font-size:45px;font-family:hurmegeometricsans4; margin:0">U</h4>
						<strong style="text-transform: uppercase; font-size:7px; margin:2px 0 0; display: inline-block">Feito no Rio Grande do Sul</strong>
					</td>
				</tr>
			</table>
		</td>
		<?
					$count++;
		}
		}
			
			
			
		
			
			
	 } ?>
	 </tr>
	</table>
</page>
