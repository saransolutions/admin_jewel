
$(document).ready(function () {
    $("#pay_button,#edit_button,#remove_button,#invoice_button").click(function () {
        var count = $("input:checkbox:checked").length
        if (count == 0) {
            alert("select at least \"one\" checkbox")
            return false
        } else if (count > 1) {
            alert("Not select more than \"one\" checkbox")
            return false
        } else {
            var value = $("input:checkbox:checked").val();
            var button_name = $(this).attr("name");
            if (button_name == "invoice") {
                $.ajax({
                    type: "GET",
                    url: "orders.php",
                    data: {
                        "get_invoice_lang": value
                    },
                    success: function (data) {
                        $("#invoice_body").html(data);
                    }
                });
            }
            if (button_name == "edit") {
                $.ajax({
                    type: "GET",
                    url: "orders.php",
                    data: {
                        "edit_id": value
                    },
                    success: function (data) {
                        $("#edit_body").html(data);
                    }
                });
            }
            if (button_name == "pay") {
                $.ajax({
                    type: "GET",
                    url: "orders.php",
                    data: {
                        "pay_id": value
                    },
                    success: function (data) {
                        $("#pay_body").html(data);
                    }
                });
            }
            if (button_name == "add_photo") {
                $.ajax({
                    type: "GET",
                    url: "orders.php",
                    data: {
                        "add_photo_id": value
                    },
                    success: function (data) {
                        $("#add_photo_body").html(data);
                    }
                });
            }
            if (button_name == "remove") {
                $.ajax({
                    type: "GET",
                    url: "orders.php",
                    data: {
                        "remove_id": value
                    },
                    success: function (data) {
                        $("#remove_body").html(data);
                    }
                });
            }
        }
    });
});
