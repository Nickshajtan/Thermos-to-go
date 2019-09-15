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
      var daysText = clock.querySelector(".days-text");
      var hoursSpan = clock.querySelector(".hours");
      var hoursText = clock.querySelector(".hours-text");
      var minutesSpan = clock.querySelector(".minutes");
      var minutesText = clock.querySelector(".minute-text");
      var secondsSpan = clock.querySelector(".seconds");
      var secondsText = clock.querySelector(".second-text");

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
        var minute = t.minutes;
        if( minute == 1 || minute == 21 || minute == 31 || minute == 41 || minute == 51 ){
            minutesText.innerHTML="Минута";
        }
        else if( minute == 2 || minute == 3 || minute == 4 || minute == 22 || minute == 23 || minute == 24 || minute == 32 || minute == 33 || minute == 34 || minute == 42 || minute == 43 || minute == 44 || minute == 52 || minute == 53 || minute == 54 ){
            minutesText.innerHTML='Минуты'; 
        }
        else{
            minutesText.innerHTML='Минут';  
        }
        minutesSpan.innerHTML = ("0" + t.minutes).slice(-2);
        //secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);
      }

      updateClock();
      var timeinterval = setInterval(updateClock, 1000);
    }
jQuery(document).ready(function($) {
    width = $(window).width();
    height = $(window).height();
    //Slider
    if( width > 1024 && $('div').is('.rev_slider_wrapper') ){
        var slider = $('.rev_slider_wrapper');
        slider.on('click', '.tp-leftarrow', function(e){
            e.stopPropagation();
            revapi1.revprev();
        });
        slider.on('click', '.tp-rightarrow', function(e){
            e.stopPropagation();
            revapi1.revnext();
        });
        slider.on('click', function(e){
            e.preventDefault();
            function sliderLink(){
                var slide = slider.find('li[data-title="Slide"]');
                $('#main__button').unwrap('a.menu');
                if( slide.is('[data-link]') && slide.hasClass('active-revslide') ){
                        var productLink = slider.find('li.active-revslide').attr('data-link');
                        $('#main__button').wrap("<a href='" + productLink + "'></a>");
                        window.location.href = productLink;
                }
                else if( slide.is(':not[data-link]') && slide.hasClass('active-revslide') ){
                        $('#main__button').wrap("<a href='#products' class='menu'></a>");
                }
            }
            var timerId = setInterval(sliderLink(), 1000);  
        });
    }
    //Links
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
    //Reviews
    if($("div").is(".reviews")){
        var div = $('.reviews .white__block');
        var showChar = 50;
        var ellipsestext = "...";
        var moretext = "Подробнее";
        var lesstext = "Скрыть";
        $(div).each(function() {
            var content = $(this).find('.one__rewiew__text').html();
            if(content.length > showChar) {
                var c = content.substr(0, showChar);
                var h = content.substr(showChar-1, content.length - showChar);
                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<span class="morelink box-button">' + moretext + '</span></span>';
                $(this).find('.one__rewiew__text').html(html);
            }
        });
        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    };
	//Actions
	if($("div").is(".actions")){
		var img = $('.box a.progressive img');
		var href = $('.action__link').attr('href');
		img.css({'cursor': 'pointer'});
		img.on('click', function(){
			window.location.href = href;
		});
	}
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