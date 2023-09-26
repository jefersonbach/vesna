<?php
ob_start();
include_once('../html2pdf/html2pdf.class.php');


		if($_SERVER['REMOTE_ADDR'] == '::1'){
			$Host = 'localhost:3306';		//servidor
			$User = 'root';				//usuario
			$senha = 'qweasd';				//senha
			$Banco = 'bakelitsul'; 
			
		}
		
 		$conn = @mysql_connect($Host, $User, $senha) or die("Não foi possível a conexão com o Banco1!");
		mysql_query("SET character_set_results=utf8", $conn);
		mysql_select_db($Banco, $conn);
		
		$sql = "SELECT * from `familias` WHERE clean_url = '".$_GET['familia']."'";
$query = mysql_query($sql);
while($row = mysql_fetch_array($query)){ $cat =  $row['nome'];$cor =  $row['cor'];$idCat =  $row['id']; }
		
		
		
		  	$prod = "SELECT * from `produtos` WHERE id = '".$_GET['produto']."'";
$prodquery = mysql_query($prod);
while($produto = mysql_fetch_array($prodquery)){ 
	$prodImg = "SELECT * from `produtosimagens` WHERE token = '".$produto['token']."' and `principal` = 1";
	$prodqueryImg = mysql_query($prodImg);
	while($produtoimg = mysql_fetch_array($prodqueryImg)){ 
		$img = explode('.',$produtoimg['img']);
	}

		$prodImg2 = "SELECT * from `produtosimagens` WHERE token = '".$produto['token']."' and (principal = 0 or principal IS NULL)";
	$prodqueryImg2 = mysql_query($prodImg2);
	while($produtoimg2 = mysql_fetch_array($prodqueryImg2)){ 
	$img3 = $produtoimg2['img'];
		$img2 = explode('.',$produtoimg2['img']);
	}
		
	 
        
 
 
 

 	?>
 
 
  
        
<style type="text/css">
<!--
    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {width: 100%; border: none; background-color: #DDDDFF;  height: 50mm}
-->
</style>
<page backtop="20mm" backbottom="40mm" backleft="10mm" backright="10mm" style="font-size: 12pt">
	<page_footer>
        <div style="width:100%; padding-bottom:0px; display:inline-block;  height:35mm; ">
        	<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%;">
            	<tr>
                	<td style="width:47%;"><div style="border-top:1px solid #e1e1e1; margin-top:1.4mm">&nbsp;</div></td>
                    <td><span style="font-family:; font-size:10px;  text-align:center !important;color:#777;margin-left:5mm"> [[page_cu]] / [[page_nb]]</span></td>
                    <td style="width:47%;"><div style="border-top:1px solid #e1e1e1; margin-top:1.4mm">&nbsp;</div></td>
                </tr>
            </table>
            
            <table style="width:100%; margin:0px 25px 30px">
                <tr>
                    <td style="width:40%; text-align:left">
                    </td>
                    <td style="width:42%; text-align:right">
                        
                        <p class="Basic-Paragraph" style="margin:20px 0 0; padding:0"><span class="CharOverride-3" style="font-size:10px; font-family:; color:#204c24"><strong>BAKELITSUL.COM.BR</strong></span></p>
                        <p class="Basic-Paragraph" style="margin:0; padding:0"><span class="CharOverride-4" style="font-size:7px;font-family:"><strong style="font-size:7px;font-family:">Produtos / <?=$cat?> / </strong><br /><?=$produto['nome']?></span></p>
                    </td>
                    <td style="width:50px">
                        <div style="opacity:0.5; width:70px; display:inline-block"></div>
                    </td>
                </tr>	
            </table>
        </div>
    </page_footer>
	<div style="background:<?=$cor?>;width:215mm; height:170px;position:absolute; left:-10mm; top:-21mm; display:inline-block;z-index:5555;">
			

		<table style="width:100%; margin:60px 45px 30px">
			<tr>
				<td style="width:60%; color:#fff;font-family:;font-size:13px; text-transform:uppercase"><?=mb_strtoupper($cat)?><br />
					<h1 style="font-size:18px; color:#fff; font-family:; text-transform:uppercase"><?=mb_strtoupper($produto['nome'])?></h1>
				</td>
			</tr>
		</table>
		
	</div>
	
	<div style="width:99.9%;margin-left:0mm;margin-top:-35mm" >
        <div style="margin-bottom:20px">
            <p style="margin:50px 0; font-size:8px;font-family:; line-height:12px; text-align:justify">
				<? if($img3){ ?>
                   
                <?	} ?>
                <br /><br /><br /><br />
                <strong style="font-family:; color:#444">DETALHES TÉCNICOS</strong><br />
                <?=strip_tags($produto['descricao'])?>
        	</p>
        </div>
     </div>
		<table  width="100%" style="margin-left:0mm;font-size:9px;" cellpadding="0" cellspacing="0" border="0">
		<?
        	$linha = explode('<tr>',$produto['tabela']);
			 unset($linha[0]);
			 $i = 0;
			 $v = 0;
			 $z = 0;
			foreach($linha as $d){
				
				if($i == 0){
					?><tr style="font-family:;font-size:8px;background:<?=$cor?>;color:#fff"><?
				}else{
					if($z==1){$z=0;}else{$z++;}
					
					if($z==0){
						?><tr style="font-family:;font-size:7px;background:#f4f4f4"><?
					}else{
						?><tr style="font-family:;font-size:7px;background:#e7e7e7"><?
					}
					
				}
				
				$celula = explode('<td>',$d);
				unset($celula[0]);
				$a = 0;
				$y = 0;
				$j = 0;
				$k = 0;
				$v++;
				foreach($celula as $c){
					$a++;
					$zz = $k++;
				$bb = 85 / $a;	
				}
				foreach($celula as $c){
					
					if($i == 0){
						if($zz == $j){$bb = $bb + 15;}
						?><td style="padding:7px; width:<?=$bb?>%"><?
					}else{
						if($y==1){$y=0;}else{$y++;}
						if($y==0){
							?><td style="padding:5px"><?
						}else{
							if($z==0){
								?><td style="padding:5px; background:#fff"><?
							}else{
								?><td style="padding:5px; background:#f7f7f7"><?
							}
						}
					}
					
					echo strip_tags($c);
					?></td>
					<? $j++;
				}
				if($i == 0){
					?></tr><?
					$i++;
				}else{
					?></tr><?
				}
				
			} ?>
		</table>
</page>

<?

$content = ob_get_clean();

# Converte o html para pdf.
try
{
	
    /* Aqui estamos instanciando um novo objeto que irá criar o 
     * pdf. Então vamos aos parametros passados:
     * 1º parâmetro: Utilize “P” para exibir o documento no 
     *               formato retrato e “L” para o formato 
     *               paisagem. 
     * 2º parâmetro: Formato da folha A4, A5....... 
     * 3º parâmetro: Caso ocorra alguma exceção durante a 
     *               conversão. Em qual idioma é para 
     *               exibir o erro. No caso o idioma escolhido 
     *               foi o português “pt”. 
     * 4º parâmetro: Informe TRUE caso o html de entrada esteja
     *               no formato unicode e FALSE caso negativo. 
     * 5º parâmetro: Codificação a ser utilizada. ISO-8859-15, UTF-8 ...... 
     * 6º parâmetro: Margem do documento. Você pode informa um 
     *               único valor como no exemplo acima. 
     *               Outra forma é informa um array setando as 
     *               margens separadamente.: Exemplo: 
     * $html2pdf = new HTML2PDF(
     *   'P',
     *   'A4',
     *   'pt',
     *   false,
     *   'ISO-8859-15',
     *   array(5,5,5,8));
     * Sendo que a primeira posição do array representa a margem esquerda depois      
     * topo, direita e rodapé. */
    $html2pdf = new HTML2PDF('P','A4','pt', true, 'ISO-8859-1', 0);
	//$html2pdf->AddFont('montserrat', '', 'montserrat.php'); 
	//$html2pdf->AddFont('montlight', '', 'montlight.php'); 
    # Passamos o html que queremos converte.
    $html2pdf->writeHTML($content); 
     
    /* Exibe o pdf:
     * 1º parãmetro: Nome do arquivo pdf. O nome que você quer dar ao pdf gerado. 
     * 2º parâmetro: Tipo de saída: 
                     I: Abre o pdf gerado no navegador. 
                     D: Abre a janela para você realizar o download do pdf. 
                     F: Salva o pdf em alguma pasta do servidor. */
					 $nno = explode(' ',$produto['nome']);
    $html2pdf->Output('BakelitSul.pdf', 'D');

	



}
catch(HTML2PDF_exception $e) 
{ 

	
	
}}