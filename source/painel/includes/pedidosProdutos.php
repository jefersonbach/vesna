<?
include('class.banco.php');
$resulSeo = new connect();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>
<div style="float:none; text-align:right; width:100%">
    <h2 style="color:#666; font-size:11px; margin:10px 0 0; padding:0; line-height:16px">Lista de</h2>
    <h1 style="color:#666; margin:0px 0 0; padding:0; line-height:25px; font-size:25px">Produtos</h1>
</div>

<? if($_POST['produtos']){
			//echo '1;';
            $pedid = $resulSeo->lista('lojas_pedidos', "id = '".$_POST['produtos']."'");
                       // echo $pedid['itens'];
            $ita = unserialize($pedid[0]['itens']);
                                    //unset($ita[0]);
                                   // print_r($ita);
                                   // die;
                                    $count = count($ita);
                                    ?>
<div style="width:100%; overflow-x: scroll; height:380px; padding-bottom:10px; margin-top:40px">
                                    <?
                                    foreach($ita as $orc){
                                    $codigo = $orc['id'];
                                    //$total = str_replace(',','.',$produto['preco']) + $total;
                                    //$totalPeso = $produto['peso'] + $totalPeso;
                                    $i++;

                                    $prodsa = $resulSeo->lista('produtos', "EAN = '".$codigo."'");
                                    //print_r($prodsa);
                                    foreach($prodsa as $produto){

                                        $nome = $produto['Nome'];
                                        $imgProd[0] = NULL;
                                        $imgProd = unserialize($produto['Imagens']);
                                        $imgProd = $imgProd['produtoimagem'];
                                     
                                        ?>
                                            
                                            <div id="linhaInterno-<?=$i?>" style="width:131px; margin:2px;float:left; border-left:0px solid #<?=$produto['cor']?>;  padding:5px 5px 20px; border-radius:3px; background:#fff;">
                                                <?
                ?>
                           
                                                                            <a href="/painel/cad_produtos.php?editar=<?=$produto['id']?>&token=<?=$produto['token']?>"  style=" display:inline-block;width:100%;  margin:0;  padding:0; line-height:19px;">
                                                                                <img src="<?php echo $imgProd[0]['Url']; ?>" alt="<?php echo $nome; ?>" />
                                                                                <div style="height:45px; line-height:12px">
                                                                                    <strong style="margin:10px 0 0; padding:0; font-size:12px; border-radius:6px?>"><?=$nome?></strong>
                                                                                </div>
                                                                                <strong style="margin:10px 0 0; padding:0; font-size:12px;color:#222">EAN: <?=$produto['EAN']?></strong><br />
                                                                                   
                                                                                <span style="margin:10px 0 0; padding:0; font-size:18px">R$<?=$orc['preco']?></span><br />
                                                                                <span style="margin:10px 0 0; padding:0; font-size:12px">Cor: <?=$orc['cor']?></span><br />
                                                                                <span style="margin:10px 0 0; padding:0; font-size:12px">Tamanho:<?=$orc['tamanho']?></span>
                                                                                <span style="margin:10px 0 0; padding:0; font-size:12px">Quantidade:<?=$orc['quantidade']?></span>
                                                                            </a>
                                                                            
                                                                            
                                                                        </div>
                                            
                                            
                                            <?
                                        
                                        
											}
											
                                        
                                        
                                    }
                        
                        ?>
                            
                            
                            <?
		
		}
?>
    
    </div>
    
    <? $nomeCliente = $nome; ?>
			