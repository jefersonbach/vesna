// Banners
var bannerHeader = new Swiper(".header-banner", {
    effect: "fade",
    loop: true,
});

var bannerHero = new Swiper(".hero", {
    loop: true,
    autoplay: {
        delay: 2500,
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
        nav.classList.toggle('on');
    });

    closeIcon.addEventListener('click', function(event) {
        nav.classList.remove('on');
    });
}

// Header Scroll
/*
var scrollWindow = function() {
    var y = window.scrollY;
    if (y >= 10) {
        nav.classList.add('overflow');
    } else {
        nav.classList.remove('overflow');
    }
};
window.addEventListener("scroll", scrollWindow);
*/

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

// Shopping Cart
var cartOpenIcon = document.querySelectorAll('[data-cart-open]');
var cartCloseIcon = document.querySelectorAll('[data-cart-close]');
var cartEl = document.querySelector('.s-shopping-cart');
var cartWrap = document.querySelector('.cart-wrap');

// Open Cart
if(cartOpenIcon) {
    cartOpenIcon.forEach(open => {
        open.addEventListener('click', function(event) {
            // Do not follow link
            event.preventDefault();
    
            // Toggle Overlay
            cartEl.classList.toggle('on');
            setTimeout(function() {
                cartWrap.classList.toggle('on');
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
            var cartItem = document.querySelector('.cart-item[data-cart-item="' + itemId + '"]');

            // Remove Item
            cartItem.remove();

            // Execute Ajax
            // ...
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