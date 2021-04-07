var table;
var columns_title = [
    { title: "STT", formatter: "rownum", frozen: true },
    { title: "Loại giấy phép", field: "loaigiayphep", hozAlign: "center", frozen: true, width: 350 },
    {
        title: "Tổng số giấy phép đã cấp",
        columns: [
            { title: "Lũy kế đến kỳ trước", columns: [{ title: "(1)", width: 150 }] },
            { title: "Lũy kế đến kỳ báo cáo", columns: [{ title: "(2)", width: 150, field: "count", hozAlign: "center" }] },
            { title: "Thay đổi", columns: [{ title: "(3) = (2) - (1)" }] },
        ],
    },
    {
        title: "Tổng số giấy phép cấp phân theo thẩm quyền",
        columns: [{
                title: "Bộ TNMT phê duyệt",
                columns: [
                    { title: "Lũy kế đến kỳ trước", columns: [{ title: "(4)", width: 150 }] },
                    { title: "Lũy kế đến kỳ báo cáo", columns: [{ title: "(5)", width: 150, field: "count_tw", hozAlign: "center" }] },
                    { title: "Thay đổi", columns: [{ title: "(6) = (5) - (4)" }] },
                ]
            },
            {
                title: "Địa phương phê duyệt",
                columns: [
                    { title: "Lũy kế đến kỳ trước", columns: [{ title: "(7)", width: 150 }] },
                    { title: "Lũy kế đến kỳ báo cáo", columns: [{ title: "(8)", width: 150, field: "count_dp", hozAlign: "center" }] },
                    { title: "Thay đổi", columns: [{ title: "(9) = (8) - (7)" }] },
                ]
            }
        ],
    }
]

/*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
var response_post = $.post("../services/gp-dacap.php")

response_post.done(function(data) {
    if (data.length != 0) {
        $("#gp_dacap_table").css("border-top", "1px solid #dee2e6");
        table = new Tabulator("#gp_dacap_table", {
            ajaxURL: "../services/gp-dacap.php",
            ajaxConfig: "post",
            columnVertAlign: "middle",
            columns: columns_title,
        })
        table.setData();
    } else {
        $("#gp_dacap_table").css("border-top", "none");
        table = new Tabulator("#gp_dacap_table", {
            height: "70px",
            placeholder: "<p class='text-danger text-bold font-size-14'>" +
                "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
        })
    }
})
