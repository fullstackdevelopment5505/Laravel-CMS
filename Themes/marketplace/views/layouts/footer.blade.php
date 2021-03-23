<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-3 footer_logo">
                 <img src="<?php echo asset('/').'public'?>/{{$logo}}" alt="logo">
            </div>
            <div class="col-md-8 col-sm-9 footer_rights">
                <ul>
                    @foreach($pages as $page)
                        <li><a href="/page/{{$page['page_slug']}}">{{$page['page_title']}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ themes('js/owl.carousel.min.js') }}"></script>
<script>
    (function ($) {
        "use strict";

        $(function () {
            var header = $(".start-style");
            $(window).scroll(function () {
                var scroll = $(window).scrollTop();

                if (scroll >= 10) {
                    header.removeClass('start-style').addClass("scroll-on");
                } else {
                    header.removeClass("scroll-on").addClass('start-style');
                }
            });
        });

        //Animation

        $(document).ready(function () {
            $('body.hero-anime').removeClass('hero-anime');
        });

        //Menu On Hover

        $('body').on('mouseenter mouseleave', '.nav-item', function (e) {
            if ($(window).width() > 750) {
                var _d = $(e.target).closest('.nav-item'); _d.addClass('show');
                setTimeout(function () {
                    _d[_d.is(':hover') ? 'addClass' : 'removeClass']('show');
                }, 1);
            }
        });

    })(jQuery);  
</script>
<!-- //Header Script -->

<!-- Awesome Theme -->
<script>
    jQuery(document).ready(function ($) {
        "use strict";
        //  TESTIMONIALS CAROUSEL HOOK
        $('#customers-testimonials').owlCarousel({
            loop: true,
            center: true,
            items: 3,
            margin: 0,
            autoplay: true,
            dots: true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        });
    });
</script>
<!-- //Awesome Theme -->

<!-- Testi Theme -->
<script>
    jQuery(document).ready(function ($) {
        "use strict";
        //  TESTIMONIALS CAROUSEL HOOK
        $('#aweseme').owlCarousel({
            loop: true,
            center: true,
            items: 3,
            margin: 0,
            autoplay: true,
            dots: true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        });
    });
</script>
<!-- //Testi Theme -->
<!-- Animation -->
<script>
    // Trigger CSS animations on scroll.
    // Detailed explanation can be found at http://www.bram.us/2013/11/20/scroll-animations/

    // Looking for a version that also reverses the animation when
    // elements scroll below the fold again?
    // --> Check https://codepen.io/bramus/pen/vKpjNP

    jQuery(function ($) {

        // Function which adds the 'animated' class to any '.animatable' in view
        var doAnimations = function () {

            // Calc current offset and get all animatables
            var offset = $(window).scrollTop() + $(window).height(),
                $animatables = $('.animatable');

            // Unbind scroll handler if we have no animatables
            if ($animatables.length == 0) {
                $(window).off('scroll', doAnimations);
            }

            // Check all animatables and animate them if necessary
            $animatables.each(function (i) {
                var $animatable = $(this);
                if (($animatable.offset().top + $animatable.height() - 20) < offset) {
                    $animatable.removeClass('animatable').addClass('animated');
                }
            });

        };

        // Hook doAnimations on scroll, and trigger a scroll
        $(window).on('scroll', doAnimations);
        $(window).trigger('scroll');

    });
</script>