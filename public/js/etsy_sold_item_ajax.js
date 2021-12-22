function profit_update(num){
    
    var sum = 0.00;
    $(".listing[data-count="+num+"] .item-cost").each(function(){

        value = this.value;

        if (!value) {value = 0.00;}

        sum += parseFloat(value);

    });
    
    shipping_cost = parseFloat($(".transaction[data-count="+num+"] .shipping-cost").val());

    if (!shipping_cost) { shipping_cost = 0.00; }

    sum += shipping_cost;

    og_profit = $(".transaction[data-count="+num+"] .profit_blk").attr('data-profit');
    
    $(".transaction[data-count="+num+"] .profit_blk").html((parseFloat(og_profit)-sum).toFixed(2));
}

$(".item-cost").keyup(function() {
    var _this = $(this);
    var sum = 0.00;
    var num = _this.closest("tr").attr("data-count");


    $(".listing[data-count="+num+"] .item-cost").each(function(){
        sum += parseFloat(this.value);
    });

    if (!sum) {sum = 0.00;}

    $(".transaction[data-count="+num+"] .item_cost_div").html(sum);

    profit_update(num);
});

$(".shipping-cost").keyup(function() {
    _this = $(this);

    var num = _this.closest("tr").attr("data-count");
    profit_update(num);
});

$("#all-check").change(function() {
    if(this.checked) {
        $('.fee-checkbox').prop('checked',true);
    }else{
        $('.fee-checkbox').prop('checked',false);
    }
});

$(".fee-checkbox").change(function() {
    if(!$(".fee-checkbox:checked").length > 0) {
        $('#all-check').prop('checked',false);
    }
}); 