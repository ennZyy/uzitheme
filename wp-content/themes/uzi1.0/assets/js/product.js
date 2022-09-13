jQuery(document).ready(function ($) {

    function cmAnswer() {
        const commentBtns = document.querySelectorAll('.comment-answer-btn');

        const answer = document.createElement('form');
        answer.classList.add('prod__comment_body');

        answer.classList.add('prod__replyto-form');

        answer.innerHTML = `
        <div class="prod__comment_body_inp">
            <input type="text" placeholder="Имя" name="name" required>
        </div>
        <div class="prod__comment_body_inp">
            <input type="email" placeholder="Email" name="email" required>
            <div class="prod__comment_body_inp_ex">*Email будет скрыт </div>
        </div>
        <div class="prod__comment_body_text">
            <textarea placeholder="Комментарий..." name="text" required></textarea>
        </div>
        <div class="prod__comment_body_action">
            <button class="prod__comment_body_action_btn answer__btn">Отправить</button>
        </div>`;

        if (commentBtns.length > 0) {
            commentBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    btn.parentElement.parentElement.classList.remove('active');

                    e.target.parentElement.parentElement.classList.toggle('active');

                    if (btn.parentElement.parentElement.classList.contains('active')) {
                        btn.parentElement.parentElement.append(answer);
                    }
                    if (!btn.parentElement.parentElement.classList.contains('active') && btn.parentElement.nextElementSibling) {
                        btn.parentElement.parentElement.removeChild(btn.parentElement.nextElementSibling);
                    }
                })
            })
        }
    }

    function objectifyForm(formArray) {//serialize data function

        var returnArray = {};
        for (var i = 0; i < formArray.length; i++){
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
    }

    $('.prod__review-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: ajax_url['url'],
            data: {
                'action': 'product_review',
                'data' : $(this).serialize()
            },
            success: function (response) {
                const reviewModal = $('.review-sent');
                $(reviewModal).removeClass('review-sent--hide');
                $('.prod__review-form')[0].reset();

                setTimeout(function(){
                    $(reviewModal).addClass('review-sent--hide')
                }, 3000);
            }
        })
    })

    $('.review-sent__close').on('click', function () {
        $('.review-sent').addClass('review-sent--hide')
    })

    $('.comment-answer-btn').on('click', cmAnswer())

    $(document).on('submit', '.prod__replyto-form', function (e) {
        e.preventDefault()

        let commentID = $(this).siblings('div.action').find('button.comment-answer-btn').data('comment'),
            formData = $(this).serializeArray(),
            productId = $('input[name="product_id"]').val()
            data = {};

        $(formData).each(function(index, obj){
            data[obj.name] = obj.value;
        });

        $.ajax({
            type: 'POST',
            url: ajax_url['url'] + '/?comment_reply_id=' + commentID + '&post_id=' + productId,
            data: {
                'action': 'post_add_reply',
                'data' : data
            },
            success: function (response) {
                const reviewModal = $('.review-sent');
                $(reviewModal).removeClass('review-sent--hide');
                $('.prod__replyto-form')[0].reset();

                setTimeout(function(){
                    $(reviewModal).addClass('review-sent--hide')
                }, 3000);
            }
        })
    })
})