$(document).ready(function () {
    function a() {
        var a = { useEasing: !0, useGrouping: !0, separator: ",", decimal: "." },
            t = parseFloat($("input[name=sold_price]").val() || 0),
            n = parseFloat($("input[name=item_cost]").val() || 0),
            e = parseFloat($("input[name=shipping_cost]").val() || 0),
            i = parseFloat($("input[name=item_tax]").val() / 100 || 0),
            r = parseFloat($("input[name=item_tax_fee]").val() / 100 || 0),
            o = parseFloat($("input[name=discount_amount]").val() || 0),
            p = $("select[name=country]").val(),
            u = 0;
        t.toFixed(2) > 0 && (u = t < 20 ? p : fees['fee_type']['platform_fees']['amount']/100 * (t - o));
        var l = n + u + e + o,
            m = (t - l).toFixed(2);
        l < 0 && (l = 0), m < 0 && (i = 0), (tax_fee = parseFloat(u * r) || 0);
        var s = m - t * i - tax_fee,
            c = (s / l) * 100 || 0,
            _ = (s / t) * 100 || 0;
        s < 0 && ((_ = 0), (c = 0)), (_ !== 1 / 0 && _ !== -1 / 0) || (_ = 0), (c !== 1 / 0 && c !== -1 / 0) || (c = 0), profit_c(s, c, _);
        var d = new CountUp("main-tax", 0, t * i + tax_fee, 2, fees['fee_type']['platform_fees']['amount']/100, a),
            v = new CountUp("main-fees", 0, u, 2, fees['fee_type']['platform_fees']['amount']/100, a),
            f = new CountUp("main-return", 0, c, 2, fees['fee_type']['platform_fees']['amount']/100, a),
            x = new CountUp("main-margin", 0, _, 2, fees['fee_type']['platform_fees']['amount']/100, a),
            F = new CountUp("main-profit", 0, s, 2, fees['fee_type']['platform_fees']['amount']/100, a);
        graph(t, 0, e, n, d.endVal, 0, 0, v.endVal, F.endVal), F.error ? console.error(F.error) : (x.start(), f.start(), F.start(), v.start(), d.start());
    }
    a(),
        $("#main-calculator")
            .children()
            .keyup(function () {
                a();
            }),
        $("button[name=p-reset]").click(function () {
            $("input[name=sold_price],input[name=item_cost],input[name=shipping_cost],input[name=name]").val(null), $("input[name=item_tax]").val($("input[name=item_tax]").attr("id")), a();
        }),
        $("select").change(function () {
            a();
        });
});
