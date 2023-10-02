  </div>
</div>
</body>
</html>
<div id="modalPadrao" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel" style="color:#099209"></h3>
    </div>
    <div class="modal-body2" style="padding:20px">
        <p></p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button>
    </div>
</div>
<?php /*?><? 
 if($p == 'newsletter'){$p = 'news';}

	$resulSeo = new conect();
			$prods = $resulSeo->lista($p);
			foreach($prods as $lis){
		?>
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


<? } ?><?php */?>



<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form method="get" action="">
<input type="hidden" name="editar" value="<?=$_GET['editar']?>" />
<input type="hidden" name="token" value="<?=$_GET['token']?>" />
<input type="hidden" name="familia" value="<?=$_GET['familia']?>" />
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Adicionar Coluna</h3>
  </div>
  <div class="modal-body">
    Após 
    <select id="after" name="after">
    		<?
								
                                $linha = explode('<tr>',$tabela);
								 unset($linha[0]);
								 $i = 0;
								foreach($linha as $d){
									$celula = explode('<td>',$d);
									unset($celula[0]);
									foreach($celula as $c){
										if($i == 0){
											
												echo '<option value="'.strip_tags($c).'">'.strip_tags($c).'</option>';
										}
										
									}
									 $i++;
								}?>
    </select>
    
    <input type="text" id="colu" name="colu" />
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <input type="submit" id="addColunafff" class="btn btn-primary" value="Salvar">
  </div>
  </form>
</div>


<script>


$("#sortableInt").sortable({
		update: function() {
			$("#tabela").html($("#wrapperTableGet").html());
		}
	}).disableSelection();
	


$(function() {
	var page = '<?=$p?>';
	

		$("#sortable").sortable({
			
			update: function(event, ui) {
				
                  
				
				//var id = ui.item.attr("data-id");
				var   order = $('#sortable').sortable('toArray').toString();
				
				 	
				
				$("#demo").load("js/ordem.php?usuarioId="+order+"&page="+page);
			}
		}).disableSelection();
		
		
		
});

</script>