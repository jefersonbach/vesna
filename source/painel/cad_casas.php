<? 
include('includes/topo.php'); 
$rProd = new connect();

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
            <div class="contentCad">
                <div class="alignCenter">
                    <div class="divLab">
                        <strong>Ativo</strong>
                        <label class="inpChecLabel">&nbsp;<input type="radio" name="ativo" value="Sim" class="checkR" <? if($ativo == 'Sim'){echo 'checked';}?> />Sim</label>
                        <label class="inpChecLabel inpChecLabelB">&nbsp;<input type="radio" name="ativo" value="Nao" class="checkR" <? if($ativo == 'Nao'){echo 'checked';}?> />Não</label>
                        <div class="controle">&nbsp;</div>
                    </div>
                    <div class="controle">&nbsp;</div>
                    
                    <label><strong>Nome</strong><input type="text" class="span5" name="nome" value="<?=$nome?>" /></label>
                   
                    <br />
                    <hr />
                    
                    <table>
                        <thead>
                            <tr>
                            <td style="padding:8px; background:#f4f4f4"><strong></strong> </td>
                                <td style="padding:8px; background:#f4f4f4"><strong> Nome da Coluna</strong> </td>
                                <td style="padding:8px; background:#f4f4f4"><strong> Pos. no Exel</strong> </td>
                                <td style="padding:8px; background:#f4f4f4"><strong> Calculo no Final</strong> </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:8px;"></td>
                                <td style="padding:8px;">Data</td>
                                <td style="padding:8px;"><input type="text" name="colunaData"  value="<?=$colunaData?>" class="span1" /></td>
                                <td style="padding:8px;">
                                <span style="font-size:11px;">Coluna com a data do relatorio</span>
                                </td>
                                
                            </tr>
                            <tr style="border-bottom:4px solid #e1e1e1">
                                <td style="padding:8px;"></td>
                                <td style="padding:8px;">ID. Parceiro</td>
                                <td style="padding:8px;"><input type="text" name="colunaId"  value="<?=$colunaId?>" class="span1" /></td>
                                <td style="padding:8px;">
                                <span style="font-size:11px;">Coluna com o id do parceiro</span>
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="padding:8px;">1</td>
                                <td style="padding:8px;">Campanha</td>
                                <td style="padding:8px;"><input type="text" name="brand"  value="<?=$brand?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="Acaobrand" class="span2">
                                        <option value="" <? if($Acaobrand == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($Acaobrand == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($Acaobrand == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">2</td>
                                <td style="padding:8px;">Clicks</td>
                                <td style="padding:8px;"><input type="text" name="visits"  value="<?=$visits?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="Acaovisits"  value="<?=$Acaovisits?>" class="span2">
                                        <option value="" <? if($Acaovisits == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($Acaovisits == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($Acaovisits == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">3</td>
                                <td style="padding:8px;">Cadastros</td>
                                <td style="padding:8px;"><input type="text" name="opens"  value="<?=$opens?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="Acaoopens"  value="<?=$Acaoopens?>" class="span2">
                                        <option value="" <? if($Acaoopens == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($Acaoopens == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($Acaoopens == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            <td style="padding:8px;">4</td>
                                <td style="padding:8px;">Depósitos</td>
                                <td style="padding:8px;"><input type="text" name="NewActiveDepositors"  value="<?=$NewActiveDepositors?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoNewActiveDepositors"  value="<?=$AcaoNewActiveDepositors?>" class="span2">
                                        <option value="" <? if($AcaoNewActiveDepositors == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoNewActiveDepositors == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoNewActiveDepositors == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">5</td>
                                <td style="padding:8px;">Bloqueado</td>
                                <td style="padding:8px;"><input type="text" name="NewLocked" value="<?=$NewLocked?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoNewLocked"  value="<?=$AcaoNewLocked?>" class="span2">
                                        <option value="" <? if($AcaoNewLocked == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoNewLocked == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoNewLocked == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">6</td>
                                <td style="padding:8px;">Moeda</td>
                                <td style="padding:8px;"><input type="text" name="DealCurrency"  value="<?=$DealCurrency?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoDealCurrency"  value="<?=$AcaoDealCurrency?>" class="span2">
                                        <option value="" <? if($AcaoDealCurrency == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoDealCurrency == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoDealCurrency == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">7</td>
                                <td style="padding:8px;">Cassino Rev. S. Net</td>
                                <td style="padding:8px;"><input type="text" name="CasinoNetRevenue"  value="<?=$CasinoNetRevenue?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoCasinoNetRevenue"  value="<?=$AcaoCasinoNetRevenue?>" class="span2">
                                        <option value="" <? if($AcaoCasinoNetRevenue == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoCasinoNetRevenue == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoCasinoNetRevenue == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">8</td>
                                <td style="padding:8px;">Esportes Rev. S.</td>
                                <td style="padding:8px;"><input type="text" name="SportsNetRevenue"  value="<?=$SportsNetRevenue?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoSportsNetRevenue"  value="<?=$AcaoSportsNetRevenue?>" class="span2">
                                        <option value="" <? if($AcaoSportsNetRevenue == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoSportsNetRevenue == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoSportsNetRevenue == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">9</td>
                                <td style="padding:8px;">Net Revenue</td>
                                <td style="padding:8px;"><input type="text" name="NetRevenue"  value="<?=$NetRevenue?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoNetRevenue"  value="<?=$AcaoNetRevenue?>" class="span2">
                                        <option value="" <? if($AcaoNetRevenue == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoNetRevenue == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoNetRevenue == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">10</td>
                                <td style="padding:8px;">Ganhos Rev. S.</td>
                                <td style="padding:8px;"><input type="text" name="RevenueShareEarnings"  value="<?=$RevenueShareEarnings?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoRevenueShareEarnings"  value="<?=$AcaoRevenueShareEarnings?>" class="span2">
                                        <option value="" <? if($AcaoRevenueShareEarnings == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoRevenueShareEarnings == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoRevenueShareEarnings == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">11</td>
                                <td style="padding:8px;">CPA</td>
                                <td style="padding:8px;"><input type="text" name="CPAQualified"  value="<?=$CPAQualified?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoCPAQualified"  value="<?=$AcaoCPAQualified?>" class="span2">
                                        <option value="" <? if($AcaoCPAQualified == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoCPAQualified == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoCPAQualified == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;">12</td>
                                <td style="padding:8px;">Ganhos CPA</td>
                                <td style="padding:8px;"><input type="text" name="CPAEarnings"  value="<?=$CPAEarnings?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoCPAEarnings"  value="<?=$AcaoCPAEarnings?>" class="span2">
                                        <option value="" <? if($AcaoCPAEarnings == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoCPAEarnings == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoCPAEarnings == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="padding:8px;">13</td>
                                <td style="padding:8px;">Ganhos Total</td>
                                <td style="padding:8px;"><input type="text" name="TotalEarnings"  value="<?=$TotalEarnings?>" class="span1" /></td>
                                <td style="padding:8px;">
                                    <select name="AcaoTotalEarnings"  value="<?=$AcaoTotalEarnings?>" class="span2">
                                        <option value="" <? if($AcaoTotalEarnings == ''){echo 'selected';}?>>Nada</option>
                                        <option value="soma" <? if($AcaoTotalEarnings == 'soma'){echo 'selected';}?>>Somar</option>
                                        <option value="media" <? if($AcaoTotalEarnings == 'media'){echo 'selected';}?>>Média</option>
                                    </select>
                                </td>
                                
                            </tr>

                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="contentCadr">
                <div class="alignCenter">
                	
                    
                   	<div class="conteiner" id="img-file" style="width:535px; margin-top:20px">
                       <label><strong>Logotipo</strong><input type="file" name="arquivo" /></label> 
                        
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
    
  
