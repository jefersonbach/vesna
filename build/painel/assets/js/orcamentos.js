// JavaScript Document

function mudaSit(valor, cor){	
		$('#situacao').text(valor).css({backgroundColor: '#'+cor});
	}	
	
	
$(document).ready(function(){
	$('#aviso').load('../includes/aviso.php');
	function calculatotal(){
	
		var valor = 0;
		
		$("#lista-valores").find(".listar").each(function(i){
			valor = parseFloat($(this).find(".deco").val().replace(',', '.')) + valor ; 
		});
		$("#lista-valores").find("#total-dec").html(valor);
		recupera = $("#lista-valores").find("#total-dec").html();
		$("#lista-valores").find("#total-dec").html(recupera.replace('.', ','));
		
		Totaldesc();
	}

	
	function Totaldesc()
	{	
		var valor = 0;
		
		$("#lista-valores").find(".listar").each(function(i){
			//valor += $(this).find(".deco").val();
		
			valor = parseFloat($(this).find(".retorna").html().replace(',', '.')) + valor ; 
		});
		
		$("#lista-valores").find("#com-dec").html(valor);
		recupera = $("#lista-valores").find("#com-dec").html();
		$("#lista-valores").find("#com-dec").html(recupera.replace('.', ','));
	}
	
	
	$("#lista-valores").find(".listar").each(function(){
		
		$(this).find(".deco").keyup(function(){
			inicial = $(this).val().replace(',', '.');
			total = ((eval($(this).parent().parent().find(".valor").html()) * eval($(this).parent().parent().find(".unidades").html())) - (inicial));
			$(this).parent().parent().find(".retorna").html(total);
			
			retorno = $(this).parent().parent().find(".retorna").html();
			$(this).parent().parent().find(".retorna").html(retorno.replace('.', ','));
			
			calculatotal();
		});
	});
	
	setInterval(function(){ $('#aviso').load('includes/aviso.php').fadeIn(); }, 1000);
	
	});