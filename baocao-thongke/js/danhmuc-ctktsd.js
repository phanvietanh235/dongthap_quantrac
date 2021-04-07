var table;
var columns_title = [
    { title: "STT", formatter: "rownum", frozen: true },
    {
        title: "Tên công trình",
        columns: [
            { title: "(1)", field: "tencongtrinh", hozAlign: "center", formatter: "textarea", width: 300 }
        ],
        frozen: true
    },
    {
        title: "Loại hình công trình (hồ, đập, cống, trạm bơm, giếng khoan, khác)",
        columns: [
            { title: "(2)", field: "type_congtrinh", hozAlign: "center", width: 390 }
        ]
    },
    {
        title: "Nguồn nước khai thác (sông, suối, hồ, đập, nước dưới đất)",
        columns: [
            { title: "(3)", field: "basin_waterfloor", hozAlign: "center", width: 365 }
        ]
    },
    {
        title: "Vị trí",
        columns: [
            { title: "Xã", columns: [{ title: "(4)", field: "xa", hozAlign: "center", /* width: 50 */ }] },
            { title: "Huyện", columns: [{ title: "(5)", field: "huyen", hozAlign: "center", /* width: 50 */ }] },
            { title: "Tỉnh", columns: [{ title: "(6)", field: "tinh", hozAlign: "center", /* width: 50 */ }] }
        ]
    },
    {
        title: "Thông số cơ bản",
        columns: [{
                title: "Hồ chứa, đập",
                columns: [{
                        title: "Dung tích toàn bộ (triệu m³)",
                        columns: [{ title: "(7)", field: "", hozAlign: "center", width: 180 }]
                    },
                    {
                        title: "Dung tích hữu ích (triệu m³)",
                        columns: [{ title: "(8)", field: "", hozAlign: "center", width: 180 }]
                    },
                    {
                        title: "Công suất (MW)",
                        columns: [{ title: "(9)", field: "", hozAlign: "center", width: 150 }]
                    }
                ]
            },
            {
                title: "Giếng khoan và loại hình khác",
                columns: [{
                        title: "Lưu lượng thiết kế (m³/ngày)",
                        columns: [{ title: "(10)", field: "", hozAlign: "center", width: 180 }]
                    },
                    {
                        title: "Lưu lượng thực tế (m³/ngày)",
                        columns: [{ title: "(11)", field: "", hozAlign: "center", width: 180 }]
                    }
                ]
            }
        ]
    },
];

/*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
var response_post = $.post("../services/danhmuc-ctktsd.php")

response_post.done(function(data) {
    if (data.length != 0) {
        $("#danhmuc_ctkt_table").css("border-top", "1px solid #dee2e6");
        table = new Tabulator("#danhmuc_ctkt_table", {
            ajaxURL: "../services/danhmuc-ctktsd.php",
            ajaxConfig: "post",
            pagination: "local",
            paginationSize: 10,
            columnVertAlign: "middle",
            height: 630,
            columns: columns_title,
            langs: {
                "vi": {
                    "pagination": {
                        "first": "<",
                        "first_title": "Trang đầu",
                        "last": ">",
                        "last_title": "Trang cuối",
                        "prev": "Trước",
                        "prev_title": "Trang trước",
                        "next": "Sau",
                        "next_title": "Trang sau",
                    }
                }
            }
        })
        table.setData();
        table.setLocale("vi");
    } else {
        $("#danhmuc_ctkt_table").css("border-top", "none");
        table = new Tabulator("#danhmuc_ctkt_table", {
            height: "70px",
            placeholder: "<p class='text-danger text-bold font-size-14'>" +
                "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
        })
    }
})
