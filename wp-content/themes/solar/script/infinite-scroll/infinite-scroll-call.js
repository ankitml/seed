$ = jQuery.noConflict();

$(document).ready(function(){
    $('.pagination').show();

    var $container = $('.grid-wrapper').isotope({
        animationEngine: 'best-available',
        layoutMode: 'sloppyMasonry',
        itemSelector : '.grid-wrapper .post',
        sortBy : 'original-order'
    });

    $container.imagesLoaded( function() {
        $container.isotope('reLayout');
    });

    var loadingImg = ajax_var.url+'/theme-images/spinner.gif';

    //Grid Infinite Scroll
    $('.grid-wrapper').infinitescroll({
        navSelector  : '.pagination',    // selector for the paged navigation
        nextSelector : '.pagination .next',  // selector for the NEXT link (to page 2)
        itemSelector : '.post',     // selector for all items you'll retrieve
        bufferPx     : -100,
        loading: {
            finishedMsg: 'No more posts to load.',
            msgText: '',
            selector: '#loading-is',
            img: loadingImg
        }
    },
        // call Isotope as a callback
        function( newElements ) {
            var $newElems = $( newElements ).hide();
            $newElems.imagesLoaded( function() {
                $newElems.fadeIn(); // fade in when ready
                $container.isotope( 'appended', $newElems );
                $('.pagination').show();
            });

        }
    );


    //Index Blog Infinite Scroll
    $('.post-load').infinitescroll({
        navSelector  : '.pagination',    // selector for the paged navigation
        nextSelector : '.pagination .next',  // selector for the NEXT link (to page 2)
        itemSelector : '.post',     // selector for all items you'll retrieve
        bufferPx     : -100,
        loading: {
            finishedMsg: 'No more posts to load.',
            msgText: '',
            selector: '#loading-is',
            img: loadingImg
        }
    },

        // call Isotope as a callback
        function( newElements ) {
            var $newElems = $( newElements ).hide();
            $newElems.imagesLoaded( function() {
                $newElems.fadeIn(); // fade in when ready
                $('.pagination').show();
            });

        }
    );
    
    //Onclick InfiniteScroll
    $(window).unbind('.infscr');

    $(".next").click(function(){
        $('.grid-wrapper').infinitescroll('retrieve');
        $('.post-load').infinitescroll('retrieve');
        return false;
    });

});