

(function() {
  var $, Range, Trie,
    indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

  $ = jQuery;

  $.fn.validateCreditCard = function(callback, options) {
    var bind, card, card_type, card_types, get_card_type, is_valid_length, is_valid_luhn, j, len, normalize, ref, validate, validate_number;
    card_types = [
      {
        name: 'amex',
        range: '34,37',
        valid_length: [15]
      }, {
        name: 'diners_club_carte_blanche',
        range: '300-305',
        valid_length: [16, 17, 18, 19]
      }, {
        name: 'diners_club_international',
        range: '3095, 36, 38-39',
        valid_length: [14, 15, 16, 17, 18, 19]
      }, {
        name: 'jcb',
        range: '3088-3094, 3096-3102, 3112-3120, 3158-3159, 3337-3349, 3528-3589',
        valid_length: [16]
      }, {
        name: 'laser',
        range: '6304, 6706, 6709, 6771',
        valid_length: [16, 17, 18, 19]
      }, {
        name: 'visa_electron',
        range: '4026, 417500, 4508, 4844, 4913, 4917',
        valid_length: [16]
      }, {
        name: 'visa',
        range: '4',
        valid_length: [13, 14, 15, 16, 17, 18, 19]
      }, {
        name: 'mastercard',
        range: '51-55,2221-2720',
        valid_length: [16]
      }, {
        name: 'discover',
        range: '6011, 622126-622925, 644-649, 65',
        valid_length: [16, 17, 18, 19]
      }, {
        name: 'dankort',
        range: '5019',
        valid_length: [16]
      }, {
        name: 'maestro',
        range: '50, 56-69',
        valid_length: [12, 13, 14, 15, 16, 17, 18, 19]
      }, {
        name: 'uatp',
        range: '1',
        valid_length: [15]
      }, {
        name: 'mir',
        range: '2200-2204',
        valid_length: [16]
      }
    ];
    bind = false;
    if (callback) {
      if (typeof callback === 'object') {
        options = callback;
        bind = false;
        callback = null;
      } else if (typeof callback === 'function') {
        bind = true;
      }
    }
    if (options == null) {
      options = {};
    }
    if (options.accept == null) {
      options.accept = (function() {
        var j, len, results;
        results = [];
        for (j = 0, len = card_types.length; j < len; j++) {
          card = card_types[j];
          results.push(card.name);
        }
        return results;
      })();
    }
    ref = options.accept;
    for (j = 0, len = ref.length; j < len; j++) {
      card_type = ref[j];
      if (indexOf.call((function() {
        var k, len1, results;
        results = [];
        for (k = 0, len1 = card_types.length; k < len1; k++) {
          card = card_types[k];
          results.push(card.name);
        }
        return results;
      })(), card_type) < 0) {
        throw Error("Credit card type '" + card_type + "' is not supported");
      }
    }
    get_card_type = function(number) {
      var k, len1, r, ref1;
      ref1 = (function() {
        var l, len1, ref1, results;
        results = [];
        for (l = 0, len1 = card_types.length; l < len1; l++) {
          card = card_types[l];
          if (ref1 = card.name, indexOf.call(options.accept, ref1) >= 0) {
            results.push(card);
          }
        }
        return results;
      })();
      for (k = 0, len1 = ref1.length; k < len1; k++) {
        card_type = ref1[k];
        r = Range.rangeWithString(card_type.range);
        if (r.match(number)) {
          return card_type;
        }
      }
      return null;
    };
    is_valid_luhn = function(number) {
      var digit, k, len1, n, ref1, sum;
      sum = 0;
      ref1 = number.split('').reverse();
      for (n = k = 0, len1 = ref1.length; k < len1; n = ++k) {
        digit = ref1[n];
        digit = +digit;
        if (n % 2) {
          digit *= 2;
          if (digit < 10) {
            sum += digit;
          } else {
            sum += digit - 9;
          }
        } else {
          sum += digit;
        }
      }
      return sum % 10 === 0;
    };
    is_valid_length = function(number, card_type) {
      var ref1;
      return ref1 = number.length, indexOf.call(card_type.valid_length, ref1) >= 0;
    };
    validate_number = function(number) {
      var length_valid, luhn_valid;
      card_type = get_card_type(number);
      luhn_valid = is_valid_luhn(number);
      length_valid = false;
      if (card_type != null) {
        length_valid = is_valid_length(number, card_type);
      }
      return {
        card_type: card_type,
        valid: luhn_valid && length_valid,
        luhn_valid: luhn_valid,
        length_valid: length_valid
      };
    };
    validate = (function(_this) {
      return function() {
        var number;
        number = normalize($(_this).val());
        return validate_number(number);
      };
    })(this);
    normalize = function(number) {
      return number.replace(/[ -]/g, '');
    };
    if (!bind) {
      return validate();
    }
    this.on('input.jccv', (function(_this) {
      return function() {
        $(_this).off('keyup.jccv');
        return callback.call(_this, validate());
      };
    })(this));
    this.on('keyup.jccv', (function(_this) {
      return function() {
        return callback.call(_this, validate());
      };
    })(this));
    callback.call(this, validate());
    return this;
  };

  Trie = (function() {
    function Trie() {
      this.trie = {};
    }

    Trie.prototype.push = function(value) {
      var char, i, j, len, obj, ref, results;
      value = value.toString();
      obj = this.trie;
      ref = value.split('');
      results = [];
      for (i = j = 0, len = ref.length; j < len; i = ++j) {
        char = ref[i];
        if (obj[char] == null) {
          if (i === (value.length - 1)) {
            obj[char] = null;
          } else {
            obj[char] = {};
          }
        }
        results.push(obj = obj[char]);
      }
      return results;
    };

    Trie.prototype.find = function(value) {
      var char, i, j, len, obj, ref;
      value = value.toString();
      obj = this.trie;
      ref = value.split('');
      for (i = j = 0, len = ref.length; j < len; i = ++j) {
        char = ref[i];
        if (obj.hasOwnProperty(char)) {
          if (obj[char] === null) {
            return true;
          }
        } else {
          return false;
        }
        obj = obj[char];
      }
    };

    return Trie;

  })();

  Range = (function() {
    function Range(trie1) {
      this.trie = trie1;
      if (this.trie.constructor !== Trie) {
        throw Error('Range constructor requires a Trie parameter');
      }
    }

    Range.rangeWithString = function(ranges) {
      var j, k, len, n, r, range, ref, ref1, trie;
      if (typeof ranges !== 'string') {
        throw Error('rangeWithString requires a string parameter');
      }
      ranges = ranges.replace(/ /g, '');
      ranges = ranges.split(',');
      trie = new Trie;
      for (j = 0, len = ranges.length; j < len; j++) {
        range = ranges[j];
        if (r = range.match(/^(\d+)-(\d+)$/)) {
          for (n = k = ref = r[1], ref1 = r[2]; ref <= ref1 ? k <= ref1 : k >= ref1; n = ref <= ref1 ? ++k : --k) {
            trie.push(n);
          }
        } else if (range.match(/^\d+$/)) {
          trie.push(range);
        } else {
          throw Error("Invalid range '" + r + "'");
        }
      }
      return new Range(trie);
    };

    Range.prototype.match = function(number) {
      return this.trie.find(number);
    };

    return Range;

  })();

}).call(this);


