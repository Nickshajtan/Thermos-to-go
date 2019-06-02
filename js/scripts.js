    function getTimeRemaining(endtime) {
      var t = Date.parse(endtime) - Date.parse(new Date());
      var seconds = Math.floor((t / 1000) % 60);
      var minutes = Math.floor((t / 1000 / 60) % 60);
      var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
      var days = Math.floor(t / (1000 * 60 * 60 * 24));
      return {
        total: t,
        days: days,
        hours: hours,
        minutes: minutes,
        seconds: seconds
      };
    }

    function initializeClock(id, endtime) {
      var clock = document.getElementById(id);
      var daysSpan = clock.querySelector(".days");
      var hoursSpan = clock.querySelector(".hours");
      var minutesSpan = clock.querySelector(".minutes");
      var secondsSpan = clock.querySelector(".seconds");

      function updateClock() {
        var t = getTimeRemaining(endtime);

        if (t.total <= 0) {
          document.getElementById("clockdiv").className = "hidden";
          document.getElementById("deadline-messadge").className = "visible";
          clearInterval(timeinterval);
          return true;
        }

        daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ("0" + t.hours).slice(-2);
        minutesSpan.innerHTML = ("0" + t.minutes).slice(-2);
        secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);
      }

      updateClock();
      var timeinterval = setInterval(updateClock, 1000);
    }
jQuery(document).ready(function($) {
    width = $(window).width();
    height = $(window).height();
    //Links
    $('#main__button').wrap("<a href='#products' class='menu'></a>");
   /* $("header ul").on("click","a", function (event) {
		event.preventDefault();
		var id  = $(this).attr('href'),
			top = $(id).offset().top;
		$('body,html').animate({scrollTop: top}, 1500);
	});;*/
    $("body").on("click","a.menu", function (event) {
		event.preventDefault();
		var id  = $(this).attr('href'),
			top = $(id).offset().top;
		$('body,html').animate({scrollTop: top}, 1500);
	});
    //mobile menu
    if (width <= 760) {
        $('.burger').on('click', function(){
            $('header').toggleClass('open');
            $('header ul').toggleClass('d-block');
            $('.overlay').toggleClass('d-block');
        });
        $(document).mouseup(function (e){ 
        var div = $('header.open');
            if (!div.is(e.target)&& div.has(e.target).length === 0) {
                $('.overlay').removeClass('d-block');
                $('header ul').removeClass('d-block');
                $('header').removeClass('open');
            }
        });
    }
    //modal close
    $(document).on('click', '.modal .value .close', function(){
       $('.modal').hide();
       $('.modal').removeClass('show');
       $('.overlay').removeClass('d-block');
    });
    //woocommerce
    $('#single__product a').on('click', function(){
        event.preventDefault();
    });
    //Cart
    $('#cart').mouseover(function () {
          $('.widget_cart').addClass('open'); 
        /*, function () {
          $('#cart').data('timer', setTimeout(function () {
            $('.widget_cart').removeClass('open'); 
          }, 200));*/
    });
    $('.widget_cart').mouseover(function(){
        $(this).addClass('open'); 
    });
    $('.widget_cart').mouseout(function(event){
        $(this).removeClass('open'); 
    });
});
//Ajax
jQuery(document).ready(function($) {

var url = wnm_custom.template_url;
var home_url = wnm_custom.url
var ajaxurl = home_url + '/wp-admin/admin-ajax.php';

$("form.submit").submit(function (e){
        e.preventDefault();
        var name = $(this).find('input#name').val();
        var phone =   $(this).find('input#tel').val();
        var spamFirst = $(this).find('textarea[name=comment]').val();
        var spamSecond = $(this).find('textarea[name=message]').val();
        $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'ajax_order',
                    name: name,
                    phone: phone,
                    spamFirst: spamFirst,
                    spamSecond: spamSecond
                },
                error: (function() {
                    $('.modal .value').html('Пожалуйста, проверьте правильность заполнение полей');
                    $('.modal .value').append('<span class="close">x</span>');
                }),
                beforeSend: (function (){
                    $('#loader').css({
                        display: 'block'
                    });
                    $('.overlay').addClass('d-block');
                }),
                complete: (function (){
                    $('#loader').css({
                        display: 'none'
                    });
                })
            }).done(function (data) {
                $('input#name').val('')
                $('input#tel').val('');
                $('.overlay').addClass('d-block');
                $('.modal .value').html('Благодарим за Ваше сообщение');
                $('.modal .value').append('<span class="close">x</span>');
                $('.modal').fadeIn( 100 ).addClass('show');
                $(document).mouseup(function (e){ 
                        var div = $('.modal.show .value');
                        if (!div.is(e.target)&& div.has(e.target).length === 0) {
                            $('.overlay').removeClass('d-block');
                            $('.modal').hide();
                            $('.modal').removeClass('show');
                        }
                });    
        });
        return false;
    });
});