<script>
    const get_cart_route = '{{ route("cart.get") }}';
    const edit_cart_route = '{{ route("cart.edit") }}';
    const empty_cart_route = '{{ route("cart.empty") }}';
    const products = @JSON($products);

    $(function () {
        reloadTotal();
    });

    function emptyCart() {
        $.ajax({
            url: empty_cart_route,
            method: "DELETE",
            success: function () {
                toastr.success("Carrello svuotato con successo");
                $("input.cart-product-items").val(0);
                $(".cart-product-totals").html(formatPrice(0));
                $(".cart-total").html(formatPrice(0));
            },
        });
    }

    function editCart(product_id, quantity) {
        const product_items = $("#product-items-" + product_id);
        const product_total = $("#product-total-" + product_id);

        const result = parseInt(product_items.val() || 0) + quantity;

        if (result >= 0) {
            product_items.val(result);
            product_total.html(formatPrice(result * products[product_id].price));

            $.ajax({
                url: edit_cart_route,
                method: "PUT",
                data: {
                    product_id: product_id,
                    quantity: result,
                },
                success: function () {
                    reloadTotal();
                },
            });
        }
    }

    function reloadTotal() {
        $.get(get_cart_route, function (res) {
            $(".cart-total").html(formatPrice(res.total));
        });
    }

</script>
