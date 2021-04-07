var selected_id;

function search_dvql() {
    /*** Get input ***/
    var name_dvql = $("#name_dvql").val();

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
        { title: "Mô tả", field: "mota", hozAlign: "center" }
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-dvql.php", {
        "name_dvql": name_dvql,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#dvql_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#dvql_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-dvql.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-dvql.php",
                ajaxParams: {
                    "name_dvql": name_dvql,
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
            $("#dvql_table").css("border-top", "none");
            table = new Tabulator("#dvql_table", {
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

$("#search_dvql").click(function() {
    updateScroll()
    search_dvql();
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
    { title: "Mô tả", field: "mota", hozAlign: "center" },
]

$("#dvql_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#dvql_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-dvql.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-dvql.php",
    ajaxParams: {
        "name_dvql": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Đơn vị quản lý ***/
$("#delete_dvql").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn đơn vị quản lý cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các đơn vị quản lý đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-dvql.php", {
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

/*** Thêm Đơn vị quản lý ***/
$("#create_dvql").click(function() {
    location.href = "../services/danhmuc/form-dvql.php";
})

/*** Xuất Excel ***/
$("#export_dvql").click(function () {
    var name_dvql = $("#name_dvql").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-dvql.php", {
        "name_dvql": name_dvql,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên đơn vị", C: "Mô tả"
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
            XLSX.writeFile(wb, 'donvi_quanly.xlsx')
        }
    })
})
