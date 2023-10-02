<?
$emp = new connect();
$prods = $emp->lista('seo',"id = '1'");
?>
<div class="header-topo">
                             <div class="descricao">
        <span><strong><?=$lis['empresa']?></strong></span>
    </div>
                            
    
    
	<div class="caixa-busca input-append" style="z-index:8888">
       
        <form action="busca.php">
            <div class="form-search">
                <input type="text" class="span3 bubu" name="whe" placeholder="Código" />
                <input type="hidden" name="busca" value="todos" />
                <?php /*?><select class="span2 bubu" name="busca" id="busca">
                	<option value="todos" style="padding:5px">Todos</option>
                    <?
						$resulMenus = new conect();
						$menus = $resulMenus->lista('seo', "id = 1");
						foreach($menus as $mens){
							if($mens['produtos'] == 1){?>	
								<option value="produtos" style="padding:5px">Produtos</option>
							<? }
							if($mens['categorias'] == 1){?>	
								<option value="categorias" style="padding:5px">Categorias</option>
							<? }
							if($mens['novidades'] == 1){?>	
								<option value="novidades" style="padding:5px">Novidades</option>
							<? 
							} 
							if($mens['orcamentos'] == 1){?>	
								<option value="orcamentos" style="padding:5px">Orçamentos</option>
							<? 
							} 
							if($mens['imoveis'] == 1){?>	
								<option value="imoveis" style="padding:5px">Imóveis</option>
							<? 
							} 
							if($mens['representantes'] == 1){?>	
								<option value="representantes" style="padding:5px">Representantes</option>
							<? 
							} 
							if($mens['onde'] == 1){?>	
								<option value="onde" style="padding:5px">Onde Encontrar</option>
							<? 
							} 
							if($mens['noticias'] == 1){?>	
								<option value="noticias" style="padding:5px">Notícias</option>
							<? 
							} 
							if($mens['downloads'] == 1){?>	
								<option value="downloads" style="padding:5px">Downloads</option>
							<? 
							} 
						}
							?>
                </select><?php */?>
                <input class="btn btn-inverse" value="Buscar" type="submit" />
                
                
            </div>
        </form>
  	</div>
	<div style="float:right" id="infs">
    	<div class="caixa-info">
        	<a href="/painel/index.php?sair=1" class="logof"></a>
        	<div style="float:right; width:230px; text-align:right">
                <span class="logado"><strong><?=$_SESSION['usuario']?></strong></span>
                <a href="/painel/alterar-senha.php" class="icon-wrench icon-white menuAlt" style="float:right; margin:2px 15px 2px 0 ; padding:10px 5px; background-position:-356px -133px" data-placement="bottom" data-toggle="tooltip" title="Alterar Senha">&nbsp;</a>
        	</div>
            
    	</div>
	</div>
</div>