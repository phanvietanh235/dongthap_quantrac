var selected_id;

function search_md_ktsd() {
    /*** Get input ***/
    var name_md_ktsd = $("#name_md_ktsd").val();

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
        { title: "Mục đích", field: "ten", formatter: "textarea", width: 350 },
        { title: "Mô tả", field: "mota", formatter: "textarea", width: 350 },
        { title: "Loại mục đích", field: "type_md_ktsd", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-md-ktsd.php", {
        "name_md_ktsd": name_md_ktsd,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#md_ktsd_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#md_ktsd_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-md-ktsd.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-md-ktsd.php",
                ajaxParams: {
                    "name_md_ktsd": name_md_ktsd,
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
            $("#md_ktsd_table").css("border-top", "none");
            table = new Tabulator("#md_ktsd_table", {
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

$("#search_md_ktsd").click(function() {
    updateScroll()
    search_md_ktsd();
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
    { title: "Mục đích", field: "ten", formatter: "textarea", width: 350 },
    { title: "Mô tả", field: "mota", formatter: "textarea", width: 350 },
    { title: "Loại mục đích", field: "type_md_ktsd", hozAlign: "center" },
]

$("#md_ktsd_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#md_ktsd_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-md-ktsd.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-md-ktsd.php",
    ajaxParams: {
        "name_md_ktsd": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Mục đích khai thác sử dụng ***/
$("#delete_md_ktsd").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn mục đích khai thác sử dụng cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các mục đích khai thác sử dụng đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-md-ktsd.php", {
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

/*** Thêm Mục đích khai thác sử dụng ***/
$("#create_md_ktsd").click(function() {
    location.href = "../services/danhmuc/form-md-ktsd.php";
})
/*** Xuất Excel ***/
$("#export_md_ktsd").click(function () {
    var name_md_ktsd = $("#name_md_ktsd").val();


    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-md-ktsd.php", {
        "name_md_ktsd": name_md_ktsd,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Mục đích", C: "Mô tả", D: "Loại mục đích"
            }], {
                header: ["A", "B", "C", "D"],
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
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'mucdichktsd.xlsx')
        }
    })
})