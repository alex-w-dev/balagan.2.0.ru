$(function () {

    /* открыть\ закрыть меню мобильное */
    $('.js-toggle-mobile-menu').click(function () {
        $('.js-mobile-menu').toggle();
    })

    /* кнопка показать  все какправило */
    $('.js-toggle').click(function () {
        var $selector = $(this).attr('data-selector');
        if ($(this).hasClass('showAll')) {
            $(this).text(($(this).attr('data-old-text') || 'Смотреть все'));
            $(this).removeClass('showAll')
            $($selector).hide();
        } else {
            $(this).attr('data-old-text', $(this).text());
            $(this).text('Скрыть');
            $(this).addClass('showAll');
            $($selector).show();
        }
        return false
    });

    /* popup */
    $('.js-close-popup').click(function () {
        closePopup($(this).closest('.js-popup'));
        return false
    });

    $('.js-open-popup').click(function () {
        openPopup($($(this).attr('data-selector')));
        return false
    });

    /* other */
    function onlyFloat($el){
        var reg = /^-?\d+\.?\d*$/;
        var v = $el.val();
        if (!v){
            $el.val('')
        }else if (!reg.test(v)){
            $el.val(($el.data('lastVal') || ''))
            return
        }else{
            $el.val(v)
        }
        $el.data('lastVal', (v));
    }
    $('.js-only-float').keyup(function () {
        onlyFloat($(this))
    }).focusout(function () {
        onlyFloat($(this))
    })

    /* СТАВИМ ГЛАЗ НА ПАРОЛИ */
    $('.js-password').each(function(){
        $parent = $(this).parent();
        $parent.addClass('relative');
        $icon = $('<div />', {
            'class': 'js-password-icon'
        }).appendTo($parent);
        $icon.click(function () {
            if($(this).hasClass('active')){
                $parent.find('input').attr('type', 'password');
                $(this).removeClass('active');
            }else{
                $parent.find('input').attr('type', 'text');
                $(this).addClass('active');
            }
        })
    })
})

/*GLOBALS  */


function closePopup(selector){
    if( typeof selector == 'string'){
        selector = $(selector);
    }
    selector.hide();
}
function openPopup(selector){
    if( typeof selector == 'string'){
        selector = $(selector);
    }
    selector.show();
}