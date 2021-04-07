/*---- Option Range Date ----*/
var tmp = new Date();
var new_day = new Date(tmp.setDate(tmp.getDate() + 1));
$("#rangeDate_gpndd").daterangepicker({
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
function search_gpndd() {
    var status_gpndd = $("#status_gpndd").val();
    var rangeDate_gpndd_start = processDate($("#rangeDate_gpndd").val().split(" - ")[0]);
    var rangeDate_gpndd_end = processDate($("#rangeDate_gpndd").val().split(" - ")[1]);
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
                labelField: "soGiayPhepNDD",
                url: function (cell) {
                    const idgp = cell._cell.row.data.idgp;
                    const macongtrinh = cell._cell.row.data.macongtrinh;
                    return "../services/ktsd-ndd/form-gp-ndd.php?macongtrinh=" + macongtrinh + "&idgp=" + idgp
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
        {title: "Tên công trình khai thác nước", field: "tenCongTrinh", formatter: "textarea", width: "250"},
        {title: "Địa chỉ công trình", field: "diaChiCongTrinh", formatter: "textarea", width: "250"},
        {title: "Mục đích", field: "mucDich", formatter: "textarea", width: "250"},
        {title: "Tầng chứa nước", field: "tangChuaNuoc", formatter: "textarea", width: "200"},
        {title: "Số hiệu", field: "soHieuGieng"},
        {title: "Lưu lượng", field: "tongLuuLuongKT"},
        {title: "Tọa độ X", field: "toaDoX"},
        {title: "Tọa độ Y", field: "toaDoY"},
        {title: "Mực nước tĩnh", field: "mucNuocTinh"},
        {title: "Mực nước động", field: "mucNuocDong"},
    ]

    /*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
    var response_post = $.post("../services/giayphep-nuocduoidat.php", {
        "status_gpndd": status_gpndd,
        "rangeDate_gpndd_start": rangeDate_gpndd_start,
        "rangeDate_gpndd_end": rangeDate_gpndd_end,
        "checked": checked
    })

    response_post.done(function (data) {
        if (data.length != 0) {
            $("#gpndd_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#gpndd_table", {
                ajaxURL: "../services/giayphep-nuocduoidat.php",
                ajaxParams: {
                    "status_gpndd": status_gpndd,
                    "rangeDate_gpndd_start": rangeDate_gpndd_start,
                    "rangeDate_gpndd_end": rangeDate_gpndd_end,
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
            $("#gpndd_table").css("border-top", "none");
            table = new Tabulator("#gpndd_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            })
        }
    })
}

$("#search_gpndd").click(function () {
    search_gpndd();
})

$("#export_gpndd").on("click", function () {
    var status_gpndd = $("#status_gpndd").val();
    var rangeDate_gpndd_start = processDate($("#rangeDate_gpndd").val().split(" - ")[0]);
    var rangeDate_gpndd_end = processDate($("#rangeDate_gpndd").val().split(" - ")[1]);
    var checked = $("input[name='loaingay-option']:checked").val();

    /*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
    var response_post = $.post("../services/giayphep/excel-gp-ndd.php", {
        "status_gpndd": status_gpndd,
        "rangeDate_gpndd_start": rangeDate_gpndd_start,
        "rangeDate_gpndd_end": rangeDate_gpndd_end,
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
                K: "Tổng lưu lượng khai thác",
                L: "Phương thức khai thác",
                M: "Tổng số giếng khai thác",
                N: "Phạm vi cấp nước",
                O: "Số lượng giếng khai thác được phép đầu tư",
                P: "Quyết định vùng bảo hộ vệ sinh",
                Q: "Ngày ban hành quyết định bảo hộ vệ sinh",
                R: "Tài liệu đính kèm"
            }], {
                header: ["A", "B", "C", "D", "E", "F", "G", "H",
                    "I", "J", "K", "L", "M", "N", "O",
                    "P", "Q", "R"],
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
                {width: 20},
                {width: 30},
                {width: 50},
                {width: 50},
                {width: 25},
                {width: 100},
                {width: 20},
                {width: 100},
                {width: 50},
                {width: 50},
                {width: 50},
                {width: 100},
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'giayphep-nuocduoidat.xlsx')
        }
    })
})
