$(document).ready(function () {
    $("#close_alert").click(function () {
        $(".alert").slideUp();
    });

    var e = moment().format("YYYY-MM-DD");

    function a() {
        $.ajax({
            url: window.origin+"/pg_sheet_list",
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            method: "POST",
            success: function (e) {
                $("#list").empty().append(e);
            },
            error: function (e, a, t) {
                $("#list").empty().append("Error");
                console.log(e);
            },
        });
    }
    $("input[name=sale_date]").val(e),
        a(),
        $(document).on("click", ".add_sales_btn", function () {
            if (!(e = $("input[name=name]").val()) || 0 === e.length) var e = $("input[name=name]").attr("class");
            $.ajax({
                url: window.origin+"/pages/store",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                method: "POST",
                data: {
                    spreadsheet_id: $("select[name=selects]").find("option:selected").attr("id"),
                    date: $("input[name=sale_date]").val(),
                    spreadsheet_name: $("select[name=selects]").find("option:selected").text().replace("Spreadsheet: ", ""),
                    platform: $("input[name=name]").attr("class"),
                    currency: $("select[name=currency]").val(),
                    name: e,
                    sold_price: parseFloat($("input[name=sold_price]").val() || 0),
                    item_cost: parseFloat($("input[name=item_cost]").val() || 0),
                    shipping_charge: parseFloat($("input[name=shipping_charge]").val() || 0),
                    shipping_cost: parseFloat($("input[name=shipping_cost]").val() || 0),
                    fees: parseFloat($("#main-fees").text().replace(/\,/g, "") || 0),
                    other_fees: parseFloat($("#other-fees").text().replace(/\,/g, "") || 0),
                    processing_fees: parseFloat($("#p-fees").text().replace(/\,/g, "") || 0),
                    tax: parseFloat($("#main-tax").text().replace(/\,/g, "") || 0),
                    currency: $("#currency option:selected").val(),
                    profit: parseFloat($("#main-profit").text().replace(/\,/g, "") || 0),
                },
                success: function (e) {
                    $(".alert").stop(!0).fadeOut(100).fadeIn(1e3), $(".alert-message").empty().append(e.message), $(".alert,.upgrade_acc").css({ background: e.color, color: e.text }), $(".p-reset").click();
                },
                error: function (e, a, t) {
                    $(".alert").stop(!0).fadeOut(100).fadeIn(1e3), $(".alert-message").empty().append("Error Try Again"), $(".alert,.upgrade_acc").css({ background: "#ea3f4f", color: "white" });
                },
            });
        }),
        $("#new_sheet").click(function (e) {
            $.ajax({
                url: window.origin+"/spreadsheet/store",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                method: "POST",
                data: { action: "new_sheet", spreadsheet_name: $("input[name=spreadsheet_name]").val() },
                success: function (e) {
                    $(".modal").modal("hide"),
                        $(".alert").stop(!0).fadeOut(100).fadeIn(1e3),
                        $("input[name=spreadsheet_name]").val(""),
                        "valid" === e.status
                            ? ($(".alert-message").empty().append("New Spreadsheet Created"), $(".alert,.upgrade_acc").css({ background: "#d4edda", color: "#262626" }))
                            : ($(".alert-message").empty().append("Error Try Again"), $(".alert,.upgrade_acc").css({ background: "#ea3f4f", color: "white" }), "upgrade" === e.account && $("#sub_status").modal("show")),
                        a();
                },
                error: function (e, a, t) {
                    $(".alert").stop(!0).fadeOut(100).fadeIn(1e3), $(".alert-message").empty().append("Error Try Again"), $(".alert,.upgrade_acc").css({ background: "#ea3f4f", color: "white" });
                    console.log(e);
                },
            });
        });
});
