var selected_id;

function search_location() {
    /*** Get input ***/
    var name_location = $("#name_location").val();

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
        { title: "Tên địa danh", field: "ten", hozAlign: "center" },
        { title: "Loại địa danh", field: "type_location", hozAlign: "center" }
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/danhmuc/list-location.php", {
        "name_location": name_location,
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#location_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#location_table", {
                selectable: 1,
                rowClick: function(e, row) {
                    var index = row._row.data.ma;
                    window.open("../services/danhmuc/form-location.php?ma=" + index, '_blank');
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/danhmuc/list-location.php",
                ajaxParams: {
                    "name_location": name_location,
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
            $("#location_table").css("border-top", "none");
            table = new Tabulator("#location_table", {
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

$("#search_location").click(function() {
    updateScroll()
    search_location();
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
    { title: "Tên địa danh", field: "ten", hozAlign: "center" },
    { title: "Loại địa danh", field: "type_location", hozAlign: "center" }
]

$("#location_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#location_table", {
    selectable: 1,
    rowClick: function(e, row) {
        var index = row._row.data.ma;
        window.open("../services/danhmuc/form-location.php?ma=" + index, '_blank');
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/danhmuc/list-location.php",
    ajaxParams: {
        "name_location": '',
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

/*** Xóa Địa danh ***/
$("#delete_location").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn địa danh cần xóa")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các địa danh đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.ma);
            })
            var response_post = $.post("../services/danhmuc/delete-location.php", {
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

/*** Thêm Địa danh ***/
$("#create_location").click(function() {
    location.href = "../services/danhmuc/form-location.php";
})
