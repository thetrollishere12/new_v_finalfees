function refund(a,e,n){null!=window.myChart&&window.myChart.destroy(),window.myChart=new Chart($("#barchart"),{type:"bar",data:{labels:["Total Refunded","Rebate Fees","Rebate Tax"],datasets:[{label:"Total Refunded",data:[a],backgroundColor:"#007bff"},{label:"Rebate Fees",data:[0,e],backgroundColor:"#ffc107"},{label:"Rebate Tax",data:[0,0,n],backgroundColor:"#4caf50"}]},options:{response:!1,legend:{display:!1},scales:{xAxes:[{stacked:!0}],yAxes:[{stacked:!0}]}}})}$(document).ready(function(){function a(){parseFloat($("input[name=name]").val()||0);refund(parseFloat($("input[name=refund]").val()||0),parseFloat($("input[name=fees]").val()||0),parseFloat($("input[name=tax]").val()||0))}a(),$("#main-calculator").children().keyup(function(){a()}),$("button[name=p-reset]").click(function(){$("input[name=name],input[name=refund],input[name=fees],input[name=tax]").val(null),a()})}),refund();