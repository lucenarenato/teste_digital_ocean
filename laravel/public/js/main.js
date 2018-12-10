// ==========  DROPDOWN SENSIVEL AO HOVER =============
// $('ul.nav li.dropdown').hover(function() {
//   $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
// }, function() {
//   $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
// });

// ==========  galeria de produtos =============
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails",
    prevText: "",
    nextText: ""
  });
});


// ==========  menu-interno =============

if ($(window).width() < 768) {
    $('.menu-apoio ul').addClass('selectdropdown');
} else {
    $('.menu-apoio ul').removeClass('selectdropdown');
}

$('ul.selectdropdown').each(function() {
    var list = $(this), select = $(document.createElement('select')).insertBefore($(this).hide());

    $('>li a', this).each(function() {
        var target = $(this).attr('target'),
        option = $(document.createElement('option'))
            .appendTo(select)
            .val(this.href)
            .html($(this).html())
            .click(function(){
                if(target==='_blank') {
                    window.open($(this).val());
                }
                else {
                    window.location.href = $(this).val();
                }
            });
    });
    list.remove();
});

$(function(){
      // bind change event to select
      $('.menu-apoio select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });


// ==========  CAROUSEL GERAL =============
$("#carousel-home .carousel-inner .item:first").addClass("active");
$("#galeria-estrutura .carousel-inner .item:first").addClass("active");
$("#galeria .carousel-inner .item:first").addClass("active");


// ==========  BUSCA =============
$('.abre-busca').click(function(){
      $('.busca').toggleClass('move');
  });

// ==========  ROLAGEM DA ANCORA =============
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});


// ==========  PARA VIDEO =============
jQuery(".modal-backdrop, #modal-video .close, #modal-video .btn").live("click", function() {
        jQuery("#modal-video iframe").attr("src", jQuery("#modal-video iframe").attr("src"));
});


// ==========  ESCONDE MENU NO SCROLL =============
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}

$(function() {
    $('#pais').on('change', function() {
        $('#result').html('<div class="loading"></div>');
        $('.element').attr("class", "element");
        if(this.value != 'brasil') {
          $('#estados').hide();
          $('#estados').html('<option selected="selected" disabled="disabled">Estado</option>');
          $('#'+this.value).attr("class", "element elactve");
          $.ajax({
              type: 'GET',
              url: 'http://equiplex.com.br/?page_id=204&slug='+this.value,
              success: function(msg) {
                  $('#result').html(msg);
              }
          });
        } else {
          $('#estados').html('<option selected="selected" disabled="disabled">Estado</option><option value="acre">Acre</option><option value="alagoas">Alagoas</option><option value="amapa">Amapá</option><option value="amazonas">Amazonas</option><option value="bahia">Bahia</option><option value="ceara">Ceará</option><option value="distrito-federal">Distrito Federal</option><option value="espirito-santo">Espírito Santo</option><option value="goias">Goiás</option><option value="maranhao">Maranhão</option><option value="mato-grosso">Mato Grosso</option><option value="mato-grosso-do-sul">Mato Grosso do Sul</option><option value="minas-gerais">Minas Gerais</option><option value="para">Pará</option><option value="paraiba">Paraíba</option><option value="parana">Paraná</option><option value="pernambuco">Pernambuco</option><option value="piaui">Piauí</option><option value="rio-de-janeiro">Rio de Janeiro</option><option value="rio-grande-do-norte">Rio Grande do Norte</option><option value="rio-grande-do-sul">Rio Grande do Sul</option><option value="rondonia">Rondônia</option><option value="roraima">Roraima</option><option value="santa-catarina">Santa Catarina</option><option value="sao-paulo">São Paulo</option><option value="sergipe">Sergipe</option><option value="tocantins">Tocantins</option>');
          $('#estados').show();
          $('#result').html('');
        }
    });

    $('.element').on('click', function() {
        $('#result').html('<div class="loading"></div>');
        var att = $(this).data("value");
        var pais = $(this).data("pais");
        $('.element').attr("class", "element");
        $(this).attr("class", "element elactve");
        //$('#'+att).attr("class", "elactve");
        if(pais != 'brasil') {
          $('#estados').hide();
          $('#estados').html('<option selected="selected" disabled="disabled">Estado</option>');
          $('#pais').val(att);
          $.ajax({
              type: 'GET',
              url: 'http://equiplex.com.br/?page_id=204&slug='+att,
              success: function(msg) {
                  $('#result').html(msg);
              }
          });
        } else {
          $('#pais').val('brasil');
          $('#estados').html('<option selected="selected" disabled="disabled">Estado</option><option value="acre">Acre</option><option value="alagoas">Alagoas</option><option value="amapa">Amapá</option><option value="amazonas">Amazonas</option><option value="bahia">Bahia</option><option value="ceara">Ceará</option><option value="distrito-federal">Distrito Federal</option><option value="espirito-santo">Espírito Santo</option><option value="goias">Goiás</option><option value="maranhao">Maranhão</option><option value="mato-grosso">Mato Grosso</option><option value="mato-grosso-do-sul">Mato Grosso do Sul</option><option value="minas-gerais">Minas Gerais</option><option value="para">Pará</option><option value="paraiba">Paraíba</option><option value="parana">Paraná</option><option value="pernambuco">Pernambuco</option><option value="piaui">Piauí</option><option value="rio-de-janeiro">Rio de Janeiro</option><option value="rio-grande-do-norte">Rio Grande do Norte</option><option value="rio-grande-do-sul">Rio Grande do Sul</option><option value="rondonia">Rondônia</option><option value="roraima">Roraima</option><option value="santa-catarina">Santa Catarina</option><option value="sao-paulo">São Paulo</option><option value="sergipe">Sergipe</option><option value="tocantins">Tocantins</option>');
          $('#estados').show();
          $('#estados').val(att);
          $.ajax({
              type: 'GET',
              url: 'http://equiplex.com.br/?page_id=204&slug='+att,
              success: function(msg) {
                  $('#result').html(msg);
              }
          });
        }
    });

    $('#estados').on('change', function() {
        $('#result').html('<div class="loading"></div>');
        $('.element').attr("class", "element");
        $('#'+this.value).attr("class", "element elactve");
        $.ajax({
            type: 'GET',
            url: 'http://equiplex.com.br/?page_id=204&slug='+this.value,
            success: function(msg) {
                $('#result').html(msg);
            }
        });
    });
});