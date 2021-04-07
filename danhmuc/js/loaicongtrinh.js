var selected_id;

function search_loaict() {
    /*** Get input ***/
    var name_loaict = $("#name_loaict").val();

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
        { title: "Tên loại công trình", field: "ten", hozAlign: "center" },
        { title: "Mã code", field: "code_loaict", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-loaict.php", {
        "name_loaict": name_loaict,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#loaict_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#loaict_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-loaict.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-loaict.php",
                ajaxParams: {
                    "name_loaict": name_loaict,
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
            $("#loaict_table").css("border-top", "none");
            table = new Tabulator("#loaict_table", {
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

$("#search_loaict").click(function() {
    updateScroll()
    search_loaict();
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
    { title: "Tên loại công trình", field: "ten", hozAlign: "center" },
    { title: "Mã code", field: "code_loaict", hozAlign: "center" },
]

$("#loaict_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#loaict_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-loaict.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-loaict.php",
    ajaxParams: {
        "name_loaict": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Loại công trình ***/
$("#delete_loaict").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn loại công trình cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các loại công trình đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-loaict.php", {
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

/*** Thêm Loại công trình ***/
$("#create_loaict").click(function() {
    location.href = "../services/danhmuc/form-loaict.php";
})

/*** Xuất Excel ***/
$("#export_loaict").click(function () {
    var name_loaict = $("#name_loaict").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-loaict.php", {
        "name_loaict": name_loaict,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên loại công trình", C: "Mã code"
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
            XLSX.writeFile(wb, 'loaicongtrinh.xlsx')
        }
    })
})
