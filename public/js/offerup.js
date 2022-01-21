$(document).ready(function () {
    function n() {
        var n = { useEasing: !0, useGrouping: !0, separator: ",", decimal: "." },
            a = parseFloat($("input[name=sold_price]").val() || 0),
            t = parseFloat($("input[name=shipping_charge]").val() || 0),
            e = parseFloat($("input[name=shipping_cost]").val() || 0),
            i = parseFloat($("input[name=item_cost]").val() || 0),
            r = parseFloat($("input[name=item_tax]").val() / 100 || 0),
            p = a + t;
        if ("no" == $("select[name=local_sold]").val()) {
            if (((o = i + e + fees['fee_type']['platform_fees']['amount']/100 * (p + t)) < fees['minimum'] && (o = fees['minimum']), (l = p - o) < 0)) r = 0;
        } else {
            var o, l;
            if ((l = p - (o = i + e)) < 0) r = 0;
        }
        var s = l - p * r,
            u = (s / o) * 100 || 0,
            m = (s / p) * 100 || 0;
        s < 0 && ((m = 0), (u = 0)), (m !== 1 / 0 && m !== -1 / 0) || (m = 0), (u !== 1 / 0 && u !== -1 / 0) || (u = 0), profit_c(s, u, m);
        var c = new CountUp("main-tax", 0, p * r, 2, 0.2, n),
            _ = new CountUp("main-fees", 0, o, 2, 0.2, n),
            v = new CountUp("main-return", 0, u, 2, 0.2, n),
            d = new CountUp("main-margin", 0, m, 2, 0.2, n),
            f = new CountUp("main-profit", 0, s, 2, 0.2, n);
        graph(a, 0, 0, i, c.endVal, 0, 0, _.endVal, f.endVal), f.error ? console.error(f.error) : (d.start(), v.start(), f.start(), _.start(), c.start());
    }
    n(),
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