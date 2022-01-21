$(document).ready(function () {
    function t() {
        var t = { useEasing: !0, useGrouping: !0, separator: ",", decimal: "." },
            n = parseFloat($("input[name=sold_price]").val() || 0),
            a = parseFloat($("input[name=shipping_charge]").val() || 0),
            e = parseFloat($("input[name=shipping_cost]").val() || 0),
            i = parseFloat($("input[name=item_cost]").val() || 0),
            p = $("input[name=percent]").val() / 100,
            r = parseFloat($("input[name=item_tax]").val() / 100 || 0),
            s = 0,
            o = n + a;
        o.toFixed(2) > 0 && (s = parseFloat($("input[name=standard]").val() || 0));
        var u = i + e + (o * p + s + fees['fee_type']['platform_fees']['amount']/100 * o);
        u < 0 && (u = 0);
        var l = (o - u).toFixed(2);
        if (l < 0) r = 0;
        var d = l - o * r,
            c = (d / u) * 100 || 0,
            m = (d / o) * 100 || 0;
        d < 0 && ((m = 0), (c = 0)), (m !== 1 / 0 && m !== -1 / 0) || (m = 0), (c !== 1 / 0 && c !== -1 / 0) || (c = 0), profit_c(d, c, m);
        var h = new CountUp("p-fees", 0, o * p + s, 2, 0.2, t),
            v = new CountUp("main-tax", 0, o * r, 2, 0.2, t),
            f = new CountUp("main-fees", 0, 0.1 * o, 2, 0.2, t),
            _ = new CountUp("main-return", 0, c, 2, 0.2, t),
            g = new CountUp("main-margin", 0, m, 2, 0.2, t),
            F = new CountUp("main-profit", 0, d, 2, 0.2, t);
        graph(n, a, e, i, v.endVal, h.endVal, 0, f.endVal, F.endVal), h.error ? console.error(h.error) : (h.start(), f.start(), _.start(), g.start(), F.start(), v.start());
    }
    t(),
        $("#main-calculator")
            .children()
            .keyup(function () {
                t();
            }),
        $("button[name=p-reset]").click(function () {
            $("input[name=sold_price],input[name=shipping_charge],input[name=shipping_cost],input[name=item_cost],input[name=name]").val(null),
                $("input[name=item_tax]").val($("input[name=item_tax]").attr("id")),
                $("input[name=percent]").val(2.9),
                $("input[name=standard]").val(".30"),
                t();
        }),
        $("button[name=p-edit]").click(function () {
            "Edit Fees" == $(this).text()
                ? ($(".standard input").each(function () {
                      $(this).prop("disabled", !1);
                  }),
                  $(".standard").slideDown(),
                  $(this).text("Done Edit"))
                : ($(".standard input").each(function () {
                      $(this).prop("disabled", !0);
                  }),
                  $(this).text("Edit Fees"),
                  t(),
                  $(".standard").slideUp());
        }),
        $("select").change(function () {
            t();
        });
});
