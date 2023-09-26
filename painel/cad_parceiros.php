<? 
include('includes/topo.php');
$nPag = explode('/',$_SERVER['PHP_SELF']);
$p = substr($nPag[2],4,-4);
if($_POST){
	$post['clean_url'] = $rProd->clean_url($_POST['nome']);


	$diag = $rProd->cadastros($post, $p);
}


$_SESSION['pagina'] = $p;
if($_SESSION['id_ficha'] == ""){
	 $_SESSION['id_ficha'] = md5(uniqid(rand(), true));
}
$_SESSION['caminho'] = '../../arquivos/'.$p.'/';

?>
<div style="width:100%;">
    <div id="contentTitu">
        <h1>Cadastro de <?=$p?></h1>
        <div id="btnF">
            <a href="<?=$p?>.php" class="btng">Listar <?=$p?></a>
            <a href="cad_<?=$p?>.php" class="btngSel">Cadastrar <?=$p?></a>
        </div>
        <div class="controle">&nbsp;</div>
    </div>
    <div style="width:100%;">
    <? if($_GET['editar']){ 
			$prods = $rProd->lista($p, 'id = '.$_GET['editar'].'');
			foreach($prods as $lis){
				extract($lis);
			}
		
		}
?>
        <form method="post" action="<?=$p?>.php" enctype="multipart/form-data">
            <div class="contentCad" style="width:35%; margin-left:5%; ">
                <div class="alignCenter" style="max-width:none">
                    <div class="divLab">
                        <strong>Ativo</strong>
                        <label class="inpChecLabel">&nbsp;<input type="radio" name="ativo" value="Sim" class="checkR" <? if($ativo == 'Sim'){echo 'checked';}?> />Sim</label>
                        <label class="inpChecLabel inpChecLabelB">&nbsp;<input type="radio" name="ativo" value="Nao" class="checkR" <? if($ativo == 'Nao'){echo 'checked';}?> />Não</label>
                        <div class="controle">&nbsp;</div>
                    </div>
                    <div class="controle">&nbsp;</div>
                    
                    
                    <label><strong>Parceiro</strong><input type="text" class="span3" name="nome" value="<?=$nome?>" /></label>  

                    <label><strong>Site</strong><input type="text" class="span3" name="site" value="<?=$site?>" /></label>

                    <div class="controle"></div>
                    <br />
                    <hr />
                    <br />
                    <div class="divLab" style="height: auto !important; background:#f4f4f4; border-radius:6px; padding:10px">
                        <label class="inpChecLabel" style="width:140px; line-height:14px">&nbsp;<input type="radio" name="afiliado" value="Nao" class="checkR" <? if($afiliado == 'Nao'){echo 'checked';}?> /> <strong style="width:110px"> Parceiro</strong></label>
                        <label class="inpChecLabel inpChecLabelB" style="width:200px; line-height:14px">&nbsp;<input type="radio" name="afiliado" id="afiSim" value="Sim" class="checkR" <? if($afiliado == 'Sim' or $afiliado == ''){echo 'checked';}?> /><strong>Afiliado a um Parc.</strong></label>
                        <div class="controle">&nbsp;</div>
                        <label id="pai" <? if($afiliado == 'Nao'){echo 'style="display:none"';}?>>
                            <select name="pai[]" class="span4" multiple style="height:200px">
                                <? 
                                    $prodsa = $rProd->lista('parceiros','','','nome asc');
                                    $pai = explode(',', $pai);
                                    foreach($prodsa as $pais){
                                        ?>
                                        <option value="<?=$pais['id']?>" <? if(in_array($pais['id'], $pai)){echo 'selected';}?> style="color:#333; padding:5px 5px 5px 20px"><?=$pais['nome']?></option>
                                        <?
                                    } 
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="controle">&nbsp;</div>
                    
                </div>
            </div>
            <div class="contentCadr" style="width:60%">
                <div class="alignCenter" style="max-width:90%; margin:0 auto">
                <?
                $regras = unserialize($regras);
                
                ?>

                <ul class="nav nav-tabs">
                    <? 
                    $active = 'class="active"';
                        $prodsa = $rProd->lista('casas');
                        foreach($prodsa as $pais){
                            
                    ?>
                        <li <?=$active?>><a data-toggle="tab" href="#casa<?=$pais['id']?>"><?=$pais['nome']?></a></li>
                    <?
                    $active = '';
                        } 
                    ?>
                </ul>

        <div class="tab-content">
            <? 
            $active = 'active';
            foreach($prodsa as $pais){
                ?>
                <div id="casa<?=$pais['id']?>" class="tab-pane fade in <?=$active?>">
                    <table>
                <?
                for ($i = 1; $i <= 5; $i++) {?>
                
                        <tr style="border-top:5px solid #eee;">
                            <td colspan="4">
                                <strong>Regra <?=$i?>&nbsp;</strong><br />
                                <span class="spanMini" style="font-size:10px; opacity:0.7"><strong> COL=2 </strong>  - para escolher o valor da coluna 2</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px">
                                <select name="casa[<?=$pais['id']?>][regra<?=$i?>][acao]" class="span2">
                                    <option value=""  <? if($regras[$pais['id']]['regra'.$i]['acao'] == ''){echo 'selected';}?>>Sem regra</option>
                                    <option value="+"  <? if($regras[$pais['id']]['regra'.$i]['acao'] == '+'){echo 'selected';}?>>(+) Adicionar</option>
                                    <option value="-" <? if($regras[$pais['id']]['regra'.$i]['acao'] == '-'){echo 'selected';}?>>(-) Descontar</option>
                                    <option value="/" <? if($regras[$pais['id']]['regra'.$i]['acao'] == '/'){echo 'selected';}?>>(/) Dividir</option>
                                    <option value="=" <? if($regras[$pais['id']]['regra'.$i]['acao'] == '='){echo 'selected';}?>>(≠) Substituir</option>
                                </select>
                                &nbsp;
                            </td>
                            <td style="padding-top:10px">na coluna <input type="text" class="span1" style="width:20px" name="casa[<?=$pais['id']?>][regra<?=$i?>][coluna]" value="<?=$regras[$pais['id']]['regra'.$i]['coluna']?>" />&nbsp;</td>
                            <td style="padding-top:10px">
                                o
                                <select name="casa[<?=$pais['id']?>][regra<?=$i?>][tipo]" class="span2">
                                <option value=""  <? if($regras[$pais['id']]['regra'.$i]['tipo'] == ''){echo 'selected';}?>></option>
                                    <option value="numero" <? if($regras[$pais['id']]['regra'.$i]['tipo'] == 'numero'){echo 'selected';}?>>(=) Valor final</option>
                                    <option value="coluna" <? if($regras[$pais['id']]['regra'.$i]['tipo'] == 'coluna'){echo 'selected';}?>>(||) Valor da coluna</option>
                                    <option value="percentual" <? if($regras[$pais['id']]['regra'.$i]['tipo'] == 'percentual'){echo 'selected';}?>>(%) Percentual</option>
                                </select>
                                &nbsp;
                            </td>
                            <td style="padding-top:10px">
                                de <input type="text" class="span1" style="width:50px" name="casa[<?=$pais['id']?>][regra<?=$i?>][valor]" value="<?=$regras[$pais['id']]['regra'.$i]['valor']?>" />
                                + <input type="text" class="span1" style="font-size:11px; width:50px; padding:6px 0 6px 3px" name="casa[<?=$pais['id']?>][regra<?=$i?>][mais]" value="<?=$regras[$pais['id']]['regra'.$i]['mais']?>" />
                            </td>
                            <td style="padding-left: 25px">
                                <input type="checkbox" style="margin:0" name="casa[<?=$pais['id']?>][regra<?=$i?>][mostrar]" <? if($regras[$pais['id']]['regra'.$i]['mostrar'] == 'sim'){echo 'checked';}?> value="sim" /> Mostrar regra 
                            </td>
                        </tr>

                    
                    <? 
                
                //$i++;
                    }
                    $active = '';
                ?>
                </table>	
                        </div>
                <?
                }
                ?>
                
                </div>









                    
                



                </div>
            </div>
            <div class="controle">&nbsp;</div>
            <div style="margin:20px 0 0; text-align:right">
                <div class="form-actions">
                	<? if($_SESSION['id_ficha']){?><input type="hidden" name="token" value="<?=$_SESSION['id_ficha']?>" /><? }?>
                    <? if($_SESSION['token']){?><input type="hidden" name="token" value="<?=$_SESSION['token']?>" /><? }?>
                	<input type="hidden" id="id" name="id" value="<? if($_GET['editar']){echo $_GET['editar'];}?>" />
                    <input type="submit" class="btn btn-primary" value="<? if($_GET['editar']){echo 'Editar';}else{echo 'Salvar';}?>" />
                    <a href="/painel/<?=$p?>.php"><button type="button" class="btn">Cancelar</button></a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){


    $('input[name="afiliado"]').change( function(){
        if($(this).val() == 'Sim'){
            $("#pai").show();
        }else{
            $("#pai").hide();
        }
    });



	$.multiploLoader("#img-file", 'img');
	
	$('.barra-topo').click(function(e) {
		$(this).find('input[type="file"]').click();
	});
	
	$('.barra-topo input').click(function(e) {
		e.stopPropagation();
	});
});

</script>
<? include('includes/rodape.php') ?>
    
  