// Banners
var bannerHeader = new Swiper(".header-banner", {
    effect: "fade",
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    }
});

var bannerHero = new Swiper(".hero", {
    loop: true,
    delay: 5000,
    autoplay: {
        delay: 7000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".hero .next",
        prevEl: ".hero .prev",
    },
});

// Mobile
var nav = document.querySelector('header nav');
var navIcon = document.querySelector('header span.navicon');
var closeIcon = document.querySelector('header .btn-mob-fechar');
if(navIcon) {
    navIcon.addEventListener('click', function(event) {
        nav.classList.add('on');
    });

    closeIcon.addEventListener('click', function(event) {
        nav.classList.remove('on');
    });
}



// Máscaras
	var SPMaskBehavior = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
		onKeyPress: function(val, e, field, options) {
			field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};

	$('.mask-data').mask('00/00/0000', {clearIfNotMatch: true});
    $('.mask-hora').mask('00:00:00', {clearIfNotMatch: true});
    $('.mask-cep').mask('00000-000', {clearIfNotMatch: true});
    $('.mask-cpf').mask('000.000.000-00', {clearIfNotMatch: true});
	$('.mask-card').mask('0000 0000 0000 0000', {clearIfNotMatch: true});
    $('.mask-cnpj').mask('00.000.000/0000-00', {clearIfNotMatch: true});
    $('.mask-tel').mask(SPMaskBehavior, spOptions, {clearIfNotMatch: true});
    $('.mask-preco').mask('000.000.000.000.000,00', {reverse: true});
    $('.mask-porcento').mask('##0,00', {reverse: true});
    $('.mask-medida').mask('##0,00', {reverse: true});
    $('.mask-peso').mask('##0.000', {reverse: true});
    $('.mask-nro').mask('00000000000000');








