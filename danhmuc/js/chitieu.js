var selected_id;

function search_ct() {
    /*** Get input ***/
    var name_standard = $("#name_standard").val();
    var name_para = $("#name_para").val();
    var name_analysis_method = $("#name_analysis_method").val();

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
        { title: "Quy chuẩn", field: "standard", formatter: "textarea", width: 350 },
        { title: "Thông số", field: "para", hozAlign: "center" },
        { title: "Đơn vị", field: "unit", hozAlign: "center" },
        { title: "Giá trị lớn nhất", field: "max", hozAlign: "center" },
        { title: "Giá trị nhỏ nhất", field: "min", hozAlign: "center" },
        { title: "Mục đích", field: "purpose", formatter: "textarea", width: 250 },
        { title: "Phương pháp phân tích", field: "ana_method", formatter: "textarea", width: 350 },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-ct.php", {
        "name_standard": name_standard,
        "name_para": name_para,
        "name_analysis_method": name_analysis_method,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#ct_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#ct_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-ct.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-ct.php",
                ajaxParams: {
                    "name_standard": name_standard,
                    "name_para": name_para,
                    "name_analysis_method": name_analysis_method,
                },
                ajaxConfig: "post",
                layout: "fitDataFill",
                pagination: "local",
                paginationSize: 10,
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
            $("#ct_table").css("border-top", "none");
            table = new Tabulator("#ct_table", {
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

$("#search_ct").click(function() {
    updateScroll()
    search_ct();
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
    { title: "Quy chuẩn", field: "standard", formatter: "textarea", width: 350 },
    { title: "Thông số", field: "para", hozAlign: "center" },
    { title: "Đơn vị", field: "unit", hozAlign: "center" },
    { title: "Giá trị lớn nhất", field: "max", hozAlign: "center" },
    { title: "Giá trị nhỏ nhất", field: "min", hozAlign: "center" },
    { title: "Mục đích", field: "purpose", formatter: "textarea", width: 250 },
    { title: "Phương pháp phân tích", field: "ana_method", formatter: "textarea", width: 350 },
]

$("#ct_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#ct_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-ct.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-ct.php",
    ajaxParams: {
        "name_standard": '',
        "name_para": '',
        "name_analysis_method": '',
    },
    ajaxConfig: "post",
    layout: "fitDataFill",
    pagination: "local",
    paginationSize: 10,
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

/*** Xóa chỉ số chỉ tiêu ***/
$("#delete_ct").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn chỉ tiêu cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các chỉ tiêu đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-ct.php", {
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

/*** Thêm chỉ số chỉ tiêu ***/
$("#create_ct").click(function() {
    location.href = "../services/danhmuc/form-ct.php";
})

/*** Xuất Excel ***/
$("#export_ct").click(function () {
    var name_standard = $("#name_standard").val();
    var name_para = $("#name_para").val();
    var name_analysis_method = $("#name_analysis_method").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-ct.php", {
        "name_standard": name_standard,
        "name_para": name_para,
        "name_analysis_method": name_analysis_method,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Quy chuẩn", C: "Thông số",  D: "Đơn vị",  E: "Giá trị lớn nhất",  F: "Giá trị nhỏ nhất",
                G: "Mục đích",  H: "Phương pháp phân tích"
            }], {
                header: ["A", "B", "C", "D", "E", "F", "G", "H"],
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
                {width: 50},
                {width: 50}
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'chitieu.xlsx')
        }
    })
})
