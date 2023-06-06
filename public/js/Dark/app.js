$(document).ready(function () {
    // filter
    window.sliders = $('.nonlinear');

    for (let i = 0; i < sliders.length; i++) {

        let slid = sliders[i];
        let id = slid.getAttribute('data-id');
        noUiSlider.create(slid, {
            connect: true,
            behaviour: 'tap',
            start: [document.getElementById(id + '-lower-value').value, document.getElementById(id + '-upper-value').value],
            range: {
                'min': [parseInt(slid.getAttribute('data-min'))],
                'max': [parseInt(slid.getAttribute('data-max'))]
            },
        });


        document.getElementById(id + '-lower-value').addEventListener('change', function () {

            if (parseInt(this.value) >= parseInt(document.getElementById(id + '-upper-value').value)) {
                this.value = document.getElementById(id + '-upper-value').value
            }
            if (this.value !== '') {
                console.log(sliders[this.getAttribute('data-index')].noUiSlider);
                sliders[this.getAttribute('data-index')].noUiSlider.set([this.value, null]);
            } else {
                this.value = parseInt(slid.getAttribute('data-min'))
            }
            let data = $('form').serializeArray();
            filterRequest(data)

        });
        document.getElementById(id + '-upper-value').addEventListener('change', function () {
            if (parseInt(this.value) <= parseInt(document.getElementById(id + '-lower-value').value)) {
                this.value = document.getElementById(id + '-lower-value').value
            }

            if (this.value !== '') {
                sliders[this.getAttribute('data-index')].noUiSlider.set([null, this.value]);
            } else {
                this.value = parseInt(slid.getAttribute('data-max'))
            }
            let data = $('form').serializeArray();
            filterRequest(data)
        });

        slid.noUiSlider.on('slide', function (values, handle, unencoded, isTap, positions) {
            var nodes = [
                document.getElementById(this.target.getAttribute('data-id') + '-lower-value'), // 0
                document.getElementById(this.target.getAttribute('data-id') + '-upper-value'),  // 1
            ];

            nodes[handle].value = parseInt(values[handle]);
        });

        slid.noUiSlider.on('end', function (values, handle, unencoded, isTap, positions) {
            let data = $('form').serializeArray();

            filterRequest(data)
        });
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            let data = $('form').serializeArray();
            let page = $(this).attr('href').split('page=')[1]
            filterRequest(data, page)
        });

        function filterRequest(data, page = 1) {
            // window.history.replaceState(null, 'aaa.loc', 'products-filter?'+a);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: window.filterRoute,
                data: {
                    filters: data,
                    page: page
                },
                success: function (response) {
                    $('.products-container').html(response.products)
                }, error: function (err) {
                    console.log(err)
                }
            });
        }
    }

// End filter

    function updateSmallBasket(data) {
        $('.small-basket').html(data)
    }

    function updateBasket(data) {
        $('.basket_page').html(data)
    }

    $(document).on("ajaxStart", function () {
        $('.loader').show();

    });
    $(document).on("ajaxComplete", function () {
        $('.loader').hide();
    });

    $(document).on('click', '.favorites_icon', function (event) {

        let product_id = $(this).data('id');
        let url = window.addTofavorites
        let that = $(this);
        if ($(this).hasClass('active')) {
            url = window.removeFromfavorites
        }
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
                    if (that.hasClass('active')) {
                        if (that.closest('.favorites-container').length) {
                            that.closest('.product-item').animate({
                                height: 0,
                                width: 0
                            }, 500, function () {
                                that.closest('.product-item').remove()
                                if (!$('.favorites-container').find('.product-item').length) {
                                    $('.favorites-container').append('<strong class="text-center fs-2 d-block">Favorite Products not exists</strong>')
                                }
                            })
                        }
                    }
                    that.toggleClass('active')

                }
            }, error: function (err) {
                console.log(err)
            }
        });
    })