// Shopping Cart
var cartOpenIcon = document.querySelectorAll('[data-cart-open]');
var cartCloseIcon = document.querySelectorAll('[data-cart-close]');
var cartEl = document.querySelector('.s-shopping-cart');
var cartWrap = document.querySelector('.cart-wrap');




$(document).ready(function(){

    $('#cep').blur(function(){
        var valor = $('#cep').val();
        var len = valor.length;
        /* Configura a requisição AJAX */
        if(len >= 8 && len <= 9){
            $.ajax({
                url : '/includes/ajax/consultar_cep.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'cep=' + valor, /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.estado){
                        $('#rua').val(data.rua);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.cidade);
                        $('#estado').val(data.estado);
                        $('#numero').focus();
                        $('#cep').css({border:'1px solid #4fff4f'});
                    }else{
                        $('#cep').val('');
                        $('#cep').focus();
                        $('#cep').css({border:'1px solid #ff4f4f'});
                        $('#cepErro').fadeIn();
                    }
                }
            });      
        }else{
            $('#cep').val('');
            $('#cepErro').fadeIn();
            $('#lineCep').css({backgroundColor:'#f00'});
            $('#cep').focus();
        }
    });

    //if($('#nome').lenght()){
        $('#nome').focus(function(){
            $('#loga').animate({opacity:'0.4'});
        });
    //}

    $('#continuaCadastro').click(function(e){
        e.preventDefault();
        $('#loga').fadeOut();
        $('#cad1').animate({ width: "0"}, function(){
            $(this).fadeOut();
            $('#cad2 div').addClass('on');
            $('#cad2').fadeIn();
            $('#cad2').animate({width:'100%'});

        });

            
           

        
    });
    



    
