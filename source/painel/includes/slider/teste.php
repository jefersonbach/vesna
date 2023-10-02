<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>


<link rel="apple-touch-icon" href="/painel/img/icon2.png" />


<link rel="stylesheet" href="/painel/css/base.css" type="text/css" media="screen" />
<link href="/painel/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link rel='stylesheet' href="/painel/uploader/css/style.css" type='text/css' media='screen' />
<link rel="stylesheet" type="text/css" href="/painel/includes/fancy/source/jquery.fancybox.css?v=2.1.4" media="screen" />



<script src="/painel/js/jquery-1.8.3.js"></script>
<script src="/painel/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/painel/includes/fancy/source/jquery.fancybox.js?v=2.1.4"></script>
	

<script type="text/javascript" src="/painel/includes/slider/js/bootstrap-slider.js"></script>
<link rel="stylesheet" href="/painel/includes/slider/css/slider.css" type="text/css" media="screen" />


<script src="/painel/uploader/js/jquery.ui.widget.js" type="text/javascript"></script>
<script src="/painel/uploader/js/jquery.fileupload.js" type="text/javascript"></script>
<script type="text/javascript" src="/painel/uploader/js/script.upload.js"></script>	

	<script>
	
$(document).ready(function(){
	
	$("#abreFiltro").click(function(e){
		e.preventDefault();
		$('#caixaBusca').animate({width:'100%'});
	});
	
	$('#ex1aa').slider({
		value: $('#preco').val(),
		formater: function(value) {
			var tmp = value+'';
			tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
			if( tmp.length > 6 )
					tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

			value = tmp;
			$('#preco').val(value);
			return value;

		}
	});
	});
	
	</script>

</head>

<body>

<input type="text" class="span5" name="preco" value="" id="preco" /></label>   
                    <input id="ex1aa" data-slider-id='ex1aaSlider' type="text" data-slider-min="0" data-slider-max="10000000" data-slider-step="10000" data-slider-value="<?=$preco?>" style="width:500px" />
</body>
</html>