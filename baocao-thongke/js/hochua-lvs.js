var table;
var columns_title = [{
        title: "STT",
        frozen: true,
        hozAlign: "center",
        formatter: "rownum"
    },
    {
        title: "Lưu vực sông",
        frozen: true,
        columns: [{
            title: "(1)",
            field: "name",
            hozAlign: "center",
            width: 400
        }, ],
    },
    {
        title: "Số lượng hồ chứa tổng hợp",
        frozen: true,
        columns: [{
            title: "(2)",
            hozAlign: "center",
            width: 250
        }, ],
    },
    {
        title: "Tổng dung tích",
        columns: [{
                title: "Toàn bộ (triệu m³)",
                columns: [{
                    title: "(3)",
                    field: "toanbo",
                    hozAlign: "center",
                    width: 250
                }, ],
            },
            {
                title: "Hữu ích (triệu m³)",
                columns: [{
                    title: "(4)",
                    field: "huuich",
                    hozAlign: "center",
                    width: 250
                }, ],
            },
            {
                title: "Phòng lũ (triệu m³)",
                columns: [{
                    title: "(5)",
                    hozAlign: "center",
                    width: 250
                }, ],
            },
            {
                title: "Tích được vào cuối mùa lũ, đầu mùa cạn (triệu m³)",
                columns: [{
                    title: "(6)",
                    hozAlign: "center",
                    width: 250
                }, ],
            }
        ],
    }
];

/*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
var response_post = $.post("../services/hochua-lvs.php")

response_post.done(function(data) {
    if (data.length != 0) {
        $("#hochua_lvs_table").css("border-top", "1px solid #dee2e6");
        table = new Tabulator("#hochua_lvs_table", {
            ajaxURL: "../services/hochua-lvs.php",
            ajaxConfig: "post",
            pagination: "local",
            paginationSize: 9,
            columnVertAlign: "middle",
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
        $("#hochua_lvs_table").css("border-top", "none");
        table = new Tabulator("#hochua_lvs_table", {
            height: "70px",
            placeholder: "<p class='text-danger text-bold font-size-14'>" +
                "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
        })
    }
})
