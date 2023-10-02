<? 
include('includes/topo.php'); 
$rProd = new conect();

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
                    <label>
           				<strong>Categoria</strong>
                    	<select name="categoria">
                        	<option value="" style="color:#777; padding:5px 5px 5px 20px"> <strong><i>-- Nenhuma --</i></strong> </option>
							<? 
                            	$prodsa = $rProd->lista('categorias');
                                foreach($prodsa as $pais){
									if($pais['pai'] == "")
									{
										$Linha = $rProd->lista('categorias', "pai='".$pais['id']."'");
										if($Linha)
										{
											foreach($Linha as $li)
											{
												$Sub = $rProd->lista('categorias', "pai='".$li['id']."'");
												if($Sub)
												{
													foreach($Sub as $sb)
													{
													?>
													<option value="<?=$sb['id']?>"  <? if($categoria == $sb['id']){echo 'selected';}?> style="color:#333; padding:5px 5px 5px 20px"><?=$pais['nome']." - ".$li['nome']." - ".$sb['nome']?></option>
													<?
													}
												}
												else
												{
													?>
                                                    <option value="<?=$li['id']?>"  <? if($categoria == $li['id']){echo 'selected';}?> style="color:#333; padding:5px 5px 5px 20px"><?=$pais['nome']." - ".$li['nome']?></option>
                                                    <?
												}
											}
										}
										else
										{
											?>
                                            <option value="<?=$pais['id']?>"  <? if($categoria == $pais['id']){echo 'selected';}?> style="color:#333; padding:5px 5px 5px 20px"><?=$pais['nome']?></option>
                                            <?
										}
									}
								} 
							?>
                        </select>
                   	</label>
                    <div class="controle">&nbsp;</div>
                    
                    
                    <label><strong>Descrição</strong><textarea class="span5" name="descricao" style="height:120px"><?=$descricao?></textarea></label>
                </div>
            </div>
            <div class="contentCadr">
                <div class="alignCenter">
                	<img src="/painel/images/starC.png" /><span>Imagem da lista</span>
                	<span class="icon-star" style="margin:3px 3px 3px 50px !important">&nbsp;</span><span>Imagem Interna</span>
                    
                   	<div class="conteiner" id="img-file" style="width:535px; margin-top:20px">
                        <div style="padding:10px; background:#eee;border-radius:6px 6px 0 0; -webkit-border-radius:6px 6px 0 0; -moz-border-radius:6px 6px 0 0;">
                            <div class="progress progress-striped active" style="margin:0" id="infs">
                                 <div class="bar" style="width: 0%;"></div>
                            </div>
                        </div>
                        <ul id="lista-arquivos" style="height:300px">
                            
                        </ul>
                        
                        <div class="barra-topo">
                            <input id="fileupload" type="file" name="files[]" data-url="uploader/upload/upload.php" multiple style="display:none; width:490px !important">
                            <div style="text-align:center">
                                <div class="btn btn-primary" type="button" id="add-arquivo" style="width:440px">Cadastrar imagens</div>
                            </div>
                            
                        </div>
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
    
  
