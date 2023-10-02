// JavaScript Document

$('.logof').hover(function(){
		$(this).animate({marginRight:'-40px', width : '110px'}, 300);
	},function(){
		$(this).animate({marginRight:'0px', width : '38px'}, 300);
			
	});

	function resize(qtn, vel){
		var wid = $(document).width();
		$('.caixa-conteudo').animate({"width":wid-qtn+"px"}, vel);
		}
	if($.session.get('open') != 0 && $.session.get('open') != 2){
		$.session.set("open", "0");	
		}	
		
		//alert($(document).width());
	if($.session.get('open') == 2){
		// FECHADO
		
		$(this).addClass('btn-fecha-close');
		$("#caixa-menu").css({'left' : '-239px'});
		$("#fecha-menu").css({'left' : '8px'});
		$(".caixa-conteudo").css({'margin-left' : '130px'});
			
		resize(165, 0);
		$(window).resize( function(){
			resize(165, 0);
		});
		
		$("#fecha-menu").toggle(function() {	
		// FECHADO ABRE
		
			resize(404, 400);
			$(window).resize( function(){
				resize(404, 0);
			});
			$.session.set("open", "0");	
			$("#caixa-menu").animate({'left' : '0px'});
			$("#fecha-menu").animate({'left' : '247px'});
			$(".caixa-conteudo").animate({'margin-left' : '390px'});
			$("#fecha-menu").removeClass('btn-fecha-close');
			
		}, function() {
			resize(165, 300);
			$(window).resize( function(){
				resize(165, 0);
			});
			$.session.set("open", "2");
			var wid = $(document).width();
			$('.topo-caminho').css("width",wid-60+"px");
			$("#caixa-menu").animate({'left' : '-239px'}, 300);
			$("#fecha-menu").animate({'left' : '8px'}, 300);
			$(".caixa-conteudo").animate({'margin-left' : '130px'});
			$(this).addClass('btn-fecha-close');
		});
			
		$('#fecha-menu').addClass('btn-fecha-close');
		
		
	}else if($.session.get('open') == 0){
		
		$('#fecha-menu').removeClass('btn-fecha-close');
		$("#caixa-menu").css({'left' : '0px'});
		$("#fecha-menu").css({'left' : '247px'});
		$(".caixa-conteudo").css({'margin-left' : '390px'});
		
		resize(404, 0);
			$(window).resize( function(){
				resize(404, 0);
			});
		
		$("#fecha-menu").toggle(function() {
			resize(165, 300);
			$(window).resize( function(){
				resize(165, 0);
			});
			$.session.set("open", "2");
			
			$("#caixa-menu").animate({'left' : '-239px'}, 300);
			$("#fecha-menu").animate({'left' : '8px'}, 300);
			$(".caixa-conteudo").animate({'margin-left' : '130px'});
			$(".topo-caminho").animate({'left' : '65px'}); 
			$(this).addClass('btn-fecha-close');
			
			
			
		}, function() {
			resize(404, 400);
			$(window).resize( function(){
				resize(404, 0);
			});
			$.session.set("open", "0");	
			//$('.menu-adm').delay(150).fadeIn(300);
			var wid = $(document).width();
			$("#caixa-menu").animate({'left' : '0px'});
			$("#fecha-menu").animate({'left' : '247px'});
			$(".caixa-conteudo").animate({'margin-left' : '390px'});
			$(this).removeClass('btn-fecha-close');
			
			
		});
		$('#fecha-menu').removeClass('btn-fecha-close');
	}