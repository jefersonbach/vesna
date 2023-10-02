<?
include('class.banco.php');
$resulSeo = new connect();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY, 'pt_BR');
?>
<div style="float:none; text-align:right; width:100%">
    <h2 style="color:#666; font-size:11px; margin:10px 0 0; padding:0; line-height:16px">Detalhes dos</h2>
    <h1 style="color:#666; margin:0px 0 0; padding:0; line-height:25px; font-size:25px">Valores</h1>
</div>
<div style="height:300px; overflow-y: scroll">
 <table style="width:100%; border-bottom:2px solid #222" id="orctable" cellpadding="0px" cellspacing="0">
 <tbody>
<? if($_POST['produtos']){
			
                        $total = 0;
                                    $envPrec = 0;
                        $ita = explode(',',$_POST['produtos']);
                                    unset($ita[0]);
                                    foreach($ita as $pp){
                                        $gg = explode('-',$pp);
                                    $count = count($ita);
                                    $prodsa = $resulSeo->lista('produtos', "id = '".$gg[2]."'");
                                    
                                    foreach($prodsa as $produto){
                                        if($produto['desconto']){
                                            $resultado = str_replace('.', '', $produto['desconto']);
                                        }else{
                                            $resultado = str_replace('.', '', $produto['preco']);
                                        }
                                        $resultado = str_replace(',', '.', $resultado);
                                        
                                      $total = ($total + $resultado);
                                        ?>
                                            
                                                <tr style=" color:#fff">
                                                                
                                                        <td style="padding:10px 1px; border-bottom:1px solid #555; text-align:left; line-height:11px">
                                                                <strong style="font:11px/11px 'opensans-regular'; width:100%; margin:0; padding:0; display:inline-block"><?=$produto['nome']?></strong>
                                                                 
                                                        </td>
                                                        <td style="padding:10px 1px; border-bottom:1px solid #555;  text-align:center">
                                                           <strong style="font:11px/11px 'opensans-regular';  margin:0; padding:0; display:inline-block"><?=$gg[0]?></strong>
                                                             <span style="font:11px/11px 'opensans-regular';  margin:0; padding:0; display:inline-block"> - <?=$produto['corNome']?></span>
                                                        </td>
                                                        <td width="70px" style="padding:10px 1px; border-bottom:1px solid #555; text-align:right; line-height:11px">
                                                            
                                                            <? 
                                                            if($produto['desconto']){
                                                               
                                                                echo '<strong style="text-decoration:line-through; font:11px/11px \'opensans-regular\'; width:100%; margin:0; padding:0; display:inline-block">de R$ '.$produto['preco'].'</strong>';
                                                                ?>
                                                                    <strong style="font:14px/14px 'opensans-regular'; width:100%; margin:0; padding:0; display:inline-block">R$ <?=$produto['desconto']?></strong>
                                                                    <?

                                                            }else{
                                                                ?>
                                                                    <strong style=" width:100%; margin:0; padding:0; display:inline-block">R$ <?=$produto['preco']?></strong>
                                                                <?

                                                            }
                                                            ?>
                                                            
                                                            
                                                            
                                                        </td>
                                                </tr>

                                                <?
                                 

                                }
                                    }
    $valorTotal = str_replace(',','.',$_POST['envioPreco']) + $total;
    $envPrec = $_POST['envioPreco'];
                                ?>
                        </tbody>
                </table>
</div>
                    <div style="width:100%; text-align:right; padding-top:15px">
                        <span style="width:60%; float:left; color:#777; font-size:12px; line-height:11px; margin-top:5px">Total parcial </span>
                        <strong style="padding:5px 0 0; width:40%; float:right;font:15px/15px 'opensans-regular'; color:#eee"><?=money_format('%n',$total)?></strong>
                        <div class="controle"></div>
                    </div>
                
                <div style="width:100%; margin:0; padding:6px 0; text-align:right">
                    <span style="width:60%; float:left;color:#777; font-size:12px; line-height:11px">Valor entrega </span>
                    <strong style="font:15px/15px 'opensans-regular'; width:40%; float:right; color:#eee"><?=money_format('%n',$_POST['envioPreco'])?></strong>
                    <div class="controle"></div>
                </div>
                <div style="width:100%; text-align:right">
                    <span style="width:60%; float:left; color:#777; font-size:12px; line-height:11px;margin-top:5px">Valor Total </span>
                    <strong style="color:#76d411; font:20px/20px 'opensans-regular'; width:40%; float:right"><?=money_format('%n',$valorTotal)?></strong>
                    <div class="controle"></div>
                <? if($_POST['parcelas']){?>
                <strong style="text-align:right;color:#999; font-size:11px"><?=$_POST['parcelas']?>x de <span id="formaPagamento" style="color:#999;font-size:11px"><?=money_format('%n',$valorTotal/$_POST['parcelas'])?></span></strong>
    </div>
    
    <? } } ?>
    
    
    
                                      
			