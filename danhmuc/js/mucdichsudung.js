var selected_id;

function search_mdsd() {
    /*** Get input ***/
    var name_mdsd = $("#name_mdsd").val();

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
        { title: "Tên mục đích", field: "ten", formatter: "textarea", width: 350 },
        { title: "Mô tả", field: "mota", hozAlign: "center", width: 250 },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-mdsd.php", {
        "name_mdsd": name_mdsd,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#mdsd_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#mdsd_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-mdsd.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-mdsd.php",
                ajaxParams: {
                    "name_mdsd": name_mdsd,
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
            $("#mdsd_table").css("border-top", "none");
            table = new Tabulator("#mdsd_table", {
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

$("#search_mdsd").click(function() {
    updateScroll()
    search_mdsd();
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
    { title: "Tên mục đích", field: "ten", formatter: "textarea", width: 350 },
    { title: "Mô tả", field: "mota", hozAlign: "center", width: 250 },
]

$("#mdsd_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#mdsd_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-mdsd.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-mdsd.php",
    ajaxParams: {
        "name_mdsd": '',
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

/*** Xóa mục đích ***/
$("#delete_mdsd").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn mục đích cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các mục đích đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-mdsd.php", {
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

/*** Thêm mục đích ***/
$("#create_mdsd").click(function() {
    location.href = "../services/danhmuc/form-mdsd.php";
})
/*** Xuất Excel ***/
$("#export_mdsd").click(function () {
    var name_mdsd = $("#name_mdsd").val();


    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-mdsd.php", {
        "name_mdsd": name_mdsd,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên mục đích", C: "Mô tả"
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
            XLSX.writeFile(wb, 'mucdichsudung.xlsx')
        }
    })
})