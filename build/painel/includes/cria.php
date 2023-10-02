<?
	$prods = $resulSeo->lista('seo');
	foreach($prods as $pro){
		foreach($pro as $p => $v){
			if($v == '1'){		
				if(!file_exists($p.'.php') and $p != 'id'){
					copy('includes/lista.php', $p.'.php');
					copy('includes/cadastra.php', 'cad_'.$p.'.php');
				}
			}
		}
	}		
?>