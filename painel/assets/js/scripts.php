<?
	$resulMenus = $emp;
	$menus = $resulMenus->lista('seo', "id = 1");
	foreach($menus as $mens){
	
	//if($mens['orcamentos'] == 1){
		//echo '<script type="text/javascript" src="/painel/js/orcamentos.js"></script>';
	//}
	}
?>	
<script src="/painel/includes/Chart.js"></script>

<script>

	
function Dialogo(tipo, text)
{
	if(tipo == "sim"){
		$('#modalPadrao').find("#myModalLabel").css('color', "#099209");
		$('#modalPadrao').find("#myModalLabel").html("Sucesso!");
	}else if(tipo == "nao"){
		$('#modalPadrao').find("#myModalLabel").css('color', "#920909");
		$('#modalPadrao').find("#myModalLabel").html("Erro!");
	}
	$("#modalPadrao .modal-body2").find("p").html(text);
	$('#modalPadrao').modal();
}

	function formatReal( int )
{
        var tmp = int+'';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
 
        return tmp;
}
	
$(document).ready(function(){
	
        
	
	$("#btnFotoNot").click(function(){
		$(".contentCadr").find('input[name="gabarito"]').click();
	});
	
	$('input[name="gabarito"]').change(function(){
		   var fileName = $(this).val();
			if (this.files && this.files[0]) {
				var reader = new FileReader();
		
				reader.onload = function (e) {
					$('#btnFotoNot').html($(this).val());
				}
		
				reader.readAsDataURL(this.files[0]);
			}
		   
	   
     });
	
	
	$(document).on("input", "#conter", function () {
		var limite = 160;
		var caracteresDigitados = $(this).val().length;
		var caracteresRestantes = limite - caracteresDigitados;
	
		$("#caracteres").text(caracteresRestantes);
	});
        
        $('.autoSave').blur( function(){
            $(this).each(function(){
                var th = $(this).attr('id');
                var newVal = $(this).val();
                var valid = $(this).attr('data-id');
                var valtamanho = $(this).attr('data-tamanho');
                $('#recebe').load('/painel/estoque.php #reloadEstoque',{val: newVal, id: valid, tamanho: valtamanho}, function(){
                    alert('sucess:'+newVal);
                    $('#'+th).css({border:'1px solid #3eb70e'});
		});
            });
            
        });
	
	 $('#mtable tbody').on('click','i',function(e){
		  	var indexs = $(this).parents('tr').index();
		  	if(indexs == 0){
				alert('Impossível remover o último item!');
		  	}else{
			  if (confirm('Tem certeza que deseja excluir a linha?')) { 
				   e.preventDefault();
				  $(this).parents('tr').remove();
				  $("#tabela").html($("#wrapperTableGet").html());
			  }
			}
		});
	  
	  
	  $('#irow').click(function(){
        $('#mtable tbody').append($("#mtable tbody tr:last").clone(true).off());
		$("#tabela").html($("#wrapperTableGet").html());
	});
	  
	  
	 $('#icol').click(function(){
    if($('#appendedInputButton').val()){
        $('#mtable tr').append($("<td>"));
        $('#mtable thead tr>td:last').html($('#appendedInputButton').val()+' <i class="icon-remove"></i>');
        $('#mtable tbody tr').each(function(){$(this).children('td:last').append($("<input type='text' value='' /><span></span>"))});
    	$("#tabela").html($("#wrapperTableGet").html());
	}else{alert('Nome da coluna inválido!');}
});
	  
	  
	
	
	$("#abreFiltro").click(function(e){
		e.preventDefault();
		$('#caixaBusca').animate({width:'1170px'});
	});
	
	$("#filtro").click(function(e){
		e.preventDefault();
		alert($('#ex1aa').val());
	});
	
	
	
	
	
	$("#novaNews").click(function(e){
		e.preventDefault();
		$('#btnF').fadeOut();
		$('#contentLists').load('/painel/newsletter/novo.php','#news1', function(){
			$('#news1').fadeIn('slow');
		});
	});
	
	
	
	
	
	
	function atualizaLine(id, mes1, mes2, mes3, mes4, mes5, nmes1, nmes2, nmes3, nmes4, nmes5){
	
		
		var lineChartDatas = {
			labels : [nmes1,nmes2,nmes3,nmes4,nmes5],
			datasets : [
				{
					borderColor: "rgba(0,0,0,1)",
					label: "Acessos deste mês",
					fillColor : "rgba(145,188,35,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "#2091f9",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [mes1,mes2,mes3,mes4,mes5]
				}
			]

		}
		
		var ctxs = document.getElementById("canvas"+id).getContext("2d");
		
		var myLineChart = new Chart(ctxs).Line(lineChartDatas, {
			responsive: false
		});

	}
	
	

	
	$('.itemProd').mouseenter(function(){
		if ($('#content').length) {
			$('#content').fadeOut('slow','', function(){
				$('#caixaGoogl').html('<img src="/painel/images/load2.gif" width="80px" style="margin:50px auto" />');
			});
		}else{
			$('#caixaGoogl').html('<img src="/painel/images/load2.gif" width="80px" style="margin:50px auto" />');
		}

		var id = $(this).attr('data-id');
		var $item = $(this).closest('.itemProd');

		$('#caixaGoogl').load('/painel/includes/boxGoogle.php?prod='+id+'','#content', function(){
			$('#content').fadeIn('slow');
			var mes1 = $('#'+id+'mes1').text();
			var mes2 = $('#'+id+'mes2').text();
			var mes3 = $('#'+id+'mes3').text();
			var mes4 = $('#'+id+'mes4').text();
			var mes5 = $('#'+id+'mes5').text();
			
			var nmes1 = $('#'+id+'nmes1').text();
			var nmes2 = $('#'+id+'nmes2').text();
			var nmes3 = $('#'+id+'nmes3').text();
			var nmes4 = $('#'+id+'nmes4').text();
			var nmes5 = $('#'+id+'nmes5').text();
			
			atualizaLine(id, mes1, mes2, mes3, mes4, mes5, nmes1, nmes2, nmes3, nmes4, nmes5);
		});
	});
	
	
	
	
	
	
	
	
	$(document).on("input", "#conter", function () {
		var limite = 160;
		var caracteresDigitados = $(this).val().length;
		var caracteresRestantes = limite - caracteresDigitados;
		$("#caracteres").text(caracteresRestantes);
	});
	
	
	$(document).on('keyup', '#lucro' , function() {
		var allTx = $("#allTx").attr('data-txlc');
		var lucr = $(this).attr('value');
		$("#allTx").html(Number(lucr) + Number(allTx));
	  });
	
	
	<?php /*?>$(document).on('keyup', 'input' , function() {
		var values = $(this).val();
		$(this).next("span").html(values);
		$("#tabela").html($("#wrapperTableGet").html());
	  });
	  
	  $('#mtable thead').delegate('td', 'click', function() {
		  if (confirm('Tem certeza que deseja excluir a coluna?')) { 
			var index = this.cellIndex;
			$(this).closest('#mtable').find('tr').each(function() {
				this.removeChild(this.cells[ index ]);
			});
		}
	});
	  <?php */?>
	  
	  
	 
	  
	$("#selecfamilia").change(function() {
	   $('#fam').submit();
	
	});
	
	$("#selecfamiliaInter").change(function() {
		if($(this).val() != ''){
	   		$('input.span2').attr('id', 'disabledInput');
			$('input.span2').attr('disabled', 'disabled');
		}else{
			$('input.span2').attr('id', '');
			$('input.span2').removeAttr('disabled');
		}
	
	});
	
	
	$('#entrega').click(function(){
		if ($('#entrega').is(":checked")){
			$('#entregaCaixa').addClass('iconSel');
		}else{ 
			$('#entregaCaixa').removeClass('iconSel');
		}
	});
		
	$('#fabricacao').click(function(){
		if ($('#fabricacao').is(":checked")){
			$('#fabricacaoCaixa').addClass('iconSel');
			$('#caixaAlteracoes').fadeIn();
		}else{ 
			$('#fabricacaoCaixa').removeClass('iconSel');
			$('#caixaAlteracoes').fadeOut();
		}	
	});
	
	$('#importado').click(function(){
		if ($('#importado').is(":checked")){
			$('#importadoCaixa').addClass('iconSel');
		}else{ 
			$('#importadoCaixa').removeClass('iconSel');
		}	
	});
	
	$('#pdf').click(function(){
		if ($('#pdf').is(":checked")){
			$('#pdfCaixa').addClass('iconSel');
		}else{ 
			$('#pdfCaixa').removeClass('iconSel');
		}	
	});
	
	$('#nota').click(function(){
		if ($('#nota').is(":checked")){
			$('#notaCaixa').addClass('iconSel');
			$('#caixaNota').fadeIn();
		}else{ 
			$('#notaCaixa').removeClass('iconSel');
			$('#caixaNota').fadeOut();
		}	
	});
	
	$('#prod').click(function(){
		if ($('#prod').is(":checked")){
			$('#prodCaixa').addClass('iconSel');
			$('#selprod').fadeIn();
		}else{ 
			$('#prodCaixa').removeClass('iconSel');
			$('#selprod').fadeOut();
		}	
	});
		
		

	var i = 1;
	while(i <= 20){
		i++;
		$('#adia'+i).click(function(e){
			e.preventDefault();
			var aa = $(this).attr('data-id');
			//console.log(aa);
			$.post('alert.php', {edit: aa});
		});
	}


	$('#myTabs').find('li').each( function(){
		$(this).click(function(e){
			e.preventDefault();
			var id = $(this).find('a.mm').attr('id');
			
			$('#myTabs').find('li').each( function(){
				$(this).removeClass('active');
			});
			
			$(this).addClass('active');
			
			$(".pill-content").find('.content-padrao').each(function(){
				if($(this).css('display') === 'block'){
					$(this).fadeOut(function(){
						$('.pill-content #'+id).fadeIn();
					});
				}
			});
		 
		 });
	});
	
	$('.logof').hover(function(){
		$(this).animate({marginRight:'-40px', width : '110px'}, 300);
	},function(){
		$(this).animate({marginRight:'0px', width : '38px'}, 300);
	});

	function resize(){
		var wid = $(document).width();
		var dim;
		dim = 244;
		if($.browser.msie  && parseInt($.browser.version, 10) === 10){
			dim = 261;
		}else{
			dim = 210;
		}
		$('.caixa-conteudo').animate({"width":wid-dim+"px"}, 0);
	}
		
	resize();
	$(window).resize( function(){
		resize();
	});
	$('.menuAlt').tooltip();
	$('.ativ').popover();
	$('.situac').button();
	$('#myTab').tab('show');
	
	$('#ex1aa').slider({
		value: $('#preco').val(),
		formater: function(value) {
			
			
			return value;

		}
	});
});

</script>
<?php /*?><script type="text/javascript" src="/slid/js/jquery.slider.js"></script><?php */?>