// comprar
var btnComprar = document.querySelector('#comprar-btn');
if(btnComprar){
    btnComprar.addEventListener('click', function(event) {
        event.preventDefault();

        

        var produId = document.getElementById('produtos-carrinho').value;
        var produLoja = document.getElementById('loja-carrinho').value;
        var produQuantidade = document.getElementById('produtos-quantidade').value;
        var prodPreco = document.getElementById('prodPreco').value;
        var prodPrecoOriginal = document.getElementById('prodPrecoO').value;
        var carrinhoId = document.getElementById('carrinho-id').value;
        //alert("/includes/ajax/carrinho.php?carrinhoId="+carrinhoId+"&produto="+produId+"&loja="+produLoja+"&quantidade="+produQuantidade);


            $('#cart-wrap').load("/includes/ajax/carrinho.php?produtoPrecoOriginal="+prodPrecoOriginal+"&produtoPreco="+prodPreco+"&carrinhoId="+carrinhoId+"&produto="+produId+"&loja="+produLoja+"&quantidade="+produQuantidade, function(responseTxt, statusTxt, xhr){
                if(statusTxt == "success"){
                    //alert("External content loaded successfully!");
                    $('#cart-wrap').html(responseTxt);
                    $('#cartId').addClass('on');
                    cartWrap.classList.toggle('on');
                
                    console.log(responseTxt);
            }
                if(statusTxt == "error"){
                  alert("Error: " + xhr.status + ": " + xhr.statusText);
                }
              });
          
        

        
    });
}





 
    // checkout
    $('#cartaoNumero').validateCreditCard(function(result) {
        if (result.card_type == null && result.card_type.name != 'uatp') {
          $("#miniBand").attr('src', '/assets/images/card.png');
        } else {
          $("#miniBand").attr('src', '/assets/images/' + result.card_type.name + '.png');
        }
        if(result.card_type.name != 'card'){
          $('#brand').val((result.card_type == null ? '-' : result.card_type.name));
        }
        // + '<br>Valid: ' + result.valid
        //  + '<br>Length valid: ' + result.length_valid
        //   + '<br>Luhn valid: ' + result.luhn_valid);
            var card_holder = $('#card_holder').val();
            if(card_holder != '' && card_cvv != ''){
                if (result.length_valid && result.luhn_valid && result.valid && result.card_type) {
                    $('#cartaoNumero').attr('data-aprovado', 'sim');
                    $('#compraFinal').css({'cursor':'pointer', 'opacity' : '1'});
                    $('#compraFinal').removeAttr('disabled');
                } else {
                    $('#compraFinal').attr('disabled','disabled');
                    $('#cartaoNumero').attr('data-aprovado', 'nao');
                    $('#compraFinal').css({'cursor':'not-allowed', 'opacity' : '0.5'});
                
                }
            }
      });

      $("#cartaoNumero").mask("9999 9999 9999 9999", {placeholder: " ", autoclear: false});												
        var tgdeveloper = {
        getCardFlag: function(cardnumber) {
          var cardnumbers = cardnumbers.replace(/[^0-9]+/g, '');
          var cards = {
            VISA: /^4[0-9]{12}(?:[0-9]{3})/,
            Master: /^5[1-5][0-9]{14}/,
            DINERS: /^3(?:0[0-5]|[68][0-9])[0-9]{11}/,
            amex: /^3[47][0-9]{13}/,
            discover: /^6(?:011|5[0-9]{2})[0-9]{12}/,
            Hipercard: /^(606282\d{10}(\d{3})?)|(3841\d{15})/,
            Elo: /^((((636368)|(438935)|(504175)|(451416)|(636297))\d{0,10})|((5067)|(4576)|(4011))\d{0,12})/,
            JCB: /^(?:2131|1800|35\d{3})\d{11}/,
            Aura: /^(5078\d{2})(\d{2})(\d{11})$/
          };

          for (var flag in cards) {
            if (cards[flag].test(cardnumbers)) {
              return flag;
            }
          }
          return false;
        }

      };

      $('#cartaoNumero').keyup(function() {
        var numb = $(this).val();
        if (numb) {
          $('#brand').val(tgdeveloper.getCardFlag(numb));
        }
      });	
	  alert('asd');

});



// Products
var productImages = new Swiper('.product-images', {
    loop: true,
    autoplay: {
        delay: 6800,
        disableOnInteraction: false,
    }
});

var productSlider = new Swiper('.loja-categoria[data-slider="true"] .loja-produtos', {
    slidesPerView: 4,
	spaceBetween: 0,
	pagination: {
		el: ".swiper-pagination",
		clickable: true,
	},
});



// Open Cart
if(cartOpenIcon) {
    cartOpenIcon.forEach(open => {
        open.addEventListener('click', function(event) {
            // Do not follow link
            event.preventDefault();
    
            
            // Toggle Overlay
            //cartEl.classList.toggle('on');
            cartEl.classList.add('on');
            //alert(cartEl.className);
            setTimeout(function() {
                cartWrap.classList.add('on');
            }, 50);
        });
    });
}

// Close Cart
if(cartCloseIcon) {
    cartCloseIcon.forEach(close => {
        close.addEventListener('click', function(event) {
            // Do not follow link
            event.preventDefault();
    
            // Toggle Overlay
            cartWrap.classList.remove('on');
            setTimeout(function() {
                cartEl.classList.remove('on');
            }, 400);
        });
    });
}

// Delete Item from Cart
var cartItemDel = document.querySelectorAll('.cart-item-delete');

