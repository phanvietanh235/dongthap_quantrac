var selected_id;

function search_type_loc() {
    /*** Get input ***/
    var name_type_loc = $("#name_type_loc").val();

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
        { title: "Loại địa danh", field: "ten", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-type-loc.php", {
        "name_type_loc": name_type_loc,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#type_loc_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#type_loc_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-type-loc.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-type-loc.php",
                ajaxParams: {
                    "name_type_loc": name_type_loc,
                },
                ajaxConfig: "post",
                layout: "fitDataStretch",
                /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
                columns: columns_title
            })
            table.setData();
            table.setLocale("vi");
        } else {
            $("#type_loc_table").css("border-top", "none");
            table = new Tabulator("#type_loc_table", {
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

$("#search_type_loc").click(function() {
    updateScroll()
    search_type_loc();
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
    { title: "Loại địa danh", field: "ten", hozAlign: "center" },
]

$("#type_loc_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#type_loc_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-type-loc.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-type-loc.php",
    ajaxParams: {
        "name_type_loc": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Loại địa danh ***/
$("#delete_type_loc").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn loại địa danh cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các loại địa danh đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-type-loc.php", {
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

/*** Thêm Loại địa danh ***/
$("#create_type_loc").click(function() {
    location.href = "../services/danhmuc/form-type-loc.php";
})

/*** Xuất Excel ***/
$("#export_type_loc").click(function () {
    var name_type_loc = $("#name_type_loc").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-type-loc.php", {
        "name_type_loc": name_type_loc,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên địa danh"
            }], {
                header: ["A", "B"],
                skipHeader: true
            });

            var results = XLSX.utils.sheet_add_json(ws, data, {
                skipHeader: true,
                origin: "A2",
            })

            /*---- Độ rộng cho từng cột ----*/
            var wscols = [
                {width: 50},
                {width: 50}
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'loaidiadanh.xlsx')
        }
    })
})

