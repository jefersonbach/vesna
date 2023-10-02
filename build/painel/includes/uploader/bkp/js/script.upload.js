(function($){
	
	$.multiploLoader = function(selector, tipo){
	 	var obj = $(selector);
		var tipos = tipo ? tipo : '';
				
		$(obj).find('#fileupload').fileupload({
			dataType: 'json',
			always: function(e, data){
				$("#img-file").find(".bar").css('width', '0%');
				$("#img-file").find("#lista-arquivos").load('uploader/upload/lista-download.php?types='+tipo, function(){ Atualiza(); });
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 10, 10);
				$("#img-file").find('.bar').css(
					'width',
					progress + '%'
				);
				
			}
		});
		
		
		$("#img-file").find("#lista-arquivos").load('uploader/upload/lista-download.php', function(){ Atualiza(); });
		
		
		function Atualiza()
		{
				
			$("#img-file ul#lista-arquivos li").find('span.exclu').each(function(){
				$(this).click(function(){
					exclui = $(this).attr('data-id');
					Dialogo("sim", "Imagem excluida com sucesso! 4");
					$.post("uploader/upload/exclui.php", {id: exclui}, function(){ $("#img-file").find("#lista-arquivos").load('uploader/upload/lista-download.php?types='+tipo, 
					
					function(){ Atualiza(); }); 

					});
					
				});
			});
			
			$("#img-file ul#lista-arquivos li").find('#legenda').each(function(){
				$(this).blur(function(){
					exclui = $(this).attr('data-id');
					legenda = $(this).val();
					$.post("uploader/upload/edita.php", {id: exclui, legenda: legenda, val: 'legenda'}, function(){ 
																					  });
					
				});
			});
			
			$("#img-file ul#lista-arquivos li").find('#estrela').each(function(){
				$(this).click(function(){
					exclui = $(this).attr('data-id');
					legenda = $(this).val();
					$.post("uploader/upload/edita.php", {id: exclui, principal: '1', val: 'principal'}, function(){ 
																					  });
					
				});
			});
			
			if(tipo == "img")
			{
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