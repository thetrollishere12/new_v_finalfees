$(document).ready(function () {
    function t() {
        var t = { useEasing: !0, useGrouping: !0, separator: ",", decimal: "." },
            n = parseFloat($("input[name=sold_price]").val() || 0),
            a = $("input[name=percent]").val() / 100,
            e = parseFloat($("input[name=item_tax]").val() / 100 || 0),
            i = 0,
            r = 0;
        if (n.toFixed(2) > 0) (i = parseFloat($("input[name=standard]").val() || 0)), (r = 0.2);
        var p = n * a + i,
            o = n * r + p;
        o < 0 && (o = 0);
        var s = (n - o).toFixed(2);
        if (s < 0) e = 0;
        var d = s - n * e,
            u = (d / o) * 100 || 0,
            l = (d / n) * 100 || 0;
        d < 0 && ((l = 0), (u = 0)), (l !== 1 / 0 && l !== -1 / 0) || (l = 0), (u !== 1 / 0 && u !== -1 / 0) || (u = 0), profit_c(d, u, l);
        var m = new CountUp("p-fees", 0, p, 2, 0.2, t),
            c = new CountUp("main-tax", 0, n * e, 2, 0.2, t),
            f = new CountUp("main-fees", 0, n * r, 2, 0.2, t),
            v = new CountUp("main-return", 0, u, 2, 0.2, t),
            h = new CountUp("main-margin", 0, l, 2, 0.2, t),
            x = new CountUp("main-profit", 0, d, 2, 0.2, t);
        graph(n, 0, 0, 0, c.endVal, m.endVal, 0, f.endVal, x.endVal), x.error ? console.error(x.error) : (h.start(), v.start(), x.start(), f.start(), m.start(), c.start());
    }
    t(),
        $("#main-calculator")
            .children()
            .keyup(function () {
                t();
            }),
        $("button[name=p-reset]").click(function () {
            $("input[name=sold_price],input[name=name]").val(null), $("input[name=item_tax]").val($("input[name=item_tax]").attr("id")), $("input[name=percent]").val(2.9), $("input[name=standard]").val(".30"), t();
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
        });
});
