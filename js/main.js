$(document).ready(function () {

    var baseURL = $('#domain').val();


    // asyncronic search
    if ($('.page-results').length > 0) {

        $(".nav-search").submit(function (event) {
            event.preventDefault();
            var value_input = $(this).find('.nav-search-input').val();

            $.ajax({
                url: "ajax.php",
                data: {
                    q: value_input,
                    action: 'getItemsSearch'
                },
                type: "POST",
                dataType: "json",
                beforeSend: function () {
                    $('#searchResults').addClass('loading').find('.container').html('');
                },
                success: function (items) {
                    $('#searchResults').removeClass('loading')
                    $.each(items, function (i, item) {
                        var html = '';

                        html += '<div class="item"><a href="' + baseURL + 'product.php?id=' + item.id + '" class="item__image"><img src="' + deployImage(item.thumbnail) + '" alt="' + item.title + '" width="160" heigth="160"></a>';
                        html += '<div class="item__info">';
                        html += '<div class="item__price__container"><div class="item__price">' + deploySearch(item.currency_id) + item.price + '</div>';

                        if (item.shipping.free_shipping == 1) {
                            html += ' <div class="item__shopping-cart"></div>';
                        }

                        html += '</div><h2 class="item__title"><a href="' + baseURL + 'product.php?id=' + item.id + '">' + item.title + '</a></h2>';
                        html += '<div class="item__location">' + item.address.city_name + '</div></div></div>';

                        $('#searchResults .container').append(html);

                    });

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    console.log(ajaxOptions);
                    console.log(thrownError);
                }
            });

        });

    }
});


function deploySearch($str) {
    var symbol;

    switch ($str) {
        case 'ARS':
            symbol = '$';
            break;

        case 'USD':
            symbol = 'U$S';
            break;
    }

    return symbol;
}

function deployImage(str) {
    return str.replace('-I.jpg', '-V.jpg');
}