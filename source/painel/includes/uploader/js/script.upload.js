(function($){
	$.multiploLoader = function(selector, tipo){
	 	var obj = $(selector);
		var tipos = tipo ? tipo : '';
		var imgApaga;	
		var pagina = $("#img-file").attr("data-pagina");
		var tokenn = $("#img-file").attr("data-token");
		  $("#img-file").find('#fileupload').fileupload({
				dataType: 'json',
				always: function(e, data){
					$("#img-file").find(".bar").css('width', '100%');
					$("#img-file").find("#lista-arquivos").load('includes/uploader/upload/lista-download.php?types='+tipo+"&pag="+pagina+"&toke="+tokenn, function(){ Atualiza(); });
					$.post("includes/uploader/upload/lista-download.php?types="+tipo+"&pag="+pagina+"&toke="+tokenn, {pag: pagina, toke: tokenn}, function(){ Atualiza(); });
				},
				progressall: function (e, data) {
					//var progress = parseInt(data.loaded / data.total * 10, 10);
					//alert(parseInt(data.total/100 - data.loaded/100, 10));
					
					//data.total = data.total / 100;
					//data.loaded = data.loaded / 100;
					//var progress = Math.round(data.loaded * 100 / data.total)
					//alert(data.total+'-'+e.loaded);
					var progress = parseInt((data.loaded / data.total * 100) * 1);
					//var progress = parseInt(data.total - data.loaded, 10);
					
						$("#img-file").find('.bar').css(
							'width',
							progress + '%'
						);
				}
			});
		
		$("#img-file").find("#lista-arquivos").load('includes/uploader/upload/lista-download.php?pag='+pagina+"&toke="+tokenn,{pag: pagina, toke: tokenn}, function(){ Atualiza(); });
		//alert("asd - "+pagina);
		
		function Atualiza(){
			//alert("asd - "+pagina);
			var pagina = $("#img-file").attr("data-pagina");
			var tokenn = $("#img-file").attr("data-token");
			$("#img-file ul#lista-arquivos li").find('span.exclu').each(function(){
				$(this).click(function(){
					exclui = $(this).attr('data-id');
					imgApaga = $(this).attr('data-token');
					Dialogo("sim", "Imagem excluida com sucesso!");
					$.post("includes/uploader/upload/exclui.php?pag="+pagina+"&toke="+tokenn, {id: exclui, token: imgApaga, toke:tokenn, pag: pagina}, function(){ Atualiza(); 
						//$.post("uploader/upload/lista-download.php?types="+tipo+"&pag="+pagina+"&toke="+tokenn, {pag: pagina, toke: tokenn}, function(){ });
					});
					
				});
			});
			
			$("#img-file ul#lista-arquivos li").find('#legenda').each(function(){
				$(this).blur(function(){
					exclui = $(this).attr('data-id');
					legenda = $(this).val();
					$.post("includes/uploader/upload/edita.php?pag="+pagina+"&toke="+tokenn, {id: exclui, legenda: legenda, val: 'legenda', pag: pagina, toke: tokenn}, function(){ 
																					  });
					
				});
			});
			
			
			$("#img-file ul#lista-arquivos li").find('#cor').each(function(){
				$(this).blur(function(){
					exclui = $(this).attr('data-id');
					var cor = $('#corSel').val();
					alert(cor);
					$.post("includes/uploader/upload/edita.php?pag="+pagina+"&toke="+tokenn, {id: exclui, cor: cor, val: 'cor', pag: pagina, toke: tokenn}, function(){ 
																					  });
					
				});
			});
			
			$("#img-file ul#lista-arquivos li").find('#estrela').each(function(){
				$(this).click(function(){
					exclui = $(this).attr('data-id');
					legenda = $(this).val();
					
					$.post("includes/uploader/upload/edita.php?pag="+pagina+"&toke="+tokenn, {id: exclui, principal: '1', val: 'principal', pag: pagina, toke: tokenn}, function(){ 
																					  });
					
				});
			});
			
			$("#img-file ul#lista-arquivos li").find('.cad').each(function(){
				$(this).click(function(){
					exclui = $(this).attr('data-id');
					legenda = $(this).val();
					
					$.post("includes/uploader/upload/edita.php?pag="+pagina+"&toke="+tokenn, {id: exclui, principal: 'tec', val: 'tecnico', pag: pagina, toke: tokenn}, function(){ 
					});
					
				});
			});
			
			
			if(tipo == "img"){
				$("#img-file ul#lista-arquivos li").find("a").each(function(){
					$(this).click(function(e){
						e.preventDefault();
						$("#img-file").find("#infs img").remove();
						$("#img-file").find("#remove").remove();
						//$("#img-file").find("#infs").append('<img src="'+$(this).attr('href')+'" height="100" border="0" />');
						//$("#img-file").find("#infs").append('<a href="#" id="remove"></a>');
						
						$("#img-file").find("#remove").click(function(e){
							e.preventDefault();
							$("#img-file").find("#infs img").remove();
							$(this).remove();
						});
					});
				});
				
				$("#img-file").find("#remove").click(function(){
					$("#img-file").find("#infs img").remove();
					$(this).remove();
				});
			}
		}
		
	}
	
})(jQuery);