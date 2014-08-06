$ = jQuery.noConflict();

$(document).ready(function($){

    //Hide Contact Error
    jQuery('#contact-error').hide();

    //Add clearfix class to category list widget
    $('.widget_categories li').addClass('clearfix');
    $('.widget_archive li').addClass('clearfix');


    // Navigation
    $("ul.dropdown-menu").prev().addClass('dropdown-toggle');
    $("ul.dropdown-menu").prev().addClass('disabled');
    $("ul.dropdown-menu").prev().attr('data-toggle','dropdown');
    $(".menu-item-has-children").addClass('dropdown');

    // Add class to parent menu item li and icon on link
    var menu_link_item = $('.menu-item > a');
    menu_link_item.wrapInner( "<strong></strong>" );

    menu_link_item.each(function(){
        var menu_item_title = $(this).attr('title');
        if(menu_item_title !== undefined){ $(this).append('<small>'+menu_item_title+'</small>'); }
    });


    // Navbar toggle

    var body = $('body'),
        navbarTrigger = $('.navbar-trigger'),
        navbar = $('.navbar');
        headerFixed = $('.main-header.fixed');
        closeNavbar = $('.close-navbar');

    navbarTrigger.click(function(e){
        e.preventDefault();
        body.toggleClass('navbar-active');
        navbar.toggleClass('navbar-active');
    });

    closeNavbar.click(function(e){
        e.preventDefault();
        body.removeClass('navbar-active');
        navbar.removeClass('navbar-active');
    });


    // Header on scroll

    var headerFixed = $('.main-header.fixed');

    var lastScrollTop = 0;
    $(window).scroll(function(event){
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            headerFixed.removeClass('active');
        } else {
            headerFixed.addClass('active');
        }
        lastScrollTop = st;
    });

    $(window).scroll(function(){
        if($(document).scrollTop() > 216){
            headerFixed.show();
        }
        else {
            headerFixed.slideUp(200);
        }
    });

    // Header search

    var searchTrigger = $('.search-trigger'),
        searchForm = $('.header-right form');

    searchTrigger.click(function(e){
        e.preventDefault();
        searchForm.toggleClass('active');
    });

    // Header right vertical align

    var rightHeader = $('main-header verticalize-container .header-right');
    var rightHeaderHeight = $('main-header verticalize-container .header-right').outerHeight();

    rightHeader.css('margin-top', - rightHeaderHeight / 2);

    // Isotope

    var $container = $('.grid-wrapper').isotope({
        animationEngine: 'best-available',
        layoutMode: 'sloppyMasonry',
        itemSelector : '.grid-wrapper .post',
        sortBy : 'original-order'
    });

    $container.imagesLoaded( function() {
        $container.isotope('reLayout');
    });

     // Widget li arrow

     var widgetListItem = $('.widget li'),
         listArrow = $('<i class="icon-arrow"></i>')

     widgetListItem.prepend(listArrow);

     // Post navigation on single

     $('.post-nav.block a.disabled').siblings('a').css('width', '100%');


     //Add classes to menu

     var menu_list      = $('.navbar-collapse > div > ul');
     var page_menu_item = $('.navbar-default li.page_item'); 
     var menu_link      = $('.navbar-default .page_item a');
     var dropdown_link  = $('.navbar-default .page_item_has_children > a');
     var dropdown_list  = $('.navbar-default .page_item_has_children > ul');

     dropdown_list.addClass('dropdown-menu');

     dropdown_link.addClass('dropdown-toggle');
     dropdown_link.attr('data-toggle',  'dropdown');
     menu_link.wrapInner('<strong></strong>');

     if(page_menu_item.hasClass('page_item_has_children')){
        page_menu_item.addClass('dropdown');
     }

     if(menu_list.hasClass('navbar-nav')){}
     else{ menu_list.addClass('nav navbar-nav'); }




}); // End Document Ready

$(window).load(function(){

    // Preloader

    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({'overflow':'visible'});

}); // End Window Load



////////////////////
//  CONTACT FORM  //
////////////////////
function check_field(field,alerttxt,checktext){
    with(field){
        var checkfalse = 0;
        if(field.value == ""){
            jQuery('#contact-error').show();
            jQuery('#contact-error').empty().append(alerttxt);
            field.focus();
            checkfalse=1;
        }

        if(field.value==checktext){
            jQuery('#contact-error').show();
            jQuery('#contact-error').empty().append(alerttxt);
            field.focus();
            checkfalse=1;
        }

        if(checkfalse==1){
            return false;
        }else{
            return true;
        }
    }
}

function validate_email(field,alerttxt){
    with (field)
    {
        apos=value.indexOf("@");
        dotpos=value.lastIndexOf(".");
        if (apos<1||dotpos-apos<2)
        {
            jQuery('#contact-error').show();
            jQuery('#contact-error').empty().append(alerttxt);
            return false;
        }
        else {
            return true;
        }
    }
}

function checkForm(thisform){
    with (thisform){
        var error = 0;

        var contactmessage = document.getElementById('contactmessage');
        if(check_field(contactmessage, js_variables.message_error_message, "Message")==false){
            error = 1;
        }

        var email = document.getElementById('contactemail');
        if(validate_email(email,js_variables.email_error_message, 'E-mail')==false){
            email.focus();
            error = 1;
        }

        var contactname = document.getElementById('contactname');
        if(check_field(contactname, js_variables.name_error_message, "Name")==false){
            error = 1;
        }

        if(error == 0){
            var contactname = document.getElementById('contactname').value;
            var email = document.getElementById('contactemail').value;
            var contactmessage = document.getElementById('contactmessage').value;

            return true;
        }
        return false;
    }
}