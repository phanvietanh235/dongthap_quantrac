/*----- DOM Option Trạm quan trắc/Giếng, Điểm khai thác dùng Select 2-----*/
$("#tramqt").select2({
    ajax: {
        url: "../services/statistic/list-station.php",
        data: function (params) {
            return {
                data: JSON.stringify({
                    searchTerm: params.term,
                    congtrinh: $("#congtrinh").val(),
                    district: $("#district").val(),
                    quychuan: $("#quychuan").val()
                })
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
    placeholder: "--Lựa chọn trạm/điểm/giếng khai thác--",
    allowClear: true,
    width: "resolve",
    language: {
        searching: function () {
            return "Đang tìm ...";
        }
    },
})

/*----- DOM Option Thông số -----*/
$("#para").select2({
    ajax: {
        url: "../services/statistic/list-thongso.php",
        data: function (params) {
            return {
                data: JSON.stringify({
                    /* searchTerm: params.term, */
                    congtrinh: $("#congtrinh").val(),
                    station: $("#tramqt").select2('val')
                })
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
    placeholder: "--Lựa chọn thông số--",
    allowClear: true,
    width: "resolve",
    language: {
        searching: function () {
            return "Đang tìm ...";
        }
    },
})
$('#para').on('select2:opening select2:closing', function (event) {
    var $searchfield = $(this).parent().find('.select2-search__field');
    $searchfield.prop('disabled', true);
});

/*** Hàm xử lý Date ***/
function processDate(date, fromto) {
    var string_day = date.split("/");
    /*** Gộp thành chuỗi rồi chuyển sang dạng thời gian mặc định ***/
    var data_day_time = string_day[2] + "-" + string_day[1] + "-" + string_day[0];
    if (fromto == 'from') {
        return moment(new Date(data_day_time + " 00:00:00")).format('YYYY-MM-DD HH:mm:ss');
    } else {
        return moment(new Date(data_day_time + " 23:59:59")).format('YYYY-MM-DD HH:mm:ss');
    }
}

/*----- Kết quả thống kê -----*/
$("#search_statistic").on('click', function () {
    $(document).ajaxSend(function() {
        $('.loader-stats').show();
    });

    /* Reset Tab */
    if ($("#tab_statistic li:nth-child(2) a").hasClass("active")) {
        $("#tab_statistic li:nth-child(2) a").removeClass("active")
        $("#tab_statistic li:nth-child(1) a").addClass("active")

        $("#nav-tabs-1").addClass("active")
        $("#nav-tabs-1").addClass("show")

        $("#nav-tabs-3").removeClass("active")
        $("#nav-tabs-3").removeClass("show")
    }

    /* var dis_time = $("#dis-time").val() */
    var rangeStats_start = processDate($("#rangedateStatistic").val().split(" - ")[0], "from");
    var rangeStats_end = processDate($("#rangedateStatistic").val().split(" - ")[1], "to");
    var thongso = $("#para").select2('val')
    var station = $("#tramqt").select2('val')

    var response_post = $.post("../services/statistic/stats-result.php", {
        "thongso": thongso,
        "station": station,
        "congtrinh": $("#congtrinh").val(),
        "start": rangeStats_start,
        "end": rangeStats_end
    })

    /* Render Column */
    var table;
    var columns_title;
    $.ajax({
        url: "../services/statistic/stats-result-column.php",
        data: {
            "thongso": thongso,
            "station": station,
            "station_text": function () {
                var selected = $('#tramqt').select2("data");
                var arr = [];
                for (var i = 0; i < selected.length; i++) {
                    arr.push(selected[i].text)
                }
                return arr;
            }
        },
        async: false,
        dataType: 'json',
        type: "POST",
        success: function(data) {
            columns_title = data;
        }
    })

    /*-- Bảng dữ liệu --*/
    response_post.done(function(data) {
        if (data.length != 0) {
            $("#statistic_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#statistic_table", {
                layout: "fitDataFill",
                ajaxURL: "../services/statistic/stats-result.php",
                ajaxParams: {
                    "thongso": thongso,
                    "station": station,
                    "congtrinh": $("#congtrinh").val(),
                    "start": rangeStats_start,
                    "end": rangeStats_end
                },
                ajaxConfig: "post",
                height: "calc(100% - 15px)",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
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
                },
                rowFormatter: function(row) {
                    var data = row.getData();
                    if (data.quanhuyen == true) {
                        row.getElement().style.fontWeight = "bold";
                        row.getElement().style.backgroundColor = "#4f8aff";
                    }
                },
            })
            table.setData();
            table.setLocale("vi");
        } else {
            $("#statistic_table").css("border-top", "none");
            table = new Tabulator("#statistic_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            })
        }
    })

    /*-- Biểu đồ --*/
    var data_chart;
    $.ajax({
        url: "../services/statistic/stats-result-chart.php",
        data: {
            "thongso": thongso,
            "station": station,
            "congtrinh": $("#congtrinh").val(),
            "start": rangeStats_start,
            "end": rangeStats_end
        },
        async: false,
        dataType: 'json',
        type: "POST",
        success: function(data) {
            data_chart = data;
        }
    })

    /* Render Div */
    var dom_chart = "";
    for (var i = 0; i < thongso.length; i++) {
        dom_chart += "<div id='thongso_" + thongso[i] + "' style='height: 400px'>" + "</div>"
    }
    $(".chart-render").html(dom_chart)

    /* Thông số text */
    var para_selected = $('#para').select2("data");
    var para_arr = [];
    for (var i = 0; i < para_selected.length; i++) {
        para_arr.push(para_selected[i].text)
    }
    /* Station text */
    var station_selected = $('#tramqt').select2("data");
    var station_text = [];
    for (var i = 0; i < station_selected.length; i++) {
        station_text.push(station_selected[i].text)
    }

    for (var i = 0; i < thongso.length; i++) {
        var dom_chart = data_chart.data[thongso[i]];

        /* Get min max Chart Data */
        var minRange, maxRange;
        for (var k_para = 0; k_para < total_std_param.length; k_para++) {
            if (parseInt(thongso[i]) == total_std_param[k_para].id) {
                minRange = total_std_param[k_para].min_value;
                maxRange = total_std_param[k_para].max_value;
            }
        }

        for (var j = 0; j < dom_chart.length; j++) {
            dom_chart[j].timejs = moment(dom_chart[j].timejs).toDate();
        }
        var unit
        if (para_arr[i].includes(", đơn vị: ")) {
            unit = para_arr[i].split(", đơn vị: ")[1];
        } else {
            unit = '';
        }

        if ($("#linechart-option:checked").val() == 'on') {
            render_groupLinechart_quantrac("thongso_" + thongso[i],
                dom_chart, para_arr[i], unit, "timejs", station_text, station, minRange, maxRange)
        } else {
            render_groupColumnchart_quantrac("thongso_" + thongso[i],
                dom_chart, para_arr[i], unit, "timejs", station_text, station, minRange, maxRange)
        }
        }

    $(document).ajaxStop(function() {
        $('.loader-stats').hide();
    });
})


