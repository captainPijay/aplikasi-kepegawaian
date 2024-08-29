$('.form-select, .form-control').change(function () {
    if ($(this).val() !== '' && $(this).val() !== null) {
        $(this).removeClass('is-invalid');
    } else {
        $(this).addClass('is-invalid');
    }
});

$('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function () {
    $(this).removeClass('input-error');
});

$('.f1 .btn-next').on('click', function () {
    var parent_fieldset = $(this).parents('fieldset');
    var next_step = true;
    var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    const form_elm = document.getElementById('form_layanan');

    $(parent_fieldset).find('input[type="text"], input[type="number"], input[type="file"], input[type="date"], textarea, select').each(function () {
        if ($(this).val() == "" || $(this).val() == null) {
            $(this).addClass('is-invalid');
            next_step = false;
        }
        else {
            $(this).removeClass('is-invalid');
        }
    });

    if (next_step) {
        parent_fieldset.fadeOut(400, function () {
            if (parent_fieldset.data("step") == 1) {
                $('.f1-progress-2').css('background', '#ed716b');
            }
            current_active_step.removeClass('active').addClass('activated').next().addClass('active');
            parent_fieldset.css('display', 'none');
            parent_fieldset.next().css('display', 'block');
            window.scrollTo({
                top: form_elm.offsetTop,
                behavior: 'smooth'
            });
        });
    }
});

$('.f1 .btn-previous').on('click', function () {
    var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    const form_elm = document.getElementById('form_layanan');

    $(this).parents('fieldset').fadeOut(400, function () {
        if ($(this).data("step") == 2) {
            $('.f1-progress-2').css('background', '#EBEBEB');
        }
        current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
        $(this).css('display', 'none');
        $(this).prev().css('display', 'block');
        window.scrollTo({
            top: form_elm.offsetTop,
            behavior: 'smooth'
        });
    });
});