var selected_id;

function search_loaigp() {
    /*** Get input ***/
    var name_loaigp = $("#name_loaigp").val();

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
        { title: "Tên loại giấy phép", field: "ten", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-loaigp.php", {
        "name_loaigp": name_loaigp,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#loaigp_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#loaigp_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-loaigp.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-loaigp.php",
                ajaxParams: {
                    "name_loaigp": name_loaigp,
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
            $("#loaigp_table").css("border-top", "none");
            table = new Tabulator("#loaigp_table", {
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

$("#search_loaigp").click(function() {
    updateScroll()
    search_loaigp();
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
    { title: "Tên loại giấy phép", field: "ten", hozAlign: "center" },
]

$("#loaigp_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#loaigp_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-loaigp.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-loaigp.php",
    ajaxParams: {
        "name_loaigp": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Loại giấy phép ***/
$("#delete_loaigp").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn loại giấy phép cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các loại giấy phép đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-loaigp.php", {
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

/*** Thêm Loại giấy phép ***/
$("#create_loaigp").click(function() {
    location.href = "../services/danhmuc/form-loaigp.php";
})

/*** Xuất Excel ***/
$("#export_loaigp").click(function () {
    var name_loaigp = $("#name_loaigp").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-loaigp.php", {
        "name_loaigp": name_loaigp,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên loại giấy phép"
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
            XLSX.writeFile(wb, 'loaigiayphep.xlsx')
        }
    })
})
