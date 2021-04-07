var selected_id;

function search_loaihinh() {
    /*** Get input ***/
    var name_loaihinh = $("#name_loaihinh").val();

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
        { title: "Tên loại hình", field: "ten", hozAlign: "center" },
        { title: "Loại hình tổng quát", field: "ten_parent", hozAlign: "center" },
        { title: "Mã loại hình", field: "code", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-loaihinh.php", {
        "name_loaihinh": name_loaihinh,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#loaihinh_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#loaihinh_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    var parent = row._row.data.parent_id;
                    window.open("../services/danhmuc/form-loaihinh.php?ma=" + index + "&parent=" + parent, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-loaihinh.php",
                ajaxParams: {
                    "name_loaihinh": name_loaihinh,
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
            $("#loaihinh_table").css("border-top", "none");
            table = new Tabulator("#loaihinh_table", {
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

$("#search_loaihinh").click(function() {
    updateScroll()
    search_loaihinh();
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
    { title: "Tên loại hình", field: "ten", hozAlign: "center" },
    { title: "Loại hình tổng quát", field: "ten_parent", hozAlign: "center" },
    { title: "Mã loại hình", field: "code", hozAlign: "center" },
]

$("#loaihinh_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#loaihinh_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        var parent = row._row.data.parent_id;
        window.open("../services/danhmuc/form-loaihinh.php?ma=" + index + "&parent=" + parent, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-loaihinh.php",
    ajaxParams: {
        "name_loaihinh": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Loại hình ***/
$("#delete_loaihinh").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn loại hình cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các loại hình đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-loaihinh.php", {
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

/*** Thêm Loại hình ***/
$("#create_loaihinh").click(function() {
    location.href = "../services/danhmuc/form-loaihinh.php";
})
/*** Xuất Excel ***/
$("#export_loaihinh").click(function () {
    var name_loaihinh = $("#name_loaihinh").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-loaihinh.php", {
        "name_loaihinh": name_loaihinh,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên loại hình", C: "Mã loại tổng quát", D: "Loại hình tổng quát",
                E: "Mã loại hình"
            }], {
                header: ["A", "B", "C", "D", "E"],
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
                {width: 50},
                {width: 50},
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'loaihinh.xlsx')
        }
    })
})