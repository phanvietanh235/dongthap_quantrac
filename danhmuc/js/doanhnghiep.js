/*---- DOM Option Doanh nghiệp ----*/
$("#name_enterprise").select2({
    ajax: {
        url: "../services/doanhnghiep.php",
        data: function(params) {
            return {
                searchTerm: params.term,
            };
        },
        processResults: function(response) {
            return {
                results: response
            };
        },
        cache: true
    },
    tags: "true",
    placeholder: "--Lựa chọn Doanh nghiệp--",
    allowClear: true,
    width: "resolve",
    language: {
        searching: function() {
            return "Đang tìm ...";
        }
    },
});

var selected_id;

function search_enterprise() {
    /*** Get input ***/
    var tendoanhnghiep = $("#name_enterprise").val();
    if (tendoanhnghiep === null) {
        tendoanhnghiep = "all";
    }
    var nguoidaidien = $("#nguoidaidien").val();
    var diachi = $("#address_enterprise").val();
    var masothue = $("#tin_enterprise").val();

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
        { title: "Tên doanh nghiệp", field: "tendoanhnghiep", frozen: true, formatter: "textarea", width: 250 },
        { title: "Mã số thuế", field: "masothue", hozAlign: "center" },
        { title: "Loại hình", field: "loaihinh", hozAlign: "center" },
        { title: "Điện thoại", field: "dienthoai" },
        { title: "Địa chỉ", field: "diachi", formatter: "textarea", width: 250 },
        { title: "Tình trạng", field: "tinhtrang", hozAlign: "center", width: 150 },
        { title: "Số tài khoản", field: "accountNumber", hozAlign: "center", width: 150 },
        { title: "Tổng vốn", field: "totalInvestment", hozAlign: "center", width: 150 },
        { title: "Ngành nghề", field: "profession", formatter: "textarea", width: 250 }
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-enterprise.php", {
        "tendoanhnghiep": tendoanhnghiep,
        "nguoidaidien": nguoidaidien,
        "diachi": diachi,
        "masothue": masothue,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#enterprise_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#enterprise_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.madoanhnghiep;
                    window.open("../services/danhmuc/form-enterprise.php?madoanhnghiep=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-enterprise.php",
                ajaxParams: {
                    "tendoanhnghiep": tendoanhnghiep,
                    "nguoidaidien": nguoidaidien,
                    "diachi": diachi,
                    "masothue": masothue,
                },
                ajaxConfig: "post",
                pagination: "local",
                layout: "fitDataFill",
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
            $("#enterprise_table").css("border-top", "none");
            table = new Tabulator("#enterprise_table", {
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

$("#search_enterprise").click(function() {
    updateScroll()
    search_enterprise()
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
    { title: "Tên doanh nghiệp", field: "tendoanhnghiep", frozen: true, formatter: "textarea", width: 250 },
    { title: "Mã số thuế", field: "masothue", hozAlign: "center" },
    { title: "Loại hình", field: "loaihinh", hozAlign: "center" },
    { title: "Điện thoại", field: "dienthoai" },
    { title: "Địa chỉ", field: "diachi", formatter: "textarea", width: 250 },
    { title: "Tình trạng", field: "tinhtrang", hozAlign: "center", width: 150 },
    { title: "Số tài khoản", field: "accountNumber", hozAlign: "center", width: 150 },
    { title: "Tổng vốn", field: "totalInvestment", hozAlign: "center", width: 150 },
    { title: "Ngành nghề", field: "profession", formatter: "textarea", width: 250 }
]

$("#enterprise_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#enterprise_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.madoanhnghiep;
        window.open("../services/danhmuc/form-enterprise.php?madoanhnghiep=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-enterprise.php",
    ajaxParams: {
        "tendoanhnghiep": 'all',
        "nguoidaidien": '',
        "diachi": '',
        "masothue": '',
    },
    ajaxConfig: "post",
    pagination: "local",
    layout: "fitDataFill",
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

/*** Xóa Doanh nghiệp ***/
$("#delete_enterprise").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn doanh nghiệp cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các doanh nghiệp đã chọn này ?")) {
            var madoanhnghiep = [];
            selected_id.forEach(function(item, index) {
                madoanhnghiep.push(item.madoanhnghiep);
            })
            var response_post = $.post("../services/danhmuc/delete-enterprise.php", {
                "madoanhnghiep": madoanhnghiep
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

/*** Thêm Doanh Nghiệp ***/
$("#create_enterprise").click(function() {
    location.href = "../services/danhmuc/form-enterprise.php";
})

/*** Xuất Excel ***/
$("#export_enterprise").click(function () {
    var tendoanhnghiep = $("#name_enterprise").val();
    if (tendoanhnghiep === null) {
        tendoanhnghiep = "all";
    }
    var nguoidaidien = $("#nguoidaidien").val();
    var diachi = $("#address_enterprise").val();
    var masothue = $("#tin_enterprise").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-enterprise.php", {
        "tendoanhnghiep": tendoanhnghiep,
        "nguoidaidien": nguoidaidien,
        "diachi": diachi,
        "masothue": masothue,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã doanh nghiệp", B: "Tên doanh nghiệp", C: "Mã số thuế", D: "Loại hình",
                E: "Số tài khoản", F: "Tổng vốn", G: "Ngành nghề", H: "Số điện thoại", I: "Địa chỉ", J: "Tình trạng"
            }], {
                header: ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"],
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
                {width: 50},
                {width: 50},
                {width: 50},
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'doanhnghiep.xlsx')
        }
    })
})
