$(document).ready(function () {
    $('.tabs').tabs();
    $('.count-chars').characterCounter();
    $('select').material_select();
    $('.carousel').carousel();
    $('.carousel.carousel-slider').carousel({full_width: true});
    $('.collapsible').collapsible({accordion: false});
    $('.dropdown-button').dropdown({
        belowOrigin: true,
        gutter: 3
    });
    $('.materialboxed').materialbox();
    $('.slider').slider({full_width: true});
    $('.modal-trigger').leanModal({
        dismissible: true,
        opacity: .5
    });
    $('.parallax').parallax();
    $('.scrollspy').scrollSpy();
    $('.button-collapse').sideNav();
    $('.chips').material_chip();
    $('input, textarea').characterCounter();
    $('#post_image').on('change', function () {
        if (typeof (FileReader) != "undefined"){
            var post_image_preview = $('#post_image_preview');
            post_image_preview.empty();

            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />",{
                    "src": e.target.result,
                    "class": "responsive-img"
                }).appendTo(post_image_preview);
            }

            post_image_preview.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            console.log("Este browser não suporta FileReader, atualize para um navegador mais recente");
            alert("Este browser não suporta FileReader, atualize para um navegador mais recente");
        }
    });
    $('#post_cancel, .modal-close').click(function () {
        $('#post_body').replaceWith($('#post_body').val('').clone(true));
        $('#post_image').replaceWith($('#post_image').val('').clone(true));
        $('#post_image_preview').empty();
    });
});
