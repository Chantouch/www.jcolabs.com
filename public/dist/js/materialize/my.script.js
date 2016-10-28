$(document).on('resize, ready', function () {
    // Add class if screen size equals
    var $window = $(window),
        $html = $('html');

    function resize() {
        $html.removeClass('xs sm md lg');
        if ($window.width() < 768) {
            return $html.addClass('xs');
        }
        else if ($window.width() > 768 && $window.width() < 992) {
            return $html.addClass('sm');
        }
        else if ($window.width() > 992 && $window.width() < 1200) {
            return $html.addClass('md');
        }
        else if ($window.width() > 1200) {
            return $html.addClass('lg');
        }
    }

    $window.resize(resize).trigger('resize');
});