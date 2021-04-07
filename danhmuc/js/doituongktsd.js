var selected_id;

function search_dt_ktsd() {
    /*** Get input ***/
    var name_dt_ktsd = $("#name_dt_ktsd").val();

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
        { title: "Tên đối tượng", field: "ten", hozAlign: "center" },
        { title: "Mô tả", field: "mota", hozAlign: "center" }
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-dt-ktsd.php", {
        "name_dt_ktsd": name_dt_ktsd,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#dt_ktsd_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#dt_ktsd_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-dt-ktsd.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-dt-ktsd.php",
                ajaxParams: {
                    "name_dt_ktsd": name_dt_ktsd,
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
            $("#dt_ktsd_table").css("border-top", "none");
            table = new Tabulator("#dt_ktsd_table", {
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

$("#search_dt_ktsd").click(function() {
    updateScroll()
    search_dt_ktsd();
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
    { title: "Tên đối tượng", field: "ten", hozAlign: "center" },
    { title: "Mô tả", field: "mota", hozAlign: "center" },
]

$("#dt_ktsd_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#dt_ktsd_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-dt-ktsd.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-dt-ktsd.php",
    ajaxParams: {
        "name_dt_ktsd": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Đối tượng KTSD ***/
$("#delete_dt_ktsd").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn đối tượng khai thác sử dụng cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các đối tượng khai thác sử dụng đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-dt-ktsd.php", {
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

/*** Thêm Đối tượng KTSD ***/
$("#create_dt_ktsd").click(function() {
    location.href = "../services/danhmuc/form-dt-ktsd.php";
})

/*** Xuất Excel ***/
$("#export_dt_ktsd").click(function () {
    var name_dt_ktsd = $("#name_dt_ktsd").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-dt-ktsd.php", {
        "name_dt_ktsd": name_dt_ktsd,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên đối tượng", C: "Mô tả"
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
            XLSX.writeFile(wb, 'doituong_ktsd.xlsx')
        }
    })
})
