<?
if($_COOKIE['cliente_nome'] == 'Vesna'){
    $af = $banco->lista('parceiros');

}else{
    $af = $banco->lista('parceiros', "pai = '".$empe[0]['id']."' and ativo != 'Nao'");

}

$parceiroMaster = $banco->lista('parceiros', "id = '".$_COOKIE['cliente_id']."'");

$parceiro = $empe[0];

$regras = unserialize($parceiro['regras']);

foreach($regras as $key => $casas){
    if($casas['mostrarCasa'] != 'Nao'){
        $casasLiberadas[] = $key;
    }
}

if($pgGet[0] == ''){
    $pgGet[0] = $casasLiberadas[0];
}


if($_GET['de'] == ''){
    $hj=strtotime('now');
    $lm=strtotime("-29 Days");
    $_GET['de'] = date("m/d/Y", $lm);
    $_GET['ate'] = date("m/d/Y", $hj);
}


//echo '<pre>';print_r($casasLiberadas);echo '</pre>';

//echo '<pre>';print_r($regras);echo '</pre>';
?>

<div class="contentHome" style="background: #97E9C5; width:100%; min-height:500px; text-align:center">
    <div class="wrapperContent">
        <hr style="border: none; border-top:1px solid #fff; max-width:300px; margin:20px auto 10px" />


        <form action="/home/<?=$pgGet[0]?>" method="GET" style="line-height:30px">

            <div style="max-width: 600px; margin:50px auto 40px;">
            <?
                if($af != 'erro'){
            ?>
            <div style=" float:left; margin: 0px 0px 0px 0;  padding:5px 15px;  background:#fff; border-radius:25px; z-index:9999; transform: translateZ(42px); position:relative">
                <span style="line-height:30px; opacity:0.5; float:left; margin:6px 20px 5px 20px; font-size:14px; position: absolute; left:0; top:-36px">Afiliados</span>
                <select name="afiliado" style="background:#fff;  min-width:100px;  border:none">
                    <option value="meu" <? if($_GET['afiliado'] == 'meu'){ echo 'selected';}?> >Meu Relatório</option>
                    <option value="todos" <? if($_GET['afiliado'] == 'todos'){ echo 'selected';}?>>Todos</option>
                    <?
                        foreach($af as $afiliado){?>
                            <option value="<?=$afiliado['clean_url']?>" <? if($_GET['afiliado'] == $afiliado['clean_url']){ echo 'selected';}?>><?=$afiliado['nome']?></option>
                        <?
                        }
                    ?>
                </select>
            </div>

            <? } 
      
            ?>
            
                <div style=" float:left; margin: 0px 0 0px 10px; width:100%; max-width:360px; padding:0px; background:#fff; border-radius:20px; z-index:9999; transform: translateZ(42px); position:relative">
                    <span style="line-height:30px; opacity:0.5; float:left; margin:6px 20px 5px 30px; font-size:14px; position: absolute; left:0; top:-36px;z-idex:9999">Filtrar período do relatório</span>
                    

                        <div style="margin:0px 0 0 20px">
                            <div id="reportrange" style="cursor: pointer; padding: 5px 0; border: 0px solid #ccc; width: 240px; margin:0; float:left">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                            <input type="hidden" name="de" value="<?=$_GET['de']?>" id="de" placeholder="02/02/2023" class="input" style="display:none" />
                            <input type="hidden" name="ate" value="<?=$_GET['ate']?>" id="ate" placeholder="02/02/2023" class="input" style="display:none" />

                            <input type="hidden" name="de2" value="<?=$_GET['de']?>" id="de2" placeholder="02/02/2023" class="input" style="display:none" />
                            <input type="hidden" name="ate2" value="<?=$_GET['ate']?>" id="ate2" placeholder="02/02/2023" class="input" style="display:none" />

                        <!-- 
                            <label for="">
                                <strong>De</strong>
                                <input type="text" name="de" value="<?=$_GET['de']?>" placeholder="02/02/2023" class="input" style="width:100px" />
                            </label>
                            <label for="">
                                <strong>Até</strong>
                                <input type="text" name="ate" value="<?=$_GET['ate']?>" placeholder="02/02/2023" class="input" style="width:100px" />
                            </label>

                        -->
                            <div class="btn-wrap" style="width:80px; float:right; margin:0">
                                <input type="submit" value="Filtrar" class="btn-form btn-login" style="padding: 12px 20px 11px 10px; font-size: 10px; margin:0; border-radius:0 20px 20px 0" />
                            </div>
                            <div class="controle"></div>
                        </div>
                    
                </div>
                <div class="controle"></div>
            </div>
        </form>

        


        <div style="background: #fff; border-radius:25px; margin: 80PX 20px 0; width: calc(100% - 40px); padding:40px 0px;  box-shadow: 0 5px 10px rgba(0,0,0,0.15), 0 10px 200px rgba(0,0,0,0.15); position: relative; transform: translateZ(42px); ">
