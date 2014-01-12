/**
 * We use the initCallback callback
 * to assign functionality to the controls
 */
function mycarousel_initCallback(carousel) {
    jQuery('#mycarousel-next').bind('click', function() {
        carousel.next();
        return false;
    });

    jQuery('#mycarousel-prev').bind('click', function() {
        carousel.prev();
        return false;
    });
}

jQuery(document).ready(function($) {

    $("#hide").click(function() {
        $(".menu-overlay").slideUp();
    });

    $("#menu-icon").click(function() {
        $(".menu-overlay").slideDown();
    });

    var $container = $('#thumbs');
    var imgLoad = imagesLoaded('#thumbs');

    imgLoad.on('always', function(instance) {
        // initialize
        $container.masonry({
            columnWidth: 219,
            gutter: 20,
            itemSelector: '.post'
        });

        var msnry = $container.data('masonry');
    });

    $('#menu-main-menu').jcarousel({
        scroll: 1,
        initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
        buttonNextHTML: null,
        buttonPrevHTML: null
    });

});