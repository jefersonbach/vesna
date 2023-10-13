<? 

	$resulMenus = new connect();
	$menus = $resulMenus->lista('seo');
	extract($menus[0]);
	$icons = array('picture',
				   'wrench',
				   'flag',
				   'globe',
				   'calendar',
				   'orcamento');
?>
<div id="caixa-menu" class="caixa-menu">
	<div id="contm">
        <ul class="menu-adm nav nav-list">
        
                   
            <? if($_SESSION['adm'] == '1' or $_SESSION['adm'] == '2'){?>
                <li <? if(substr($_SERVER['REQUEST_URI'], 0, 15) == '/painel/seo.php'){echo 'class="active"';}?> id="config">
                    <a href="/painel/seo.php" title="Configurações">
                        <span style="float:left; font-weight:normal"> Configurações </span>
                        <i class=" icon-cog" style="margin:6px 15px; float:right">&nbsp;</i>
                    </a>
                </li>
            <? } ?>
            <? if($_SESSION['adm'] == '1' or $_SESSION['adm'] == '2'){?>
            <li <? if(substr($_SERVER['REQUEST_URI'], 0, 15) == '/painel/home.php'){echo 'class="active"';}?> id="config">
                    <a href="/painel/home.php" title="Home">
                        <span style="float:left; font-weight:normal"> Home </span>
                        <i class=" icon-home" style="margin:6px 15px; float:right">&nbsp;</i>
                    </a>
                </li>
            
            <?
            }
			 if($_SESSION['adm'] == '3'){?>
                <li <? if(substr($_SERVER['REQUEST_URI'], 0, 15) == '/painel/curriculos.php'){echo 'class="active"';}?>>
                    <a href="/painel/curriculos.php" title="Currículos">
                        <span style="float:left; font-weight:normal"> Currículos </span>
                        <i class=" icon-cog" style="margin:6px 15px; float:right">&nbsp;</i>
                    </a>
                </li>
            <? }elseif( $_SESSION['adm'] == '9'){?>
                <li <? if($_SERVER['REQUEST_URI'] == '/painel/categorias.php'){echo 'class="active"';}?>>
                        <a href="/painel/categorias.php" title="Categorias">
                        <span style="float:left; font-weight:normal">  Categorias</span>
                        <i class="icoMenu" id="<?=$icons[$i]?>" style="margin:3px 15px; float:right">&nbsp;</i>
                    </a>
                </li>
                <li <? if($_SERVER['REQUEST_URI'] == '/painel/produtos.php'){echo 'class="active"';}?>>
                        <a href="/painel/produtos.php" title="produtos">
                        <span style="float:left; font-weight:normal">  Produtos</span>
                        <i class="icoMenu" id="<?=$icons[$i]?>" style="margin:3px 15px; float:right">&nbsp;</i>
                    </a>
                </li>
                <li <? if($_SERVER['REQUEST_URI'] == '/painel/blog.php'){echo 'class="active"';}?>>
                        <a href="/painel/blog.php" title="blog">
                        <span style="float:left; font-weight:normal">  Blog</span>
                        <i class="icoMenu" id="<?=$icons[$i]?>" style="margin:3px 15px; float:right">&nbsp;</i>
                    </a>
                </li>
 

                <?
            }else{
                    if($pag){
					$pag2 = substr($pag, 1);
                    $pagina = explode(',', $pag2);
						
					$i = 0;
					foreach($pagina as $pagi){
                                           
						if($pagi != 'curriculos'){
							
						?>
						<li <? if($_SERVER['REQUEST_URI'] == '/painel/'.$pagi.'.php'){echo 'class="active"';}?>>
                                                        <a href="/painel/<? if($pagi == 'newsletter'){echo 'homeNews';}else{echo $pagi;}?>.php" title="<?=$resulMenus->maiuscula($pagi)?>">
                                                        <span style="float:left; font-weight:normal">  <?=$resulMenus->maiuscula($pagi)?></span>
                                                        <i class="icoMenu" id="<?=$icons[$i]?>" style="margin:3px 15px; float:right">&nbsp;</i>
                                                    </a>
                                                </li>
						<?
							$i++;
						}
						}
					}
                }
       
		?>
        </ul>
        <div class="controle">&nbsp;</div>
       <? /* <div style="width:100%; height:270px; position:absolute; bottom:0" id="caixaGoogl">
        </div>*/?>
	</div>
</div>

  