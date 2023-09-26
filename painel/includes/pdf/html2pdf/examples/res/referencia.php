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
 		
		
		$sql = "SELECT * from `referencia`";
$query = mysql_query($sql);

		function geraCodigoBarra($numero){
			$fino = 1;
			$largo = 3;
			$altura = 37;

			$barcodes[0] = '00110';
			$barcodes[1] = '10001';
			$barcodes[2] = '01001';
			$barcodes[3] = '11000';
			$barcodes[4] = '00101';
			$barcodes[5] = '10100';
			$barcodes[6] = '01100';
			$barcodes[7] = '00011';
			$barcodes[8] = '10010';
			$barcodes[9] = '01010';

			for($f1 = 9; $f1 >= 0; $f1--){
				for($f2 = 9; $f2 >= 0; $f2--){
					$f = ($f1*10)+$f2;
					$texto = '';
					for($i = 1; $i < 6; $i++){
						$texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
					}
					$barcodes[$f] = $texto;
				}
			}

			echo '<img src="./teste/imagens/p.jpg" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="./teste/imagens/b.jpg" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="./teste/imagens/p.jpg" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="./teste/imagens/b.jpg" width="'.$fino.'" height="'.$altura.'" border="0" />';

			echo '<img ';

			$texto = $numero;

			if((strlen($texto) % 2) <> 0){
				$texto = '0'.$texto;
			}

			while(strlen($texto) > 0){
				$i = round(substr($texto, 0, 2));
				$texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));

				if(isset($barcodes[$i])){
					$f = $barcodes[$i];
				}

				for($i = 1; $i < 11; $i+=2){
					if(substr($f, ($i-1), 1) == '0'){
						$f1 = $fino ;
					}else{
						$f1 = $largo ;
					}

					echo 'src="./teste/imagens/p.jpg" width="'.$f1.'" height="'.$altura.'" border="0">';
					echo '<img ';

					if(substr($f, $i, 1) == '0'){
						$f2 = $fino ;
					}else{
						$f2 = $largo ;
					}

					echo 'src="./teste/imagens/b.jpg" width="'.$f2.'" height="'.$altura.'" border="0">';
					echo '<img ';
				}
			}
			echo 'src="./teste/imagens/p.jpg" width="'.$largo.'" height="'.$altura.'" border="0" />';
			echo '<img src="./teste/imagens/b.jpg" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="./teste/imagens/p.jpg" width="1" height="'.$altura.'" border="0" />';
	}

	
		
	 
 

 	?>
  
        
<page backtop="7mm" backbottom="0mm" backleft="4.8mm" backright="4.8mm" style="font-size: 12pt">
	<table cellpadding="0" cellspacing="0" border="0" style="margin:0">
	<tr>
	<?
		$i = 0;
		$count = 0;
		while ($lis = mysql_fetch_array($query, MYSQL_ASSOC)) {
			
			
			if($lis['pp'] > 0){
				while($count < $lis['pp']){
					if($i == '5'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
	?>
	
		<td style="width:39.3mm; height:20.4mm; margin:0px;padding:0; text-align:left; vertical-align: top; border:0px solid #ccc">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0.2mm">
				<tr style="text-align:center">
					<td style="padding:0px 0 0px 10px">
						<?=geraCodigoBarra($lis['referencia']);?>
					</td>
					<td style="padding:3px 0 10px 0; width:80px; text-align:center">
						<h4 style="font-size:25px;font-family:hurmegeometricsans4; margin:0">PP</h4>
					</td>
				</tr>
				<tr style="text-align:center">
					<td style="padding:0px 10px 11.5px">
						<h4 style="font-size:12px; margin:0"><?=$lis['referencia'];?></h4>
					</td>
					<td style="padding-bottom:2px">
						
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
					if($i == '5'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
	?>
	
		<td style="width:39.3mm; height:20.4mm; margin:0px;padding:0; text-align:left; vertical-align: top; border:0px solid #ccc">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0.2mm">
				<tr style="text-align:center">
					<td style="padding:0px 0 0px 10px">
						<?=geraCodigoBarra($lis['referencia']);?>
					</td>
					<td style="padding:3px 0 10px 0; width:80px; text-align:center">
						<h4 style="font-size:25px;font-family:hurmegeometricsans4; margin:0">P</h4>
					</td>
				</tr>
				<tr style="text-align:center">
					<td style="padding:0px 10px 11.5px">
						<h4 style="font-size:12px; margin:0"><?=$lis['referencia'];?></h4>
					</td>
					<td style="padding-bottom:2px">
						
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
					if($i == '5'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
				
	?>
	
		<td style="width:39.3mm; height:20.4mm; margin:0px;padding:0; text-align:left; vertical-align: top; border:0px solid #ccc">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0.2mm">
				<tr style="text-align:center">
					<td style="padding:0px 0 0px 10px">
						<?=geraCodigoBarra($lis['referencia']);?>
					</td>
					<td style="padding:3px 0 10px 0; width:80px; text-align:center;">
						<h4 style="font-size:25px;font-family:hurmegeometricsans4; margin:0">M</h4>
					</td>
				</tr>
				<tr style="text-align:center">
					<td style="padding:0px 10px 11.5px">
						<h4 style="font-size:12px; margin:0"><?=$lis['referencia'];?></h4>
					</td>
					<td style="padding-bottom:2px">
						
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
					if($i == '5'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
	?>
	
		<td style="width:39.3mm; height:20.4mm; margin:0px;padding:0; text-align:left; vertical-align: top; border:0px solid #ccc">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0.2mm">
				<tr style="text-align:center">
					<td style="padding:0px 0 0px 10px">
						<?=geraCodigoBarra($lis['referencia']);?>
					</td>
					<td style="padding:3px 0 10px 0; width:80px; text-align:center">
						<h4 style="font-size:25px;font-family:hurmegeometricsans4; margin:0">G</h4>
					</td>
				</tr>
				<tr style="text-align:center">
					<td style="padding:0px 10px 11.5px">
						<h4 style="font-size:12px; margin:0"><?=$lis['referencia'];?></h4>
					</td>
					<td style="padding-bottom:2px">
						
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
					if($i == '5'){
						$i = 1;
						echo '</tr><tr>';
					}else{
						$i++;
					}
	?>
	
		<td style="width:39.3mm; height:20.4mm; margin:0px;padding:0; text-align:left; vertical-align: top; border:0px solid #ccc">
			<table cellpadding="0" cellspacing="0" border="0" style="margin:0.2mm">
				<tr style="text-align:center">
					<td style="padding:0px 0 0px 10px">
						<?=geraCodigoBarra($lis['referencia']);?>
					</td>
					<td style="padding:3px 0 10px 0; width:80px; text-align:center;">
						<h4 style="font-size:25px;font-family:hurmegeometricsans4; margin:0">U</h4>
					</td>
				</tr>
				<tr style="text-align:center">
					<td style="padding:0px 10px 11.5px">
						<h4 style="font-size:12px; margin:0"><?=$lis['referencia'];?></h4>
					</td>
					<td style="padding-bottom:2px">
						
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
