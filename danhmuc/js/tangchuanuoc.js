var selected_id;

function search_tcn() {
    /*** Get input ***/
    var name_tcn = $("#name_tangchuanuoc").val();

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
        { title: "Tên tầng chứa nước", field: "ten", formatter: "textarea", width: 300 },
        { title: "Chiều sâu mái", field: "chieusau_mai", formatter: "textarea", width: 300 },
        { title: "Chiều sâu đáy", field: "chieusau_day", formatter: "textarea", width: 300 },
        { title: "Thành phần", field: "thanhphan", formatter: "textarea", width: 300 },
        { title: "Thạch học", field: "thachhoc", formatter: "textarea", width: 300 },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-tcn.php", {
        "name_tcn": name_tcn,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#tangchuanuoc_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#tangchuanuoc_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-tcn.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-tcn.php",
                ajaxParams: {
                    "name_tcn": name_tcn,
                },
                ajaxConfig: "post",
                // layout: "fitDataStretch",
                /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
                columns: columns_title
            })
            table.setData();
            table.setLocale("vi");
        } else {
            $("#tangchuanuoc_table").css("border-top", "none");
            table = new Tabulator("#tangchuanuoc_table", {
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

$("#search_tangchuanuoc").click(function() {
    updateScroll()
    search_tcn();
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
    { title: "Tên tầng chứa nước", field: "ten", formatter: "textarea", width: 300 },
    { title: "Chiều sâu mái", field: "chieusau_mai", formatter: "textarea", width: 300 },
    { title: "Chiều sâu đáy", field: "chieusau_day", formatter: "textarea", width: 300 },
    { title: "Thành phần", field: "thanhphan", formatter: "textarea", width: 300 },
    { title: "Thạch học", field: "thachhoc", formatter: "textarea", width: 300 },
]

$("#tangchuanuoc_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#tangchuanuoc_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-tcn.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-tcn.php",
    ajaxParams: {
        "name_tcn": '',
    },
    ajaxConfig: "post",
    // layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa chỉ số chất lượng môi trường ***/
$("#delete_tcn").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn chỉ số chất lượng môi trường cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các chỉ số chất lượng môi trường đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-tcn.php", {
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

/*** Thêm chỉ số chất lượng môi trường ***/
$("#create_tcn").click(function() {
    location.href = "../services/danhmuc/form-tcn.php";
})

/*** Xuất Excel ***/
$("#export_tcn").click(function () {
    var name_tcn = $("#name_tangchuanuoc").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-tcn.php", {
        "name_tcn": name_tcn,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên tầng chứa nước", C: "Chiều sâu mái", D: "Chiều sâu đáy",
                E: "Thành phần", F: "Thạch học"
            }], {
                header: ["A", "B", "C", "D", "E", "F"],
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
                {width: 50},
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'tangchuanuoc.xlsx')
        }
    })
})
