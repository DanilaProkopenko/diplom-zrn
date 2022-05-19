jQuery(document).ready(function ($) {
    var add_form_2 = $('#add_feedback_2');

    // Сброс значений полей
    $('#add_feedback_2 input').on('blur', function () {
        $('#add_feedback_2 input').removeClass('error');
        $('.error-name,.error-email,.error-comments,.message-success').remove();
        $('#submit-feedback_2').val('Отправить сообщение');
    });

    // Отправка значений полей
    var options = {
        url: feedback_2_object.url,
        data: {
            action: 'feedback_action_2',
            nonce: feedback_2_object.nonce
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (xhr) {
            // При отправке формы меняем надпись на кнопке
            $('#submit-feedback_2').val('Отправляем...');
        },
        success: function (request, xhr, status, error) {

            if (request.success === true) {
                // Если все поля заполнены, отправляем данные и меняем надпись на кнопке
                add_form_2.after('<div class="message-success">' + request.data + '</div>').slideDown();
                $('#submit-feedback_2').val('Отправить сообщение');
            } else {
                // Если поля не заполнены, выводим сообщения и меняем надпись на кнопке
                $.each(request.data, function (key, val) {
                    $('.art_' + key).addClass('error');
                    $('.art_' + key).before('<span class="error-' + key + '">' + val + '</span>');
                });
                $('#submit-feedback_2').val('Что-то пошло не так ART...');

            }
            // При успешной отправке сбрасываем значения полей
            $('#add_feedback_2')[0].reset();
        },
        error: function (request, status, error) {
            $('#submit-feedback_2').val('Что-то пошло не так...');
        }
    };
    // Отправка формы
    add_form_2.ajaxForm(options);

    var add_small_form = $('#small_form');

    // Сброс значений полей
    $('#small_form input').on('blur', function () {
        $('#small_form input').removeClass('error');
        $('.error-name,.error-email,.error-comments,.message-success').remove();
        $('#submit-small').val('Отправить сообщение');
    });

    // Отправка значений полей
    var smallOptions = {
        url: feedback_2_object.url,
        data: {
            action: 'feedback_action_2',
            nonce: feedback_2_object.nonce
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (xhr) {
            // При отправке формы меняем надпись на кнопке
            $('#submit-small').val('Отправляем...');
        },
        success: function (request, xhr, status, error) {

            if (request.success === true) {
                // Если все поля заполнены, отправляем данные и меняем надпись на кнопке
                add_small_form.after('<div class="message-success">' + request.data + '</div>').slideDown();
                $('#submit-small').val('Отправить сообщение');
            } else {
                // Если поля не заполнены, выводим сообщения и меняем надпись на кнопке
                $.each(request.data, function (key, val) {
                    $('.art_' + key).addClass('error');
                    $('.art_' + key).before('<span class="error-' + key + '">' + val + '</span>');
                });
                $('#submit-small').val('Что-то пошло не так ART...');

            }
            // При успешной отправке сбрасываем значения полей
            $('#small_form')[0].reset();
        },
        error: function (request, status, error) {
            $('#submit-small').val('Что-то пошло не так...');
        }
    };
    // Отправка формы
    add_small_form.ajaxForm(smallOptions);
});