var selected_id;

/*---- DOM Option Quận/huyện và Phường/xã ----*/
$.getJSON("../services/quanhuyen.php", function (quanhuyen) {
    $('#quanhuyen')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Quận/Huyện--"));
    $.each(quanhuyen, function (key, value) {
        $('#quanhuyen')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

/*** DOM Option depended Phường/Xã ***/
$('#quanhuyen').change(function () {
    $.post("../services/phuongxa.php", {
        "maHuyen": $(this).val()
    }).done(function (data) {
        if (data.length != 0) {
            /*** Remove Option trước đó ***/
            $('#phuongxa').find('option').remove();
            $('#phuongxa')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn Phường/Xã--"));
            $.each(data, function (key, value) {
                $('#phuongxa')
                    .append($("<option></option>")
                        .attr('value', value.id).text(value.name));
            });
        } else {
            $('#phuongxa').find('option').remove();
            $('#phuongxa')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn Phường/Xã--"));
        }
    })
})

/*** DOM Option Mã trạm cũ ***/
// $("#ma_tramcu").select2({
//     ajax: {
//         url: "../services/ma_tramcu.php",
//         data: function(params) {
//             return {
//                 searchTerm: params.term,
//             };
//         },
//         processResults: function(response) {
//             return {
//                 results: response
//             };
//         },
//         cache: true
//     },
//     tags: "true",
//     placeholder: "--Lựa chọn Mã trạm cũ--",
//     allowClear: true,
//     width: "resolve",
//     language: {
//         searching: function() {
//             return "Đang tìm ...";
//         }
//     },
// });

function search_list_diemqt_nm() {
    /*** Get input ***/
    var tencongtrinh = $("#name_ct").val();
    var quanhuyen = $("#quanhuyen").val();
    var sohieu = $("#soHieuDiemQT").val();
    var ma_tramcu = $("#ma_tramcu").val();
    /* if (ma_tramcu === null) {
        ma_tramcu = [];
    } */
    var diachi_ct = $("#diachi_ct").val();
    var phuongxa = $("#phuongxa").val();
    var coso_sanxuat = $("#coso_sanxuat").val();

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
        }},
        {title: "#", formatter: "rownum", frozen: true},
        {title: "Tên công trình", field: "tencongtrinh", frozen: true, formatter: "textarea", width: 350},
        {title: "Địa chỉ công trình", field: "diachi_ct", formatter: "textarea", width: 300},
        {title: "Quận/huyện", field: "quanhuyen", hozAlign: "center"},
        {title: "Phường/xã", field: "phuongxa", hozAlign: "center"},
        {title: "Mã trạm cũ", field: "ma_tramcu", hozAlign: "center", width: 400},
        {title: "Tên số hiệu quan trắc", field: "soHieu", formatter: "textarea", width: 200},
        {title: "Cơ sở sản xuất", field: "coso_sanxuat", formatter: "textarea", width: 300},
        {title: "Tên địa danh", field: "tendiadanh", formatter: "textarea", width: 300},
        {title: "Tọa độ X", field: "toadoX", hozAlign: "center"},
        {title: "Tọa độ Y", field: "toadoY", hozAlign: "center"},
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/qt-nm/diemqt-nm.php", {
        "tencongtrinh": tencongtrinh,
        "quanhuyen": quanhuyen,
        "sohieu": sohieu,
        "ma_tramcu": ma_tramcu,
        "diachi_ct": diachi_ct,
        "phuongxa": phuongxa,
        "coso_sanxuat": coso_sanxuat,
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            $("#list_diemqt_nm_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#list_diemqt_nm_table", {
                selectable: 1,
                rowClick: function (e, row) {
                    var index = row._row.data.id_soHieu;
                    window.open("../services/qt-nm/diemqt-nm-info.php?idsoHieu=" + index, '_blank');
                    /* location.href = "../services/ktsd-nm-info.php?macongtrinh=" + index; */
                },
                rowSelectionChanged: function(data, rows) {
                    selected_id = data;
                },
                ajaxURL: "../services/qt-nm/diemqt-nm.php",
                ajaxParams: {
                    "tencongtrinh": tencongtrinh,
                    "quanhuyen": quanhuyen,
                    "sohieu": sohieu,
                    "ma_tramcu": ma_tramcu,
                    "diachi_ct": diachi_ct,
                    "phuongxa": phuongxa,
                    "coso_sanxuat": coso_sanxuat,
                },
                ajaxConfig: "post",
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
            alert("Không có dữ liệu!")
            /* $("#list_ctkt_nm_table").css("border-top", "none");
            table = new Tabulator("#list_ctkt_nm_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            }) */
        }
    })
}

function updateScroll() {
    $('html,body').animate({scrollTop: 330});
}

$("#search_list_diemqt_nm").click(function () {
    search_list_diemqt_nm();
    setTimeout(updateScroll(), 1000);
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
    }},
    {title: "#", formatter: "rownum", frozen: true},
    {title: "Tên công trình", field: "tencongtrinh", frozen: true, formatter: "textarea", width: 350},
    {title: "Địa chỉ công trình", field: "diachi_ct", formatter: "textarea", width: 300},
    {title: "Quận/huyện", field: "quanhuyen", hozAlign: "center"},
    {title: "Phường/xã", field: "phuongxa", hozAlign: "center"},
    {title: "Mã trạm cũ", field: "ma_tramcu", hozAlign: "center", width: 200},
    {title: "Tên số hiệu quan trắc", field: "soHieu", formatter: "textarea", hozAlign: "center", width: 200},
    {title: "Cơ sở sản xuất", field: "coso_sanxuat", formatter: "textarea", width: 300}, 
    {title: "Tên địa danh", field: "tendiadanh", formatter: "textarea", width: 300},
    {title: "Tọa độ X", field: "toadoX", hozAlign: "center"},
    {title: "Tọa độ Y", field: "toadoY", hozAlign: "center"},
]

$("#list_diemqt_nm_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#list_diemqt_nm_table", {
    selectable: 1,
    rowClick: function (e, row) {
        var index = row._row.data.id_soHieu;
        window.open("../services/qt-nm/diemqt-nm-info.php?idsoHieu=" + index, '_blank');
        /* location.href = "../services/ktsd-nm-info.php?macongtrinh=" + index; */
    },
    rowSelectionChanged: function(data, rows) {
        selected_id = data;
    },
    ajaxURL: "../services/qt-nm/diemqt-nm.php",
    ajaxParams: {
        "tencongtrinh": '',
        "quanhuyen": 'none',
        "sohieu": '',
        "ma_tramcu": '',
        "diachi_ct": '',
        "phuongxa": 'none',
        "coso_sanxuat": '',
    },
    ajaxConfig: "post",
    pagination: "local",
    paginationSize: 10,
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


/*** Xóa giếng quan trắc nước dưới đất ***/
$("#delete_create_diemqt_nm").click(function() {
    if (selected_id.length == 0) {
        alert("Vui lòng chọn điểm quan trắc nước mặt")
    } else {
        if (confirm("Bạn chắc chắn muốn xóa các điểm quan trắc nước mặt đã chọn này ?")) {
            var ma = [];
            selected_id.forEach(function(item, index) {
                ma.push(item.id_soHieu);
            })
            var response_post = $.post("../services/qt-nm/delete-diemqt-nm.php", {
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
$("#create_diemqt_nm").click(function() {
    location.href = "../services/diemqt-nm/diemqt-nm-info.php";
})
