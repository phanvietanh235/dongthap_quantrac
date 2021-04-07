/*---- DOM Option Lưu vực sông ----*/
$("#name_lvs").select2({
    ajax: {
        url: "../services/basin.php",
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
    placeholder: "--Lựa chọn lưu vực sông--",
    allowClear: true,
    width: "resolve",
    language: {
        searching: function() {
            return "Đang tìm ...";
        }
    },
});

var selected_id;

function search_lvs() {
    /*** Get input ***/
    var name_lvs = $("#name_lvs").val();
    if (name_lvs === null) {
        name_lvs = "all";
    }
    var ma_lvs = $("#ma_lvs").val();

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
        { title: "Mã lưu vực sông", field: "riverid", hozAlign: "center"},
        { title: "Tên lưu vực sông", field: "ten", hozAlign: "center", width: 250 },
        { title: "Diện tích mặt hồ", field: "surfaceareanwt", hozAlign: "center", width: 250 },
        { title: "Dung tích", field: "capacity", hozAlign: "center", width: 250 },
        { title: "Dung tích hữu ích", field: "netcapacity", hozAlign: "center", width: 250 },
        { title: "Dung tích chết", field: "deadcapacity", hozAlign: "center", width: 250 },
        { title: "Mực nước chết", field: "deadwaterlevel", hozAlign: "center" },
        { title: "Điểm đầu", field: "beginning", hozAlign: "center" },
        { title: "Điếm cuối", field: "termini", hozAlign: "center" },
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-lvs.php", {
        "name_lvs": name_lvs,
        "ma_lvs": ma_lvs
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#lvs_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#lvs_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-lvs.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-lvs.php",
                ajaxParams: {
                    "name_lvs": name_lvs,
                    "ma_lvs": ma_lvs
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
            $("#lvs_table").css("border-top", "none");
            table = new Tabulator("#lvs_table", {
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

$("#search_luuvucsong").click(function() {
    updateScroll()
    search_lvs();
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
    { title: "Mã lưu vực sông", field: "riverid", hozAlign: "center" },
    { title: "Tên lưu vực sông", field: "ten", hozAlign: "center", width: 250 },
    { title: "Diện tích mặt hồ", field: "surfaceareanwt", hozAlign: "center", width: 250 },
    { title: "Dung tích", field: "capacity", hozAlign: "center", width: 250 },
    { title: "Dung tích hữu ích", field: "netcapacity", hozAlign: "center", width: 250 },
    { title: "Dung tích chết", field: "deadcapacity", hozAlign: "center", width: 250 },
    { title: "Mực nước chết", field: "deadwaterlevel", hozAlign: "center" },
    { title: "Điểm đầu", field: "beginning", hozAlign: "center" },
    { title: "Điếm cuối", field: "termini", hozAlign: "center" },
]

$("#lvs_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#lvs_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-lvs.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-lvs.php",
    ajaxParams: {
        "name_lvs": 'all',
        "ma_lvs": ''
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

/*** Xóa Lưu vực sông ***/
$("#delete_lvs").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn lưu vực sông cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các lưu vực sông đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-lvs.php", {
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

/*** Thêm Lưu vực sông ***/
$("#create_lvs").click(function() {
    location.href = "../services/danhmuc/form-lvs.php";
})
/*** Xuất Excel ***/
$("#export_lvs").click(function () {
    var name_lvs = $("#name_lvs").val();
    if (name_lvs === null) {
        name_lvs = "all";
    }
    var ma_lvs = $("#ma_lvs").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-lvs.php", {
        "name_lvs": name_lvs,
        "ma_lvs": ma_lvs
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã", B: "Mã lưu vực sông", C: "Tên lưu vực sông", D: "Diện tích mặt hồ",
                E: "Dung tích", F: "Dung tích hữu ích", G: "Dung tích chết", H: "Mực nước chết", I: "Điểm đầu", J: "Điểm cuối"
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
            XLSX.writeFile(wb, 'luuvucsong.xlsx')
        }
    })
})