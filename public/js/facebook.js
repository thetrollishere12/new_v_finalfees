$(document).ready(function () {
    function n() {
        var n = { useEasing: !0, useGrouping: !0, separator: ",", decimal: "." },
            a = parseFloat($("input[name=sold_price]").val() || 0),
            t = parseFloat($("input[name=shipping_charge]").val() || 0),
            e = parseFloat($("input[name=shipping_cost]").val() || 0),
            i = parseFloat($("input[name=item_cost]").val() || 0),
            r = parseFloat($("input[name=item_tax]").val() / 100 || 0),
            s = 0;
        "yes" == $("select[name=shipping_option]").val() && (a + t >= fees['fee_type']['platform_fees']['min_max']['max'] ? (s = fees['fee_type']['platform_fees']['amount']/100 * (a + t)) : a + t > 0 && a + t < fees['fee_type']['platform_fees']['min_max']['max'] && (s = fees['minimum'])), (p = a + t), (o = i + e + s), (u = p - o), u < 0 && (r = 0);
        var l = u - p * r,
            c = (l / o) * 100 || 0,
            m = (l / p) * 100 || 0;
        l < 0 && ((m = 0), (c = 0)), (m !== 1 / 0 && m !== -1 / 0) || (m = 0), (c !== 1 / 0 && c !== -1 / 0) || (c = 0), profit_c(l, c, m);
        var g = new CountUp("main-tax", 0, p * r, 2, fees['fee_type']['platform_fees']['amount'], n),
            h = new CountUp("main-fees", 0, s, 2, fees['fee_type']['platform_fees']['amount'], n),
            _ = new CountUp("main-return", 0, c, 2, fees['fee_type']['platform_fees']['amount'], n),
            v = new CountUp("main-margin", 0, m, 2, fees['fee_type']['platform_fees']['amount'], n),
            d = new CountUp("main-profit", 0, l, 2, fees['fee_type']['platform_fees']['amount'], n);
        graph(a, t, e, i, g.endVal, 0, 0, h.endVal, d.endVal), d.error ? console.error(d.error) : (v.start(), _.start(), d.start(), h.start(), g.start());
    }
    n(),
        $("select[name=shipping_option]").change(function () {
            "no" == $(this).val() ? ($(".shipping-container").slideUp(), $("input[name=shipping_charge]").val(""), $("input[name=shipping_cost]").val("")) : "yes" == $(this).val() && $(".shipping-container").slideDown();
        }),
        $("#main-calculator")
            .children()
            .keyup(function () {
                n();
            }),
        $("button[name=p-reset]").click(function () {
            $("input[name=sold_price],input[name=shipping_charge],input[name=shipping_cost],input[name=item_cost],input[name=name]").val(null), $("input[name=item_tax]").val($("input[name=item_tax]").attr("id")), n();
        }),
        $("select").change(function () {
            n();
        });
});
