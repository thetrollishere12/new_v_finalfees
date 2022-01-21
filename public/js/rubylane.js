$(document).ready(function () {
    function n() {
        var n = { useEasing: !0, useGrouping: !0, separator: ",", decimal: "." },
            a = parseFloat($("input[name=sold_price]").val() || 0),
            t = parseFloat($("input[name=shipping_charge]").val() || 0),
            e = parseFloat($("input[name=shipping_cost]").val() || 0),
            i = parseFloat($("input[name=item_cost]").val() || 0),
            r = parseFloat($("input[name=item_tax]").val() / 100 || 0),
            p = a + t,
            o = fees['fee_type']['platform_fees']['amount']/100 * (a + t),
            u = p - o;
        u < 0 && (r = 0);
        var m = u - p * r,
            s = (m / o) * 100 || 0,
            l = (m / p) * 100 || 0;
        m < 0 && ((l = 0), (s = 0)), (l !== 1 / 0 && l !== -1 / 0) || (l = 0), (s !== 1 / 0 && s !== -1 / 0) || (s = 0), profit_c(m, s, l);
        var c = new CountUp("main-tax", 0, p * r, 2, 0.2, n),
            _ = new CountUp("main-fees", 0, o, 2, 0.2, n),
            g = new CountUp("main-return", 0, s, 2, 0.2, n),
            d = new CountUp("main-margin", 0, l, 2, 0.2, n),
            v = new CountUp("main-profit", 0, m, 2, 0.2, n);
        graph(a, t, e, i, c.endVal, 0, 0, _.endVal, v.endVal), v.error ? console.error(v.error) : (d.start(), g.start(), v.start(), _.start(), c.start());
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
