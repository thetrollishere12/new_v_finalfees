$(document).ready(function () {
    function t() {
        var t = { useEasing: !0, useGrouping: !0, separator: ",", decimal: "." },
            a = parseFloat($("input[name=sold_price]").val() || 0),
            n = parseFloat($("input[name=item_cost]").val() || 0),
            e = parseFloat($("input[name=item_tax]").val() / 100 || 0),
            i = 0;
        if (a.toFixed(2) > 0)
            if (a <= fees['fee_type']['platform_fees']['min_max']['min']) i = fees['minimum'];
            else i = fees['fee_type']['platform_fees']['amount']/100 * a;
        var r = n + i;
        r < 0 && (r = 0);
        var o = (a - r).toFixed(2);
        if (o < 0) e = 0;
        var u = o - a * e,
            p = (u / r) * 100 || 0,
            l = (u / a) * 100 || 0;
        u < 0 && ((l = 0), (p = 0)), (l !== 1 / 0 && l !== -1 / 0) || (l = 0), (p !== 1 / 0 && p !== -1 / 0) || (p = 0), profit_c(u, p, l);
        var m = new CountUp("main-fees", 0, i, 2, 0.2, t),
            s = new CountUp("main-return", 0, p, 2, 0.2, t),
            c = new CountUp("main-margin", 0, l, 2, 0.2, t),
            d = new CountUp("main-profit", 0, u, 2, 0.2, t),
            f = new CountUp("main-tax", 0, a * e, 2, 0.2, t);
        graph(a, 0, 0, n, f.endVal, 0, 0, m.endVal, d.endVal), d.error ? console.error(d.error) : (c.start(), s.start(), d.start(), m.start(), f.start());
    }
    t(),
        $("#main-calculator")
            .children()
            .keyup(function () {
                t();
            }),
        $("button[name=p-reset]").click(function () {
            $("input[name=sold_price],input[name=item_cost]").val(null), $("input[name=item_tax]").val($("input[name=item_tax]").attr("id")), t();
        });
});
