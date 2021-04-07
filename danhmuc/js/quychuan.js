/*---- DOM Option Loại hình ----*/
$.getJSON("../services/loaihinh-option.php", function(loaihinh) {
    $('#loaihinh')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn loại hình--"));
    $.each(loaihinh, function(key, value) {
        $('#loaihinh')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

var selected_id;

function search_quychuan() {
    /*** Get input ***/
    var name_quychuan = $("#name_quychuan").val();
    var symbol_quychuan = $("#symbol_quychuan").val();
    var loaihinh = $("#loaihinh").val();

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
        { title: "Ký hiệu quy chuẩn", field: "symbol", hozAlign: "center" },
        { title: "Tên quy chuẩn", field: "ten", formatter: "textarea", width: 250 },
        { title: "Ngày ban hành", field: "dateoflssue", hozAlign: "center" },
        { title: "Cơ quan ban hành", field: "organization", hozAlign: "center" },
        { title: "Loại quan trắc", field: "loaihinh", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-quychuan.php", {
        "name_quychuan": name_quychuan,
        "symbol_quychuan": symbol_quychuan,
        "loaihinh": loaihinh,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#quychuan_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#quychuan_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-quychuan.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-quychuan.php",
                ajaxParams: {
                    "name_quychuan": name_quychuan,
                    "symbol_quychuan": symbol_quychuan,
                    "loaihinh": loaihinh,
                },
                ajaxConfig: "post",
                layout: "fitDataStretch",
                height: "350px",
                /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
                columns: columns_title
            })
            table.setData();
            table.setLocale("vi");
        } else {
            $("#quychuan_table").css("border-top", "none");
            table = new Tabulator("#quychuan_table", {
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

$("#search_quychuan").click(function() {
    updateScroll()
    search_quychuan();
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
    { title: "Ký hiệu quy chuẩn", field: "symbol", hozAlign: "center" },
    { title: "Tên quy chuẩn", field: "ten", formatter: "textarea", width: 250 },
    { title: "Ngày ban hành", field: "dateoflssue", hozAlign: "center" },
    { title: "Cơ quan ban hành", field: "organization", hozAlign: "center" },
    { title: "Loại quan trắc", field: "loaihinh", hozAlign: "center" },
]

$("#quychuan_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#quychuan_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-quychuan.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-quychuan.php",
    ajaxParams: {
        "name_quychuan": '',
        "symbol_quychuan": '',
        "loaihinh": "none",
    },
    ajaxConfig: "post",
    layout: "fitDataStretch",
    height: "350px",
    /* placeholder: "<p class='text-danger text-bold font-size-14'>" +
        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>", */
    columns: columns_title,
})
table.setData();
table.setLocale("vi");

/*** Xóa Quy chuẩn ***/
$("#delete_quychuan").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn quy chuẩn cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các quy chuẩn đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-quychuan.php", {
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

/*** Thêm Quy chuẩn ***/
$("#create_quychuan").click(function() {
    location.href = "../services/danhmuc/form-quychuan.php";
})
/*** Xuất Excel ***/
$("#export_quychuan").click(function () {
    var name_quychuan = $("#name_quychuan").val();
    var symbol_quychuan = $("#symbol_quychuan").val();
    var loaihinh = $("#loaihinh").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-quychuan.php", {
        "name_quychuan": name_quychuan,
        "symbol_quychuan": symbol_quychuan,
        "loaihinh": loaihinh,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Tên quy chuẩn", C: "Ký hiệu quy chuẩn", D: "Mã loại quan trắc",
                E: "Loại quan trắc", F: "Ngày ban hành", G: "Cơ quan ban hành"
            }], {
                header: ["A", "B", "C", "D", "E", "F", "G"],
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
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'quychuan.xlsx')
        }
    })
})