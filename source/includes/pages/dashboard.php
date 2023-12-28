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
    $widCas = count($casasLiberadas) * 103;

    if($pgGet[0] == ''){
        $pgGet[0] = $casasLiberadas[0];
    }

    if($_GET['de'] == ''){
        $hj=strtotime('now');
        $lm=strtotime("-29 Days");
        $_GET['de'] = date("m/d/Y", $lm);
        $_GET['ate'] = date("m/d/Y", $hj);
    }

    $de = str_replace("/", "-", $_GET['de']);
    $de = implode('-',array_reverse(explode('-',$de)));
    $de = explode('-',$de);
    $de = $de[0].'-'.$de[2].'-'.$de[1];


    $ate = str_replace("/", "-", $_GET['ate']);
    $ate = implode('-',array_reverse(explode('-',$ate)));
    $ate = explode('-',$ate);
    $ate = $ate[0].'-'.$ate[2].'-'.$ate[1];

    function array_orderby(){
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                    $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }
   
?>
<div class="contentHome" style="background: #97E9C5; width:100%; min-height:500px; text-align:center">
    <div class="wrapperContent">
    <div style="background: #fff; border-radius:30px; margin: 20px 10px 0; padding:10px; max-width: calc(100% - 20px);  box-shadow: 0 5px 10px rgba(0,0,0,0.15), 0 10px 200px rgba(0,0,0,0.15); position: relative; display:flex; flex-wrap:wrap; align-items: flex-start">

<?   

    foreach($af as $afiliado){
        $afilia[] = $afiliado['id'];
        $afiliaData[] = $afiliado['atualizado'];
    }
    foreach($afilia as $parcei){
        //'periodo, id, totalearnings, casa, cpaearnings'
        $rows = $banco->lista('relatorios', "empresa = '".$parcei."' and DATE(periodo) BETWEEN '".$de."' AND '".$ate."'",'',"DATE(periodo) desc",''); 
        if($rows != 'erro'){
            foreach($rows as $row){
                $data[] = $row;
                
                $casa = $banco->lista('casas', "id = '".$row['casa']."'");
                $empresa = $banco->lista('parceiros', "id = '".$row['empresa']."'");

                $resultParc[$row['empresa']]['parceiro'] = $empresa[0]['nome'];
                $resultParc[$row['empresa']]['totalerelatorios'] = $resultParc[$row['empresa']]['totalerelatorios'] + 1;


               

                $resultParc[$row['empresa']]['visits'] = $resultParc[$row['empresa']]['visits'] + $row['visits']; 
                if($resultParc[$row['empresa']]['visits'] and $resultParc[$row['empresa']]['visits'] > 0){
                    $resultParc['totalClicks'] = $resultParc['totalClicks'] + str_replace(',','.',$row['visits']);
                }


                $resultParc[$row['empresa']]['revenueshareearnings'] = $resultParc[$row['empresa']]['revenueshareearnings'] + $row['revenueshareearnings']; 
                $resultParc[$row['empresa']][$casa[0]['nome']]['revenueshareearnings'] = $resultParc[$row['revenueshareearnings']][$casa[0]['nome']]['revenueshareearnings'] + $row['revenueshareearnings'];
                if($resultParc[$row['empresa']]['revenueshareearnings'] and $resultParc[$row['empresa']]['revenueshareearnings'] > 0){
                    $resultParc['totalGanREV'] =  $resultParc['totalGanREV'] + str_replace(',','.',$resultParc[$row['empresa']]['revenueshareearnings']);
                    $tabHouse[$casa[0]['id']]['totalREV'] = $tabHouse[$casa[0]['id']]['totalREV'] + $resultParc['totalGanREV'];
                }
                

                $resultParc[$row['empresa']]['cpaqualified'] = $resultParc[$row['empresa']]['cpaqualified'] + $row['cpaqualified']; 
                $resultParc[$row['empresa']][$casa[0]['nome']]['cpaqualified'] = $resultParc[$row['empresa']][$casa[0]['nome']]['cpaqualified'] + $row['cpaqualified'];
                if($resultParc[$row['empresa']]['cpaqualified']){
                    $resultParc['totalGanCPA'] =  $resultParc['totalGanCPA'] + str_replace(',','.',$resultParc[$row['empresa']]['cpaqualified']);
                    $tabHouse[$casa[0]['id']]['totalCPA'] = $tabHouse[$casa[0]['id']]['totalCPA'] + $resultParc['totalGanCPA'];
                }
                
                $resultParc[$row['empresa']]['totalearnings'] = $resultParc[$row['empresa']]['totalearnings'] + $row['totalearnings']; 
                $resultParc[$row['empresa']][$casa[0]['nome']]['totalearnings'] = $resultParc[$row['empresa']][$casa[0]['nome']]['totalearnings'] + $row['totalearnings'];
                if($resultParc[$row['empresa']]['totalearnings'] and $resultParc[$row['empresa']]['totalearnings'] > 0){
                    $resultParc['totalGanhos'] =  $resultParc['totalGanhos'] + str_replace(',','.',$resultParc[$row['empresa']]['totalearnings']);
                    $tabHouse[$casa[0]['id']]['totalearnings'] = $tabHouse[$casa[0]['id']]['totalearnings'] + $resultParc['totalGanhos'];
                }
                $tabHouse[$casa[0]['id']]['nome'] = $casa[0]['nome'];
                $tabHouse[$casa[0]['id']]['id'] = $casa[0]['id'];
                $tabHouse[$casa[0]['id']]['img'] = $casa[0]['img'];
                

            }
        }
    }




    if($dados == 'erro'){
        $nRelatorios = 0;
    }else{
        $nRelatorios = count($data);
    }
    $resultParc = array_orderby($resultParc, 'totalearnings', SORT_DESC);

    $resultParcs = array_slice($resultParc,0,7);

    // sort array with given user-defined function 
    //$afiliaData = usort($afiliaData); 
      
    //print_r($arr); 

    foreach($afiliaData as $maiorD){
        if($maiorD and strtotime($maiorD) > strtotime($maiorData)){
            $maiorData = $maiorD;
        }
    }


    //echo '<pre>';
    //echo print_r($tabHouse);
    //echo '</pre>';

    //echo '<h3>'.$maiorData.'</h3>';
   
