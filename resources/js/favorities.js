{/* <script>
$(document).on('click', '.add-to-favorites', function(event) {
    event.preventDefault();
    var button = $(this);
    var productId = button.data('product-id');
    $.ajax({
        url: '/favorites/add',
        type: 'POST',
        dataType: 'json',
        data: {
            product_id: productId
        },
        success: function(data) {
            if (data.status == 'success') {
                button.text('В избранном');
            } else {
                alert('Ошибка добавления в избранное');
            }
        },
        error: function(xhr, status, error) {
            alert('Ошибка добавления в избранное');
        }
    });
});
$(document).ready(function() {
    $.each($('.add-to-favorites'), function(index, button) {
        var productId = $(button).data('product-id');
        $.ajax({
            url: '/favorites/check',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: productId
            },
            success: function(data) {
                if (data.status === 'success') {
                    $(button).text('В избранном');
                }
            },
            error: function(xhr, status, error) {
                alert('Ошибка проверки избранного');
            }
        });
    });
});
</script> */}