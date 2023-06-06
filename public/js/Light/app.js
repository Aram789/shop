$(document).ready(function () {
    let needWait = false;

    function checkRequired(form, button) {
        let submitForm = true;
        $(form).find("[required='']").each((kay, val) => {
            if ($(val).val() === '') {
                submitForm = false
            }
        })
        if (submitForm) {
            $(button).removeAttr('disabled')
        } else {
            $(button).attr('disabled', 'disabled')
        }
    }

    $(document).on('click', '.favorite', function (e) {
        e.preventDefault()
        let url = window.addTofavorites
        if ($(this).hasClass('light_favorite_active')) {
            url = window.removeFromfavorites
        }
        needWait = true;
        let product_id = $(this).data('id');
        let that = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: url,
            data: {
                "product_id": product_id,
            },
            success: function (response) {
                if (response.success === 'Success') {
                    if (that.hasClass('light_favorite_active')) {
                        that.children('svg').attr('fill', 'silver')
                        that.closest('#favorite_page .card').animate({
                            height: 0,
                            width: 0
                        }, 300, function () {
                            $(this).remove();
                            $('#favorite_page').children().append('<strong class="fs-1 d-block text-center py-5 text-white">Empty</strong>')
                        })
                        $('.countFavorite').text(response.data.countFavorite)
                    } else {
                        that.children('svg').attr('fill', 'red')
                        $('.countFavorite').text(response.data.countFavorite)
                    }
                    that.toggleClass('light_favorite_active')

                }
                needWait = false;

            }, error: function (err) {
                needWait = false;
            }
        });


    })
    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault()
        if (!needWait) {
            needWait = true;
            let product_id = $(this).data('id');
            let that = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: window.basketAdd,
                data: {
                    "product_id": product_id,
                },
                success: function (response) {
                    if (response.success === 'Success') {
                        that.closest('.basket-buttons-container').html(response.data.buttons)
                        $('.basket_count ').text(response.data.basketProductsCount)
                    }
                    needWait = false;

                }, error: function (err) {
                    needWait = false;
                }
            });
        }
    })
    $(document).on('click', '.remove-from-cart', function (e) {
        e.preventDefault()
        if (!needWait) {
            needWait = true;
            let product_id = $(this).data('id');
            let that = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: window.basketRemove,
                data: {
                    "product_id": product_id,
                },
                success: function (response) {
                    if (response.success === 'Success') {
                        that.closest('#basket_page .card').animate({
                            height: 0,
                            width: 0
                        }, 300, function () {
                            $(this).remove();
                            $('#basket_page').children().append('<strong class="fs-1 d-block text-center py-5 text-white">Empty</strong>')
                        })
                        that.closest('.basket-buttons-container').append(response.data.buttons);
                        that.remove()
                        $('.basket_count ').text(response.data.basketProductsCount);
                    }
                    needWait = false;

                }, error: function (err) {
                    needWait = false;
                }
            });
        }
    })
    $(document).on('input', '#contactForm', function () {
        checkRequired($(this), $('.contact_submit'))
    })

    AOS.init();
});
