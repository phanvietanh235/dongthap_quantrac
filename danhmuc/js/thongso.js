var selected_id;

function search_thongso() {
    /*** Get input ***/
    var name_thongso = $("#name_thongso").val();

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
        { title: "Tên thông số", field: "ten", hozAlign: "center" },
        { title: "Mã thông số", field: "code", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-thongso.php", {
        "name_thongso": name_thongso,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#thongso_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#thongso_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-thongso.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-thongso.php",
                ajaxParams: {
                    "name_thongso": name_thongso,
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
            $("#thongso_table").css("border-top", "none");
            table = new Tabulator("#thongso_table", {
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

$("#search_thongso").click(function() {
    updateScroll()
    search_thongso();
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
    { title: "Tên thông số", field: "ten", hozAlign: "center" },
    { title: "Mã thông số", field: "code", hozAlign: "center" },
]

$("#thongso_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#thongso_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-thongso.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-thongso.php",
    ajaxParams: {
        "name_thongso": '',
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

/*** Xóa Thông số ***/
$("#delete_thongso").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn thông số cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các thông số đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-thongso.php", {
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

/*** Thêm Thông số ***/
$("#create_thongso").click(function() {
    location.href = "../services/danhmuc/form-thongso.php";
})
/*** Xuất Excel ***/
$("#export_thongso").click(function () {
    var name_thongso = $("#name_thongso").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-thongso.php", {
        "name_thongso": name_thongso,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Mã thông số", C: "Tên thông số"
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
                {width: 50},
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'thongso.xlsx')
        }
    })
})