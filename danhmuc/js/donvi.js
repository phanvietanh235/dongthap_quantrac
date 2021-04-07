var selected_id;

function search_donvi() {
    /*** Get input ***/
    var name_donvi = $("#name_donvi").val();

    /*** DOM Table using Tabulator ***/
    var table;
    var columns_title = [{
            formatter: "rowSelection",
            titleFormatter: "rowSelection",
            hozAlign: "center",
            headerSort: false,
            frozen: true,
            cellClick: function(e, cell) {
                cell.getRow().toggleSelect();
            }
        },
        { title: "#", formatter: "rownum", frozen: true },
        { title: "Tên đơn vị", field: "ten", hozAlign: "center" },
        { title: "Mã đơn vị", field: "code", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-donvi.php", {
        "name_donvi": name_donvi,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#donvi_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#donvi_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-donvi.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-donvi.php",
                ajaxParams: {
                    "name_donvi": name_donvi,
                },
                ajaxConfig: "post",
                pagination: "local",
                paginationSize: 10,
                layout: "fitDataStretch",
                /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
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
            $("#donvi_table").css("border-top", "none");
            table = new Tabulator("#donvi_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            })
        }
    })
}

function updateScroll() {
    $('html,body').animate({ scrollTop: 330 });
}

$("#search_donvi").click(function() {
    updateScroll()
    search_donvi();
})

/*---- Render Table First ----*/
var table;
var columns_title = [{
        formatter: "rowSelection",
        titleFormatter: "rowSelection",
        hozAlign: "center",
        headerSort: false,
        frozen: true,
        cellClick: function(e, cell) {
            cell.getRow().toggleSelect();
        }
    },
    { title: "#", formatter: "rownum", frozen: true },
    { title: "Tên đơn vị", field: "ten", hozAlign: "center" },
    { title: "Mã đơn vị", field: "code", hozAlign: "center" },
]

$("#donvi_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#donvi_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-donvi.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-donvi.php",
    ajaxParams: {
        "name_donvi": '',
    },
    ajaxConfig: "post",
    pagination: "local",
    paginationSize: 10,
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
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

/*** Xóa đơn vị ***/
$("#delete_donvi").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn đơn vị cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các đơn vị đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-donvi.php", {
                "ma": ma
            }).done(function(data) {
                if (data != "error") {
                    location.reload();
                }
            })
        } else {
            console.log("No rows deleted")
        }
    }
})

/*** Thêm đơn vị ***/
$("#create_donvi").click(function() {
    location.href = "../services/danhmuc/form-donvi.php";
})

/*** Xuất Excel ***/
$("#export_donvi").click(function () {
    var name_donvi = $("#name_donvi").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-donvi.php", {
        "name_donvi": name_donvi,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Mã code", C: "Tên đơn vị"
            }], {
                header: ["A", "B", "C"],
                skipHeader: true
            });

            var results = XLSX.utils.sheet_add_json(ws, data, {
                skipHeader: true,
                origin: "A2",
            })

            /*---- Độ rộng cho từng cột ----*/
            var wscols = [
                {width: 50},
                {width: 50},
                {width: 50}
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'donvi.xlsx')
        }
    })
})
