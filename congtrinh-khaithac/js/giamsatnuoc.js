/*---- DOM Option Quận/huyện và Phường/xã ----*/
$.getJSON("../services/quanhuyen.php", function(quanhuyen) {
    $('#quanhuyen')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Quận/Huyện--"));
    $.each(quanhuyen, function(key, value) {
        $('#quanhuyen')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

/*** DOM Option depended Phường/Xã ***/
$('#quanhuyen').change(function() {
    $.post("../services/phuongxa.php", {
        "maHuyen": $(this).val()
    }).done(function(data) {
        if (data.length != 0) {
            /*** Remove Option trước đó ***/
            $('#phuongxa').find('option').remove();
            $('#phuongxa')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn Phường/Xã--"));
            $.each(data, function(key, value) {
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

/*** DOM Option Tầng chứa nước ***/
$("#tangchuanuoc").select2({
    ajax: {
        url: "../services/tangchuanuoc.php",
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
    placeholder: "--Lựa chọn Tầng chứa nước--",
    allowClear: true,
    width: "resolve",
    language: {
        searching: function() {
            return "Đang tìm ...";
        }
    },
});

/*---- DOM Option Lưu vực sông ----*/
$("#basin_option").select2({
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
    placeholder: "--Lựa chọn Lưu vực sông--",
    allowClear: true,
    width: "resolve",
    language: {
        searching: function() {
            return "Đang tìm ...";
        }
    },
});

/*---- DOM Option Công trình ----*/
$.getJSON("../services/loaicongtrinh-ktsd.php", function(ctkt) {
    $('#ctkt')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Loại công trình khai thác--"));
    $.each(ctkt, function(key, value) {
        $('#ctkt')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

function search_station_ctkt() {
    /*** GET Input ***/
    var sohieu = $("#sohieu").val();
    var quanhuyen = $("#quanhuyen").val();
    var phuongxa = $("#phuongxa").val();
    var ctkt = $("#ctkt").val();
    var tinhtrang_giengdiem = $("#tinhtrang_giengdiem").val();
    var ten_ct = $("#ten_ct").val();
    var diachi_ct = $("#diachi_ct").val();
    var tangchuanuoc = $("#tangchuanuoc").val();
    if (tangchuanuoc === null) {
        tangchuanuoc = "all";
    }
    var basin_option = $("#basin_option").val();
    if (basin_option === null) {
        basin_option = "all";
    }

    /*** DOM Table using Tabulator ***/
    var table, table2;
    var showMap = function(cell, formatterParams, onRendered) {
        var cell_stt = cell._cell.row.data.STT
        return '<button class="map_click_' + cell_stt + ' btn-xs btn-outline-info">' +
            '<i class="map_click fa fa-map-marker font-size-12"></i>' +
            '</button>' +
            '<button class="giam_sat_' + cell_stt + ' mrg-left-5 btn-xs btn-outline-info">' +
            '<i class="giam_sat fa fa-info font-size-12"></i>' +
            '</button>';
    };

    var columns_title = [
        { title: "#", formatter: "rownum", frozen: true },
        {
            formatter: showMap,
            hozAlign: "center",
            title: "",
            frozen: true,
            headerSort: false,
            cellClick: function(e, row, formatterParams) {
                var target_class = e.target.classList[0];
                const id = row.getData().id.split("_")[0];
                const type_ct = row.getData().type_ct;
                const sohieu = row.getData().sohieu;
                if (target_class.includes("map_click")) {
                    window.open("../map.php?idpoi=" + id + "&type=" + type_ct)
                } else {
                    window.open("../services/giamsat-tnn/giamsat-info.php?idpoi=" + id +
                        "&type=" + type_ct + "&name=" + sohieu);
                }
            }
        },
        { title: "Số hiệu giếng", field: "sohieu", frozen: true, hozAlign: "center" },
        { title: "Quận/huyện", field: "quanhuyen", hozAlign: "center" },
        { title: "Phường/xã", field: "phuongxa", hozAlign: "center" },
        /* { title: "Tên doanh nghiệp", field: "doanhnghiep", formatter: "textarea", width: 300 }, */
        { title: "Tên công trình", field: "ten_ct", formatter: "textarea", width: 400 },
        { title: "Địa chỉ công trình", field: "diachi_ct", formatter: "textarea", width: 400 },
        { title: "Loại công trình", field: "loai_ct", hozAlign: "center" },
        { title: "Tình trạng giếng/điểm", field: "tinhtrang", hozAlign: "center", formatter: "textarea", width: 200 },
    ]

    /* Reset Navbar */
    if ($("#tab_giamsat li:nth-child(2) a").hasClass("active")) {
        $("#tab_giamsat li:nth-child(2) a").removeClass("active")
        $("#tab_giamsat li:nth-child(1) a").addClass("active")

        $("#nav-list-ctkt").addClass("active")
        $("#nav-list-ctkt").addClass("show")

        $("#nav-list-ctkt-2").removeClass("active")
        $("#nav-list-ctkt-2").removeClass("show")
    }

    /*** POST send Data ***/
    var response_post = $.post("../services/giamsat-tnn/giamsat-nuoc.php", {
        "sohieu": sohieu,
        "quanhuyen": quanhuyen,
        "phuongxa": phuongxa,
        "ctkt": ctkt,
        "tinhtrang_giengdiem": tinhtrang_giengdiem,
        "ten_ct": ten_ct,
        "diachi_ct": diachi_ct,
        "tangchuanuoc": tangchuanuoc,
        "basin_option": basin_option
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#list_station_ctkt").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#list_station_ctkt", {
                ajaxURL: "../services/giamsat-tnn/giamsat-nuoc.php",
                ajaxParams: {
                    "sohieu": sohieu,
                    "quanhuyen": quanhuyen,
                    "phuongxa": phuongxa,
                    "ctkt": ctkt,
                    "tinhtrang_giengdiem": tinhtrang_giengdiem,
                    "ten_ct": ten_ct,
                    "diachi_ct": diachi_ct,
                    "tangchuanuoc": tangchuanuoc,
                    "basin_option": basin_option
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
                            "netd": "Sau",
                            "netd_title": "Trang sau",
                        }
                    }
                }
            })
            table.setData();
            table.setLocale("vi");
        } else {
            /* alert("Không có dữ liệu!") */
            /* $("#list_station_ctkt").css("border-top", "none");
            table = new Tabulator("#list_station_ctkt", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            }) */
        }
    })

    $("#tab_giamsat li:nth-child(2)").on("click", function() {
        /*** POST send Data ***/
        var response_post_2 = $.post("../services/giamsat-tnn/giamsat-nuoc-2.php", {
            "sohieu": sohieu,
            "quanhuyen": quanhuyen,
            "phuongxa": phuongxa,
            "ctkt": ctkt,
            "tinhtrang_giengdiem": tinhtrang_giengdiem,
            "ten_ct": ten_ct,
            "diachi_ct": diachi_ct,
            "tangchuanuoc": tangchuanuoc,
            "basin_option": basin_option
        })

        response_post_2.done(function(data) {
            if (data.length != 0) {
                $("#list_station_ctkt_2").css("border-top", "1px solid #dee2e6");
                table2 = new Tabulator("#list_station_ctkt_2", {
                    ajaxURL: "../services/giamsat-tnn/giamsat-nuoc-2.php",
                    ajaxParams: {
                        "sohieu": sohieu,
                        "quanhuyen": quanhuyen,
                        "phuongxa": phuongxa,
                        "ctkt": ctkt,
                        "tinhtrang_giengdiem": tinhtrang_giengdiem,
                        "ten_ct": ten_ct,
                        "diachi_ct": diachi_ct,
                        "tangchuanuoc": tangchuanuoc,
                        "basin_option": basin_option
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
                                "netd": "Sau",
                                "netd_title": "Trang sau",
                            }
                        }
                    }
                })
                table2.setData();
                table2.setLocale("vi");
            } else {
                /* alert("Không có dữ liệu!") */
                /* $("#list_station_ctkt").css("border-top", "none");
                table = new Tabulator("#list_station_ctkt", {
                    height: "70px",
                    placeholder: "<p class='text-danger text-bold font-size-14'>" +
                        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
                }) */
            }
        })
    })
}

function updateScroll() {
    $('html,body').animate({ scrollTop: 380 });
}

$("#search_station_ctkt").click(function() {
    search_station_ctkt();
    setTimeout(updateScroll(), 1000);
})

/*---- Render Table First ----*/
var table, table2;
var showMap = function(cell, formatterParams, onRendered) {
    var cell_stt = cell._cell.row.data.STT
    return '<button class="map_click_' + cell_stt + ' btn-xs btn-outline-info">' +
        '<i class="map_click fa fa-map-marker font-size-12"></i>' +
        '</button>' +
        '<button class="giam_sat_' + cell_stt + ' mrg-left-5 btn-xs btn-outline-info">' +
        '<i class="giam_sat fa fa-info font-size-12"></i>' +
        '</button>';
};

var columns_title = [
    { title: "#", formatter: "rownum", frozen: true },
    {
        formatter: showMap,
        align: "center",
        title: "",
        frozen: true,
        headerSort: false,
        cellClick: function(e, row, formatterParams) {
            var target_class = e.target.classList[0];
            const id = row.getData().id.split("_")[0];
            const type_ct = row.getData().type_ct;
            const sohieu = row.getData().sohieu;
            if (target_class.includes("map_click")) {
                window.open("../map.php?idpoi=" + id + "&type=" + type_ct)
            } else {
                window.open("../services/giamsat-tnn/giamsat-info.php?idpoi=" + id +
                    "&type=" + type_ct + "&name=" + sohieu);
            }
        }
    },
    { title: "Số hiệu giếng", field: "sohieu", frozen: true, hozAlign: "center" },
    { title: "Quận/huyện", field: "quanhuyen", hozAlign: "center" },
    { title: "Phường/xã", field: "phuongxa", hozAlign: "center" },
    /* { title: "Tên doanh nghiệp", field: "doanhnghiep", formatter: "textarea", width: 300 }, */
    { title: "Tên công trình", field: "ten_ct", formatter: "textarea", width: 400 },
    { title: "Địa chỉ công trình", field: "diachi_ct", formatter: "textarea", width: 400 },
    { title: "Loại công trình", field: "loai_ct", hozAlign: "center" },
    { title: "Tình trạng giếng/điểm", field: "tinhtrang", hozAlign: "center", formatter: "textarea", width: 200 },
]

$("#list_station_ctkt").css("border-top", "1px solid #dee2e6");

table = new Tabulator("#list_station_ctkt", {
    ajaxURL: "../services/giamsat-tnn/giamsat-nuoc.php",
    ajaxParams: {
        "sohieu": '',
        "quanhuyen": 'none',
        "phuongxa": 'none',
        "ctkt": 'none',
        "tinhtrang_giengdiem": 'none',
        "ten_ct": '',
        "diachi_ct": '',
        "tangchuanuoc": 'all',
        "basin_option": 'all'
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
                "netd": "Sau",
                "netd_title": "Trang sau",
            }
        }
    }
})
table.setData();
table.setLocale("vi");

$("#tab_giamsat li:nth-child(2)").on("click", function() {
    $("#list_station_ctkt_2").css("border-top", "1px solid #dee2e6");
    table2 = new Tabulator("#list_station_ctkt_2", {
        ajaxURL: "../services/giamsat-tnn/giamsat-nuoc-2.php",
        ajaxParams: {
            "sohieu": '',
            "quanhuyen": 'none',
            "phuongxa": 'none',
            "ctkt": 'none',
            "tinhtrang_giengdiem": 'none',
            "ten_ct": '',
            "diachi_ct": '',
            "tangchuanuoc": 'all',
            "basin_option": 'all'
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
                    "netd": "Sau",
                    "netd_title": "Trang sau",
                }
            }
        }
    })
    table2.setData();
    table2.setLocale("vi");
})

