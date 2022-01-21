$(document).ready(function () {
    function a() {
        var a = { useEasing: !0, useGrouping: !0, separator: ",", decimal: "." },
            t = parseFloat($("input[name=sold_price]").val() || 0),
            n = parseFloat($("input[name=shipping_charge]").val() || 0),
            e = parseFloat($("input[name=shipping_cost]").val() || 0),
            i = parseFloat($("input[name=item_cost]").val() || 0),
            p = parseFloat($("select[name=paypal_method]").val() / 100),
            r = parseFloat($("input[name=item_tax]").val() / 100 || 0),
            s = 0,
            o = 0,
            l = t + n;
        if (l.toFixed(2) > 0) (s = parseFloat($("input[name=standard]").val() || 0)), (o = fees['fee_type']['platform_fees']['amount']/100);
        var u = i + e + (l * p + s + l * o);
        u < 0 && (u = 0);
        var d = (l - u).toFixed(2);
        if (d < 0) r = 0;
        var m = d - l * r,
            c = (m / u) * 100 || 0,
            v = (m / l) * 100 || 0;
        v < 0 && (v = 0), profit_c(m, c, v);
        var h = new CountUp("p-fees", 0, l * p + s, 2, 0.2, a),
            f = new CountUp("main-tax", 0, l * r, 2, 0.2, a),
            _ = new CountUp("main-fees", 0, l * o, 2, 0.2, a),
            g = new CountUp("main-return", 0, c, 2, 0.2, a),
            F = new CountUp("main-margin", 0, v, 2, 0.2, a),
            x = new CountUp("main-profit", 0, m, 2, 0.2, a);
        graph(t, n, e, i, f.endVal, h.endVal, 0, _.endVal, x.endVal), h.error ? console.error(paypal_fees.error) : (h.start(), _.start(), F.start(), g.start(), x.start(), f.start());
    }
    a(),
        $("#main-calculator")
            .children()
            .keyup(function () {
                a();
            }),
        $("button[name=p-reset]").click(function () {
            $("input[name=sold_price],input[name=shipping_charge],input[name=shipping_cost],input[name=item_cost],input[name=name]").val(null),
                $("input[name=item_tax]").val($("input[name=item_tax]").attr("id")),
                $("input[name=percent]").val(2.9),
                $("input[name=standard]").val(".30"),
                a();
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
                  a(),
                  $(".standard").slideUp());
        }),
        $("select").change(function () {
            $("input[name=percent]").val($("select[name=paypal_method]").find(":selected").val()), $("input[name=standard]").val(0.3), a();
        });
});
