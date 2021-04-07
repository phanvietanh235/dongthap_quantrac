/*----- DOM Option Nguồn tiếp nhận -----*/
$("#tiepnhan_option").select2({
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
    placeholder: "--Lựa chọn nguồn tiếp nhận--",
    allowClear: true,
    width: "resolve",
    language: {
        searching: function() {
            return "Đang tìm ...";
        }
    },
});

/*---- Option Range Date ----*/
var tmp = new Date();
var new_day = new Date(tmp.setDate(tmp.getDate() + 1));
$("#rangeDate_gpxt").daterangepicker({
    endDate: new_day,
    applyClass: "btn-info",
    opens: "right",
    locale: {
        format: 'DD/MM/YYYY',
        applyLabel: 'Áp dụng',
        cancelLabel: 'Cancel',
    }
});

/*** Hàm xử lý Date ***/
function processDate(date) {
    var string_day = date.split("/");
    /*** Gộp thành chuỗi rồi chuyển sang dạng thời gian mặc định ***/
    var data_day_time = new Date(string_day[2] + "-" + string_day[1] + "-" + string_day[0]);
    return moment(new Date(data_day_time)).format('YYYY-MM-DD');
}

/*---- Tìm kiếm giấy phép nước mặt ----*/
function search_gpxt() {
    var status_gpxt = $("#status_gpxt").val();
    var tiepnhan_option = $("#tiepnhan_option").val();
    if (tiepnhan_option === null) {
        tiepnhan_option = [];
    }
    var rangeDate_gpxt_start = processDate($("#rangeDate_gpxt").val().split(" - ")[0]);
    var rangeDate_gpxt_end = processDate($("#rangeDate_gpxt").val().split(" - ")[1]);
    var checked = $("input[name='loaingay-option']:checked").val();

    /*** DOM Table using Tabulator ***/
    var table;
    var columns_title = [
        { title: "STT", formatter: "rownum", frozen: true },
        {
            title: "Số giấy phép",
            field: "idgp",
            frozen: true,
            hozAlign: "center",
            formatter: "link",
            formatterParams: {
                labelField: "soGiayPhepXT",
                url: function(cell) {
                    const idgp = cell._cell.row.data.idgp;
                    const macongtrinh = cell._cell.row.data.macongtrinh;
                    return "../services/ktsd-xt/form-gp-xt.php?macongtrinh=" + macongtrinh + "&idgp=" + idgp
                },
                target: "_blank"
            }
        },
        { title: "Ngày cấp phép", field: "ngayCapPhep" },
        { title: "Thời hạn giấy phép", field: "thoiHanGiayPhep" },
        { title: "Tên doanh nghiệp", field: "tenDoanhNghiep", formatter: "textarea", width: "250" },
        { title: "Địa chỉ doanh nghiệp", field: "diachiDoanhNghiep", formatter: "textarea", width: "250" },
        { title: "Tên cơ sở sản xuất", field: "coSoKTSD", formatter: "textarea", width: "250" },
        { title: "Địa chỉ cơ sở sản xuất", field: "diachiCSSX", formatter: "textarea", width: "250" },
        { title: "Tên công trình xả thải", field: "tenCongTrinh", formatter: "textarea", width: "250" },
        { title: "Địa chỉ công trình", field: "diaChiCongTrinh", formatter: "textarea", width: "250" },
        { title: "Loại hình nước thải", field: "LoaihinhXT", formatter: "textarea", width: "250" },
        { title: "Lưu lượng", field: "tongLLXaLonNhatMuaKho" },
        /* {title: "QUY CHUẨN KỸ THUẬT QUỐC GIA", field: ""}, */
        { title: "Tọa độ X", field: "toaDoX" },
        { title: "Tọa độ Y", field: "toaDoY" },
        { title: "Nguồn tiếp nhận", field: "nguonTiepNhanNT", formatter: "textarea", width: "250" }
    ]

    /*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
    var response_post = $.post("../services/giayphep-xathai.php", {
        "status_gpxt": status_gpxt,
        "tiepnhan_option": tiepnhan_option,
        "rangeDate_gpxt_start": rangeDate_gpxt_start,
        "rangeDate_gpxt_end": rangeDate_gpxt_end,
        "checked": checked
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#gpxt_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#gpxt_table", {
                ajaxURL: "../services/giayphep-xathai.php",
                ajaxParams: {
                    "status_gpxt": status_gpxt,
                    "tiepnhan_option": tiepnhan_option,
                    "rangeDate_gpxt_start": rangeDate_gpxt_start,
                    "rangeDate_gpxt_end": rangeDate_gpxt_end,
                    "checked": checked
                },
                ajaxConfig: "post",
                pagination: "local",
                paginationSize: 10,
                height: "500px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
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
            $("#gpxt_table").css("border-top", "none");
            table = new Tabulator("#gpxt_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            })
        }
    })
}

$("#search_gpxt").click(function() {
    search_gpxt();
})

$("#export_gpxt").on("click", function() {
    var status_gpxt = $("#status_gpxt").val();
    var tiepnhan_option = $("#tiepnhan_option").val();
    if (tiepnhan_option === null) {
        tiepnhan_option = [];
    }
    var rangeDate_gpxt_start = processDate($("#rangeDate_gpxt").val().split(" - ")[0]);
    var rangeDate_gpxt_end = processDate($("#rangeDate_gpxt").val().split(" - ")[1]);
    var checked = $("input[name='loaingay-option']:checked").val();

    var response_post = $.post("../services/giayphep/excel-gp-xt.php", {
        "status_gpxt": status_gpxt,
        /* "tiepnhan_option": tiepnhan_option, */
        "rangeDate_gpxt_start": rangeDate_gpxt_start,
        "rangeDate_gpxt_end": rangeDate_gpxt_end,
        "checked": checked
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            /*---- Export Excel From JSON ----*/
            var ws = XLSX.utils.json_to_sheet([{
                A: "Số giấy phép",
                B: "Loại giấy phép",
                C: "Ngày cấp phép",
                D: "Ngày hết hạn",
                E: "Tên doanh nghiệp",
                F: "Địa chỉ doanh nghiệp",
                G: "Tình trạng giấy phép",
                H: "Thời hạn cấp phép",
                I: "Đơn vị cấp phép",
                J: "Đơn vị quản lý",
                K: "Tổng lưu lượng xả lớn nhất",
                L: "Tổng lưu lượng xả lớn nhất mùa khô",
                M: "Tổng số điểm xả",
                N: "Ghi chú",
                O: "Tài liệu đính kèm",
            }], {
                header: ["A", "B", "C", "D", "E", "F", "G", "H",
                    "I", "J", "K", "L", "M", "N", "O",
                    "P", "Q", "R"],
                skipHeader: true
            });

            var results = XLSX.utils.sheet_add_json(ws, data,{
                skipHeader: true,
                origin: "A2",
            })
            /*---- Độ rộng cho từng cột ----*/
            var wscols = [
                {width: 20},
                {width: 20},
                {width: 20},
                {width: 20},
                {width: 100},
                {width: 100},
                {width: 20},
                {width: 20},
                {width: 50},
                {width: 50},
                {width: 50},
                {width: 50},
                {width: 20},
                {width: 100},
                {width: 50},
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'giayphep-xathai.xlsx')
        }
    })
})
