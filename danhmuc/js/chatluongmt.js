var selected_id;

function search_clmt() {
    /*** Get input ***/
    var name_clmt = $("#name_clmt").val();

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
        { title: "Tên chỉ số", field: "ten", hozAlign: "center" },
        { title: "Giá trị nhỏ nhất", field: "min", hozAlign: "center" },
        { title: "Giá trị lớn nhất", field: "max", hozAlign: "center" },
        { title: "Mã màu", field: "colorcode", hozAlign: "center" },
        { title: "Mục đích", field: "purpose", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-clmt.php", {
        "name_clmt": name_clmt,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#clmt_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#clmt_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-clmt.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-clmt.php",
                ajaxParams: {
                    "name_clmt": name_clmt,
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
            $("#clmt_table").css("border-top", "none");
            table = new Tabulator("#clmt_table", {
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

$("#search_clmt").click(function() {
    updateScroll()
    search_clmt();
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
    { title: "Tên chỉ số", field: "ten", hozAlign: "center" },
    { title: "Giá trị nhỏ nhất", field: "min", hozAlign: "center" },
    { title: "Giá trị lớn nhất", field: "max", hozAlign: "center" },
    { title: "Mã màu", field: "colorcode", hozAlign: "center" },
    { title: "Mục đích", field: "purpose", hozAlign: "center" },
]

$("#clmt_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#clmt_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-clmt.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-clmt.php",
    ajaxParams: {
        "name_clmt": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa chỉ số chất lượng môi trường ***/
$("#delete_clmt").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn chỉ số chất lượng môi trường cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các chỉ số chất lượng môi trường đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-clmt.php", {
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
$("#create_clmt").click(function() {
    location.href = "../services/danhmuc/form-clmt.php";
})

/*** Xuất Excel ***/
$("#export_clmt").click(function () {
    var name_clmt = $("#name_clmt").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-clmt.php", {
        "name_clmt": name_clmt,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên chỉ số", C: "Giá trị nhỏ nhất",  D: "Giá trị lớn nhất",  E: "Mã màu",  F: "Mục đích"
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
                {width: 50}
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'chatluong_moitruong.xlsx')
        }
    })
})
