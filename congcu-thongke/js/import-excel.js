/*---- Dom Option Quy chuẩn ----*/
$.getJSON("../services/standard-option.php", function(standard) {
    $('#standard-option')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Quy chuẩn--"));
    $.each(standard, function(key, value) {
        $('#standard-option')
            .append($("<option></option>")
                .attr('value', value.id).text(value.symbol));
    });
})

/*---- Dom Option Mục đích ----*/
$.getJSON("../services/purpose-option.php", function(purpose) {
    $('#purpose-option')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Mục đích--"));
    $.each(purpose, function(key, value) {
        $('#purpose-option')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

/*---- Import Excel ----*/
function ProcessExcel() {
    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx)$/;
    /* Checks whether the file is a valid excel file */
    if (regex.test($("#excelfile").val().toLowerCase())) {
        /* Checks whether the browser supports HTML5 */
        if (typeof (FileReader) != "undefined") {
            var reader = new FileReader();
            reader.onload = function (e) {
                var data = new Uint8Array(e.target.result);
                var workbook = XLSX.read(data, {
                    type: 'array',
                    cellDates: true,
                    cellNF: false,
                    cellText: false
                });
                /* Gets all the sheetnames of excel in to a variable */
                var sheet_name_list = workbook.SheetNames;

                /* Iterate through all sheets */
                sheet_name_list.forEach(function (y) {
                    /* Convert the cell value to Json */
                    var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y], {
                        raw: false,
                        range: 4,
                        defval: "",
                        dateNF: "HH:mm:ss YYYY-MM-DD"
                    });

                    $.post("../services/excel-import.php", {
                        /*** Thêm phần quy chuẩn ***/
                        quantrac_option: $('#quantrac-option').val(),
                        quychuan_option: $("#standard-option").val(),
                        importExcel: ProcessJSON(exceljson)
                    }, function (data) {
                        /*** Thông báo chuyển dữ liệu thành công hay thất bại ***/
                        if (data.trim() != "error") {
                            $(".upload-success").css("display", "block");
                            $(".upload-error").css("display", "none");
                            $("#success_upload").text("Chuyển dữ liệu thành công");
                            setTimeout(function() {
                                $(".upload-success").css("display", "none");
                            }, 3000)
                        } else {
                            $(".upload-error").css("display", "block");
                            $(".upload-success").css("display", "none");
                            $("#error_upload").text("Chuyển dữ liệu thất bại");
                            setTimeout(function() {
                                $(".upload-error").css("display", "none");
                            }, 3000)
                        }
                    });
                });
            }
            /* If excel file is .xlsx extension than creates a Array Buffer from excel */
            reader.readAsArrayBuffer($("#excelfile")[0].files[0]);
        } else {
            /*** Thông báo không hỗ trợ trình xuất Excel ***/
            $(".upload-error").css("display", "block");
            $(".upload-success").css("display", "none");
            $("#error_upload").text("Trình duyệt không hỗ trợ xuất Excel");
            setTimeout(function() {
                $(".upload-error").css("display", "none");
            }, 3000)
        }
    } else {
        /*** Thông báo định dạng file Excel ***/
        $(".upload-error").css("display", "block");
        $(".upload-success").css("display", "none");
        $("#error_upload").text("Định dạng lỗi! Vui lòng chọn định dạng xlsx để upload");
        setTimeout(function() {
            $(".upload-error").css("display", "none");
        }, 3000)
    }
}

var total_std_param;
$.ajax({
    url: "../services/std-para.php",
    async: false,
    dataType: 'json',
    success: function (data) {
        total_std_param = data;
    }
});

function ProcessJSON(exceljson) {
    var result = [];
    var select_purpose = $('#purpose-option').val();
    var select_standard = $('#standard-option').val();

    for (var k = 0; k < exceljson.length; k++) {
        var object_keys = Object.keys(exceljson[k]);

        var detail = {};
        var data_para = [];
        for (var i = 0; i < object_keys.length; i++) {
            for (var j = 0; j < total_std_param.length; j++) {
                if (object_keys[i] == total_std_param[j].parameterCode &&
                    total_std_param[j].purposeid == select_purpose &&
                    total_std_param[j].standardID == select_standard) {
                    var object_para = {}

                    /*** Tạo Object Detail cho từng Para ***/
                    object_para[total_std_param[j].id] = {};
                    /*** Kiểm tra có value với thông số đó có hay không, nếu không có thì để Null ***/
                    if (isNaN(parseFloat(exceljson[k][object_keys[i]])) == false) {
                        object_para[total_std_param[j].id].v = parseFloat(exceljson[k][object_keys[i]]);
                        /*** Kiểm tra vượt ngưỡng ***/
                        if (parseFloat(exceljson[k][object_keys[i]]) >= parseFloat(total_std_param[j].min_value) &&
                            parseFloat(exceljson[k][object_keys[i]]) <= parseFloat(total_std_param[j].max_value)) {
                            object_para[total_std_param[j].id].inlimit = "N"
                        } else {
                            object_para[total_std_param[j].id].inlimit = "Y"
                        }
                    } else {
                        continue;
                        /* object_para[total_std_param[j].id].v = null;
                        object_para[total_std_param[j].id].inlimit = "N" */
                    }
                    data_para.push(object_para)
                }
            }
        }

        /*** Xử lý Time and Date ***/
        var time = exceljson[k]['Time (Sample_BTD)'].split(" ")[0];
        if (time == '') {
            time = "00:00:00";
        }

        var date_sampling = exceljson[k]['dateOfSampling (Sample_BTD)'].split(" ")[1];
        var string_date_sampling = date_sampling.split("-");
        var date_sampling_format = string_date_sampling[2] + "/" +
            string_date_sampling[1] + "/" + string_date_sampling[0]

        var date_analysis = exceljson[k]['dateOfAnalysis (Sample_BTD)'].split(" ")[1];
        var string_date_analysis = date_sampling.split("-");
        var date_analysis_format = string_date_analysis[2] + "/" +
            string_date_analysis[1] + "/" + string_date_analysis[0]

        /*** Kiểm tra Undefined do có thực hiện qua 1 function ***/
        if (typeof date_analysis == 'undefined') {
            detail.time = time + ", " + date_sampling_format;
        } else {
            detail.time = time + ", " + date_analysis_format;
        }

        detail.data = data_para;
        if (data_para.length != 0) {
            /*** Đẩy các Items ***/
            result.push({
                "code_station": exceljson[k]['Trạm quan trắc'],
                "symbol": exceljson[k]['Trạm quan trắc'],
                "time": time,
                "dateOfSampling": date_sampling,
                "dateOfAnalysis": typeof date_analysis == 'undefined' ? date_sampling : date_analysis,
                "samplingLocations": exceljson[k]['samplingLocations (Sample_BTD)'],
                "weather": exceljson[k]['Weather (Sample_BTD)'],
                "idExcel": exceljson[k]['IdSTT'],
                "detail_data": detail
            })
        } else {
            result.push({
                "status": 'error'
            })
        }
    }

    return result
}
