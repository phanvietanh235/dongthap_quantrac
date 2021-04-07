var selected_id;

function search_loaitram() {
    /*** Get input ***/
    var name_loaitram = $("#name_loaitram").val();

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
        { title: "Tên loại trạm", field: "ten", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-loaitram.php", {
        "name_loaitram": name_loaitram,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#loaitram_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#loaitram_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-loaitram.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-loaitram.php",
                ajaxParams: {
                    "name_loaitram": name_loaitram,
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
            $("#loaitram_table").css("border-top", "none");
            table = new Tabulator("#loaitram_table", {
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

$("#search_loaitram").click(function() {
    updateScroll()
    search_loaitram();
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
    { title: "Tên loại trạm", field: "ten", hozAlign: "center" },
]

$("#loaitram_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#loaitram_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-loaitram.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-loaitram.php",
    ajaxParams: {
        "name_loaitram": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Loại trạm ***/
$("#delete_loaitram").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn loại trạm cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các loại trạm đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-loaitram.php", {
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

/*** Thêm Loại trạm ***/
$("#create_loaitram").click(function() {
    location.href = "../services/danhmuc/form-loaitram.php";
})
/*** Xuất Excel ***/
$("#export_loaitram").click(function () {
    var name_loaitram = $("#name_loaitram").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-loaitram.php", {
        "name_loaitram": name_loaitram,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên loại trạm"
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
                {width: 50},
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'loaitram.xlsx')
        }
    })
})