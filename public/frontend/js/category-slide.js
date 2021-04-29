$(document).ready(function() {
    $('.responsivecat').slick({

       //dots: true,
        infinite: true,
        speed: 300,
        arrows:true,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsivecat: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
                // centerMode: true,

            }
        }, {
            breakpoint: 800,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2,
                infinite: true,

            }
        }, {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
                infinite: true,

            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
            }
        }, {
            breakpoint: 320,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
            }
        }]
    });

    $('.category-slide .show-more-link').on('click', function() {
      $(this).next().css('display', 'block');
    });


    $('.category-slide .close-cat').on('click', function() {
      $(this).parent().css('display', 'none');
    });

  });
