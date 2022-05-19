jQuery(document).ready(function ($) {

    var add_small_form = $('#small_form');

    // Сброс значений полей
    $('#small_form input').on('blur', function () {
        $('#small_form input').removeClass('error');
        $('.error-name,.error-email,.error-comments,.message-success').remove();
        $('#submit-small').val('Отправить сообщение');
    });

    // Отправка значений полей
    var smallOptions = {
        url: feedback_small_object.url,
        data: {
            action: 'feedback_action_small',
            nonce: feedback_small_object.nonce
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (xhr) {
            // При отправке формы меняем надпись на кнопке
            // $('#submit-small').val('Отправляем...');
            $('#submit-small').val(' ');
        },
        success: function (request, xhr, status, error) {

            if (request.success === true) {
                // Если все поля заполнены, отправляем данные и меняем надпись на кнопке
                add_small_form.after('<div class="message-success">' + request.data + '</div>').slideDown();
                // $('#submit-small').val('Отправить сообщение');
                $('#submit-small').val(' ');
            } else {
                // Если поля не заполнены, выводим сообщения и меняем надпись на кнопке
                $.each(request.data, function (key, val) {
                    $('.s_' + key).addClass('error');
                    $('.s_' + key).before('<span class="error-' + key + '">' + val + '</span>');
                });
                // $('#submit-small').val('Что-то пошло не так ART...');
                $('#submit-small').val(' ');

            }
            // При успешной отправке сбрасываем значения полей
            $('#small_form')[0].reset();
        },
        error: function (request, status, error) {
            // $('#submit-small').val('Что-то пошло не так...');
            $('#submit-small').val(' ');
        }
    };
    // Отправка формы
    add_small_form.ajaxForm(smallOptions);
});