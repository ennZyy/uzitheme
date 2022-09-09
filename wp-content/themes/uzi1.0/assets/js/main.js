jQuery(document).ready(function ($) {
    let consultationModal = $('.feed-modal');

    $('.feed__body').on('submit', function (e) {
        e.preventDefault();

        let userPhone = $('#telInput').val()
        $.ajax({
            type: 'POST',
            url: ajax_url['url'],
            data: {
                'action': 'post_user_request',
                'data' : userPhone
            },
            success: function(response) {
                if ( response === 'ok' ) {

                }
            }
        })
    });

    $('.feed__body-modal').on('submit', function (e) {
        e.preventDefault();

        let userPhone = $('#modalTelInput').val()
        $.ajax({
            type: 'POST',
            url: ajax_url['url'],
            data: {
                'action': 'post_user_request',
                'data' : userPhone
            },
            success: function(response) {
                consultationModal.addClass('modal-hide');
            }
        })
    })

    $('#modalTelInput').mask("+7 (999) 999-99-99");
    $('#telInput').mask("+7 (999) 999-99-99");

    $('.search__btn').on('click', function (e) {
        e.preventDefault();

        let searchValue = $('input[name="search"]').val();

        if ( searchValue !== '' ) {
            console.log(searchValue)

            // window.location.href = document.location.host + '/?s=' + searchValue;
            window.location.replace(document.location.host + '/?s=' + searchValue);
            window.location.href = "http://uzi/?s=" + searchValue;
        }
    });

    $('.addc__btn').on('click', function (e) {
        e.preventDefault();
        console.log('hello')
    })

    $(document).on('click', '#loadmore', function () {
        $(this).text('Загрузка...');

        let posts_vars = $('input[name="posts_vars"]').val()
        let current_page = $('input[name="current_page"]').val()
        let max_pages = $('input[name="max_pages"]').val()

        var data = {
            'action': 'loadmore',
            'query': posts_vars,
            'page' : current_page
        };
        $.ajax({
            url: ajax_url['url'],
            data: data,
            type:'POST',
            success:function(data){
                if(data) {
                    $('.list__body_items').append(data)
                    $('#loadmore').text('Показать ещё');
                    current_page++;
                    if (current_page == max_pages) $("#loadmore").remove();

                    let items = document.querySelectorAll('.list__body_items_item');

                    let count = items.length;
                    $('.filter__item_info span').text(`(${count})`);
                } else {
                    $('#loadmore').remove();
                }
            }
        });
    })

    $('#home-loadmore').click(function(){
        $(this).text('Загрузка...');

        let posts_vars = $('input[name="posts_vars"]').val()
        let current_page = $('input[name="current_page"]').val()
        let max_pages = $('input[name="max_pages"]').val()


        var data = {
            'action': 'loadmore_featured',
            'query': posts_vars,
            'page' : current_page
        };
        $.ajax({
            url: ajax_url['url'],
            data:data,
            type:'POST',
            success:function(data){
                if(data) {
                    $('.best__ap-list').append(data)
                    $('#home-loadmore').text('Показать ещё');
                    current_page++;
                    if (current_page == max_pages) $("#home-loadmore").remove();
                } else {
                    $('#home-loadmore').remove();
                }
            }
        });
    });

    $('#blog-loadmore').click(function () {
        $(this).text('Загрузка...');

        var data = {
            'action': 'loadmore_get_articles',
            'query': posts_vars,
            'page' : current_page
        };

        $.ajax({
            url: ajax_url['url'],
            data:data,
            type:'POST',
            success:function(data){
                if(data) {
                    $('.articles__list').append(data)
                    $('#blog-loadmore').text('Показать ещё');
                    current_page++;
                    if (current_page == max_pages) $("#blog-loadmore").remove();
                } else {
                    $('#blog-loadmore').remove();
                }
            }
        });
    })

    $('#vendor-loadmore').click(function () {
        $(this).text('Загрузка...');

        let posts_vars = $('input[name="posts_vars"]').val()
        let current_page = $('input[name="current_page"]').val()
        let max_pages = $('input[name="max_pages"]').val()

        var data = {
            'action': 'loadmore',
            'query': posts_vars,
            'page' : current_page
        };
        $.ajax({
            url: ajax_url['url'],
            data:data,
            type:'POST',
            success:function(data){
                if(data) {
                    $('.vendors__list').append(data)
                    $('#vendor-loadmore').text('Показать ещё');
                    current_page++;
                    if (current_page == max_pages) $("#vendor-loadmore").remove();
                } else {
                    $('#vendor-loadmore').remove();
                }
            }
        });
    })

    $(document).on('mouseover', '#nercard', function (e) {
        let ex = e.currentTarget.querySelector('.card__body_ex');

        ex.style.cssText = `height: ${ex.scrollHeight}px`;
    })

    $(document).on('mouseout', '#nercard', function (e) {
        let ex = e.currentTarget.querySelector('.card__body_ex');

        ex.style.cssText = `height: 0px`;
    })

    $("button[name=filterDate]").on('click', function (e) {
        let orderBy = $('input[name="inputFilterDate"]').val();

        $(this).toggleClass('active');

        let data = {
            'action': 'filter_articles_by_date',
            'orderBy': orderBy
        };

        $.ajax({
            type: 'POST',
            url: ajax_url['url'],
            data: data,
            success: function(response) {
                if (orderBy == 'DESC') {
                    $('input[name="inputFilterDate"]').val('ASC');
                } else {
                    $('input[name="inputFilterDate"]').val('DESC');
                }

                $('.articles__list').html(response);
            }
        })
    })

    $("button[name=filterView]").on('click', function (e) {
        let orderBy = $('input[name="inputFilterView"]').val();

        $(this).toggleClass('active-view');

        let data = {
            'action': 'filter_articles_by_views',
            'views': orderBy
        };

        $.ajax({
            type: 'POST',
            url: ajax_url['url'],
            data: data,
            success: function(response) {
                if (orderBy == 'popular') {
                    $('input[name="inputFilterView"]').val('nopopular');
                } else {
                    $('input[name="inputFilterView"]').val('popular');
                }

                $('.articles__list').html(response);
            }
        })
    })

    $(".vendor__product-more").on('click', function () {
        let vendorList = $('.vendor__list'),
            btn = this;

        vendorList.each(function (e) {
            if ( $(this).hasClass('vendor__list-hidden') ) {
                $(this).removeClass('vendor__list-hidden')
                btn.remove()
            }
        })
    })

    $(".sensor__more").on('click', function () {
        let sensorList = $('.sensor__list'),
            btn = this;

        sensorList.each(function (e) {
            if ( $(this).hasClass('sensor__list-hidden') ) {
                $(this).removeClass('sensor__list-hidden');
                btn.remove();
            }
        })
    })

    var files; // переменная. будет содержать данные файлов

    // заполняем переменную данными, при изменении значения поля file
    $('#uploadLogo').on('change', function(){
        files = this.files;
    });

    $('.vendor__registration').on('click', function (e) {
        e.preventDefault();

        let data = new FormData(),
            name = $('input[name="vendorName"]').val(),
            desc = $('textarea[name="vendorDescription"]').val();

        data.append("action", "post_registration_vendor")

        $.each( files, (key, value) => {
            data.append(key, value);
        } );

        data.append( "name", name );
        data.append( "desc", desc );

        $.ajax({
            type: 'POST',
            url: ajax_url['url'],
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            successes: function (response) {
                console.log(response);
            },
            error: function (jqXHR, status) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        }).done(function (data) {
            console.log(data);
            $('.addc').removeClass('active');
            $('.company-sent').removeClass('company-sent--hide')

            setTimeout(function(){
                $('.company-sent').addClass('company-sent--hide')
            }, 3000);
        })
    })

    $('aside.filter').on('change', function () {
        let categoryId = $('input[name="categoryID"]').val(),
            minPrice, maxPrice, attributes = [], types = [], data = {};

        let url = ajax_url['url'] + '/?action=filter_apparatus&category_id='+categoryId;

        // Price
        if ($('input[name="fprice"]').val()) {
            url += '&min='+$('input[name="fprice"]').val()
        }

        if ($('input[name="tprice"]').val()) {
            url += '&max='+$('input[name="tprice"]').val()
        }

        $("input[id*='vendor-']").each(function (i, el) {
            //It'll be an array of elements
            if ( $(el).prop('checked') ) {
                url += '&vendor='+$(el).val()
            }
        });

        let count = 0;
        $("input[id*='attribute-']").each(function (i, el) {
            if ( $(el).prop('checked') ) {
                count++;
                if ( count > 1 ) {
                    url += ';'+$(el).val();
                } else {
                    url += '&attribute='+$(el).val();
                }
            }
        });

        $("input[id*='type-']").each(function (i, el) {
            //It'll be an array of elements
            if ( $(el).prop('checked') ) {
                count++;
                if ( count > 1 ) {
                    url += '&type='+$(el).val();
                } else {
                    url += '&type='+$(el).val();
                }
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            success: function(response) {
                let result = JSON.parse(response);
                let postsVars = result["posts_vars"];
                let currentPage = result["current_page"];
                let max_pages = result["max_pages"];
                let wrapper = $('.list__body_items');

                wrapper.html(result['html']);

                $('input[name="posts_vars"]').val(JSON.stringify(postsVars));
                $('input[name="max_pages"]').val(max_pages);
                let current_page = $('input[name="current_page"]').val()
                current_page = currentPage;

                if (current_page == max_pages) {
                    $("#loadmore").remove();
                } else {
                    if ( !$('#loadmore').length ) {
                        $('.list__body_action').append('<button id="loadmore">Показать ещё</button>')
                    }
                }

                let count = (result['html'].match(/list__body_items_item/g) || []).length;
                $('.filter__item_info span').text(`(${count})`);
            }
        })
    })

    $(document).on('mouseover', '.card', function (e) {
        let ex = e.currentTarget.querySelector('.card__body_ex');

        ex.style.cssText = `height: ${ex.scrollHeight}px`;
    })

    $(document).on('mouseout', '.card', function (e) {
        let ex = e.currentTarget.querySelector('.card__body_ex');

        ex.style.cssText = `height: 0px`;
    })

    $('.filter__item-reset').on('click', function (e) {
        e.preventDefault();

        let categoryId = $('input[name="categoryID"]').val()

        $.ajax({
            type: 'POST',
            url: ajax_url['url'] + '/?action=get_all_apparatus&category_id='+categoryId,
            success: function(response) {
                let result = JSON.parse(response);
                let postsVars = result["posts_vars"];
                let currentPage = result["current_page"];
                let max_pages = result["max_pages"];
                let wrapper = $('.list__body_items');

                console.log(result)

                wrapper.html(result['html']);

                $('input[name="posts_vars"]').val(JSON.stringify(postsVars));
                $('input[name="max_pages"]').val(max_pages);
                let current_page = $('input[name="current_page"]').val()
                current_page = currentPage;

                if (current_page == max_pages) {
                    $("#loadmore").remove();
                } else {
                    if ( !$('#loadmore').length ) {
                        $('.list__body_action').append('<button id="loadmore">Показать ещё</button>')
                    }
                }

                let count = (result['html'].match(/list__body_items_item/g) || []).length;
                $('.filter__item_info span').text(`(${count})`);
            }
        })
    })

    $('.product-action-consultation').on('click', function (e) {
        e.preventDefault();

        console.log($(this));

        consultationModal.removeClass('modal-hide');
    })

    $(document).on('click', '.close', function (e) {
        consultationModal.addClass('modal-hide')
    })

    $(document).keydown(function(e){
        if(e.which == 27 && !consultationModal.hasClass('modal-hide')){
            consultationModal.addClass('modal-hide')
        }
    });
})