?>

            <div class="boxDashFull" style="text-align:left ; padding:25px 0">
                <span style="margin: 0 0 0 40px">Ganhos por casas</span>
                <table style="width:100%; background: rgba(255,255,255,0)">
                <thead style="font-size:12px">
                    <tr>
                        <td style="padding:7px; background: rgba(255,255,255,0)"></td>
                        <td style="padding:7px; background: rgba(255,255,255,0)"><strong>Casa</strong></td>
                        <td style="padding:7px; background: rgba(255,255,255,0)"><strong>REV S.</strong></td>
                        <td style="padding:7px; background: rgba(255,255,255,0)"><strong>CPA</strong></td>
                    </tr>
                </thead>
                   
                <? foreach($tabHouse as $casa){?>
                    <tr>
                        <td style="padding:7px 7px 7px 30px; background: rgba(255,255,255,0); border-bottom:1px solid rgba(0,0,0,0.05)">
                            <div style="background: rgba(255,255,255,0.7) url(/painel/arquivos/casas/<?=$casa['img']?>) center center no-repeat; background-size: 80% auto; width:100px; height:35px"></div>
                        </td>
                        <td style="padding:7px; background: rgba(255,255,255,0); border-bottom:1px solid rgba(0,0,0,0.05); font-size:14px; opacity:0.85"><?=$casa['nome']?></td>
                        <td style="padding:7px; background: rgba(255,255,255,0); border-bottom:1px solid rgba(0,0,0,0.05); font-weight:500; font-size:16px"><?=$casa['totalREV']?></td>
                        <td style="padding:7px 30px 7px 7px; background: rgba(255,255,255,0); border-bottom:1px solid rgba(0,0,0,0.05); font-weight:700; font-size:16px"><?=$casa['totalCPA']?></td>
                    </tr>
                <?}?>
                </table>
                <span class="spanMini"></span>
            </div> 

           

           <div class="contentSmalls">
                <div class="boxDash">
                        <span style="margin-top:8px">Parceiros afiliados</span>
                        <h3 class="slowVal"><?=count($af)?></h3>
                    </div> 
                
                    <div class="boxDash">
                        <span style="margin-top:8px">Casas Associadas</span>
                        <h3 class="slowVal"><?=count($casasLiberadas)?></h3>
                    </div> 

                    <div class="boxDash">
                        <span>Clicks Totais</span>
                        <h3 class="slowVal"><?=str_replace(',','.',$resultParc['totalClicks'])?></h3>
                        <span class="spanMini">(Últimos 30 dias)</span>
                    </div>
                        
                    <div class="boxDash">
                        <span>Relatórios</span>
                        <h3 class="slowVal"><?=$nRelatorios?></h3>
                        <span class="spanMini">(Últimos 30 dias)</span>
                    </div>
            </div>
            <div class="boxDash-2-5">
                <span>Ganhos Totais</span>
                <h3 class="slowVal"><?=str_replace(',','.',$resultParc['totalGanhos'])?></h3>
                <span class="spanMini">(Últimos 30 dias)</span><br /><br />
                <canvas id="myChart" width="390px" height="390px"></canvas>
            </div>
            
            <div class="boxDashFull">
                <canvas id="myChartBars" height="500px" width="700px" ></canvas>
            </div>
            
            <div class="controle"></div>
          
        </div>
        <div style="background: #333; border-radius:5px; margin: -2px auto 50px; width:38%; height:3px">
        </div>
        <? if($maiorData){?>
            <span style="display:block; text-align:center; margin: 0px 0 0px">Relatório atualizado <strong><?=strftime('%A, %d de %B de %Y', strtotime($maiorData));?></strong></span>
        <?}?>

    </div>
    
