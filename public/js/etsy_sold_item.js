$("#auto_sold").addClass("select-blue");




// function selectPage(e) {
//     var etsy_id = $('#active_account').find(":selected").val();
//     var t = $.trim(e);
//     s = $("#loader");
//     s.fadeIn();
    
//     $.ajax({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
//         },
//         url: window.origin+"/sold",
//         type: "POST",
//         data:{etsy_id:etsy_id,current_page:t},
//         success: function(e) {
//             s.fadeOut();
//             console.log(e);
//             $(".auto-grid").empty().append(e);
//         },
//         error: function(e, t, a) {
//             console.log(e);
//             s.fadeOut();
//             popMessage("danger", "Network error! ");
//         }
//     })
// }


$(document).on("click", ".add_sales_btn", function(e) {
    
    var sp = [];
    var spreadsheet_id = $("#sheet_page_list").children("option:selected").attr("id");

    $('.fee-checkbox:checked').each(function(e){

        _this = $(this);

        var listing = {

            platform:"Etsy",
            item_id:$("#sheet_page_list").children("option:selected").attr("id"),
            sale_id:$.trim(_this.parent().parent().find("td").eq("1").children().html()),
            date:$.trim(_this.parent().parent().find("td").eq("2").children().html()),
            name:$.trim(_this.parent().parent().find("td").eq("4").children().html()),
            quantity:$.trim(_this.parent().parent().find("td").eq("5").children().html()),
            currency:$.trim(_this.parent().parent().find("td").eq("6").children().html()),
            sold_price:$.trim(_this.parent().parent().find("td").eq("7").children().html()),
            item_cost:$.trim(_this.parent().parent().find("td").eq("8").children().html()),
            shipping_charge:$.trim(_this.parent().parent().find("td").eq("9").children().html()),
            shipping_cost:$.trim(_this.parent().parent().find("td").eq("10").children().val()),
            fees:$.trim(_this.parent().parent().find("td").eq("14").children().html()),
            other_fees:0,
            processing_fees:0,
            tax:$.trim(_this.parent().parent().find("td").eq("12").children().html()),
            profit:$.trim(_this.parent().parent().find("td").eq("15").children().html())
        }

        sp.push(listing);

    });

    if (0 === sp.length) {
        popMessage("danger", "Wrong! Please  select checkbox!!");
    }

    if (sp.length > 200) {
        popMessage("danger", "Wrong! you can't select more than 200  at once ");
    }


    $.ajax({
        url: window.origin+"/auto/etsy/add-sold-listing",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        type: "POST",
        data: {
            fee_array:sp,spreadsheet_id:spreadsheet_id
        },
        success: function(e) {
            console.log(e);
            "valid" == e.status ? ($("#loader").fadeOut(), popMessage("success", "The selected sales has been added!")) : ($("#loader").fadeOut(), popMessage("danger", "Wrong! Please upgrade your account!"))
        },
        error: function(e, t, a) {
            console.log(e);
            popMessage("danger", "Wrong! Please upgrade your account!")
        }
    });
    
});