<? $widCas = count($casasLiberadas) * 132;?>

            <div style="width: <?=$widCas?>px; position: absolute; top:-50px; left: 50%; margin-left: -<?=$widCas/2?>px; height:50px;">
                <? 
                foreach($casasLiberadas as $casaId){
                $cs = $banco->lista('casas', "id = '".$casaId."' and ativo != 'Nao'");
                $wid = 100 / count($casasLiberadas);
                    foreach($cs as $casa){
                        if($casa['id'] == $pgGet[0]){
                            $stl = "margin:0 1px; box-shadow: 0 -10px 10px rgba(0,0,0,0.15);height:60px;  transform: translateZ(-50px); background-size:85% auto; opacity:1;  -webkit-filter: grayscale(0%); filter: grayscale(0%);";
                        }else{$stl = ' -webkit-filter: grayscale(100%); filter: grayscale(100%);background-size:65% auto;';}
                        ?>
                        <a  onclick="window.location='/home/<?=$casa['id']?>'+window.location.search;"  style="trasition: 0.4s;cursor:pointer; float:left; margin:5px 1px 0; height:45px; width: 130px;max-width:140px; opacity:0.7; background:#fff url(/painel/arquivos/casas/<?=$casa['img']?>) center center no-repeat;  border-radius: 15px 15px 0 0;<?=$stl?>">
                            
                        </a>
                        <?
                    }
                }
                ?>
                <div class="controle"></div>
            </div>



           
            <?



 
$de = str_replace("/", "-", $_GET['de']);
$de = implode('-',array_reverse(explode('-',$de)));
$de = explode('-',$de);
$de = $de[0].'-'.$de[2].'-'.$de[1];


//$de = strtotime($de);

$ate = str_replace("/", "-", $_GET['ate']);
$ate = implode('-',array_reverse(explode('-',$ate)));

$ate = explode('-',$ate);
$ate = $ate[0].'-'.$ate[2].'-'.$ate[1];

//$ate = strtotime($ate);

if($_GET['afiliado'] and $_GET['afiliado'] != 'meu' and $_GET['afiliado'] != 'todos'){
    foreach($af as $afiliado){
        if($afiliado['clean_url'] == $_GET['afiliado']){
            $afilia[] = $afiliado['id'];
        }
    }
    

}elseif($_GET['afiliado'] == 'meu'){
    $afilia[] =  $empe[0]['id'];
   
}elseif($_GET['afiliado'] == 'todos' or $_GET['afiliado'] == ''){
    $afilia[] =  $empe[0]['id'];
    foreach($af as $afiliado){
        $afilia[] = $afiliado['id'];
    }
   
}
  $totcols[0] = 0;
    $totcols[1] = 0;
    $totcols[2] = 0;
    $totcols[3] = 0;
    $totcols[4] = 0;
    $totcols[5] = 0;
    $totcols[6] = 0;
    $totcols[7] = 0;
    $totcols[8] = 0;
    $totcols[9] = 0;
    $totcols[10] = 0;
    $totcols[11] = 0;
    $totcols[12] = 0;
    $totcols[13] = 0;
