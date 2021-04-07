/*---- Option Range Date ----*/
var tmp = new Date();
var new_day = new Date(tmp.setDate(tmp.getDate() + 1));
$("#rangeDate_gptd").daterangepicker({
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
function search_gptd() {
    var status_gptd = $("#status_gptd").val();
    var rangeDate_gptd_start = processDate($("#rangeDate_gptd").val().split(" - ")[0]);
    var rangeDate_gptd_end = processDate($("#rangeDate_gptd").val().split(" - ")[1]);
    var checked = $("input[name='loaingay-option']:checked").val();

    /*** DOM Table using Tabulator ***/
    var table;
    var columns_title = [
        {title: "STT", formatter: "rownum", frozen: true},
        {
            title: "Số giấy phép",
            field: "idgp",
            frozen: true,
            hozAlign: "center",
            formatter: "link",
            formatterParams: {
                labelField: "soGiayPhepTD",
                url: function (cell) {
                    const idgp = cell._cell.row.data.idgp;
                    const macongtrinh = cell._cell.row.data.macongtrinh;
                    return "../services/ktsd-td/form-gp-td.php?macongtrinh=" + macongtrinh + "&idgp=" + idgp
                },
                target: "_blank"
            }
        },
        {title: "Ngày cấp phép", field: "ngayCapPhep"},
        {title: "Thời hạn giấy phép", field: "thoiHanGiayPhep"},
        {title: "Tên doanh nghiệp", field: "tenDoanhNghiep", formatter: "textarea", width: "250"},
        {title: "Địa chỉ doanh nghiệp", field: "diachiDoanhNghiep", formatter: "textarea", width: "250"},
        {title: "Tên cơ sở sản xuất", field: "coSoKTSD", formatter: "textarea", width: "250"},
        {title: "Địa chỉ cơ sở sản xuất", field: "diachiCSSX", formatter: "textarea", width: "250"},
        {title: "Địa chỉ công trình", field: "diaChiCongTrinh", formatter: "textarea", width: "250"},
        {title: "Số lượng giếng thăm dò", field: "soLuongGiengTD"},
        {title: "Lưu lượng", field: ""},
        {title: "Tầng chứa nước", field: "tangChuaNuoc", formatter: "textarea", width: "250"},
    ]

    /*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
    var response_post = $.post("../services/giayphep-thamdo.php", {
        "status_gptd": status_gptd,
        "rangeDate_gptd_start": rangeDate_gptd_start,
        "rangeDate_gptd_end": rangeDate_gptd_end,
        "checked": checked
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            $("#gptd_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#gptd_table", {
                ajaxURL: "../services/giayphep-thamdo.php",
                ajaxParams: {
                    "status_gptd": status_gptd,
                    "rangeDate_gptd_start": rangeDate_gptd_start,
                    "rangeDate_gptd_end": rangeDate_gptd_end,
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
            $("#gptd_table").css("border-top", "none");
            table = new Tabulator("#gptd_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            })
        }
    })
}

$("#search_gptd").click(function () {
    search_gptd();
})

$("#export_gptd").on("click", function () {
    var status_gptd = $("#status_gptd").val();
    var rangeDate_gptd_start = processDate($("#rangeDate_gptd").val().split(" - ")[0]);
    var rangeDate_gptd_end = processDate($("#rangeDate_gptd").val().split(" - ")[1]);
    var checked = $("input[name='loaingay-option']:checked").val();

    var response_post = $.post("../services/giayphep/excel-gp-td.php", {
        "status_gptd": status_gptd,
        "rangeDate_gptd_start": rangeDate_gptd_start,
        "rangeDate_gptd_end": rangeDate_gptd_end,
        "checked": checked
    })

    response_post.done(function (data) {
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
                K: "Mục đích thăm dò",
                L: "Quy mô thăm dò",
                M: "Ghi chú",
                N: "Tài liệu đính kèm"
            }], {
                header: ["A", "B", "C", "D", "E", "F", "G", "H",
                    "I", "J", "K", "L", "M", "N"],
                skipHeader: true
            });

            var results = XLSX.utils.sheet_add_json(ws, data, {
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
                {width: 50},
                {width: 20},
                {width: 50},
                {width: 50},
                {width: 100},
                {width: 100},
                {width: 100},
                {width: 50}
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'giayphep-thamdo.xlsx')
        }
    })
})