//  product add to basket
    let needWait = false;
    $(document).on('click', '.add-to-cart', function () {
        if (!needWait) {
            $('.header_basket').trigger('click')
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
                        $('.bi-basket').addClass('rotate_animate');

                        that.removeClass('add-to-cart').addClass('remove-from-cart').text('Remove from cart')
                        basketCount.text(response.data.basketProductsCount)
                        setTimeout(function () {
                            $('.bi-basket').removeClass('rotate_animate')
                        }, 1000)
                        updateSmallBasket(response.data.smallBasket)
                    }
                    needWait = false;

                }, error: function (err) {
                    needWait = false;
                }
            });
        }

    })
//  product add to basket
    $(document).on('click', '.remove-from-cart', function () {

        if (!needWait) {
            if (!$('#small_basket').hasClass('show')) {
                $('.header_basket').trigger('click')
            }
            needWait = true;
            let product_id = $(this).data('id')
            let cardBody = $(document).find('.card-body[data-id="' + product_id + '"]');
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
                        basketCount.text(response.data.basketProductsCount)
                        cardBody.find('.basket-buttons-container').remove('');
                        cardBody.append(response.data.buttons);
                        if ($('.small-basket tr[data-id="' + product_id + '"]').length) {
                            $('.small-basket tr[data-id="' + product_id + '"]').remove()
                        }
                        if ($('.basket_page tr[data-id="' + product_id + '"]').length) {
                            $('.basket_page tr[data-id="' + product_id + '"]').remove()
                        }
                        updateSmallBasket(response.data.smallBasket)
                        updateBasket(response.data.smallBasket)
                    }
                    needWait = false;
                }, error: function (err) {
                    console.log(err)
                    needWait = false;
                }
            });
        }

    })
// basket index blade  button plus
    $(document).on('click', '.plus', function () {
        if (!$('#small_basket').hasClass('show')) {
            $('.header_basket').trigger('click')
        }
        let quantity = $(this).closest('.quantity-container').find('.quantity')
        let quantityValue = parseInt(quantity.text());
        let that = $(this)
        that.attr('disabled', 'disabled')
        quantity.text(++quantityValue);
        $('.minus').attr('disabled', false)
        let product_id = $(this).data('id')
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
                    setTimeout(function () {
                        that.attr('disabled', false)
                    }, 100)
                    updateSmallBasket(response.data.smallBasket)
                    updateBasket(response.data.smallBasket)

                }
            }, error: function (err) {
                console.log(err)
            }
        });


    })
// basket index blade  button minus
    $(document).on('click', '.minus', function () {
        if (!$('#small_basket').hasClass('show')) {
            $('.header_basket').trigger('click')
        }
        let that = $(this)
        that.attr('disabled', 'disabled')
        let quantity = $(this).closest('.quantity-container').find('.quantity')
        let quantityValue = parseInt(quantity.text());
        let product_id = $(this).data('id')

        if (quantityValue === 1) {
            return false
        } else {
            quantity.text(--quantityValue);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: window.basketQuantityMinus,
            data: {
                "product_id": product_id,
            },
            success: function (response) {
                setTimeout(function () {
                    that.attr('disabled', false)
                }, 100)
                if (response.success === 'Success') {
                    updateSmallBasket(response.data.smallBasket)
                    updateBasket(response.data.smallBasket)
                }
            }, error: function (err) {
                setTimeout(function () {
                    that.attr('disabled', false)
                }, 100)
            }
        });
    })


// categories item hide on click body
    $(document).on('click', 'body', function () {
        $('.categories_collapse ').removeClass('show')
    })

    $(document).on('click', '.confirm-order', function () {
        let {user_id, total_price, address} = $(this).data();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: window.order,
            data: {
                user_id,
                total_price,
                address
            },
            success: function (response) {
                if (response.success === 'Success') {
                    updateSmallBasket(response.data.smallBasket)
                    updateBasket(response.data.smallBasket)
                    basketCount.text(0)
                }

            }, error: function (err) {

            }
        });
    })

});
