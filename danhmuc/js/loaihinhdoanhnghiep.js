var selected_id;

function search_type_enter() {
    /*** Get input ***/
    var name_loaihinh_dn = $("#name_type_enter").val();

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
        { title: "Tên loại hình", field: "ten", formatter: "textarea", width: 250 },
        { title: "Mô tả", field: "mota", formatter: "textarea", width: 520 },
        { title: "Căn cứ pháp lý", field: "cancuphaply", hozAlign: "center", width: 150 },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-type-enter.php", {
        "name_loaihinh_dn": name_loaihinh_dn,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#enter_type_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#enter_type_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-type-enter.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-type-enter.php",
                ajaxParams: {
                    "name_loaihinh_dn": name_loaihinh_dn,
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
            $("#enter_type_table").css("border-top", "none");
            table = new Tabulator("#enter_type_table", {
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

$("#search_type_enter").click(function() {
    updateScroll()
    search_type_enter();
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
    { title: "Tên loại hình", field: "ten", formatter: "textarea", width: 250 },
    { title: "Mô tả", field: "mota", formatter: "textarea", width: 520 },
    { title: "Căn cứ pháp lý", field: "cancuphaply", hozAlign: "center", width: 150 },
]

$("#enter_type_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#enter_type_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-type-enter.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-type-enter.php",
    ajaxParams: {
        "name_loaihinh_dn": '',
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Loại hình Doanh nghiệp ***/
$("#delete_type_enter").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn loại hình doanh nghiệp cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các loại hình doanh nghiệp đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-type-enter.php", {
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

/*** Thêm Loại hình Doanh Nghiệp ***/
$("#create_type_enter").click(function() {
    location.href = "../services/danhmuc/form-type-enter.php";
})
/*** Xuất Excel ***/
$("#export_type_enter").click(function () {
    var name_loaihinh_dn = $("#name_type_enter").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-type-enter.php", {
        "name_loaihinh_dn": name_loaihinh_dn,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên loại hình", C: "Mô tả", D: "Căn cứ pháp lý"
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
            XLSX.writeFile(wb, 'loaihinhdoanhnghiep.xlsx')
        }
    })
})