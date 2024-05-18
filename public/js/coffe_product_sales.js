$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#form-login").validate({
        rules: {
            product_name: "required",
            quantity: {
                required: true,
                digits: true,
            },
            unit_cost: {
                required: true,
                digits: true,
            },
        },
        messages: {
            product_name: " Please select Product",
            quantity: {
                required: " Please enter Shipment Cost",
                ddigits: "Please enter numbers",
            },
            unit_cost: {
                required: " Please enter Unit Cost",
                ddigits: "Please enter numbers",
            },
        },

        errorPlacement: function (error, element) {
            if (element.attr("name") === "quantity") {
                $("#quantity_err").html(error);
            } else {
                error.insertAfter(element.parent());
            }
            if (element.attr("name") === "unit_cost") {
                $("#unit_cost_err").html(error);
            }
            if (element.attr("name") === "product_name") {
                $("#product_name_err").html(error);
            }
        },
    });
});
