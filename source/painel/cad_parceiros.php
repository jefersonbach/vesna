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

    if($_GET['editar']){ 
        $prods = $rProd->lista($p, 'id = '.$_GET['editar'].'');
        foreach($prods as $lis){
            extract($lis);
        }
    }
    $regras = unserialize($regras);
?>
<style>
    .contentCadr label{float: left;
    margin: 10px 0 0 0;
    padding: 0px 5px 0 0;
    line-height: 30px;
    height: auto;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;}

    .contentCadr label strong{width: 125px;
    float: left;
    text-align: left;
    margin: 0 5px 0 5px;
    line-height: 36px;}

    .tituTab{font-size:14px !important}

    
</style>

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
        <form method="post" action="<?=$p?>.php" enctype="multipart/form-data"><br />
        <ul class="nav nav-tabs" style="margin-bottom:0">
            <li class="active"><a data-toggle="tab" href="#info">Informações</a></li>
            <li><a data-toggle="tab" href="#afiliado">Afiliado</a></li>
            <li><a data-toggle="tab" href="#casas">Casas</a></li>
            <li><a data-toggle="tab" href="#regrass">Acordos</a></li>
            <li><a data-toggle="tab" href="#relatorios">Relatórios</a></li>
            <li><a data-toggle="tab" href="#loginss">Logins</a></li>
            
        </ul>

        <div class="tab-content" style="padding-top: 30px; background: rgba(0,0,0,0.05); height:100%; padding-bottom:100px">
            <div  id="info" class="tab-pane fade in active">
                <div class="contentCad" style="width:40%; margin:0 0 0 5%; padding:0; min-width:400px ">
                    <div class="alignCenter" style="max-width:none">
                        <div class="divLab">
                            <strong>Ativo</strong>
                            <label class="inpChecLabel">&nbsp;<input type="radio" name="ativo" value="Sim" class="checkR" <? if($ativo == 'Sim'){echo 'checked';}?> />Sim</label>
                            <label class="inpChecLabel inpChecLabelB">&nbsp;<input type="radio" name="ativo" value="Nao" class="checkR" <? if($ativo == 'Nao'){echo 'checked';}?> />Não</label>
                            <div class="controle">&nbsp;</div>
                        </div>
                        <div class="controle">&nbsp;</div>
                        <label><strong>Parceiro</strong><input type="text" class="span3" name="nome" value="<?=$nome?>" /></label>
                        <label><strong>E-mail</strong><input type="text" class="span3" name="email" value="<?=$email?>" /></label>  
                        <label><strong>Telefone</strong><input type="text" class="span3" name="telefone" value="<?=$telefone?>" /></label>

                        <label><strong>CNPJ</strong><input type="text" class="span3" name="cnpj" value="<?=$cnpj?>" /></label>
                        <label><strong>Responsável</strong><input type="text" class="span3" name="responsavel" value="<?=$responsavel?>" /></label>
                        <div class="controle"></div>
                        <hr />
                        <label><strong>Site</strong><input type="text" class="span3" name="site" value="<?=$site?>" /></label>
                        <div class="controle">&nbsp;</div>
                    </div>
                </div>
                <div class="contentCadr" style="width:40%; margin:0 0 0 5%; padding:0; float:left">
                    <div class="alignCenter" style="max-width:none">
                        <label><strong>CEP</strong><input type="text" class="span3" name="cep" id="cep" value="<?=$cep?>" /></label>
                        <label><strong>Rua</strong><input type="text" class="span3" name="rua" id="rua" value="<?=$rua?>" /></label>
                        <label><strong>Bairro</strong><input type="text" class="span3" name="bairro" id="bairro" value="<?=$bairro?>" /></label>
                        <label><strong>Cidade</strong><input type="text" class="span3" name="cidade" id="cidade" value="<?=$cidade?>" /></label>
                        <label><strong>Estado</strong><input type="text" class="span3" name="estado" id="estado" value="<?=$estado?>" /></label>
                        <label><strong>Número</strong><input type="text" class="span3" name="numero" id="numero" value="<?=$numero?>" /></label>
                        <label><strong>Complemento</strong><input type="text" class="span3" name="complemento" value="<?=$complemento?>" /></label>
                    </div>
                </div>
            </div>

            <div id="afiliado" class="tab-pane fade in">
                <div class="contentCad" style="width:80%; margin:0 0 0 5%; padding:0; min-width:400px ">
                    <div class="alignCenter" style="max-width:none">
                        <label style="width:250px; line-height:22px; float:left; margin:60px 100px 0 50px; display:inline-block; background:#ff; border-radius:10px; padding:20px 40px">&nbsp;
                            <input type="radio" name="afiliado" value="Nao" class="checkR" <? if($afiliado == 'Nao'){echo 'checked';}?> /> 
                            <strong style="width:200px; font-size:22px"> Parceiro Direto</strong>
                            <span>Afiliado direto a Vesna</span>
                        </label>
                        <div class="divLab" style="height: 400px !important; background:#fff; border-radius:6px; padding:10px; width: 350px; margin:0; float:left">
                            <label class="inpChecLabel inpChecLabelB" style="width:300px; line-height:14px">&nbsp;
                                <input type="radio" name="afiliado" id="afiSim" value="Sim" class="checkR" <? if($afiliado == 'Sim' or $afiliado == ''){echo 'checked';}?> />
                                <strong style="width:250px; font-size:22px"> Afiliado a um parceiro</strong>
                            </label>
                            <div class="controle">&nbsp;</div>
                            <label id="pai" <? if($afiliado == 'Nao'){echo 'style="display:none"';}?>>
                                <select name="pai[]" class="span4" multiple style="height:350px">
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
                    </div>
                </div>
            </div>

            <div id="casas" class="tab-pane fade in">
                <div class="alignCenter" style="max-width:90%; margin:0 auto">
                <ul class="nav nav-tabs" style="margin-bottom:0">
                    <style>
 .tabIndex{ transition:0.5s; -webkit-transition:0.5s; margin:0 2px -6px !important; background-color: rgba(255,255,255,0.7);  border-top: 2px solid #eee;}
    .tabIndex .tabSelect{transition:0.5s; -webkit-transition:0.5s; opacity: 0.6; background-size: 70% auto; height:40px; width: 80px; display:inline-block; margin: 0;  background-position: center center; background-repeat:  no-repeat;  -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
  filter: grayscale(100%);}
  .tabIndex.active { border-top: 2px solid #111;}
    .tabIndex.active .tabSelect{transition:0.5s; -webkit-transition:0.5s;opacity:1; background-size: 90% auto;  background-color: #fff;  -webkit-filter: grayscale(0%); /* Safari 6.0 - 9.0 */
  filter: grayscale(0%);}
  table tr:hover {opacity: 1 !important;}
                    </style>
                    <? 
                    $active = 'active';
                    $prodsa = $rProd->lista('casas', "ativo != 'Nao'");
                    foreach($prodsa as $pais){
                    ?>
                        <li class="tabIndex <?=$active?>">
                            <a data-toggle="tab" class="tabSelect" href="#casa<?=$pais['id']?>" style="background-image:  url(/painel/arquivos/casas/<?=$pais['img']?>)">
                            
                            </a>
                        </li>
                    <?
                        $active = '';
                    } 
                    ?>
                </ul>

                <div class="tab-content" style="background: #fff; padding: 0 30px; border:1px solid #e1e1e1; border-top: 0px solid #eee">
                    <? 
                    $active = 'active';
                    foreach($prodsa as $pais){
                        ?>
                        <div id="casa<?=$pais['id']?>" class="tab-pane fade in <?=$active?>">
                        <br />
                            <table>
                                <tr>
                                    <td style="width: 350px; vertical-align:top">
                                        <div class="divLab" style="margin:5px 0 0">
                                            <strong style="float:left; width:120px; line-height:25px">Mostrar casa</strong>
                                            <label class="inpChecLabel" style="float:left; width:60px;  line-height:25px">&nbsp;<input type="radio" style="margin:0" name="casa[<?=$pais['id']?>][mostrarCasa]" value="Sim" class="checkR" <? if($regras[$pais['id']]['mostrarCasa'] == 'Sim'){echo 'checked';}?> />Sim</label>
                                            <label class="inpChecLabel inpChecLabelB" style="float:left; line-height:25px">&nbsp;<input type="radio" style="margin:0" name="casa[<?=$pais['id']?>][mostrarCasa]" value="Nao" class="checkR" <? if($regras[$pais['id']]['mostrarCasa'] == 'Nao'){echo 'checked';}?> />Não</label>
                                            <div class="controle">&nbsp;</div>
                                        </div>
                                    </td>
                                    <td style="padding: 0 40px 10px"><label><strong>Identificador Único do parceiro </strong><input type="text" class="span2" name="casa[<?=$pais['id']?>][nomeIdentificador]" value="<?=$regras[$pais['id']]['nomeIdentificador']?>" /></label></td>
                                </tr>
                            </table>
                            <div class="controle"></div>
                            <table>
                                <tr>
                                    <td style="background:#111; color:#fff"></td>
                                    <td style="background:#111; color:#fff"><strong style="font-size:11px;">Valida até</strong></td>
                                    <td style="background:#111; color:#fff"><strong style="font-size:11px;">Visivel</strong></td>
                                    
                                    <td style="background:#111; color:#fff" colspan="3"></td>
                                    <td style="background:#111; color:#fff"><span class="spanMini" style="font-size:11px; opacity:0.9; margin-left: 90px; line-height:14px"><strong> COL=2 </strong><br /> para o valor da coluna 2</span></td>
                                    
                                    
                                </tr>
                        <?
                            for ($i = 1; $i <= 5; $i++) {
                                $borderColor = '#eee';
                                $opc = '0.6';
                                if($regras[$pais['id']]['regra'.$i]['acao'] != ''){$borderColor = '#111'; $opc = '1';}
                                ?>
                                <tr style="border-top:10px solid #fff; opacity: <?=$opc?>">
                                    <td colspan="1" style="padding:10px 10px 0 15px; background: rgba(0,0,0,0.05); border-radius:10px 10px 0 0; vertical-align: middle; border-left:4px solid <?=$borderColor?>">
                                        <? if($regras[$pais['id']]['regra'.$i]['nome'] == ''){$regras[$pais['id']]['regra'.$i]['nome'] = 'Regra '.$i;}?>
                                        <input type="text" class="span2" placeholder="Nome da regra" style="width: 95px" name="casa[<?=$pais['id']?>][regra<?=$i?>][nome]" value="<?=$regras[$pais['id']]['regra'.$i]['nome']?>" />
                                    </td>
                                    <td colspan="1" style="padding:10px 10px 0 0; background: rgba(0,0,0,0.05); border-radius:10px 10px 0 0; vertical-align: middle;">
                                        <input type="text" class="span2" placeholder="01/01/2023" style="width: 85px" name="casa[<?=$pais['id']?>][regra<?=$i?>][dataValidade]" value="<?=$regras[$pais['id']]['regra'.$i]['dataValidade']?>" />
                                    </td>
                                    <td style="padding: 0 20px 0 0; background: rgba(0,0,0,0.05); vertical-align: middle;">
                                        <input type="checkbox" style="margin:0" name="casa[<?=$pais['id']?>][regra<?=$i?>][mostrar]" <? if($regras[$pais['id']]['regra'.$i]['mostrar'] == 'sim'){echo 'checked';}?> value="sim" /> 
                                    </td>
                                    
                                    <td style="padding:0px 5px 0 15px; background: rgba(0,0,0,0.03); vertical-align: middle;">
                                        <select name="casa[<?=$pais['id']?>][regra<?=$i?>][acao]" class="span2"  style="width: 120px; margin-top:10px">
                                            <option value="" <? if($regras[$pais['id']]['regra'.$i]['acao'] == ''){echo 'selected';}?>>Sem regra</option>
                                            <option value="+" <? if($regras[$pais['id']]['regra'.$i]['acao'] == '+'){echo 'selected';}?>>(+) Adicionar</option>
                                            <option value="-" <? if($regras[$pais['id']]['regra'.$i]['acao'] == '-'){echo 'selected';}?>>(-) Descontar</option>
                                            <option value="/" <? if($regras[$pais['id']]['regra'.$i]['acao'] == '/'){echo 'selected';}?>>(/) Dividir</option>
                                            <option value="=" <? if($regras[$pais['id']]['regra'.$i]['acao'] == '='){echo 'selected';}?>>(≠) Substituir</option>
                                        </select>
                                        &nbsp;
                                    </td>
                                    <td style="padding-top:0px; background: rgba(0,0,0,0.03); vertical-align: middle;">
                                        na coluna 
                                        <input type="text" class="span1" style="width:20px; margin-top:10px" name="casa[<?=$pais['id']?>][regra<?=$i?>][coluna]" value="<?=$regras[$pais['id']]['regra'.$i]['coluna']?>" />&nbsp;
                                    </td>
                                    <td style="padding-top:0px; background: rgba(0,0,0,0.03); vertical-align: middle;">
                                        o
                                        <select name="casa[<?=$pais['id']?>][regra<?=$i?>][tipo]" class="span2" style=" margin-top:10px">
                                        <option value=""  <? if($regras[$pais['id']]['regra'.$i]['tipo'] == ''){echo 'selected';}?>></option>
                                            <option value="numero" <? if($regras[$pais['id']]['regra'.$i]['tipo'] == 'numero'){echo 'selected';}?>>(=) Valor final</option>
                                            <option value="coluna" <? if($regras[$pais['id']]['regra'.$i]['tipo'] == 'coluna'){echo 'selected';}?>>(||) Valor da coluna</option>
                                            <option value="percentual" <? if($regras[$pais['id']]['regra'.$i]['tipo'] == 'percentual'){echo 'selected';}?>>(%) Percentual</option>
                                        </select>
                                        &nbsp;
                                    </td>
                                    <td style="padding-top:0px; background: rgba(0,0,0,0.03); vertical-align: middle;">
                                        de <input type="text" class="span1" style="width: 35px; margin-top:10px" name="casa[<?=$pais['id']?>][regra<?=$i?>][valor]" value="<?=$regras[$pais['id']]['regra'.$i]['valor']?>" />
                                        + <input type="text" class="span1" style="font-size:11px; width: 35px; padding: 5px 0 5px 3px; margin-top:10px" name="casa[<?=$pais['id']?>][regra<?=$i?>][mais]" value="<?=$regras[$pais['id']]['regra'.$i]['mais']?>" />
                                    </td>
                                    
                                    
                                    
                                </tr>
                            <? 
                            }
                            $active = '';
                        ?>
                        </table>	
                        <br /><br /><br /><br />
                    </div>
                <?
                }
                ?>    
            </div>
        </div>
    </div>

    <div  id="regrass" class="tab-pane fade in">
        <label style="width: calc(100% - 100px); margin:0 50px">
            <textarea name="regrasDesc"  id="mytextarea" style="height:600px;"><?=$regrasDesc?></textarea>
        </label>
    </div>

    <div  id="loginss" class="tab-pane fade in">
        <table class="table table-striped" width="100%" style="margin-top:30px" cellpadding="0">
            <thead style="background: url(images/bgTable.png); padding:40px 30px !important; color:#fff">
                <tr>
                    <td style="padding:0 !important" width="5px"></td>
                    <td style="padding:10px 30px !important;"><span class="tituTab">Usuário</span></td>
                    <td style="padding:10px 30px !important; text-align:center" width="50%"><span class="tituTab">Empresa</span></td>
                    <td style="padding:10px 30px !important; text-align:center" width="10%"></td>
                </tr>
            </thead> 
            
            <tbody>
            <? 
                $prods = $resulSeo->lista('logins'," empresa = '".$_GET['editar']."'");
                foreach($prods as $lis){
            ?>
                <tr style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
                    <td style="background: #038800 !important; padding:0"></td>
                    
                    <td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><strong><?=$lis['user']?></strong></div></td>
                    <td>
                       <?=$nome?>
                    </td>
                    <td style="text-align:center;padding:0">
                        <div style="border-left:1px solid #fff">
                            <div style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
                                <a href="cad_<?=$p?>.php?editar=<?=$lis['id']?>&token=<?=$lis['token']?>" class="icon-edit">&nbsp;</a>
                                <a href="#modalExcl<?=$lis['id']?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <div id="modalExcl<?=$lis['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                            <h3 id="myModalLabel" style="color:#099209">Excluir</h3>
                        </div>
                        <div class="modal-body2" style="padding:20px">
                            <p>Tem certeza que deseja excluir este registro?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
                            <a href="<? if($p == 'news'){echo 'newsletter';}else{echo $p;}?>.php?excluir=<?=$lis['id']?>&table=<?=$p?>&familia=<?=$_GET['familia']?>" class="btn btn-primary">Confirmar</a>
                        </div>
                    </div>
                <? } ?>
            </tbody>
        </table>
    </div>

    
    <div  id="relatorios" class="tab-pane fade in">

        <table class="table table-striped" width="100%" style="margin-top:0px" cellpadding="0">
            <thead style="background: #111; padding:40px 30px !important; color:#fff;">
                <tr>
                    <td style="padding:10px 30px !important; text-align:center" width="90px"><span class="tituTab">Casa</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="100px"><span class="tituTab">Período</span></td>
                    <td style="padding:10px 20px !important; text-align:center; max-width:150px" width="80px"><span class="tituTab">Campanha</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="80px"><span class="tituTab">Cadastros</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="70px"><span class="tituTab">Depositos</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="70px"><span class="tituTab">Bloqueado</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="70px"><span class="tituTab">Moeda</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="240px"><span class="tituTab">Cassino Rev. S. Net</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="70px"><span class="tituTab">CPA</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="150px"><span class="tituTab">Ganhos CPA</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="150px"><span class="tituTab">Ganhos Total</span></td>
                    <td style="padding:10px 20px !important; text-align:center" width="60px"></td>
                </tr>
            </thead>
            
            <tbody>
            <? 
                if($_GET['editar']){
                    $prods = $resulSeo->lista('relatorios', "empresa = '".$_GET['editar']."'");
                    foreach($prods as $lis){
                        $periodo = str_replace("/", "-", $lis['periodo']);
                        $periodo = implode('/',array_reverse(explode('-',$periodo)));
                    ?>
                            <tr style="border:4px solid #fff; background:#eee; padding:10px 0 !important; ">
                                <td>
                                <? $empes = $resulSeo->lista('casas', "id = '".$lis['casa']."'");?>
                                    <a href="" style="height:40px; width: 80px; display:inline-block; margin: 0;background: #fff url(/painel/arquivos/casas/<?=$empes[0]['img']?>) center center no-repeat;background-size: 90% auto;">
                                    
                                    </a>
                                </td>
                                <td><strong><?=$periodo?></strong></td>
                                <td style="max-width:150px"><?=$lis['brand'];?></td>
                                <td><?=$lis['visits'];?></td>
                                <td><?=$lis['opens'];?></td>
                                <td><?=$lis['newactivedepositors'];?></td>
                                <td><?=$lis['dealcurrency'];?></td>
                                <td><?=$lis['casinonetrevenue'];?></td>
                                <td><?=$lis['sportsnetrevenue'];?></td>
                                <td><?=$lis['netrevenue'];?></td>

                                <td style="padding:0"><div style="border-right:1px solid #ccc; height:40px; line-height:40px; padding:0 10px"><strong><?=$lis['de']?></strong></div></td>
                                <td style="text-align:center;padding:0">
                                    <div style="border-left:1px solid #fff">
                                        <div style=" padding:6px; border-radius:6px; -moz-border-radius:6px; -webkit-border-radius:6px; background:#fff; width:50px; box-shadow:0 2px 2px #e1e1e1; margin:0 auto">
                                            <a href="cad_<?=$p?>.php?editar=<?=$lis['id']?>&token=<?=$lis['token']?>" class="icon-edit">&nbsp;</a>
                                            <a href="#modalExcl<?=$lis['id']?>" class="icon-remove" data-toggle="modal">&nbsp;</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div id="modalExcl<?=$lis['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                    <h3 id="myModalLabel" style="color:#099209">Excluir</h3>
                                </div>
                                <div class="modal-body2" style="padding:20px">
                                    <p>Tem certeza que deseja excluir este registro?</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
                                    <a href="<? if($p == 'news'){echo 'newsletter';}else{echo $p;}?>.php?excluir=<?=$lis['id']?>&table=<?=$p?>&familia=<?=$_GET['familia']?>" class="btn btn-primary">Confirmar</a>
                                </div>
                            </div>
                        <? } }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="controle">&nbsp;</div>
        <div style="margin:20px 0 0; text-align:right; position:fixed; bottom:0; right:0; z-index:9999; width: calc(100% - 210px)">
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
<script type="text/javascript">
    $(document).ready(function(){
        tinymce.init({
            selector: '#mytextarea',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste imagetools wordcount'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            automatic_uploads: true,
        });

        var cepCheck = document.querySelector('#cep');
        if(cepCheck){
            $('#cep').blur(function(){
                var valor = $('#cep').val();
            // alert(valor);
                var len = valor.length;
                /* Configura a requisição AJAX */
                if(len >= 8 && len <= 9){
                    $.ajax({
                        url : 'includes/consultar_cep.php', /* URL que será chamada */ 
                        type : 'POST', /* Tipo da requisição */ 
                        data: 'cep=' + valor, /* dado que será enviado via POST */
                        dataType: 'json', /* Tipo de transmissão */
                        success: function(data){
                            console.log(data);
                            if(data.estado){
                                $('#rua').val(data.rua);
                                $('#bairro').val(data.bairro);
                                $('#cidade').val(data.cidade);
                                $('#estado').val(data.estado);
                                $('#numero').focus();
                                $('#cep').css({border:'1px solid #4fff4f'});
                            }else{
                                //$('#cep').val('');
                                //$('#cep').focus();
                                $('#cep').css({border:'1px solid #ff4f4f'});
                                //$('#cepErro').fadeIn();
                            }
                        }
                    });      
                }else{
                    //$('#cep').val('');
                    $('#cepErro').fadeIn();
                    $('#lineCep').css({backgroundColor:'#f00'});
                    $('#cep').focus();
                }
            });
        }

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
    
  
