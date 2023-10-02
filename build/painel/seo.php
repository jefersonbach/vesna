<?
include('includes/topo.php');
if($_GET['salva'] == 1){
	$ss = $resulSeo->cadastros($post, 'seo'); 
	?>
	<script>
		$(document).ready(function(){
			<?
			if($ss == "sim"){?>Dialogo("sim", "Configurações cadastradas com sucesso!");<?
			}elseif($ss == "nao"){ ?>Dialogo("nao", "Erro ao cadastrar configurações!");<?
			}elseif($ss == "sime"){?>Dialogo("sim", "Configurações editadas com sucesso!");<?
			}elseif($ss == "naoe"){?>Dialogo("nao", "Erro ao editar configurações.");<? } 
		?>
		});
	</script>
	<?
	include('includes/cria.php');
	}
	$prods = $resulSeo->lista('seo');
	extract($prods[0]);		
?>
<style>
	.help-inline{font-size:11px}
</style>
<div id="contentTitu">
    <h1>Configurações</h1>
    <div class="controle">&nbsp;</div>
</div>
<form method="post" action="?salva=1">

    <div class="contentCad">
        <div class="alignCenter">

<h2>Configurações gerais</h2>

        	<h2>SEO</h2>
            <label><strong>Empresa</strong><input type="text" class="span5" name="empresa" value="<?=$empresa?>" /></label>
            
            <label><strong>E-mail</strong><input class="span5" type="text" name="email" value="<?=$email?>" required></label>
            
            <label><strong>Telefone</strong><input type="text" class="span5" name="telefone" value="<?=$telefone?>" /></label><span class="help-inline" style="float:right; margin-right:40px">(55) 5555-5555</span>
        
        	<label><strong>Rua</strong><input type="text" class="span5" name="rua" value="<?=$rua?>" /></label><span class="help-inline" style="float:right; margin-right:40px">Avenida Abramo Randon 1087</span>
        
        	<label><strong>Região</strong><input type="text" class="span4" name="regiao" value="<?=$regiao?>" /></label><label><input type="text" class="span1" name="es" value="<?=$es?>" style="margin:5px 0 0 0px; width:22px" /></label><span class="help-inline" style="float:right; margin-right:40px">RS</span><span class="help-inline" style="float:right; margin:0 20px 0 0">Rio Grande do Sul - BR</span>
            
            <label><strong>Cidade</strong><input type="text" class="span5" name="cidade" value="<?=$cidade?>" /></label><span class="help-inline" style="float:right; margin-right:40px">Caxias do Sul</span>
            
            <br />
            <hr />
           
        </div>
    </div>
    <div class="contentCadr">
        <div class="alignCenter">
        	<h2>Páginas</h2>
            <div class="well span3" style="margin:0; padding:8px 0">
                <ul class="nav nav-list" >
                    <li class="nav-header">Páginas</li>
                    	<div id="list-pag">
							<?
                            if($pag){
                                $pag2 = substr($pag, 1);
                                $pagina = explode(',', $pag2);
                                
                                $i = 0;
                                foreach($pagina as $pagi){
                                    ?>
                                    <li class="ll">
                                        <label class="checkbox" style="padding:2px; margin-bottom:2px">
                                            <?=$resulSeo->maiuscula($pagi)?>
                                            <a class="btn btn-mini right tira" style="float:right" href="#" id="<?=$pagi?>"><i class="icon-minus"></i></a>
                                        </label>
                                    </li>
								<?
                                }
                             }
                            ?>
						</div>
                    <li class="divider"></li>
                    <li class="nav-header">Ou Nova</li>
                    <li>
                        <input type="text" name="paginas" class="span2" id="pag" style="margin-bottom:0 !important" />
                        <input type="hidden" value="<?=$id?>" id="id-atual" />
                        <a href="#" class="btn" id="maisPag" style=" display:inline;">+</a>
                    </li>
                </ul>
            </div>
            
            <div id="form-paginas">
                <? 
				$pagCria = explode(',',$post['pag']);
				unset($pagCria[0]);
				$p = end($pagCria);
				if($p){		
					if(!file_exists($p.'.php')){
						copy('includes/lista.php', $p.'.php');
						copy('includes/cadastra.php', 'cad_'.$p.'.php');
					}	
				}
				
				if($_POST['add']){
					unset($post['add']);
					echo $ss = $resulSeo->cadastros($post, 'seo'); 
					
				}?>
            </div>
            
            <div id="tira-paginas">
				<?	
				if($_POST['exc']){
					unset($post['exc']);
                    $post['pag'] = str_replace(",".$_POST['pag'],'', $pag);
                 	$ss = $resulSeo->cadastros($post, 'seo'); 
                }
                ?>
            </div>
            <div id="refrash"><input type="hidden" value="<?=$pag?>" id="pag-atual" /></div>
            
            
            <script type="text/javascript">
			$(document).ready(function(){
				
				function atualiza(){
					$('a.tira').each(function(){
						$(this).click(function(e){
							e.preventDefault();
							$('#tira-paginas').load('seo.php #tira-paginas', {id: $('#id-atual').val(), pag: $(this).attr('id'), exc: true}, function(){
								$('#tira-paginas').load('seo.php #tira-paginas');
								$('#pag').val('');
								$('#list-pag').load('seo.php #list-pag', function(){ atualiza(); $('#refrash').load('seo.php #refrash'); });
								
							});
						
						});
					});
					
				}
				
				
				$('a#maisPag').click(function(e){
					e.preventDefault();
					if($('#pag-atual').val() == ''){
						novo = ','+$('#pag').val();
					}else{
						novo = $('#pag-atual').val()+','+$('#pag').val();	
					}
					
					$('#form-paginas').load('seo.php #form-paginas', {pag : novo, id: $('#id-atual').val(), add: true}, function(){
						$('#pag').val('');
						$('#list-pag').load('seo.php #list-pag', function(){ atualiza(); $('#refrash').load('seo.php #refrash'); });
					});
					
				});
				
				
				$('a.tira').each(function(){
					$(this).click(function(e){
					e.preventDefault();
						$('#tira-paginas').load('seo.php #tira-paginas', {id: $('#id-atual').val(), pag: $(this).attr('id'), exc: true}, function(){
							$('#tira-paginas').load('seo.php #tira-paginas');
							$('#pag').val('');
							$('#list-pag').load('seo.php #list-pag', function(){ atualiza(); $('#refrash').load('seo.php #refrash'); });
						});
					
					});
				});
				
				
			});
			</script>
            
            
            <div class="controle">&nbsp;</div><br /><br /><br />
			<a href="/painel/gera-xml.php" target="_blank" class="btn">Gerar Sitemap</a>
        </div>
    </div>
    <div class="controle">&nbsp;</div>
    <div style="margin:20px 0 0; text-align:right">
        <div class="form-actions">
        	<? if($id){ ?><input type="hidden" name="id" value="<?=$id?>" /><? } ?>
            <input type="submit" class="btn btn-primary" value="Salvar alterações" />
            <a href="/painel/produtos.php"><button type="button" class="btn">Cancelar</button></a>
        </div>
    </div>
</form>

<? include('includes/rodape.php') ?>