foreach($afilia as $parcei){
    $dados = '';
    $regras = '';
    $dados = $banco->lista('relatorios', "empresa = '".$parcei."' and casa = '".$pgGet[0]."' and DATE(periodo) BETWEEN '".$de."' AND '".$ate."'",'',"DATE(periodo) desc");
    $casa = $banco->lista('casas', "id = '".$pgGet[0]."'");
    $ppa = $banco->lista('parceiros', "id = '".$parcei."'");
    $regras = unserialize($ppa[0]['regras']);




    $de = str_replace("/", "-", $_GET['de']);
    $de = implode('-',array_reverse(explode('-',$de)));
    $de = explode('-',$de);
    $dePt = $de[1].'/'.$de[2].'/'.$de[0];
    
    
    //$de = strtotime($de);
    
    $ate = str_replace("/", "-", $_GET['ate']);
    $ate = implode('-',array_reverse(explode('-',$ate)));
    
    $ate = explode('-',$ate);
    $atePt = $ate[1].'/'.$ate[2].'/'.$ate[0];

    
?>
<br />
    <h3 style="font-weight:400; color:#555; font-size:20px; margin:0; padding:0">
        <? if($empe[0]['id'] != $ppa[0]['id']){?>Afiliado <strong><?=$ppa[0]['nome']?></strong> - <?}?>Período de <strong> <?=$dePt?> até <?=$atePt?></strong> - <strong><?=$casa[0]['nome']?></strong>
    </h3>
            <table border="0" class="table">
                <thead>
                    <tr style="position: sticky; top: 0;">
                        <th scope="col">Data</th>
                        <? if($casa[0]['brand']){ $coluna[1] = 'Campanha';?><th scope="col">Campanha</th><?}?>
                        <? if($casa[0]['visits']){$coluna[2] = 'Clicks';?><th scope="col">Clicks</th><?}?>
                        <? if($casa[0]['opens']){$coluna[3] = 'Cadastros';?><th scope="col">Cadastros</th><?}?>
                        <? if($casa[0]['NewActiveDepositors']){$coluna[4] = 'Depósitos';?><th scope="col">Depósitos</th><?}?>
                        <? if($casa[0]['NewLocked']){$coluna[5] = 'Bloqueado';?><th scope="col">Bloqueado</th><?}?>
                        <? if($casa[0]['DealCurrency']){$coluna[6] = 'Moeda';?><th scope="col">Moeda</th><?}?>
                        <? if($casa[0]['CasinoNetRevenue']){$coluna[7] = 'Cassino Rev. S. Net';?><th scope="col">Cassino Rev. S. Net</th><?}?>
                        <? if($casa[0]['SportsNetRevenue']){$coluna[8] = 'Esportes Rev. S.';?><th scope="col">Esportes Rev. S.</th><?}?>
                        <? if($casa[0]['NetRevenue']){$coluna[9] = 'Net Revenue';?><th scope="col">Net Revenue</th><?}?>
                        <? if($casa[0]['RevenueShareEarnings']){$coluna[10] = 'Ganhos Rev. S.';?><th scope="col">Ganhos Rev. S.</th><?}?>
                        <? if($casa[0]['CPAQualified']){$coluna[11] = 'CPA';?><th scope="col">CPA</th><?}?>
                        <? if($casa[0]['CPAEarnings']){$coluna[12] = 'Ganhos CPA';?><th scope="col">Ganhos CPA</th><?}?>
                        <? if($casa[0]['TotalEarnings']){$coluna[13] = 'Ganhos Total';?><th scope="col">Ganhos Total</th><?}?>
                    </tr>
                </thead>
                <tbody>
                    <? 
                    $ii = 1;

                    
                    $emp =  $ppa[0]['id'];
                    

                    //print_r($dados);

                    $numeroReg = count($dados);

                    $totTotalEarnings = 0;

                    
                    $totBrand = 0;
                    $totOpens = 0;
                    $totVisits = 0;
                    $totNewactivedepositors = '';
                    $totCasinoNetRevenue = '';
                    
                    $totcols[0] = 0;
                    $totcols[1] = 0;
                    $totcols[2] = 0;
                    $totcols[3] = 0;
                    $totcols[4] = 0;
                    $totcols[5] = 0;
                    $totcols[6] = 0;
                    $totcols[7] = 0;
                    $totcols[8] = 0;
                    $totcols[9] = 0;
                    $totcols[10] = 0;
                    $totcols[11] = 0;
                    $totcols[12] = 0;
                    $totcols[13] = 0;
                    foreach($dados as $dado){


//echo $casa[0]['NewLocked'];
                        if($casa[0]['brand'] != ''){
                            $cols[1] = $dado['brand'];
                        }
                        if($casa[0]['visits'] != ''){
                            $cols[2] = $dado['visits'];
                        }
                        if($casa[0]['opens'] != ''){
                            $cols[3] = $dado['opens'];
                        }
                        if($casa[0]['NewActiveDepositors'] != ''){
                            $cols[4] = $dado['newactivedepositors'];
                        }
                        if($casa[0]['NewLocked'] != ''){
                            $cols[5] = $dado['newlocked'];
                        }
                        if($casa[0]['DealCurrency'] != ''){
                            $cols[6] = $dado['dealcurrency'];
                        }
                        if($casa[0]['CasinoNetRevenue'] != ''){
                            $cols[7] = $dado['casinonetrevenue'];
                        }
                        if($casa[0]['SportsNetRevenue'] != ''){
                            $cols[8] = $dado['sportsnetrevenue'];
                        }
                        if($casa[0]['NetRevenue'] != ''){
                            $cols[9] = $dado['netrevenue'];
                        }
                        if($casa[0]['RevenueShareEarnings'] != ''){
                            $cols[10] = $dado['revenueshareearnings'];
                        }
                        if($casa[0]['CPAQualified'] != ''){
                            $cols[11] = $dado['cpaqualified'];
                        }
                        if($casa[0]['CPAEarnings'] != ''){
                            $cols[12] = $dado['cpaearnings'];
                        }
                        if($casa[0]['TotalEarnings'] != ''){
                            $cols[13] = $dado['totalearnings'];
                           
                        }
                        
                        $numeroReg = 0;
                        //echo '<pre>';
                        //print_r($cols);
                        //echo '</pre>';
                        $periodo = str_replace("/", "-", $dado['periodo']);
$periodo = implode('/',array_reverse(explode('-',$periodo)));
                        
                        ?>
                        <tr>
                        <td  scope="row" data-label="Data" style="line-height:15px">
                           <strong> <?=$periodo?></strong>
                        </td>
                            <?
                            $i = 0;
                                foreach ($cols as $i => $colName) {
                                    //$i++;
                                    //echo $colName;
                                    if(1 == 1){
                            ?>
                                    
                                        <?
                                        $tp = '';
                                        $celula = '';
                                        
                                        $most = '';
                                        $rgcasa['mostrar'] = '';
                                        $x = 0;
                                        foreach($regras[$pgGet[0]] as $coll => $rgcasa){
                                            $celula = $colName;
                                            
                                            //echo $i;
                                            if($rgcasa['coluna'] == $i){

                                                //echo '<pre>';
                                                //print_r($rgcasa);
                                                //echo '</pre>';


                                                if($rgcasa['acao'] == '+'){
                                                    if($rgcasa['tipo'] == 'numero'){
                                                        $celula = $cols[$i] + $rgcasa['valor'];
                                                    }elseif($rgcasa['tipo'] == 'coluna'){
                                                        $celula = $cols[$i] + $cols[$rgcasa['valor']];
                                                        $cols[$i] = $celula;
                                                        $getValue[$i] = $celula;
                                                    }elseif($rgcasa['tipo'] == 'percentual'){
                                                        $celula = $cols[$i] + ($cols[$i] * $rgcasa['valor'] / 100);
                                                        $cols[$i] = $celula;
                                                    }
                                                }elseif($rgcasa['acao'] == '-'){
                                                    if($rgcasa['tipo'] == 'numero'){
                                                        $celula = $cols[$i] - $rgcasa['valor'];
                                                    }elseif($rgcasa['tipo'] == 'coluna'){
                                                        $celula = $cols[$i] - $cols[$rgcasa['valor']];
                                                        $cols[$i] = $celula;
                                                    }elseif($rgcasa['tipo'] == 'percentual'){
                                                        $celula = $cols[$i] - ($cols[$i] * $rgcasa['valor'] / 100);
                                                        $cols[$i] = $celula;
                                                    }
                                                }elseif($rgcasa['acao'] == '/'){
                                                    if($rgcasa['tipo'] == 'numero'){
                                                        $celula = $cols[$i] / $rgcasa['valor'];
                                                    }elseif($rgcasa['tipo'] == 'coluna'){
                                                        $celula = $cols[$i] / $cols[$rgcasa['valor']];
                                                        $cols[$i] = $celula;
                                                    }elseif($rgcasa['tipo'] == 'percentual'){
                                                        $celula = $cols[$i] / ($cols[$i] * $rgcasa['valor'] / 100);
                                                        $cols[$i] = $celula;
                                                    }
                                                }elseif($rgcasa['acao'] == '='){
                                                    if($rgcasa['tipo'] == 'numero'){
                                                        $celula = $rgcasa['valor'];
                                                        $cols[$i] = $celula;
                                                    }elseif($rgcasa['tipo'] == 'coluna'){
                                                        $celula = $cols[$rgcasa['valor']];
                                                        $cols[$i] = $celula;
                                                    }elseif($rgcasa['tipo'] == 'percentual'){
                                                        //echo $cols[$i] + ($cols[$i] * $empe[0]['val1'] / 100);
                                                    }
                                                }
                                                
                                                if($celula == ''){
                                                    $celula = $cols[$i];
                                                }
                                                if($rgcasa['mais']){
                                                    $rgcasa['mais'] = explode('=',$rgcasa['mais']);
                                                    if($rgcasa['mais'][1]){
                                                        $rgcasa['mais'] = $cols[$rgcasa['mais'][1]];
                                                    }else{
                                                        $rgcasa['mais'] = $rgcasa['mais'][0];
                                                    }
                                                    $celula = $celula + $rgcasa['mais'];
                                                    $cols[$i] = $celula;
                                                    //echo '<br />';
                                                }

                                                if($rgcasa['tipo'] == 'percentual'){$tp = '%';}
                                                if($rgcasa['mostrar'] == 'sim'){
                                                    if($cols[$rgcasa['valor']]){
                                                        $most = '<span class="spanMini" style="font-size:11px; line-height:11px; display:block">('.$rgcasa['acao'].''.$cols[$rgcasa['valor']].''.$tp.')</span>'; 
                                                    }else{
                                                        $most = '<span class="spanMini" style="font-size:11px; line-height:11px; display:block">('.$rgcasa['acao'].''.$rgcasa['valor'].' + '.$rgcasa['mais'].' - '.$tp.')</span>';
                                                    }
                                                }else{
                                                    $most = '';
                                                }
                                                break;
                                                
                                            }
                                           
                                        }
                                        if($celula == ''){
                                            $cols[$i] = round($celula + $cols[$rgcasa['valor']],2);
                                            echo '<td style="line-height:15px" data-label="'.$coluna[$i].'" data-coluna="'.$i.'">'.str_replace('"','',$cols[$i]).'</td>';
                                        }else{
                                            if(is_numeric($celula)){
                                                $celula = round($celula,2);
                                            }
                                            echo '<td style="line-height:15px" data-label="'.$coluna[$i].'" data-coluna="'.$i.'">'.str_replace('"','',$celula);
                                            
                                            if($most){
                                                echo $most;
                                            }
                                            echo '</td>';
                                            
                                        }

                                        if($i == 1){
                                            $totcols[1] = $cols[1] + $totcols[1];
                                            
                                        }
                                        if($i == 2){
                                            $totcols[2] = $cols[2] + $totcols[2];
                                          
                                        }
                                        if($i == 3){
                                            $totcols[3] = $cols[3] + $totcols[3];
                                           
                                        }
                                        if($i == 4){
                                            $totcols[4] = $cols[4] + $totcols[4];
                                           
                                        }
                                        if($i == 5){
                                            $totcols[5] = $cols[5] + $totcols[5];
                                           
                                        }
                                        if($i == 6){
                                            $totcols[6] = $cols[6] + $totcols[6];
                                          
                                        }
                                        if($i == 7){
                                            $totcols[7] = $cols[7] + $totcols[7];
                                          
                                        }
                                        if($i == 8){
                                            $totcols[8] = $cols[8] + $totcols[8];
                                            
                                        }
                                        if($i == 9){
                                            $totcols[9] = $cols[9] + $totcols[9];
                                           
                                        }
                                        if($i == 10){
                                            $totcols[10] = $cols[10] + $totcols[10];
                                           
                                        }
                                        if($i == 11){
                                            $totcols[11] = $cols[11] + $totcols[11];
                                          
                                        }
                                        if($i == 12){
                                            $totcols[12] = $cols[12] + $totcols[12];
                                         
                                        }
                                        if($i == 13){
                                            $totcols[13] = $cols[13] + $totcols[13];
                                          
                                        }
                                        
                        
                                       
                                    }





                                        $x++;
                                        ?>
                            <?


                                
                            ?>

                                
                            </td>
                        

                    <? 
                    $ii++; 
                }
                
                
                
                
                ?>
                    </tr>
                <? }?>
                <tr style="background:none; border-bottom: 0px solid #eee">
                    <td style="line-height:11px; border:none"></td>


                        <? if($casa[0]['brand']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['Acaobrand'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[1],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Campanha (<?=$casa[0]['Acaobrand']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['visits']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['Acaovisits'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[2],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Clicks Total (<?=$casa[0]['Acaovisits']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['opens']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['Acaoopens'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[3],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Cadastros Total (<?=$casa[0]['Acaoopens']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['NewActiveDepositors']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['AcaoNewActiveDepositors'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[4],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Depósitos Total (<?=$casa[0]['AcaoNewActiveDepositors']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['NewLocked']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['AcaoNewLocked'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[5],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Bloqueado Total (<?=$casa[0]['AcaoNewLocked']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        
                        <? if($casa[0]['DealCurrency']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['AcaoDealCurrency'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[6],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Moeda (<?=$casa[0]['AcaoDealCurrency']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['CasinoNetRevenue']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['AcaoCasinoNetRevenue'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[7],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Cassino Rev. S. Total (<?=$casa[0]['AcaoCasinoNetRevenue']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['SportsNetRevenue']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['AcaoSportsNetRevenue'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[8],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Esportes Rev. S. Total (<?=$casa[0]['AcaoSportsNetRevenue']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['NetRevenue']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['AcaoNetRevenue'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[9],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Net Revevenue Total (<?=$casa[0]['AcaoNetRevenue']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['RevenueShareEarnings']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['AcaoRevenueShareEarnings'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[10],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Ganhos Rev. S. Total (<?=$casa[0]['AcaoRevenueShareEarnings']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['CPAQualified']){?>
                            <td style="line-height:11px; border:none">
                                <? if($casa[0]['AcaoCPAQualified'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[11],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">CPA Total (<?=$casa[0]['AcaoCPAQualified']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['CPAEarnings']){?>
                            <td style="line-height:11px">
                                <? if($casa[0]['AcaoCPAEarnings'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[12],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Ganhos CPA Total(<?=$casa[0]['AcaoCPAEarnings']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                        <? if($casa[0]['TotalEarnings']){?>
                            <td style="line-height:11px">
                                <? if($casa[0]['AcaoTotalEarnings'] != ''){?>
                                    <h3 style="font-size:20px; line-height:20px; margin:0; padding:0"><?=number_format($totcols[13],2,',','.')?></h3>
                                    <span class="spanMini" style="font-size:11px; line-height:11px">Ganhos Total(<?=$casa[0]['AcaoTotalEarnings']?>)</span>
                                <? } ?>
                            </td>
                        <? }?>
                    </tr>

                </tbody>
            </table>
<?  

} ?>

        </div>
        <div style="background: #333; border-radius:5px; margin: -2px auto 50px; width:38%; height:3px">
        </div>
        <span style="display:block; text-align:center; margin: 0px 0 0px">Relatório atualizado <strong><?=strftime('%A, %d de %B de %Y', strtotime($empe[0]['atualizado']));?></strong></span>

    </div>
    
</div>


