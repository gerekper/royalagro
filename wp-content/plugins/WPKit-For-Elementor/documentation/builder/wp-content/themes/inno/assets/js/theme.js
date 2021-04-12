/**
 * Scripts for the theme.
 * @since 1.0.0
 */

(function($){
	"use strict";
	var TMV_Theme = window.TMV_Theme || {};
	window.TMV_Theme = TMV_Theme;

	/* Basic */
	TMV_Theme.basic = function(){
	    /* Sidebar  */
		$('.site-sidebar').niceScroll();
		
		if($(window).width() > 767){
	    	$('#secondary').css('height',$('#page').height());
		}

		/*Masonry*/	
		$('#grid').imagesLoaded(function() {
		      $('#grid').masonry({
		        itemSelector: '.post',
		        gutter: 0
		      });
		});

		/* Apply the post format to the comment content elements */
		$('.comment-content').addClass('entry-content');
    }

	/* Custom Page Style */
	TMV_Theme.page_customized_system = function(){
	    var top_links = $('#masthead:not(.tmv-sticky-top) .main-navigation a,.mini-menu,#masthead:not(.tmv-sticky-top) #site-icons a,#masthead:not(.tmv-sticky-top) .site-branding a,.menu-toggle i');
	    if(typeof tmv_page_config !== 'undefined'){
	    	if(tmv_page_config.trans_nav == '1'){
	    		$('body').addClass('transparent-header');
	    	}
		    $(top_links).css('color', tmv_page_config.menu_text_color);
		    top_links.hover(function(){
		    	 $(this).css('color', tmv_page_config.menu_text_hover_color);
		    },function(){
		    	 $(this).css('color', tmv_page_config.menu_text_color);
		    });
		    $('.main-navigation ul ul li a').css('color','#000');
		    $('.main-navigation ul ul li a').hover(function(){
		    	$(this).css('color','#999');
		    },function(){
		    	$(this).css('color','#000');
		    });
		    $('.site-bottom').css({
		    	backgroundColor: tmv_page_config.bottom_bg_color,
		    	color: tmv_page_config.bottom_text_color,
		    	borderColor: 'rgba(255,255,255,.08)'
		    });
		    $('.site-bottom p,.site-bottom h1,.site-bottom h2,.site-bottom h3,.site-bottom h4,.site-bottom h5,.site-bottom h6,.site-bottom blockquote').css({
		    	color: tmv_page_config.bottom_text_color
		    });
		    $('.site-bottom a').css({
		    	color: tmv_page_config.bottom_link_color
		    });
		    $('.site-bottom a').hover(function(){
		    	$(this).css('color', tmv_page_config.bottom_link_hover_color);
		    },function(){
		    	$(this).css('color', tmv_page_config.bottom_link_color);
		    });
		    $('.site-footer').css({
		    	backgroundColor: tmv_page_config.footer_bg_color,
		    	color: tmv_page_config.footer_text_color
		    });
		    $('.site-footer p,.site-footer h1,.site-footer h2,.site-footer h3,.site-footer h4,.site-footer h5,.site-footer h6,.site-footer blockquote').css({
		    	color: tmv_page_config.footer_text_color
		    });
		    $('.site-footer a').css('color', tmv_page_config.footer_link_color);
		    $('.site-footer a').hover(function(){
		    	$(this).css('color', tmv_page_config.footer_link_hover_color);
		    },function(){
		    	$(this).css('color', tmv_page_config.footer_link_color);
		    });

		    if(tmv_page_config.hide_logo == '1' && $('.tmv-col10').length > 0){
		    	$('#site-navigation').removeClass('tmv-col10').addClass('tmv-col9');
		    }
		    if(tmv_page_config.hide_logo == '1' && $('.tmv-col7').length > 0){
		    	$('#site-navigation').removeClass('tmv-col7').addClass('tmv-col9');
		    }

		    $('#tmv-page-header').css({
		    	color: tmv_page_config.page_header_text_color,
		    	backgroundColor: tmv_page_config.page_header_bg_color,
		    });
		    if(tmv_page_config.page_header_height == 'custom'){
			    $('#tmv-page-header').css({
			    	height:tmv_page_config.page_header_custom_height+'px',
			    });
		    }
		    if(tmv_page_config.page_header_bg_picture !=='' && tmv_page_config.page_header_bg_picture !== null){
			    $('#tmv-page-header').css({
			   	    backgroundImage: 'url('+tmv_page_config.page_header_bg_picture+')',
			    	backgroundPosition: tmv_page_config.page_header_bg_picture_position,
			    	backgroundAttachment: tmv_page_config.page_header_bg_picture_scrollable,
			    	backgroundRepeat: tmv_page_config.page_header_bg_picture_repeat,
			    	backgroundSize:  tmv_page_config.page_header_bg_picture_size,
			    });
		    }
		    $('#tmv-page-header a').css({
		    	color:tmv_page_config.page_header_link_color,
		    });
		    $('#tmv-page-header a').hover(function(){
		    	$(this).css('color', tmv_page_config.page_header_link_hover_color);
		    },function(){
		    	$(this).css('color', tmv_page_config.page_header_link_color);
		    });
	    }
	}

	/** 
	 * Smart Header
	 * documentation: http://wicky.nillia.ms/headroom.js/ 
	 */
	TMV_Theme.header_system = function() {
		if(typeof tmv_global_config !== 'undefined' && tmv_global_config.sticky_top !== '1'){
			var header = document.querySelector("#masthead");

		    if(window.location.hash) {
		      header.classList.add("tmv-smart-header-unpinned");
		    }

		    var headroom = new Headroom(header, {
		        tolerance: {
		          down : 10,
		          up : 20
		        },
		        offset : 205,
		        // css classes to apply
			    classes : {
			       "initial": "tmv-smart-top",
				    "pinned": "tmv-smart-top-pinned",
				    "unpinned": "tmv-smart-top-unpinned",
			        // when above offset
			        top : "tmv-smart-header-top",
			        // when below offset
			        notTop : "tmv-smart-header-not-top",
			        // when at bottom of scoll area
			        bottom : "tmv-smart-header-bottom",
			        // when not at bottom of scroll area
			        notBottom : "tmv-smart-header-not-bottom"
			    },
		    });
		    if($('#masthead').length > 0){
		    	headroom.init();
			}
	    }

	    var default_logo =  $('#site-logo').attr('src');

		$(window).on('scroll',function(){
	        /*Sticky Top*/
	        if($(document).scrollTop() >= 400){
	         
	          if($(window).width()<=600){
	             $('#masthead.tmv-sticky-top').css('top','0');
		      }
		     
		      $('.main-navigation a, #site-icons a,.mini-menu,.site-branding a,.menu-toggle').removeAttr('style');
		      
		      if(typeof tmv_global_config !== 'undefined' && tmv_global_config.sticky_top == '1'){
		         $('#masthead').addClass('tmv-sticky-top');
		      }

		      $('#site-logo').attr('src', $('#site-logo').attr('data-logo'));

			}else{
			 
			  $('#masthead').removeClass('tmv-sticky-top');
			  $('#masthead').removeClass('tmv-smart-top-pinned');
			  $('#site-logo').attr('src', default_logo);
			  
			  if(typeof tmv_page_config !== 'undefined'){
			     $('.main-navigation ul li a,#site-icons a,.mini-menu, .site-branding a,.menu-toggle').css('color',tmv_page_config.menu_text_color);
			  }

			  $('.main-navigation ul ul li a').css('color','#000');
			}
		});
    }

    TMV_Theme.ajax_search = function(){
    	$('#search_button').on('click',function(e) {
    		 e.preventDefault();
    		 var post_type = $('#search_type').val();
             var keyword = $('#search_input').val();
             $('#tmv_search_result').empty();
             $('.animsition-loading').fadeIn();

             if (typeof keyword !== 'undefined' && keyword !== '') {
             	  $.ajax ({
                    url: tmv_data.ajax_url,
                    type:'POST',
                    data:{
		                action:'tmv_ajax_search', 
		                keyword: keyword,
		                post_type: post_type
		            },
                    success:function(results) {
                    	$('#tmv_search').addClass('shrink');
                    	 $('.animsition-loading').fadeOut();
                        $('#tmv_search_result').append(results).delay(300).fadeIn();
                        TMV_Theme.resizeWooCommerceWrapper();
                    }
                });
             }
    	});
    }

	/* Page Transition Effect */
	TMV_Theme.page_transition = function(){
		var targetLinks = $('a:not([target="_blank"]):not([href^="#"]):not([href*="javascript:"]):not([href^="javascript:void(0);"]):not([href^=""])');
		targetLinks.addClass('smooth');

	    if(!$('body').hasClass('elementor-editor-active')){
		    $('.smooth-transition').animsition({
			    inClass: 'fade-in',
			    outClass: 'fade-out',
			    inDuration: 500,
			    outDuration: 300,
			    linkElement: '.smooth',
			    // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
			    loading: true,
			    loadingParentElement: 'body', //animsition wrapper element
			    loadingClass: 'animsition-loading',
			    loadingInner: '', // e.g '<img src="loading.svg" />'
			    timeout: false,
			    timeoutCountdown: 5000,
			    onLoadEvent: true,
			    browser: [ 'animation-duration', '-webkit-animation-duration'],
			    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
			    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
			    overlay : false,
			    overlayClass : 'animsition-overlay-slide',
			    overlayParentElement : 'body',
			    transition: function(url){ window.location.href = url; }
			});

			$(window).bind("pageshow", function(event) {
		      if (event.originalEvent.persisted) {
		          window.location.reload()
		      }
		    }); 
	    }
    }

	TMV_Theme.menu_system = function(){
		/* Mobile menu toggle */
		$('#mobile_menu .menu-item-has-children').addClass('pushy-submenu');
		
		$('.pushy .menu-item-has-children > a').each(function(){
			$(this).after('<a href="javascript:void(0);" class="open-submenu"><i class="ion-ios-plus-empty"></i></a>');
		});
		
		$('.menu-toggle').on('click',function(){
			$('#close-menu').css('display','block');
		});
		
	    $('.pushy ul li a.open-submenu').toggle(function(){
		  $(this).next().slideDown();
		  $(this).children('i').removeClass('ion-ios-plus-empty').addClass('ion-ios-minus-empty');
	    },function(){
		  $(this).next().slideUp();
		  $(this).children('i').removeClass('ion-ios-minus-empty').addClass('ion-ios-plus-empty');
	    });
    }
	
	/*Popup*/
    TMV_Theme.popup_system = function(){
	    function popup(button,obj,status){
		   $(button).on('click',function(){
		      if(status=='open'){
				   $('#tmv_popup').animate({left:'0'},800,'easeInOutExpo',function(){
				   	  $(obj).show();
				      $('#s').focus();
				      $('#tmv_popup_close').show();
				   });
			  }else{  
				   $(obj).fadeOut();
				   $('#tmv_popup_close').hide();
				   $('#tmv_popup').animate({left:'-100%'},800,'easeInExpo');
			  }
		   });
	    }
	    popup('.search_button','#tmv_popup_search','open');
	    popup('#tmv_popup_close','#tmv_popup_search','close');
	    popup('.menu_button','#tmv_popup_menu','open');
	    popup('.menu-toggle','#tmv_popup_menu','open');
	    popup('#tmv_popup_close','#tmv_popup_menu','close');
	    popup('.shopping-cart','#tmv_popup_cart','open');
	    popup('#tmv_popup_close','#tmv_popup_cart','close');
	    popup('.book_list_button','#tmv_popup_books','open');
	    popup('#tmv_popup_close','#tmv_popup_books','close');

	    $('#tmv_popup').niceScroll();

	    $('#tmv_popup .menu-item-has-children').each(function(index,value){
	    	var id = $(this).prop('id');
	    	$(this).prepend('<input type="checkbox" id="toggle-'+id+'" /><label for="toggle-'+id+'">+</label>');
	    });
	}

	/* Portfolio System */
	TMV_Theme.portfolio_system = function(){

		function load_portfolio_item(){
			$('.tmv-grid-item').each(function(){
			    $(this).css('height',$(this).find('img').height());
			    $(this).children('.text-desc').css({
			       width: $(this).width(),
			       height: $(this).height()+10
			    });
			});

			$('.tmvc_portfolios_grid.masonry').each(function(){
			    $(this).css('height',$(this).find('img').height());
			    $(this).children('.tmvc_portfolios_thumbnail').css({
			       width: $(this).width(),
			       height: $(this).height()
			    });
			});

			/* Masonry */
		    var opts = {
			      itemSelector: '.type-tmvc_portfolio',
			      gutter: 20,
			      percentPosition: true,
			      transitionDuration: 0
			}
			var $grid =  $('.tmv-portfolio-grid.masonry').masonry(opts);       

			/* Position and show image as it loads */
			$('.tmv-portfolio-grid').imagesLoaded().progress(function(imgLoadData, elem ){
			      $(elem.img).closest('.type-tmvc_portfolio').css('opacity', 1);
			      $grid.masonry('layout');
			});
		}

		$(window).load(function(){
			load_portfolio_item();
		});
		$(window).resize(function(){
			load_portfolio_item();
		});
  }

  TMV_Theme.swiper_slider = function(){
  			  
  			  var autoHeight = false;
  			  
  			  if(typeof $('.tmv-swiper-slider').data('auto-height') !=='undefined' && $('.tmv-swiper-slider').data('auto-height')=='auto-height'){
  			  	  autoHeight = true;
  			  }

		      /* Swipe Slider */
		      $('.tmv-swiper-slider').each(function(){
			      var galleryTop = new Swiper($(this).find('.gallery-top'), {
			        nextButton: '.swiper-button-next',
			        prevButton: '.swiper-button-prev',
			        autoHeight: autoHeight
			      });
			     
			      var galleryThumbs = new Swiper($(this).find('.gallery-thumbs'), {
	      		    touchRatio: 0.2,
			        slidesPerView: 'auto',
			        grabCursor: true,
			        spaceBetween: 5,
			        centeredSlides: true,
			        slideToClickedSlide: true,
			        nextButton: '.swiper-button-next',
			        prevButton: '.swiper-button-prev'
			      });

			      if($(this).find('.gallery-thumbs').length > 0){
			         galleryTop.params.control = galleryThumbs;
	    			 galleryThumbs.params.control = galleryTop;

			      }
		      });
		      
  }

  TMV_Theme.OnePageScroll = function(){
  	var titles = [];
  	var slugs = [];
  	$('#slideshow-page .slideshow-section').each(function(){
  		 titles.push($(this).data('title'));
  		 slugs.push($(this).data('slug'));
  	});
  	$('#slideshow-page').fullpage({
		//Navigation
		menu: '#tmv-slideshow-menu',
		lockAnchors: false,
		anchors: slugs,
		navigation: true,
		navigationPosition: 'right',
		navigationTooltips: titles,
		
		scrollBar: false,
		css3: true,
		easing: 'easeInOutCubic',
		easingcss3: 'ease',
		loopBottom: false,
		loopTop: false,
		loopHorizontal: true,
		continuousVertical: false,
		continuousHorizontal: false,
		scrollHorizontally: false,
		interlockedSlides: false,
		dragAndMove: true,
		offsetSections: false,
		resetSliders: false,
		fadingEffect: false,
		normalScrollElements: '',
		scrollOverflow: false,
		scrollOverflowReset: false,
		scrollOverflowOptions: null,
		touchSensitivity: 15,
		normalScrollElementTouchThreshold: 5,
		bigSectionsDestination: null,

		//Accessibility
		keyboardScrolling: true,
		animateAnchor: true,
		recordHistory: true,

		//Design
		controlArrows: true,
		verticalCentered: true,
		sectionsColor : [],
		paddingTop: '0',
		paddingBottom: '0',
		fixedElements: '',
		responsiveWidth: 0,
		responsiveHeight: 0,
		responsiveSlides: false,
		parallax: true,
		parallaxOptions: {type: 'reveal', percentage: 62, property: 'translate'},

		//Custom selectors
		sectionSelector: '.slideshow-section',
		slideSelector: '.slide',

		lazyLoading: true,

		//events
		onLeave: function(index, nextIndex, direction){
			$('.slideshow-section:nth-child('+nextIndex+')').find('.animated').each(function(){
				  var animate_effect = $(this).data('settings')._animation;
				  $(this).removeClass(animate_effect).addClass('elementor-invisible');
			});

			
		},
		afterLoad: function(anchorLink, index){
			$('.slideshow-section:nth-child('+index+')').find('.animated').each(function(){
				  var animate_effect = $(this).data('settings')._animation;
				  $(this).removeClass('elementor-invisible').addClass(animate_effect);
			});

			var currentSection = $('.slideshow-section:nth-child('+index+')');
			if(currentSection.data('transparent-header') == '1'){
	    		$('body').addClass('transparent-header');
	    	}

	    	if(currentSection.data('hide-page-logo')=='1'){
	    		$('.site-branding').hide();
	    	}

	    	if(typeof currentSection.data('logo') !== 'undefined' && currentSection.data('logo') !== ''){
	    		$('.site-branding img').attr('src', currentSection.data('logo'));
	    	}

	    	var top_links = $('#masthead:not(.tmv-sticky-top) .main-navigation a,.mini-menu,#masthead:not(.tmv-sticky-top) #site-icons a,#masthead:not(.tmv-sticky-top) .site-branding a,.menu-toggle i');
		    
		    $(top_links).css('color', currentSection.data('menu-text-color'));
		    
		    top_links.hover(function(){
		    	 $(this).css('color', currentSection.data('menu-text-hover-color'));
		    },function(){
		    	 $(this).css('color', currentSection.data('menu-text-color'));
		    });
		    $('.main-navigation ul ul li a').css('color','#000');
		    $('.main-navigation ul ul li a').hover(function(){
		    	$(this).css('color','#999');
		    },function(){
		    	$(this).css('color','#000');
		    });
		},
		afterRender: function(){},
		afterResize: function(){},
		afterResponsive: function(isResponsive){},
		afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){

		},
		onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex){}
	});
  }
  
  TMV_Theme.media_player = function(){
  	  /* Media player setup */
	  plyr.setup();
	     
	     (function(d, p){
	      var a = new XMLHttpRequest(),
	          b = d.body;
	      a.open('GET', p, true);
	      a.send();
	      a.onload = function() {
	          var c = d.createElement('div');
	          c.setAttribute('hidden', '');
	          c.innerHTML = a.responseText;
	          b.insertBefore(c, b.childNodes[0]);
	      };
	  })(document, tmv_data.plyr_svg);
  }

  /* Modal System */
  TMV_Theme.modal_system = function(){
  	   /* Ajax load */
	   function ajaxload(id,url,object) { 
		    $.ajax({ 
		      type: "get", 
		      url: url, 
		      cache: false, 
		      error: function() {(id).html('Loading error!');}, 
		      success: function(data) { 
		        $('.animsition-loading').remove();
		        $(id).append($(data).find(object).html());
		        TMV_Theme.swiper_slider();
		        TMV_Theme.audio_player();
		      }
		    }); 
		}
  	  $('.tmvc_preview').each(function(){
	       var modal = $("#tmv-modal");
	       var url =  $(this).attr('data-url');
	       var type = $(this).attr('data-type');
	       $(this).on('click',function(){
	         modal.addClass(type);
	         modal.append('<div class="animsition-loading"></div>');
	         modal.fadeIn();
			 ajaxload('.tmv-preview',url,'.tmv-preview');
	       });
	  });

	  $('#tmv-module-close').on('click',function(){
	       $('#tmv-modal').fadeOut();
	       $('.tmv-preview').empty();
	       $('#tmv-modal').removeAttr('class');
	  });
  }

  TMV_Theme.ajaxComment = function(){
  	 
  	 /* Ajax Submit Comment
  	  * @reference https://rudrastyh.com/wordpress/ajax-comments.html 
  	  */

  	 jQuery.extend(jQuery.fn, {
		/*
		 * check if field value lenth more than 3 symbols ( for name and comment ) 
		 */
		validate: function () {
			if (jQuery(this).val().length < 3) {jQuery(this).addClass('error');return false} else {jQuery(this).removeClass('error');return true}
		},
		/*
		 * check if email is correct
		 * add to your CSS the styles of .error field, for example border-color:red;
		 */
		validateEmail: function () {
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
			    emailToValidate = jQuery(this).val();
			if (!emailReg.test( emailToValidate ) || emailToValidate == "") {
				jQuery(this).addClass('error');return false
			} else {
				jQuery(this).removeClass('error');return true
			}
		},
	 });

  	 $('#commentform').submit(function() {
         // define some vars
		var button = $('#submit'), // submit button
		    respond = $('#respond'), // comment form container
		    commentlist = $('.comment-list'), // comment list container
		    cancelreplylink = $('#cancel-comment-reply-link');
 
		// if user is logged in, do not validate author and email fields
		if( $( '#author' ).length )
			$( '#author' ).validate();
 
		if( $( '#email' ).length )
			$( '#email' ).validateEmail();
 
		// validate comment in any case
		$( '#comment' ).validate();
 
		// if comment form isn't in process, submit it
		if ( !button.hasClass( 'loadingform' ) && !$( '#author' ).hasClass( 'error' ) && !$( '#email' ).hasClass( 'error' ) && !$( '#comment' ).hasClass( 'error' ) ){
 
			// ajax request
			$.ajax({
				type : 'POST',
				url : tmv_data.ajax_url, // admin-ajax.php URL
				data: $(this).serialize() + '&action=ajaxcomments', // send form data + action parameter
				beforeSend: function(xhr){
					// what to do just after the form has been submitted
					button.addClass('loadingform').val(tmv_data.submiting_text);
				},
				error: function (request, status, error) {
					if( status == 500 ){
						alert( 'Error while adding comment' );
					} else if( status == 'timeout' ){
						alert('Error: Server doesn\'t respond.');
					} else {
						// process WordPress errors
						var wpErrorHtml = request.responseText.split("<p>"),
							wpErrorStr = wpErrorHtml[1].split("</p>");
 
						alert( wpErrorStr[0] );
					}
				},
				success: function ( addedCommentHTML ) {
 
					// if this post already has comments
					if( commentlist.length > 0 ){
 
						// if in reply to another comment
						if( respond.parent().hasClass( 'comment' ) ){
 
							// if the other replies exist
							if( respond.parent().children( '.children' ).length ){	
								respond.parent().children( '.children' ).append( addedCommentHTML );
							} else {
								// if no replies, add <ol class="children">
								addedCommentHTML = '<ol class="children">' + addedCommentHTML + '</ol>';
								respond.parent().append( addedCommentHTML );
							}
							// close respond form
							cancelreplylink.trigger("click");
						} else {
							// simple comment
							commentlist.append( addedCommentHTML );
						}
					}else{
						// if no comments yet
						addedCommentHTML = '<ol class="comment-list">' + addedCommentHTML + '</ol>';
						respond.before( $(addedCommentHTML) );
					}
					// clear textarea field
					$('#comment').val('');
				},
				complete: function(){
					// what to do after a comment has been added
					button.removeClass( 'loadingform' ).val( 'Post Comment' );
				}
			});
		}
		return false;
     });
  }

  /* Init */
  TMV_Theme.init = function() {
	  TMV_Theme.basic();
	  TMV_Theme.page_customized_system();
	  TMV_Theme.header_system();
	  TMV_Theme.OnePageScroll();
	  TMV_Theme.ajax_search();
	  TMV_Theme.page_transition();
	  TMV_Theme.menu_system();
	  TMV_Theme.popup_system();
	  TMV_Theme.swiper_slider();
	  TMV_Theme.media_player();
	  TMV_Theme.portfolio_system();
	  TMV_Theme.modal_system();
	  TMV_Theme.ajaxComment();
  }

  TMV_Theme.init();

})(jQuery);