</div>
<?
if($_GET['afiliado'] == 'todos'){
//print_r($afilia2);
}

?>


            <script>


  var ctx1 = document.getElementById('myChartBars').getContext('2d');

    const datas = {
        labels: [
            <? foreach($resultParcs as $parcei){ 
                if($parcei['parceiro']){echo "'".$parcei['parceiro']."',";}
                }?>],
        datasets: [{
            label: 'Ganhos Totais',
            data: [
                <? foreach($resultParcs as $parceis){
                    if($parceis['totalearnings']){echo "'".str_replace(',','.',round($parceis['totalearnings'],2))."',";}
                    }?>],
            backgroundColor: [
                'rgba(0, 206, 125, 1)',
                'rgba(10, 206, 125, 0.8)',
                'rgba(20, 206, 125, 0.6)',
                'rgba(30, 206, 125, 0.4)',
                'rgba(40, 206, 125, 0.2)',
                'rgba(50, 206, 125, 0.1)',
                'rgba(0, 206, 125, 0.4)'
                ],
            borderColor: [
                'rgba(0, 206, 125, 1)',
                'rgba(10, 206, 125, 0.8)',
                'rgba(20, 206, 125, 0.6)',
                'rgba(30, 206, 125, 0.4)',
                'rgba(40, 206, 125, 0.2)',
                'rgba(50, 206, 125, 0.1)',
                'rgba(0, 206, 125, 0.4)'
            ],
            borderWidth: 1
        },]
    };
    new Chart(ctx1, {
        type: 'bar',
        indexAxis: 'y',
        options: {
            indexAxis: 'y'
        },
        data: datas
        
    });






    var ctx = document.getElementById('myChart').getContext('2d');

    const data2 = {
        labels: [
            <? foreach($resultParcs as $parcei){ 
                if($parcei['parceiro']){echo "'".$parcei['parceiro']."',";}
                }?>],
        datasets: [{
            label: 'My First Dataset',
            data: [
                <? foreach($resultParcs as $parceis){
                    if($parceis['totalearnings']){echo "'".str_replace(',','.',round($parceis['totalearnings'],2))."',";}
                    }?>],
            backgroundColor: [
                'rgba(0, 206, 125, 1)',
                'rgba(10, 206, 125, 0.8)',
                'rgba(20, 206, 125, 0.6)',
                'rgba(30, 206, 125, 0.4)',
                'rgba(40, 206, 125, 0.2)',
                'rgba(50, 206, 125, 0.1)',
                'rgba(0, 206, 125, 0.05)'
                ],
        }]
    };
    new Chart(ctx, {
        type: 'doughnut',
        data: data2,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Chart.js Doughnut Chart'
                }
            }
        },
       
    });

</script>

 