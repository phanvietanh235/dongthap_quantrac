/*---- DOM Option Loại hình ----*/
$.getJSON("../services/loaihinh-option.php", function (loaihinh) {
    $('#loaihinh')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Loại hình--"));
    $.each(loaihinh, function (key, value) {
        $('#loaihinh')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

/*---- DOM Option Loại trạm ----*/
$.getJSON("../services/loaitram-option.php", function (loaitram) {
    $('#loaitram')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Loại trạm--"));
    $.each(loaitram, function (key, value) {
        $('#loaitram')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

/*---- DOM Option Quận huyện ----*/
$.getJSON("../services/district.php", function (district) {
    $('#district')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Huyện/Thị xã--"));
    $.each(district, function (key, value) {
        $('#district')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

/*---- Option Range Date ----*/
var tmp = new Date();
var new_day = new Date(tmp.setDate(tmp.getDate() + 1));
$("#date-rangeAW").daterangepicker({
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

var url_list_WA = '';
$("#WQI-AQI-result-btn").click(function () {
    /*** Reset các Input ***/
    $('#search_quantrac_WA').val('');

    var WA_quantrac_selected = [];
    var item_congtrinh_WA = $("#quantrac-option").val();
    var item_loaihinh_WA = $("#loaihinh").val();
    var item_loaitram_WA = $("#loaitram").val();
    var item_quanhuyen_WA = $("#district").val();
    var fromDate_WA = processDate($("#date-rangeAW").val().split(" - ")[0]);
    var toDate_WA = processDate($("#date-rangeAW").val().split(" - ")[1]);

    item_congtrinh_WA_cond = '%20quantrac_WA=' + item_congtrinh_WA

    if (item_loaihinh_WA == 'none') {
        item_loaihinh_WA_cond = '%20loaihinh_WA=1=1';
    } else {
        item_loaihinh_WA_cond = '%20loaihinh_WA=' + item_loaihinh_WA
    }

    if (item_loaitram_WA == 'none') {
        item_loaitram_WA_cond = '%20loaitram_WA=1=1';
    } else {
        item_loaitram_WA_cond = '%20loaitram_WA=' + item_loaitram_WA
    }

    if (item_quanhuyen_WA == 'none') {
        item_quanhuyen_WA_cond = '%20district_WA=1=1';
    } else {
        item_quanhuyen_WA_cond = '%20district_WA=' + item_quanhuyen_WA
    }

    if (fromDate_WA == '') {
        fromDate_WA_cond = '%20fromDate_WA=%271900-01-01%27';
    } else {
        fromDate_WA_cond = '%20fromDate_WA=' + "%27" + fromDate_WA + "%27";
    }

    if (toDate_WA == '') {
        toDate_WA_cond = '%20toDate_WA=%272200-01-01%27';
    } else {
        toDate_WA_cond = '%20toDate_WA=' + "%27" + toDate_WA + "%27";
    }

    url_list_WA = '../services/aqi-wqi-result.php?' + item_congtrinh_WA_cond + "&" + item_loaihinh_WA_cond + "&" +
        item_loaitram_WA_cond + "&" + item_quanhuyen_WA_cond + "&" +
        fromDate_WA_cond + "&" + toDate_WA_cond;

    /*** DOM result WQI/AQI ***/
    DOM_data_WQI_AQI(url_list_WA);
})

function DOM_data_WQI_AQI(url_list) {
    var table;
    var columns_title = [
        {title: "STT", hozAlign: "center", formatter: "rownum"},
        {title: "Tên trạm", hozAlign: "center", field: "code"},
        {title: "Ngày", hozAlign: "center", field: "day"},
        {title: "Giá trị", hozAlign: "center", field: "value"},
        {title: "Mức độ", hozAlign: "center", field: "qualityColorcode", formatter:"color"},
        {title: "Mục đích", hozAlign: "center", field: "qualityPurpose"},
    ]

    $("#aqiwqi_table").css("border-top", "1px solid #dee2e6");
    table = new Tabulator("#aqiwqi_table", {
        layout:"fitDataStretch",
        ajaxURL: url_list,
        // height: "310px",
        columnVertAlign: "middle",
        columns: columns_title,
        pagination: "local",
        paginationSize: 10,
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
}
