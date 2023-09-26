
(function($){
	
	$.multiploLoaderD = function(selector, tipo){
	 	var obj = $(selector);
		var tipos = tipo ? tipo : '';
		
		  
		  $("#img-fileD").find('#fileuploadD').fileupload({
				dataType: 'json',
				always: function(e, data){
					$("#img-fileD").find(".barD").css('width', '0%');
					$("#img-fileD").find("#lista-arquivosD").load('uploader/upload/lista-downloadD.php?types='+tipo, function(){ Atualiza(); });
				},
				progressall: function (e, data) {
					var progress = parseInt(data.loaded / data.total * 10, 10);
					$("#img-fileD").find('.barD').css(
						'width',
						progress + '%'
					);
					
				}
			});
		  
		
			
		
		
		
		$("#img-fileD").find("#lista-arquivosD").load('uploader/upload/lista-downloadD.php', function(){ Atualiza(); });
		
		
		function Atualiza()
		{
				
			$("#img-fileD ul#lista-arquivosD li").find('span.excluD').each(function(){
				$(this).click(function(){
					exclui = $(this).attr('data-id');
					alert(exclui);
					//asdd = "Imagem excluida com sucesso!";
					//Dialogo("sim", 'Arquivo excluído com sucesso');
					$.post("uploader/upload/excluiD.php", {id: exclui}, function(){ $("#img-fileD").find("#lista-arquivosD").load('uploader/upload/lista-downloadD.php?types='+tipo, 
					
					function(){ Atualiza(); }); 

					});
					
				});
			});
			
			$("#img-fileD ul#lista-arquivosD li").find('#legendaD').each(function(){
				$(this).blur(function(){
					exclui = $(this).attr('data-id');
					legenda = $(this).val();
					$.post("uploader/upload/editaD.php", {id: exclui, legenda: legenda, val: 'legenda'}, function(){ 
																					  });
					
				});
			});
			
			$("#img-fileD ul#lista-arquivosD li").find('#estrelaD').each(function(){
				$(this).click(function(){
					exclui = $(this).attr('data-id');
					legenda = $(this).val();
					$.post("uploader/upload/editaD.php", {id: exclui, principal: '1', val: 'principal'}, function(){ 
																					  });
					
				});
			});
			
			if(tipo == "img")
			{
				$("#img-fileD ul#lista-arquivosD li").find("a").each(function(){
					$(this).click(function(e){
						e.preventDefault();
						$("#img-fileD").find("#infsD img").remove();
						$("#img-fileD").find("#removeD").remove();
						//$("#img-file").find("#infs").append('<img src="'+$(this).attr('href')+'" height="100" border="0" />');
						//$("#img-file").find("#infs").append('<a href="#" id="remove"></a>');
						
						$("#img-fileD").find("#removeD").click(function(e){
							e.preventDefault();
							$("#img-fileD").find("#infsD img").remove();
							$(this).remove();
						});
					});
				});
				
				$("#img-fileD").find("#removeD").click(function(){
					$("#img-fileD").find("#infsD img").remove();
					$(this).remove();
				});
			}
		}
		
	}
	
})(jQuery);