jQuery(document).ready(function ($) {
	// Tabs section
	$(function () {
		var $accordion, $wideScreen;
		$accordion = $('#accordion').children('li');
		$wideScreen = $(window).width() > 767;
		if ($wideScreen) {
			$accordion.on('mouseenter click mouseleave', function (e) {
				var $this;
				e.stopPropagation();
				$this = $(this);
				if ($this.hasClass('out')) {
					$this.addClass('out');
				} else {
					$this.addClass('out');
					$this.siblings().removeClass('out');
				}
			});
			$accordion.on('mouseleave', function (e) {
				var $this;
				e.stopPropagation();
				$this = $(this);
				if ($("li").hasClass('out')) {
					$("li").removeClass('out');
				}
			});
		} else {
			$accordion.on('touchstart touchend', function (e) {
				var $this;
				e.stopPropagation();
				$this = $(this);
				if ($this.hasClass('out')) {

				} else {
					$this.addClass('out');
					$this.siblings().removeClass('out');
				}
			});
		}
		$(".tab_toogle").on('click', function (e) {
			$("#accordion>li").removeClass('out');
		});
	});



	// Открытие панели поиска
	$(".search_icon").click(function () {
		$(this).toggleClass("close");
		$(".search_block").toggleClass("open");
		if ($(window).width() >= '899') {
			$(".tabs").toggleClass("open");
		};
		$(".menu_icon").removeClass("close");
		$(".menu_block").removeClass("open");
		$(".subs_icon").removeClass("subs_icon_open");
		$(".subs_block").removeClass("open");
	});
	// Открытие меню и закрытие остальных блоков
	$(".menu_icon").click(function () {
		$(this).toggleClass("close");
		$(".menu_block").toggleClass("open");
		$(".tabs").removeClass("open");
		$(".search_icon").removeClass("close");
		$(".search_block").removeClass("open");
		$(".subs_icon").removeClass("subs_icon_open");
		$(".subs_block").removeClass("open");
	});
	// Форма подписки
	$(".subs_icon").click(function () {
		$(this).toggleClass("subs_icon_open");
		$(".subs_block").toggleClass("open");

		$(".search_icon").removeClass("close");
		$(".search_block").removeClass("open");
		$(".menu_icon").removeClass("close");
		$(".menu_block").removeClass("open");
	});
	$(".subs_form_close").click(function () {
		$(".subs_block").toggleClass("open");
		$(".subs_icon").toggleClass("subs_icon_open");
	});
	// Добавление класса для меню
	$("ul#primary-menu>li ").click(function () {
		$('ul#primary-menu>li').removeClass('current_item');
		$(this).toggleClass("current_item");
	});

	$("li.menu-item-has-children").click(function () {
		if ($(".sub-menu").css('display') == 'none') {
			$(".sub-menu").css("display", "flex");
		} else {
			$(".sub-menu").css("display", "none");
		}
	});
	// Развернуть блок контента
	$(".image_wraper").click(function () {
		if ($(".article_content_wraper").hasClass("open")) {
			$(".article_content_wraper").removeClass("open");
			$(".article_content_wraper").css({ transition: 'all 1s ease-in-out 0s', width: '70%' });
		} else {
			$(".article_content_wraper").addClass("open");
			$(".article_content_wraper").css({ transition: 'all 1s ease-in-out 0s', width: '99%' });
		}
	});

	$(".article_content_wraper").resizable({
		handleSelector: ".article_btn",
		resizeHeight: false,
		resizeWidthFrom: 'left',
	});

	$(".article_content_wraper").mouseleave(function () {
		var artwidth = parseInt($(".article_content_wraper").css("width"));
		$.cookie('art_width', artwidth);
	});

	// Search on ajax 
	var searchTerm = '';

	$('.search-input').keydown(function () {
		searchTerm = $.trim($(this).val());
	});
	$('.search-input').keyup(function () {
		if ($.trim($(this).val()) != searchTerm) { // Если новое значение не равно старому, идем дальше
			searchTerm = $.trim($(this).val());
			if (searchTerm.length > 2) { // Если введено больше 2-х символов, идем дальше
				$.ajax({
					url: '/wp-admin/admin-ajax.php', // Ссылка на AJAX обработчик WP
					type: 'POST', // Отправляем данные методом POST
					data: {
						'action': 'ba_ajax_search', // Вызываемое действие, которое мы описали в functions.php
						'term': searchTerm // Отправляемые данные поля ввода
					},
					beforeSend: function () { // Перед отправкой данных
						$('.result-search .result-search-list').fadeOut(); // Скроем блок результатов
						$('.result-search .result-search-list').empty(); // Очистим блок результатов
					},
					success: function (result) { // После выполнения поиска
						$('.result-search .result-search-list').fadeIn().html(result); // Покажем блок результатов и добавим в него полученные данные
					}
				});
			}
		}
	});

	$('.search-input').focusin(function () {
		$('.result-search').fadeIn();
	})
	// Скрыть выдачу при клике вне поля ввода
	// $(document).click(function (e) {
	// 	if ((!$('.result-search').is(e.target) && $('.result-search').has(e.target).length === 0) && (!$('.search-input').is(e.target) && $('.search-input').has(e.target).length === 0)) {
	// 		$('.result-search').fadeOut();
	// 	}
	// });


	// Font size change
	let fontSize;
	let color_mode;
	$('.font_increase').click(function () {
		$(".article_content_wraper").css({ transition: 'all 1s ease-in-out 0s', width: '99%' });
		$('.entry-content').css("font-size", function () {
			if ($(this).css("font-size") < "26px") {
				fontSize = parseInt($(this).css("font-size")) + 2 + "px";
				$.cookie('mysite_font_size', fontSize);
				return fontSize;
			}
		});
	});

	$('.font_decrease').click(function () {
		$('.entry-content').css("font-size", function () {
			if ($(this).css("font-size") > "10px") {
				fontSize = parseInt($(this).css("font-size")) + -2 + "px";
				$.cookie('mysite_font_size', fontSize);
				return fontSize;
			}
		});
	});

	// Dark / Light mode
	$('.color_toogle').click(function () {
		$('.article_content_wraper').toggleClass("white");
		color_mode = $('.article_content_wraper').hasClass("white");
		$.cookie('mysite_color', color_mode);
	});

	// Cookies
	$(function () {
		if ($.cookie('mysite_font_size') == null) { }
		else {
			$('.entry-content').css("font-size", $.cookie('mysite_font_size'));
		}
		if ($.cookie('mysite_color') == null) { }
		if ($.cookie('mysite_color') == "false") {
			$('.article_content_wraper').toggleClass("white");
		}
		if ($.cookie('art_width') == null) { }
		else {
			$(".article_content_wraper").css("width", $.cookie('art_width'));
		}
	});

	$(function () {
		var doc = $(document),
			fixed = false,
			anchor = doc.find('article');
		var onScroll = function (e) {
			var docTop = doc.scrollTop(),
				anchorTop = anchor.offset().top;
			if (docTop > anchorTop) {
				if (!fixed) {
					$("article h1").addClass('fixed');
					$(".logo").addClass('fixed');
					$(".article_content_wraper").addClass("open");
					$(".article_content_wraper").css({ transition: 'all 1s ease-in-out 0s', width: '99%' });
					fixed = true;
				}
			} else {
				if (fixed) {
					$("article h1").removeClass('fixed');
					$(".logo").removeClass('fixed');
					$(".article_content_wraper").css({ transition: 'all 1s ease-in-out 1s', width: '70%' });
					fixed = false;
				}
			}
		};
		$(".article_content").on('scroll', onScroll);

	});
	$(".tooltip_time").on('hover click', function () {
		var $this = $(this).parents('.tooltips');
		if ($(".time_descr").hasClass('show')) {
			$(".time_descr").fadeOut().removeClass('show');
			$(".tooltip_items").removeClass('border_tooltips');
			$(".tooltip_descr").removeClass('border_tooltips');
		} else {
			$(".tooltip_items").addClass('border_tooltips');
			$(".tooltip_descr").addClass('border_tooltips');
			$this.find(".time_descr").fadeIn().css("display", "flex").addClass("show");
			$(".price_descr").removeClass('show').css("display", "none");
			$(".loc_descr").removeClass('show').css("display", "none");
		}
	});

	$(".tooltip_price").on('hover click', function () {
		var $this = $(this).parents('.tooltips');
		if ($(".price_descr").hasClass('show')) {
			$(".price_descr").fadeOut().removeClass('show');
			$(".tooltip_items").removeClass('border_tooltips');
			$(".tooltip_descr").removeClass('border_tooltips');
		} else {
			$(".tooltip_items").addClass('border_tooltips');
			$(".tooltip_descr").addClass('border_tooltips');
			$this.find(".price_descr").fadeIn().css("display", "flex").addClass("show");
			$(".time_descr").removeClass('show').css("display", "none");
			$(".loc_descr").removeClass('show').css("display", "none");
		}
	});

	$(".tooltip_loc").on('hover click', function () {
		var $this = $(this).parents('.tooltips');
		if ($(".loc_descr").hasClass('show')) {
			$(".loc_descr").fadeOut().removeClass('show');
			$(".tooltip_items").removeClass('border_tooltips');
			$(".tooltip_descr").removeClass('border_tooltips');
		} else {
			$(".tooltip_items").addClass('border_tooltips');
			$(".tooltip_descr").addClass('border_tooltips');
			$this.find(".loc_descr").fadeIn().css("display", "flex").addClass("show");
			$(".time_descr").removeClass('show').css("display", "none");
			$(".price_descr").removeClass('show').css("display", "none");
		}
	});

	var elem2 = document.getElementById("lottie2");
	var animData2 = {
		container: elem2,
		renderer: 'svg',
		loop: true,
		autoplay: true,
		rendererSettings: {
			progressiveLoad: true,
			preserveAspectRatio: "xMidYMid meet",
			imagePreserveAspectRatio: "xMidYMid meet"
		},
		path: '/wp-content/themes/lacan/img/Glass_Shape_Animation.json'
	};
	anim2 = lottie.loadAnimation(animData2);
	anim2.addEventListener("DOMLoaded", function () {
		$("#lottie2").css("background", "url()");
		console.log("lottie loaded");
	});

	$(function () {
		const form = document.querySelector(".sorting_form");
		if (form) {
		const select = document.querySelector(".sorting_select");
		$(".sort_list").on("change", function () {
			$(".sort_list").not(this).prop("checked", false);
		});
		
			select.addEventListener("change", function () { 
				form.submit(); 
			});
		}
	});

	$(".more_post").on("click", function () {
		$("#redirectForm").submit(); 
	});

});