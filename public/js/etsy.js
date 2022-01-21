$(document).ready(function () {
    function t() {
        var t = { useEasing: !0, useGrouping: !0, separator: ",", decimal: "." },
            a = parseFloat($("input[name=sold_price]").val() || 0),
            e = parseFloat($("input[name=shipping_charge]").val() || 0),
            n = parseFloat($("input[name=shipping_cost]").val() || 0),
            i = parseFloat($("input[name=item_cost]").val() || 0),
            p = parseFloat($("input[name=ad_cost]").val() || 0),
            r = $("input[name=percent]").val() / 100,
            s = parseFloat($("input[name=item_tax]").val() / 100 || 0),
            l = 0,
            o = 0,
            u = 0,
            c = a + e;
        if (c.toFixed(2) > 0) {
            l = parseFloat($("input[name=standard]").val() || 0);
            (o = fees['fee_type']['listing_fees']['amount']), (u = fees['fee_type']['platform_fees']['amount']/100);
        }
        var d = i + p + n + (c * r + l + c * u) + o;
        d < 0 && (d = 0);
        var m = (c - d).toFixed(2);
        if (m < 0) s = 0;
        var v = m - c * s,
            _ = (v / d) * 100 || 0,
            f = (v / c) * 100 || 0;
        v < 0 && ((f = 0), (_ = 0)), (f !== 1 / 0 && f !== -1 / 0) || (f = 0), (_ !== 1 / 0 && _ !== -1 / 0) || (_ = 0), profit_c(v, _, f);
        var h = new CountUp("p-fees", 0, c * r + l, 2, fees['fee_type']['listing_fees']['amount'], t),
            F = new CountUp("main-tax", 0, c * s, 2, fees['fee_type']['listing_fees']['amount'], t),
            g = new CountUp("main-fees", 0, c * u + o + p, 2, fees['fee_type']['listing_fees']['amount'], t),
            x = new CountUp("main-return", 0, _, 2, fees['fee_type']['listing_fees']['amount'], t),
            y = new CountUp("main-margin", 0, f, 2, fees['fee_type']['listing_fees']['amount'], t),
            w = new CountUp("main-profit", 0, v, 2, fees['fee_type']['listing_fees']['amount'], t);
        graph(a, e, n, i, F.endVal, 0, h.endVal, g.endVal, w.endVal), h.error ? console.error(h.error) : (h.start(), g.start(), y.start(), x.start(), w.start(), F.start());
    }
    t(),
        $("#main-calculator")
            .children()
            .keyup(function () {
                t();
            }),
        $("button[name=p-reset]").click(function () {
            $("input[name=sold_price],input[name=shipping_charge],input[name=shipping_cost],input[name=item_cost],input[name=ad_cost],input[name=name]").val(null),
                $("input[name=item_tax]").val($("input[name=item_tax]").attr("id")),
                $("select[name=etsy_payment]").val(1);
            var a = $("select[name=etsy_payment]").find(":selected").text().split("+");
            $("input[name=percent]").val(parseFloat(a[0].replace("%", ""))), $("input[name=standard]").val(parseFloat(a[1].replace("$", ""))), t();
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
            var a = $("select[name=etsy_payment]").find(":selected").text().split("+");
            $("input[name=percent]").val(parseFloat(a[0].replace("%", ""))), $("input[name=standard]").val(parseFloat(a[1].replace("$", ""))), t();
        });
});
