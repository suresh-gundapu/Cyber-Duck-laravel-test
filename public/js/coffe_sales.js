$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#form-login").validate({
        rules: {
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
        },
    });
});
