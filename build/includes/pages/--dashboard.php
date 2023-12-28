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
?>
<div class="contentHome" style="background: #97E9C5; width:100%; min-height:500px; text-align:center">
    <div class="wrapperContent">
    <div style="background: #fff; border-radius:25px; margin: 20px 10px 0; max-width: calc(100% - 20px); padding:40px 40px;  box-shadow: 0 5px 10px rgba(0,0,0,0.15), 0 10px 200px rgba(0,0,0,0.15); position: relative;">

<?   $dados = $banco->lista('relatorios', "empresa = '".$parcei."' and casa = '".$pgGet[0]."' and DATE(periodo) BETWEEN '".$de."' AND '".$ate."'",'',"DATE(periodo) desc"); ?>
           
           <div class="boxDash">
                <span>Parceiros afiliados</span>
                <h3 id="value" onload="animateValue(this, 0, <?=count($af)?>, 1500)">0</h3>
            </div> 
           
            <div class="boxDash">
                <span>Casas Associadas</span>
                <h3 id="value2" data-val="<?=count($casasLiberadas)?>">0</h3>
            </div> 

           <div class="boxDash">
                <canvas id="myChart" width="300" height="300" style="margin:20px;"></canvas>
            </div>

            <div class="boxDash">
                <a href="/home" class="btn-form btn-login" style="text-decoration: none;max-width:250px; float:none">Relatórios</a>
            </div> 

            
            <div class="controle"></div>
          
        </div>
        <div style="background: #333; border-radius:5px; margin: -2px auto 50px; width:38%; height:3px">
        </div>
        <span style="display:block; text-align:center; margin: 0px 0 0px">Relatório atualizado <strong><?=strftime('%A, %d de %B de %Y', strtotime($empe[0]['atualizado']));?></strong></span>

    </div>
    
</div>
<?
if($_GET['afiliado'] == 'todos'){
//print_r($afilia2);
}
?>


<?
if($_GET['afiliado'] == 'todos'){?>
            <script>
    var ctx = document.getElementById('myChart').getContext('2d');

    const data = {
        labels: [
            <? foreach($afilia2['nome'] as $parcei){
                echo "'".$parcei."',";
            }?>
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [
                <? foreach($afilia2['total'] as $parceis){
                    echo $parceis.",";
                }?>
            ],
            hoverOffset: 4
        }]
    };


    new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Chart.js Doughnut Chart'
            }
            }
        },
        
    });




</script>
<?}?>

 