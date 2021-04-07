/*---- DOM Option Quận/huyện và Phường/xã ----*/
$.getJSON("../services/quanhuyen.php", function (quanhuyen) {
    $('#quanhuyen')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Quận/Huyện--"));
    $('#quanhuyen_modal')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Quận/Huyện--"));
    $.each(quanhuyen, function (key, value) {
        $('#quanhuyen')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
        $('#quanhuyen_modal')
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

/*** DOM Option Tầng chứa nước
 $("#tangchuanuoc").select2({
    ajax: {
        url: "../services/tangchuanuoc.php",
        data: function (params) {
            return {
                searchTerm: params.term,
            };
        },
        processResults: function (response) {
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
        searching: function () {
            return "Đang tìm ...";
        }
    },
}); ***/

function search_list_ctkt_ndd() {
    /*** Get input ***/
    var tencongtrinh = $("#name_ct").val();
    /* var mucdich_khaithac = $("#mucdich_kt").val();
    var tongsogieng =  $("#tongsogieng").val();
    var thoihan_ktsd = $("#thoihan_ktsd").val(); */
    var quanhuyen = $("#quanhuyen").val();
    var doanhnghiep = $("#doanhnghiep").val();
    var sogiayphep = $("#sogiayphep").val();
    /* var status_gieng_ndd = $("#status_gieng_ndd").val(); */
    var diachi_ct = $("#diachi_ct").val();
    /* var chedo_kt = $("#chedo_kt").val();
    var tong_llkt = $("#tong_llkt").val();
    var tangchuanuoc = $("#tangchuanuoc").val();
    if (tangchuanuoc === null) {
        tangchuanuoc = "all";
    } */
    var phuongxa = $("#phuongxa").val();
    var coso_sanxuat = $("#coso_sanxuat").val();
    var nam_xd = $("#nam_xd").val();
    /* var phamvi_capnuoc = $("#phamvi_capnuoc").val();
    var status_list_ctkt_ndd = $("#status_list_ctkt_ndd").val(); */

    /*** DOM Table using Tabulator ***/
    var table;
    var columns_title = [
        {title: "#", formatter: "rownum", frozen: true},
        {title: "Tên công trình", field: "tencongtrinh", frozen: true, formatter: "textarea", width: 350},
        {title: "Địa chỉ công trình", field: "diachi_ct", formatter: "textarea", width: 250},
        {title: "Quận/huyện", field: "quanhuyen", hozAlign: "center", width: 150},
        {title: "Phường/xã", field: "phuongxa", hozAlign: "center", width: 150},
        {title: "Tên doanh nghiệp", field: "doanhnghiep", formatter: "textarea", width: 200},
        {title: "Cơ sở sản xuất", field: "coso_sanxuat", formatter: "textarea", width: 300},
        {title: "Số giấy phép mới nhất", field: "sogiayphep", hozAlign: "center"},
        {title: "Năm xây dựng", field: "nam_xd", hozAlign: "center"},
    ]

    /*** POST send Data ***/
    var response_post = $.post("../services/ktsd-ndd/ktsd-nuocduoidat.php", {
        "tencongtrinh": tencongtrinh,
        /* "mucdich_khaithac": mucdich_khaithac,
        "tongsogieng": tongsogieng,
        "thoihan_ktsd": thoihan_ktsd, */
        "quanhuyen": quanhuyen,
        "doanhnghiep": doanhnghiep,
        "sogiayphep": sogiayphep,
        /* "status_gieng_ndd": status_gieng_ndd, */
        "diachi_ct": diachi_ct,
        /* "chedo_kt": chedo_kt,
        "tong_llkt": tong_llkt,
        "tangchuanuoc": tangchuanuoc, */
        "phuongxa": phuongxa,
        "coso_sanxuat": coso_sanxuat,
        "nam_xd": nam_xd
        /* "phamvi_capnuoc": phamvi_capnuoc,
        "status_list_ctkt_ndd": status_list_ctkt_ndd, */
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            $("#list_ctkt_ndd_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#list_ctkt_ndd_table", {
                selectable: 1,
                rowClick: function (e, row) {
                    var index = row._row.data.macongtrinh;
                    window.open("../services/ktsd-ndd/ktsd-ndd-info.php?macongtrinh=" + index, '_blank');
                    /* location.href = "../services/ktsd-ndd-info.php?macongtrinh=" + index; */
                },
                ajaxURL: "../services/ktsd-ndd/ktsd-nuocduoidat.php",
                ajaxParams: {
                    "tencongtrinh": tencongtrinh,
                    /* "mucdich_khaithac": mucdich_khaithac,
                    "tongsogieng": tongsogieng,
                    "thoihan_ktsd": thoihan_ktsd, */
                    "quanhuyen": quanhuyen,
                    "doanhnghiep": doanhnghiep,
                    "sogiayphep": sogiayphep,
                    /* "status_gieng_ndd": status_gieng_ndd, */
                    "diachi_ct": diachi_ct,
                    /* "chedo_kt": chedo_kt,
                    "tong_llkt": tong_llkt,
                    "tangchuanuoc": tangchuanuoc, */
                    "phuongxa": phuongxa,
                    "coso_sanxuat": coso_sanxuat,
                    "nam_xd": nam_xd
                    /* "phamvi_capnuoc": phamvi_capnuoc,
                    "status_list_ctkt_ndd": status_list_ctkt_ndd, */
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
            /* $("#list_ctkt_ndd_table").css("border-top", "none");
            table = new Tabulator("#list_ctkt_ndd_table", {
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

$("#search_list_ctkt_ndd").click(function () {
    search_list_ctkt_ndd();
    setTimeout(updateScroll(), 1000);
})

/*---- Render Table First ----*/
var table;
var columns_title = [
    {title: "#", formatter: "rownum", frozen: true},
    {title: "Tên công trình", field: "tencongtrinh", frozen: true, formatter: "textarea", width: 350},
    {title: "Địa chỉ công trình", field: "diachi_ct", formatter: "textarea", width: 250},
    {title: "Quận/huyện", field: "quanhuyen", hozAlign: "center", width: 150},
    {title: "Phường/xã", field: "phuongxa", hozAlign: "center", width: 150},
    {title: "Tên doanh nghiệp", field: "doanhnghiep", formatter: "textarea", width: 200},
    {title: "Cơ sở sản xuất", field: "coso_sanxuat", formatter: "textarea", width: 300},
    {title: "Số giấy phép mới nhất", field: "sogiayphep", hozAlign: "center"},
    {title: "Năm xây dựng", field: "nam_xd", hozAlign: "center"},
]

$("#list_ctkt_ndd_table").css("border-top", "1px solid #dee2e6");
table = new Tabulator("#list_ctkt_ndd_table", {
    selectable: 1,
    rowClick: function (e, row) {
        var index = row._row.data.macongtrinh;
        window.open("../services/ktsd-ndd/ktsd-ndd-info.php?macongtrinh=" + index, '_blank');
        /* location.href = "../services/ktsd-ndd-info.php?macongtrinh=" + index; */
    },
    ajaxURL: "../services/ktsd-ndd/ktsd-nuocduoidat.php",
    ajaxParams: {
        "tencongtrinh": '',
        /* "mucdich_khaithac": '',
        "tongsogieng": '',
        "thoihan_ktsd": '', */
        "quanhuyen": 'none',
        "doanhnghiep": '',
        "sogiayphep": '',
        /* "status_gieng_ndd": 'all', */
        "diachi_ct": '',
        /* "chedo_kt": '',
        "tong_llkt": '',
        "tangchuanuoc": 'all', */
        "phuongxa": 'none',
        "coso_sanxuat": '',
        "nam_xd": ''
        /* "phamvi_capnuoc": '',
        "status_list_ctkt_ndd": 'all', */
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

/*---- Export Excel From JSON ----*/
$("#export_list_ctkt_ndd").click(function () {
    var tencongtrinh = $("#name_ct").val();
    var quanhuyen = $("#quanhuyen").val();
    var doanhnghiep = $("#doanhnghiep").val();
    var sogiayphep = $("#sogiayphep").val();
    var diachi_ct = $("#diachi_ct").val();
    var phuongxa = $("#phuongxa").val();
    var coso_sanxuat = $("#coso_sanxuat").val();
    var nam_xd = $("#nam_xd").val();

    /*** POST send Data ***/
    var response_post = $.post("../services/ktsd-ndd/ktsd-nuocduoidat.php", {
        "tencongtrinh": tencongtrinh,
        "quanhuyen": quanhuyen,
        "doanhnghiep": doanhnghiep,
        "sogiayphep": sogiayphep,
        "diachi_ct": diachi_ct,
        "phuongxa": phuongxa,
        "coso_sanxuat": coso_sanxuat,
        "nam_xd": nam_xd
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            var ws = XLSX.utils.json_to_sheet([{
                A: "Mã công trình", B: "Tên công trình", C: "Địa chỉ công trình", D: "Quận/Huyện",
                E: "Doanh nghiệp", F: "Số giấy phép mới nhất", G: "Phường/Xã", H: "Cơ sở sản xuất", I: "Năm xây dựng"
            }], {
                header: ["A", "B", "C", "D", "E", "F", "G", "H", "I"],
                skipHeader: true
            });

            var results = XLSX.utils.sheet_add_json(ws, data, {
                skipHeader: true,
                origin: "A2",
            })

            /*---- Độ rộng cho từng cột ----*/
            var wscols = [
                {width: 20},
                {width: 100},
                {width: 100},
                {width: 100},
                {width: 100},
                {width: 100},
                {width: 100},
                {width: 100},
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'ktsd_nuocduoidat.xlsx')
        }
    })
})

/* Thêm mới 1 công trình */
$.getJSON("../services/mucdich-ktsd.php", function (mucdichKTSD) {
    $('#mucdich')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Mục đích khai thác/Sử dụng--"));
    $.each(mucdichKTSD, function (key, value) {
        /*** Đánh dấu Option Mục đích được chọn ***/
        $("#mucdich")
            .append($("<option></option>")
                .attr("value", value.id).text(value.mucDich));
    })
})

$('#quanhuyen_modal').change(function () {
    $.post("../services/phuongxa.php", {
        "maHuyen": $(this).val()
    }).done(function (data) {
        if (data.length != 0) {
            /*** Remove Option trước đó ***/
            $('#phuongxa_modal').find('option').remove();
            $('#phuongxa_modal')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn Phường/Xã--"));
            $.each(data, function (key, value) {
                $('#phuongxa_modal')
                    .append($("<option></option>")
                        .attr('value', value.id).text(value.name));
            });
        } else {
            $('#phuongxa_modal').find('option').remove();
            $('#phuongxa_modal')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn Phường/Xã--"));
        }
    })
})

$("#add_ctkt_ndd").on("click", function () {
    $("#info-ctkt").modal("show")
})

$("#add_info_ctkt").on("click", function () {
    var tencongtrinh = $("#tencongtrinh").val();
    var diachi_congtrinh = $("#diachi_ct").val();
    var ma_mucdichktsd = $("#mucdich").val()
    var thoihan_ktsd = $("#thoihan_ktsd").val();
    var ma_dvhc = $("#phuongxa_modal").val();

    if (ma_dvhc == 'none' || tencongtrinh == '' || diachi_congtrinh == '') {
        alert("Chưa nhập đủ thông tin!")
    } else {
        var response_post = $.post("../services/ktsd-ndd/add-ndd-info.php", {
            /*** CT_KTSD ***/
            "tencongtrinh": tencongtrinh,
            "diachi_congtrinh": diachi_congtrinh,
            "ma_mucdichktsd": ma_mucdichktsd,
            "thoihan_ktsd": thoihan_ktsd,
            "ma_dvhc": ma_dvhc
        }).done(function (data) {
            /*** Reset Input ***/
            if (data != "error") {
                alert("Thêm mới công trình thành công");
                window.open("../services/ktsd-ndd/ktsd-ndd-info.php?macongtrinh=" + data, '_blank');
            } else {
                alert("Lỗi cập nhật dữ liệu");
            }
        })
    }
})
