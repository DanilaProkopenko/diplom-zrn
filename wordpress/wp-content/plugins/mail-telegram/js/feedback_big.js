jQuery(document).ready(function ($) {
    var add_bid_form = $('#bid_form');

    // Сброс значений полей
    $('#bid_form input').on('blur', function () {
        $('#bid_form input').removeClass('error');
        $('.error-name,.error-email,.error-comments,.message-success').remove();
        $('#submit-big').val('Send brif');
    });

    // Отправка значений полей
    var bigOptions = {
        url: feedback_big_object.url,
        data: {
            action: 'feedback_action_big',
            nonce: feedback_big_object.nonce
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (xhr) {
            // При отправке формы меняем надпись на кнопке
            $('#submit-big').val('Sending...');
        },
        success: function (request, xhr, status, error) {

            if (request.success === true) {
                // Если все поля заполнены, отправляем данные и меняем надпись на кнопке
                add_bid_form.after('<div class="message-success">' + request.data + '</div>').slideDown();
                $('#submit-big').val('Send brif');
            } else {
                // Если поля не заполнены, выводим сообщения и меняем надпись на кнопке
                $.each(request.data, function (key, val) {
                    $('.b_' + key).addClass('error');
                    $('.b_' + key).before('<span class="error-' + key + '">' + val + '</span>');
                });
                $('#submit-big').val('Error .b_...');

            }
            // При успешной отправке сбрасываем значения полей
            $('#bid_form')[0].reset();
        },
        error: function (request, status, error) {
            $('#submit-big').val('Error...');
        }
    };
    // Отправка формы
    add_bid_form.ajaxForm(bigOptions);
});