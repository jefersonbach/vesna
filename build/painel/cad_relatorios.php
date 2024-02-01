<? 
ini_set('display_errors', 0); 
ini_set('max_execution_time', 0);
ini_set('pcre.backtrack_limit', '99999998576');
set_time_limit(0);
include('includes/topo.php'); 

function detectDelimiter($csvFile)
{
    $delimiters = [";" => 0, "," => 0, "\t" => 0, "|" => 0];

    $handle = fopen($csvFile, "r");
    $firstLine = fgets($handle);
    fclose($handle); 
    foreach ($delimiters as $delimiter => &$count) {
        $count = count(str_getcsv($firstLine, $delimiter));
    }

    return array_search(max($delimiters), $delimiters);
}



$nPag = explode('/',$_SERVER['PHP_SELF']);
$p = substr($nPag[2],4,-4);

$_SESSION['pagina'] = $p;
if($_SESSION['id_ficha'] == ""){
	 $_SESSION['id_ficha'] = md5(uniqid(rand(), true));
}
$_SESSION['caminho'] = '../../arquivos/relatorios/';


if($_POST['casas']){

    $casa = $rProd->lista('casas', 'id = '.$_POST['casas'].'');

    $casa[0]['colunaData'] = $casa[0]['colunaData'] - 1;
    

    if($_POST['periodo']){
        $periodo = $_POST['periodo'];
    }else{
        $periodo = $data[$casa[0]['colunaData']];
    }


    $nome = $periodo.'_'.$casa[0]['nome'];
	
	$new_file_name = $rProd->clean_url($nome).'.csv';
	
	if(move_uploaded_file($_FILES['arquivo']['tmp_name'], 'arquivos/relatorios/'.$new_file_name)){
		$message = 'Congratulations!  Your file was accepted.';

        

		 // Abre o Arquvio no Modo r (para leitura)
		$arquivo = fopen ('arquivos/relatorios/'.$new_file_name, 'r');
		$ic = 0;
		$a = 0;
		$cad = 0;

        $linha = fgets($arquivo, 1024);
        $dados = explode(';', $linha);
        
        $dados = explode(',', $dados[0]);
        //print_r($dados);
		 // Lê o conteúdo do arquivo

         
         
//echo $casa[0]['brand'];
        //die;
        $casa[0]['brand'] = $casa[0]['brand'] - 1;
        $casa[0]['visits'] = $casa[0]['visits'] - 1;
        $casa[0]['NewActiveDepositors'] = $casa[0]['NewActiveDepositors'] - 1;
        $casa[0]['NewLocked'] = $casa[0]['NewLocked'] - 1;
        $casa[0]['DealCurrency'] = $casa[0]['DealCurrency'] - 1;
        $casa[0]['CasinoNetRevenue'] = $casa[0]['CasinoNetRevenue'] - 1;
        $casa[0]['NetRevenue'] = $casa[0]['NetRevenue'] - 1;
        $casa[0]['SportsNetRevenue'] = $casa[0]['SportsNetRevenue'] - 1;
        $casa[0]['RevenueShareEarnings'] = $casa[0]['RevenueShareEarnings'] - 1;
        $casa[0]['CPAQualified'] = $casa[0]['CPAQualified'] - 1;
        $casa[0]['CPAEarnings'] = $casa[0]['CPAEarnings'] - 1;
        $casa[0]['TotalEarnings'] = $casa[0]['TotalEarnings'] - 1;
        //$casa[0]['TotalEarnings'] = $casa[0]['TotalEarnings'] - 1;

        $casa[0]['colunaId'] = $casa[0]['colunaId'] - 1;
       
        

		 while(!feof($arquivo)){
            //echo '<br />'; echo '<br />';
			  // Pega os dados da linha
              
              //echo '<br />'; echo '<br />';
              while (($data = fgetcsv($arquivo, 1000, ';')) !== FALSE) {
                $delimiter =  detectDelimiter($data);
                $num = count($data);
                if($data[2] == ''){
                    $data = explode(',', $data[0]);
                }
                echo '<pre>';
                print_r($data);
                echo '</pre>';

                //echo "<p>------------". $data[0]." asd campos na linha $row: <br /></p>\n";

                $periodo = str_replace("/", "-", $periodo);
                $periodo = implode('-',array_reverse(explode('-',$periodo)));
                $periodoTime = strtotime($periodo);
                //echo '<h3>'.$_POST['de'].' - '.$_POST['ate'].'</h3>';
                //echo '<h3>--------- '.$periodo.' - '.$periodoTime.'</h3>';

                if($_POST['empresa']){
                    $pp['idParceiro'] = $_POST['empresa'];
                }else{
                    $pp['idParceiro'] = $data[$casa[0]['colunaId']];
                }
                
                $prodsa = $rProd->lista('parceiros','','','nome asc');
                foreach($prodsa as $pais){
                    $reg = unserialize($pais['regras']);

                    foreach($reg as $idPart){
                       

                        if($idPart['nomeIdentificador'] == $pp['idParceiro']){
                            
                            $pp['empresa'] = $pais['id'];

                        }
                    }
                } 
            
               //echo '<pre>';
                //print_r($idPart);
               // echo '</pre>';

                
                $pp['casa'] = $_POST['casas'];
                $pp['periodoTime'] = $data[$casa[0]['colunaData']];
                $pp['periodo'] = $data[$casa[0]['colunaData']];

                $pp['brand'] = $data[$casa[0]['brand']];
                $pp['visits'] = $data[$casa[0]['visits']];
                $pp['opens'] = $data[$casa[0]['opens']];
                $pp['NewActiveDepositors'] = $data[$casa[0]['NewActiveDepositors']];
                $pp['NewLocked'] = $data[$casa[0]['NewLocked']];
                $pp['DealCurrency'] = $data[$casa[0]['DealCurrency']];
                $pp['NetRevenue'] = $data[$casa[0]['NetRevenue']];
                $pp['CasinoNetRevenue'] = $data[$casa[0]['CasinoNetRevenue']];
                $pp['SportsNetRevenue'] = $data[$casa[0]['SportsNetRevenue']];
                $pp['RevenueShareEarnings'] = $data[$casa[0]['RevenueShareEarnings']];
                $pp['CPAQualified'] = $data[$casa[0]['CPAQualified']];
                $pp['CPAEarnings'] = $data[$casa[0]['CPAEarnings']];
                $pp['TotalEarnings'] = $data[$casa[0]['TotalEarnings']];

                
                $pp['colData'] = $data[$casa[0]['colunaData']];

                $row++;

                echo '<pre>'; print_r($pp); echo '</pre>';
                //print_r($pp);
                //die;
                echo $grava = $rProd->cadastro($pp, 'relatorios');
/* 
                $antigos = $rProd->lista('relatorios', "empresa = '".$_POST['empresa']."' and deTime >= '".$deTime."' and ateTime <= '".$ateTime."'");
                $excluidos = 0;
                if($antigos != 'erro'){
                    foreach($antigos as $exclu){
                        $excluidos++;
                        $delP = $resulSeo->deleta($exclu['id'], 'relatorios');
                    }
                    //
                    print_r($antigos);
                }*/

                //echo 'INSERT INTO relatorios (empresa, de, ate, deTime, ateTime, brand, visits, opens, new-active-depositors, new-locked, deal-currency, casino-net-revenue) VALUES '.$qquer.';';
                //mysqli_query($rProd->getConnection(),'INSERT INTO relatorios (codigo, preco) VALUES '.$qquer.' ON DUPLICATE KEY UPDATE preco=VALUES(preco);');
            }
           
                if($grava == 'sim'){
                    $parc['id'] = $pp['empresa'];
                    $parc['atualizado'] = date("Y-m-d H:i:s");
                    $rProd->cadastro($parc, 'parceiros');
                    echo 'SALVO COM SUCESSO';
                }
               
                die;

	 	// Fecha arquivo aberto
         fclose($arquivo);
        
	 	
	}
    
}

}


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
        <form method="post" action="cad_<?=$p?>.php" enctype="multipart/form-data">
            <div class="contentCad">
                <div class="alignCenter">
                    <label>
           				<strong>Casa</strong>
                    	<select name="casas" id="casaSel">
                        	<option value="" style="color:#777; padding:5px 5px 5px 20px"> <strong><i>-- Nenhuma --</i></strong> </option>
							<? 
                            	$cs = $rProd->lista('casas');
                                foreach($cs as $css){
                                    ?>
                                    <option value="<?=$css['id']?>"  <? if($casa == $css['id']){echo 'selected';}?> style="color:#333; padding:5px 5px 5px 20px"><?=$css['nome']?></option>
                                    <?
								} 
							?>
                        </select>
                   	</label>
                    <div class="controle">&nbsp;</div>
                    <div id="loadCol"></div>

                    


<!--
                    

                    <label><strong>Período</strong></label>    
                    <label><input type="text" class="span2" name="periodo" value="<?=$periodo?>" placeholder="10/05/2023" /></label>           
                    
                    -->
                    
                </div>
            </div>
            <div class="contentCadr">
                <div class="alignCenter">
                    <p>Escolha o arquivo <strong>.CSV</strong> para atualizar o estoque do site.<br/>
                        O arquivo deve seguir o padrão da imagem ao lado.</p>
                    <label><strong>Arquivo csv</strong><input type="file" name="arquivo" /></label> 
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
    
  


<script>


$(document).ready(function(){
 
    $('#casaSel').change(function(){
	    
        var idCasa = $(this).val();
        $.ajax({
            url: 'identificaCasaRelatorio.php',
            type: 'post',
            data: {casa:idCasa},
            success: function(response){
                $('#loadCol').html(response);
            }
        });
    });
 
});


</script>