if(cartItemDel) {
    cartItemDel.forEach(itemDel => {
        itemDel.addEventListener('click', function(event) {
            

            var itemId = this.getAttribute('data-cart-item');
            var produId = this.getAttribute('data-cart-item-ean');
            //var cartItem = document.querySelector('.cart-item[data-cart-item="' + itemId + '"]');
            
            var carrinhoId = document.getElementById('carrinho-id').value;
            //alert('ad'+carrinhoId);
            
            // Remove Item
            
            $('#reload').load("/includes/ajax/deletaCarrinho.php?carrinhoId="+carrinhoId+"&produto="+produId, function(responseTxt, statusTxt, xhr){
               //alert('ad'+responseTxt);
                if(statusTxt == "success"){
                    //alert("External content loaded successfully!");
                    $('#cart-wrap').html(responseTxt);
                    //$('#cartId').addClass('on');
                    //cartWrap.classList.toggle('on');
                   // cartItem.remove();
                   // alert('ad');
                    //console.log(responseTxt);
                }
                if(statusTxt == "error"){
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
                }
            });
         
        });
    });
}


// Checkout Payments
var paymentTypes = document.querySelectorAll('.checkout-payment');
if(paymentTypes) {
    paymentTypes.forEach(payments => {
        payments.addEventListener('click', function(event) {
            // Clear All Radios
            document.querySelectorAll('.checkout-payment').forEach(r => {
                r.classList.remove('on');
            });

            // Check this
            this.classList.add('on');
        });
    });
}

// Custom Radio
var customRadios = document.querySelectorAll('.custom-radio');

if(customRadios) {
    customRadios.forEach(radio => {
        radio.addEventListener('click', function(event) {
            // Clear All Radios
            document.querySelectorAll('.custom-radio').forEach(r => {
                r.classList.remove('radio-on');
            });

            // Check this
            radio.classList.toggle('radio-on');
        });
    });
}

// Frete
var freteField = document.querySelector('.shipping-simulation input[name="cep"]');
var freteBtn = document.querySelector('.shipping-simulation input[name="ok"]');
var freteResult = document.querySelector('.shipping-result');
if(freteField && freteBtn) {
    freteBtn.addEventListener('click', function(event) {
        if(freteField.value != '') {
            freteResult.classList.add('result-ok');
        }
    });
}

// Checkout
var btnNextStep = document.querySelectorAll('.btn-step[data-next-step]');
if(btnNextStep) {
	btnNextStep.forEach(btn => {
		btn.addEventListener('click', (event) => {
			
			// Next Step
			var nextStep = btn.getAttribute('data-next-step');
			
			// Step
			document.querySelector('.checkout-steps span.on').classList.remove('on');
			document.querySelector('.checkout-steps span[data-step="'+ nextStep +'"]').classList.add('on');

			document.querySelector('.checkout-step.on').classList.remove('on');
			document.querySelector('.checkout-step[data-step="'+ nextStep +'"]').classList.add('on');

		});
	});
}

var btnStep = document.querySelectorAll('.checkout-steps span[data-step]');
if(btnStep) {
	btnStep.forEach(btn => {
		btn.addEventListener('click', (event) => {
			
			// Next Step
			var currentStep = document.querySelector('.checkout-steps span.on').getAttribute('data-step');
			var nextStep = btn.getAttribute('data-step');

			if(currentStep > nextStep) {
				// Step
				document.querySelector('.checkout-steps span.on').classList.remove('on');
				document.querySelector('.checkout-steps span[data-step="'+ nextStep +'"]').classList.add('on');

				document.querySelector('.checkout-step.on').classList.remove('on');
				document.querySelector('.checkout-step[data-step="'+ nextStep +'"]').classList.add('on');
			}

		});
	});
}












// Header Scroll
var header = document.querySelector('header');
var headerHeight = header.offsetHeight;
var scrollWindow = function() {
    var y = window.scrollY;
    var windowWidth = window.innerWidth;

    if(windowWidth > 768) {
        if (y >= 360) {
            header.classList.add('fixed');

            if(document.querySelector('.hero')) {
                document.querySelector('.hero').style.marginTop = headerHeight+'px';
            }
            if(document.querySelector('main')) {
                document.querySelector('main').style.marginTop = headerHeight+'px';
            }
        } else {
            header.classList.remove('fixed');
            
            if(document.querySelector('.hero')) {
                document.querySelector('.hero').style.marginTop = 0;
            }
            if(document.querySelector('main')) {
                document.querySelector('main').style.marginTop = 0;
            }
        }
    }
};
window.addEventListener("scroll", scrollWindow);

