
<?
if($_SERVER['https_HOST'] == 'vereda.dev'){
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
        
<page backtop="21mm" backbottom="0mm" backleft="7mm" backright="7mm" style="font-size: 12pt; position:relative">
	<table cellpadding="0" cellspacing="0" border="0" style="margin:0; margin-top:-24px; position:absolute; left:0; top:0">
	<tr>
	<?
		$i = 0;
		$count = 0;
		$tota = 0;
		while ($lis = mysql_fetch_array($query, MYSQL_ASSOC)) {
			
			if($tota == 30){
			
			}
			
			
			if($lis['pp'] > 0){
				while($count < $lis['pp']){
					if($i == '6'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
						$tota++;
					}
	?>
	
		<td style="width:34.1mm; height:56mm;margin:0px;padding:0; text-align:left; vertical-align: bottom;">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:56mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:34.1mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:34.1mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:34.1mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:34.1mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:34.1mm;"><? if($lis['poliester'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliester']?>% Poliester</H4><?}
if($lis['elastano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['elastano']?>% Elastano</H4><?}
if($lis['algodao'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['algodao']?>% Algodao</H4><?}
if($lis['poliamida'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliamida']?>% Poliamida</H4><?}
if($lis['linho'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['linho']?>% Linho</H4><?}
if($lis['viscose'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['viscose']?>% Viscose</H4><?}
if($lis['poliuretano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliuretano']?>% Poliuretano</H4><?}
if($lis['acrilico'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['acrilico']?>% Acrílico</H4><?}?>
					<table cellpadding="0" cellspacing="0" border="0" style="margin:5px 0 0;width:34.1mm;">
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
							echo '<td style="text-align:center;padding-top:3px; width:9.5mm; height:5mm; vertical-align: middle"><img src="https://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:0px auto 0;" /></td>';
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
						$tota++;
					}
	?>
	
		<td style="width:32.1mm; height:56mm; max-height:56mm; margin:0px;padding:0; text-align:left; vertical-align: bottom;">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:56mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:32.1mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:32.1mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:32.1mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:34.1mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:32.1mm;">

<? if($lis['poliester'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliester']?>% Poliester</H4><?}
if($lis['elastano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['elastano']?>% Elastano</H4><?}
if($lis['algodao'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['algodao']?>% Algodao</H4><?}
if($lis['poliamida'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliamida']?>% Poliamida</H4><?}
if($lis['linho'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['linho']?>% Linho</H4><?}
if($lis['viscose'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['viscose']?>% Viscose</H4><?}
if($lis['poliuretano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliuretano']?>% Poliuretano</H4><?}
if($lis['acrilico'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['acrilico']?>% Acrílico</H4><?}?>	
						
					
					<table cellpadding="0" cellspacing="0" border="0" style="margin:5px auto 0;width:30mm;">
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
							echo '<td style="text-align:center;padding-top:3px; width:9.5mm; height:5mm; vertical-align: middle"><img src="https://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:auto;" /></td>';
						}
						?>
						</tr>
						
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>
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
						$tota++;
					}
				
	?>
	
		<td style="width:32.1mm; max-height:56mm;height:56mm; margin:0px;padding:0; text-align:left; vertical-align: bottom;">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:56mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:32.1mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:32.1mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:32.1mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:32.1mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:32.1mm;"><? if($lis['poliester'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliester']?>% Poliester</H4><?}
if($lis['elastano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['elastano']?>% Elastano</H4><?}
if($lis['algodao'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['algodao']?>% Algodao</H4><?}
if($lis['poliamida'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliamida']?>% Poliamida</H4><?}
if($lis['linho'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['linho']?>% Linho</H4><?}
if($lis['viscose'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['viscose']?>% Viscose</H4><?}
if($lis['poliuretano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliuretano']?>% Poliuretano</H4><?}
if($lis['acrilico'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['acrilico']?>% Acrílico</H4><?}?>
						
						
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
							echo '<td style="text-align:center;padding-top:3px; width:9.5mm; height:5mm; vertical-align: middle"><img src="https://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:0px auto 0;" /></td>';
						}
						?>
						</tr>
						
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>
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
						$tota++;
					}
	?>
	
		<td style="width:32.1mm; height:56mm;max-height:56mm; margin:0px;padding:0; text-align:left; vertical-align: top;">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:56mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:32.1mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:32.1mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:32.1mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:32.1mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:32.1mm">
						<? if($lis['poliester'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliester']?>% Poliester</H4><?}
if($lis['elastano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['elastano']?>% Elastano</H4><?}
if($lis['algodao'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['algodao']?>% Algodao</H4><?}
if($lis['poliamida'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliamida']?>% Poliamida</H4><?}
if($lis['linho'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['linho']?>% Linho</H4><?}
if($lis['viscose'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['viscose']?>% Viscose</H4><?}
if($lis['poliuretano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliuretano']?>% Poliuretano</H4><?}
if($lis['acrilico'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['acrilico']?>% Acrílico</H4><?}?>
						
					<table cellpadding="0" cellspacing="0" border="0" style="margin:5px 0 0;width:32.1mm">
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
							echo '<td style="text-align:center;padding-top:3px; width:9.5mm; height:5mm; vertical-align: middle"><img src="https://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:0px auto 0;" /></td>';
						}
						?>
						</tr>
						
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>
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
						$tota++;
					}
	?>
	
		<td style="width:32.1mm; height:56mm; margin:0px;padding:0; text-align:left; vertical-align: top">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0; height:56mm; ">
				<tr style="text-align:center">
					<td style="padding-bottom:2px; padding-top:30px">
						<h5 style="font-size:16px;font-family:hurmegeometricsans4; margin:20px 0 0; width:32.1mm;">VEREDA</h5>
						<h6 style="margin:0 0px; font-size:7px;width:32.1mm;">Confecção e Comércio de Roupas</h6>
						<h6 style="font-size:7px;width:32.1mm; margin:5px 0 0; padding:0; line-height:7px; display:block">CNPJ</h6>
						<strong style=" margin:0;font-size:9px;line-height:8px; width:32.1mm; padding:0; display:block">26.868.826/0001-60</strong>
					</td>
				</tr>
				<tr style=" text-align:center">
					<td style="border-top:1px solid #444;padding-top:2px; width:32.1mm"><? if($lis['poliester'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliester']?>% Poliester</H4><?}
if($lis['elastano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['elastano']?>% Elastano</H4><?}
if($lis['algodao'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['algodao']?>% Algodao</H4><?}
if($lis['poliamida'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliamida']?>% Poliamida</H4><?}
if($lis['linho'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['linho']?>% Linho</H4><?}
if($lis['viscose'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['viscose']?>% Viscose</H4><?}
if($lis['poliuretano'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['poliuretano']?>% Poliuretano</H4><?}
if($lis['acrilico'] > 0){?><H4 style="text-transform: uppercase;font-size:9px; font-family:hurmegeometricsans4;line-height:9px;width:32.1mm; margin:0; padding:0; display:block"><?=$lis['acrilico']?>% Acrílico</H4><?}?>
					<table cellpadding="0" cellspacing="0" border="0" style="margin:5px 0 0;width:32.1mm;">
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
							echo '<td style="text-align:center;padding-top:3px; width:9.5mm; height:5mm; vertical-align: middle"><img src="https://www.veredars.com.br/painel/images/icons/ff/'.$icons.'.jpg" style="width:70%;margin:0px auto 0;" /></td>';
						}
						?>
								
						</tr>
						
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>
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
