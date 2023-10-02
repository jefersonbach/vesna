<? 
include('class.banco.php');
$orcas = new conect();
$orcs = $orcas->lista('orcamentos', 'novo = 1'); 
	$i = 1;
	foreach($orcs as $lis){
		$numOrc = $i++;
		if($numOrc >= 0){?>
			<span class="badge badge-important" style="position:absolute;top:-12px;right:-21px; font-size:9px; padding:5px; font-weight:normal; font-style:normal; color:#fff; line-height:9px"><?=$numOrc?></span>
		<?
		}
	 } 
?>