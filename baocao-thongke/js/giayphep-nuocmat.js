/*----- DOM Option Lưu vực sông -----*/
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

/*---- Option Range Date ----*/
var tmp = new Date();
var new_day = new Date(tmp.setDate(tmp.getDate() + 1));
$("#rangeDate_gpnm").daterangepicker({
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
function search_gpnm() {
    var status_gpnm = $("#status_gpnm").val();
    var basin_option = $("#basin_option").val();
    if (basin_option === null) {
        basin_option = [];
    }
    var rangeDate_gpnm_start = processDate($("#rangeDate_gpnm").val().split(" - ")[0]);
    var rangeDate_gpnm_end = processDate($("#rangeDate_gpnm").val().split(" - ")[1]);
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
                labelField: "soGiayPhepNM",
                url: function(cell) {
                    const idgp = cell._cell.row.data.idgp;
                    const macongtrinh = cell._cell.row.data.macongtrinh;
                    return "../services/ktsd-nm/form-gp-nm.php?macongtrinh=" + macongtrinh + "&idgp=" + idgp
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
        { title: "Tên công trình khai thác nước", field: "tenCongTrinh", formatter: "textarea", width: "250" },
        { title: "Địa chỉ công trình", field: "diaChiCongTrinh", formatter: "textarea", width: "250" },
        { title: "Loại công trình", field: "Loaicongtrinh" },
        { title: "Mục đích", field: "mucDich", formatter: "textarea", width: "200" },
        { title: "Lưu lượng", field: "tongLLKTLonNhatTungThoiKy" },
        {
            title: "Tọa độ",
            columns: [
                { title: "Tọa độ X", field: "toaDoX" },
                { title: "Tọa độ Y", field: "toaDoY" },
            ]
        },
        { title: "Lưu vực sông khai thác", field: "nguonKhaiThac" }
    ]

    /*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
    var response_post = $.post("../services/giayphep-nuocmat.php", {
        "status_gpnm": status_gpnm,
        "basin_option": basin_option,
        "rangeDate_gpnm_start": rangeDate_gpnm_start,
        "rangeDate_gpnm_end": rangeDate_gpnm_end,
        "checked": checked
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#gpnm_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#gpnm_table", {
                ajaxURL: "../services/giayphep-nuocmat.php",
                ajaxParams: {
                    "status_gpnm": status_gpnm,
                    "basin_option": basin_option,
                    "rangeDate_gpnm_start": rangeDate_gpnm_start,
                    "rangeDate_gpnm_end": rangeDate_gpnm_end,
                    "checked": checked
                },
                ajaxConfig: "post",
                height: "500px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
                columns: columns_title
            })
            table.setData();
        } else {
            $("#gpnm_table").css("border-top", "none");
            table = new Tabulator("#gpnm_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            })
        }
    })
}

$("#search_gpnm").click(function() {
    search_gpnm();
})

$("#export_gpnm").on("click", function() {
    var status_gpnm = $("#status_gpnm").val();
    var basin_option = $("#basin_option").val();
    if (basin_option === null) {
        basin_option = [];
    }
    var rangeDate_gpnm_start = processDate($("#rangeDate_gpnm").val().split(" - ")[0]);
    var rangeDate_gpnm_end = processDate($("#rangeDate_gpnm").val().split(" - ")[1]);
    var checked = $("input[name='loaingay-option']:checked").val();

    /*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
    var response_post = $.post("../services/giayphep/excel-gp-nm.php", {
        "status_gpnm": status_gpnm,
        /* "basin_option": basin_option, */
        "rangeDate_gpnm_start": rangeDate_gpnm_start,
        "rangeDate_gpnm_end": rangeDate_gpnm_end,
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
                K: "Tổng lưu lượng khai thác lớn nhất từng thời kỳ",
                L: "Tổng lượng nước sử dụng trong năm",
                M: "Phạm vi cấp nước",
                N: "Quyết định vùng bảo hộ vệ sinh",
                O: "Ngày ban hành quyết định bảo hộ vệ sinh",
                P: "Ghi chú",
                Q: "Tài liệu đính kèm"
            }], {
                header: ["A", "B", "C", "D", "E", "F", "G", "H",
                    "I", "J", "K", "L", "M", "N", "O",
                    "P", "Q"],
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
                {width: 100},
                {width: 40},
                {width: 50},
                {width: 100},
                {width: 50},
            ];
            results['!cols'] = wscols;
            var wb = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(wb, results, 'res')
            XLSX.writeFile(wb, 'giayphep-nuocmat.xlsx')
        }
    })
})
