jQuery(document).ready(function ($) {

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
                console.log(response)
            }
        })
    })

    $('.prod__replyto-form').on('submit', function (e) {
        e.preventDefault();

        let commentId = $('input[name="comment_id"]').val(),
            postId    = $('input[name="product_id"]').val(),
            str       = "div-comment-"+commentId;

        $('.answer__btn').data('commentid', commentId);
        $('.answer__btn').data('belowelement', str);
        $('.answer__btn').data('postid', postId);

        $.ajax({
            type: 'POST',
            url: '/?replytocom='+commentId+'#respond',
            data: $(this).serialize(),
            success: function (response) {
                console.log(response)
            }
        })
    })
})

