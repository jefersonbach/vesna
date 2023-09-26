<?

	function geraNumeros($quantidade, $minimo, $maximo)
{
	$listaDeNumeros = range($minimo, $maximo);
	$numeros = array_rand(array_flip($listaDeNumeros), $quantidade);
 
	$numeros = array_map( function ($value){
		return str_pad($value, 2, '0', STR_PAD_LEFT);	
	}, $numeros);
 
	return implode($numeros, '-');
}
 

		
		
		shuffle($at);
	
		if($_GET['quant']){
			$qq = 1;
			$i = 1;
			$o=1;
			while($o < $_GET['quant']){
				$o++;
				if($qq == 1){?>
	<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm" style="font-size: 12pt">
			<img src="../painel/bingo<?=$_GET['rodada']?>.png" style="width:100%; left:0; top:0; position:absolute; z-index:1111" />
			<div style="margin:0; position: absolute; z-index:8888; left:0; top:190px; width:100%">
						<? } ?>
			
				
			
		<? if($qq == 1 and $o != 0){$o = $o-1;}?>
				<div style="width:950px; height:200px; margin:12px 20px 12px -10px; position:relative">
				<div style="font-size:12px; line-height:12px;display:inline-block; padding:5px 5px; border-radius:0px; color:#fff;text-align:center; background:#002512; width:300px; margin:<? if($qq == 1 and $o != 0){?>12.2px<?}else{?>15.5px<?}?> 130px 20px">
					PRÊMIO <?=$_GET['premio']?><span style="display:inline-block; margin:0 20px"> </span>
					CARTELA NÚMERO: <strong style="font:12px/12px 'hurme_geometric_sans_3SBd'; "><?=$o?></strong></div>
					
					<? 

						$altc = array(1,1,2,3,3,2,3,2,1,2);
						shuffle($altc);
						//print_r($altc);
						?>
						<div style="position:absolute; left:65px; top:57px; width:40px; height:150px">	
							<?
							$numb1 = explode('-',geraNumeros($altc[0]+1, 1, 9) . PHP_EOL);
							$volt1 = 1;
							while($volt1 <= $altc[0]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb1[$volt1]?></div>
								<?
								$volt1++;
							}
							?>
						</div>	
					
						<div style="position:absolute; left:108px; top:57px; width:40px; height:150px">	
						<?
							$numb2 = explode('-',geraNumeros($altc[1]+1, 10, 19) . PHP_EOL);
							$volt2 = 1;
							while($volt2 <= $altc[1]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb2[$volt2]?></div>
								<?
								$volt2++;
							}
						?>
						</div>	
				
						<div style="position:absolute; left:155px; top:57px; width:40px; height:150px">	
						<?
							$numb3 = explode('-',geraNumeros($altc[2]+1, 20, 29) . PHP_EOL);
							$volt3 = 1;
							while($volt3 <= $altc[2]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb3[$volt3]?></div>
								<?
								$volt3++;
							}
						?>
						</div>

						<div style="position:absolute; left:200px; top:57px; width:40px; height:150px">	
						<?
							$numb4 = explode('-',geraNumeros($altc[3]+1, 30, 39) . PHP_EOL);
							$volt4 = 1;
							while($volt4 <= $altc[3]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb4[$volt4]?></div>
								<?
								$volt4++;
							}
						?>
						</div>


						<div style="position:absolute; left:243px; top:57px; width:40px; height:150px; ">	
						<?
							$numb5 = explode('-',geraNumeros($altc[4]+1, 40, 49) . PHP_EOL);
							$volt5 = 1;
							while($volt5 <= $altc[4]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb5[$volt5]?></div>
								<?
								$volt5++;
							}
						?>
						</div>
					
					
						<div style="position:absolute; left:289px; top:57px; width:40px; height:150px; ">	
						<?
							$numb6 = explode('-',geraNumeros($altc[5]+1, 50, 59) . PHP_EOL);
							$volt6 = 1;
							while($volt6 <= $altc[5]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb6[$volt6]?></div>
								<?
								$volt6++;
							}
						?>
						</div>	
					
					
					
						<div style="position:absolute; left:334px; top:57px; width:40px; height:150px; ">	
						<?
							$numb7 = explode('-',geraNumeros($altc[6]+1, 60, 69) . PHP_EOL);
							$volt7 = 1;
							while($volt7 <= $altc[6]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb7[$volt7]?></div>
								<?
								$volt7++;
							}
						?>
						</div>

						

						<div style="position:absolute; left:378px; top:57px; width:40px; height:150px; ">	
						<?
							$numb8 = explode('-',geraNumeros($altc[7]+1, 70, 79) . PHP_EOL);
							$volt8 = 1;
							while($volt8 <= $altc[7]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb8[$volt8]?></div>
								<?
								$volt8++;
									}
								?>
						</div>

						<div style="position:absolute; left:422px; top:57px; width:40px; height:150px; ">	
						<?
							$numb9 = explode('-',geraNumeros($altc[8]+1, 80, 89) . PHP_EOL);
							$volt9 = 1;
							while($volt9 <= $altc[8]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb9[$volt9]?></div>
								<?
								$volt9++;
							}
						?>
						</div>
					
						<div style="position:absolute; left:465px; top:57px; width:40px; height:150px; ">	
						<?
							$numb10 = explode('-',geraNumeros($altc[9]+1, 90, 99) . PHP_EOL);
							$volt10 = 1;
							while($volt10 <= $altc[9]){
								?>
								<div style="display:inline-block; font-size:25px; width:40px; text-align:center; height:65px;color:#fff;"><?=$numb10[$volt10]?></div>
								<?
								$volt10++;
							}
						?>
						</div>		
				</div>
		
			<?
				
				
				if($qq == 2){$qq = 0;?>
						</div>
					</page>
				<?
					
				}else{
					$qq++;
				}
				
				$i++;
			}
			
		}

	?>

