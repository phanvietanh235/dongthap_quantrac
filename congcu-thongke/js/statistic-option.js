var total_std_param;
$.ajax({
    url: "../services/std-para.php",
    async: false,
    dataType: 'json',
    success: function (data) {
        total_std_param = data;
    }
});

/*---- DOM Option Các loại công trình ----*/
$.getJSON("../services/loaicongtrinh-option.php", function (loaicongtrinh) {
    /* $('#loaicongtrinh')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn loại công trình--")); */
    $.each(loaicongtrinh, function (key, value) {
        if (value.id != 5 && value.id != 7) {
            if (value.name_stats != null) {
                $('#congtrinh')
                    .append($("<option></option>")
                        .attr('value', value.type_ct).text(value.name_stats))
            } else {
                $('#congtrinh')
                    .append($("<option></option>")
                        .attr('value', value.type_ct).text(value.name))
            }
        }
    });
})

/*---- DOM Option Quận/Huyện ----*/
$.getJSON("../services/quanhuyen.php", function (quanhuyen) {
    $('#district')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Thị xã/Huyện/Thành phố--"));
    $.each(quanhuyen, function (key, value) {
        $('#district')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

/*---- DOM Option Loại trạm
$.getJSON("../services/category-option.php", function (loaitram) {
    $('#loaitram')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Loại trạm--"));
    $.each(loaitram, function (key, value) {
        $('#loaitram')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
}) ----*/

/*---- DOM Option Quy chuẩn ----*/
$.getJSON("../services/standard-option.php", function(standard) {
    /* $('#standard-option')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Quy chuẩn--")); */
    $.each(standard, function(key, value) {
        $('#quychuan')
            .append($("<option></option>")
                .attr('value', value.symbol).text(value.symbol));
    });
})

/*---- Option Range Date ----*/
var tmp = new Date();
var new_day = new Date(tmp.setDate(tmp.getDate() + 1));
$("#rangedateStatistic").daterangepicker({
    endDate: new_day,
    applyClass: "btn-info",
    opens: "right",
    locale: {
        format: 'DD/MM/YYYY',
        applyLabel: 'Áp dụng',
        cancelLabel: 'Cancel',
    }
});
