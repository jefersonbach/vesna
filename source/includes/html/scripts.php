<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->


<script async defer src="//assets.pinterest.com/js/pinit.js"></script>

<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="/assets/js/scripts.min.js?<?php echo filemtime('assets/js/scripts.min.js'); ?>"></script>


<script>

$(document).ready(function(){

	var col = document.querySelector('[data-coluna]');
	console.log(col);


	function alerta(titu, mensagem, btn, caminhoBtn, cor) {
		//alert('asd');
		$('#bgBlackAlerta').fadeIn(120);
		$('#contentBoxAlerta').css({
			display: 'inline-block'
		});
		//$('#contentBoxAlerta').fadeIn();
		$('#contentBoxAlerta').animate({
			top: '30%'
		}, 100);
		$('#contentBoxAlerta').delay(70).animate({
			opacity: 1
		}, 60);

		$('#boxNewsAlert #mensagemAlerta').html(mensagem);
		$('#boxNewsAlert #tituloAlerta').html(titu);
		if (caminhoBtn) {
			$('#contentBoxAlerta #btnAlerta').attr('href', caminhoBtn);
		} else {
			$("#btnAlerta").click(function(e) {
				e.preventDefault();
			});
		}
		$('#contentBoxAlerta #btnAlerta').html(btn);
		$('#boxNewsAlert #tituloAlerta').css('color', cor);

	}

	function fechaAlerta() {
		$('#bgBlackAlerta').stop().fadeOut(500);
		$('#contentBoxAlerta').css({
			opacity: 0,
			top: '-50px'
		});
		$('#contentBoxAlerta').delay(600).fadeOut(0);
	}


	$('#bgBlackAlerta').click(function(){
		fechaAlerta();
	});
	$('#contentBoxAlerta').click(function(){
		fechaAlerta();
	});




    <? if($alerta['titulo']){?>
        alerta('<?=$alerta['titulo']?>', '<?=$alerta['mensagem']?>', '<?=$alerta['btn']?>', '<?=$alerta['link']?>', '<?=$alerta['cor']?>');
    <?}?>




});
    </script>