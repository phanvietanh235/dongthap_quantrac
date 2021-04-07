var total_std_param;
$.ajax({
    url: "../services/std-para.php",
    async: false,
    dataType: 'json',
    success: function (data) {
        total_std_param = data;
    }
});

/*** Hàm sort json theo object ***/
function sortResults(data, prop, asc) {
    data.sort(function (a, b) {
        if (asc) {
            return (a[prop] > b[prop]) ? 1 : ((a[prop] < b[prop]) ? -1 : 0);
        } else {
            return (b[prop] > a[prop]) ? 1 : ((b[prop] < a[prop]) ? -1 : 0);
        }
    });
    return data;
}

function format(d) {
    var DOM_child_table = '';
    var parameterName, parameterID, unitName;
    var spidID, value;

    var total_detail = d.total_detail;

    if (total_detail.length != 0) {
        DOM_child_table = '<div class="table-wrapper-threshold">' +
            '<table class="table table-bordered table-striped table-hover">';
        DOM_child_table += '<thead>' +
            '<tr>' +
            '<th class="first-col-threshold" scope="col" ' +
            'style="border-top: none !important"></th>' +
            '<th class="first-col-threshold" scope="col" ' +
            'style="border-top: 1px solid #ddd !important; ' +
            'margin-top: -1px; text-align: center;">Thời gian/Thông số</th>'

        /*** DOM tên thông số chung kèm Min Max***/
        var detail_data_param = total_detail[0].data;
        for (var i_threshold = 0; i_threshold < detail_data_param.length; i_threshold++) {
            spidID = Object.keys(detail_data_param[i_threshold]);
            /* var min, max, dom_min_max; */
            for (var k_para_threshold = 0; k_para_threshold < total_std_param.length; k_para_threshold++) {
                if (parseInt(spidID) == total_std_param[k_para_threshold].id) {
                    parameterID = total_std_param[k_para_threshold].parameterid;
                    parameterName = total_std_param[k_para_threshold].parameterName;
                    min = total_std_param[k_para_threshold].min_value;
                    max = total_std_param[k_para_threshold].max_value;

                    /*** DOM ngưỡng dữ liệu
                     if (min == null && max != null) {
                            dom_min_max = '&#8804; ' + max;
                        }
                     if (min != null && max == null) {
                            dom_min_max = '&#8805; ' + min;
                        }
                     if (min != null && max != null) {
                            dom_min_max = min + ' &#8804; x &#8804; ' + max;
                        }  ***/
                }
            }
            /*** DOM min max
             DOM_child_table += '<th scope="col" style="white-space: nowrap;" ' +
             'class="parameter_tab" id="' + spidID + '">' +
             parameterName + ' (' + dom_min_max + ')</th>'; ***/

            DOM_child_table += '<th scope="col" style="white-space: nowrap;" ' +
                'class="parameter_tab" id="' + spidID + "_" + row_detail + '">' +
                parameterName + '</th>';
        }

        /*** DOM value vượt ngưỡng ***/
        /*** Thay đổi rowspan theo time và date  ***/
        DOM_child_table += '</thead><tbody>' + '<tr>' +
            '<th class="first-col-threshold" rowspan="' + total_detail.length + '"></th>';

        /*** Tạo bảng dữ liệu trước ***/
        for (var i_dom_threshold = 0; i_dom_threshold < total_detail.length; i_dom_threshold++) {
            var detail_data_value = total_detail[i_dom_threshold].data;
            var j_threshold;
            var td_id_threshold;

            /*** DOM hàng đầu tiên không thêm thẻ tr ***/
            if (i_dom_threshold == 0) {
                /*** Thời gian ***/
                DOM_child_table += '<td style="text-align: center; border-bottom-width: 1px;" ' +
                    'class="first-col-threshold ' + i_dom_threshold + "_" + row_detail +
                    '_daytimes' + '">' +
                    '</td>';
                /*** Số liệu vượt ngưỡng và đơn vị ***/
                for (j_threshold = 0; j_threshold < detail_data_value.length; j_threshold++) {
                    /*** Thêm thuộc tính ID có chứa hàng row i và ID thông số ***/
                    td_id_threshold = Object.keys(detail_data_value[j_threshold]) +
                        "_" + i_dom_threshold;

                    DOM_child_table += '<td style="text-align: center" ' +
                        'id="' + td_id_threshold + "_" + row_detail + '">' +
                        '<b class="red"></b>' +
                        '</td>';
                }
            }
            DOM_child_table += '</tr>';

            /*** DOM các hàng tiếp theo cần thêm thẻ tr ***/
            if (i_dom_threshold >= 1) {
                /*** Thời gian ***/
                DOM_child_table += '<tr><td style="text-align: center; border-bottom-width: 1px;" ' +
                    'class="first-col-threshold ' + i_dom_threshold + "_" + row_detail +
                    '_daytimes' + '">' +
                    '</td>';
                /*** Số liệu vượt ngưỡng và đơn vị ***/
                for (j_threshold = 0; j_threshold < detail_data_value.length; j_threshold++) {
                    /*** Thêm thuộc tính ID có chứa hàng row i và ID thông số ***/
                    td_id_threshold = Object.keys(detail_data_value[j_threshold]) +
                        "_" + i_dom_threshold;

                    DOM_child_table += '<td style="text-align: center" ' +
                        'id="' + td_id_threshold + "_" + row_detail + '">' +
                        '<b class="red"></b>' +
                        '</td>';
                }
                DOM_child_table += '</tr>'
            }
        }
        DOM_child_table += '</tbody></table></div>';
    } else {
        DOM_child_table = '<div class="red" style="text-align: center;">' +
            '<b>Không có dữ liệu</b></div>'
    }
    return DOM_child_table;
}

/*---- Hàm cắt chuối JSON trả về theo thời gian ----*/
function onChangeTime_feature(time, type) {
    /*---- Call Threshold Station using Ajax ----*/
    var detail_threshold_station;
    $.ajax({
        url: "../services/threshold-station.php",
        async: false,
        dataType: 'json',
        success: function (data) {
            detail_threshold_station = data;
        }
    });

    var data_threshold_station = detail_threshold_station.data;
    var length_station_threshold = detail_threshold_station.data.length;

    /*** Tìm thời gian x (1, 8 hoặc 24) giờ trước hoặc 30 phút trước ***/
    var d_curent = new Date();
    var d_hour_minus;
    if (type == "hour") {
        d_hour_minus = new Date(d_curent.setHours(d_curent.getHours() - time));
    } else {
        d_hour_minus = new Date(d_curent.setMinutes(d_curent.getMinutes() - time));
    }

    for (var i = 0; i < length_station_threshold; i++) {
        var total_detail = data_threshold_station[i].total_detail;
        /*** Vòng lặp phải chạy ngược từ length - 1 về 0 ==> Hàm splice mới thực hiện chính xác ***/
        for (var j = total_detail.length - 1; j >= 0; j--) {

            var detail_daytime = total_detail[j].time.split(", ");
            var detail_day = detail_daytime[1];
            var detail_time = detail_daytime[0];

            /*** Chuyển detail time sang time mặc định trong JS ***/
            var string_day = detail_day.split("/");

            /*** Gộp thành chuỗi rồi chuyển sang dạng thời gian mặc định ***/
            var data_day_time = new Date(string_day[2] + "/" + string_day[1] + "/" + string_day[0] +
                " " + detail_time);

            total_detail[j]['time_js'] = data_day_time;
            // console.log(data_day_time)

            if (data_day_time.getTime() < d_hour_minus.getTime()) {
                /*** Dùng hàm Splice cắt phần tử mảng ở vị trí thứ j và bỏ đi 1 phần tử ***/
                total_detail.splice(j, 1);
            }
            detail_threshold_station.data[i].total_detail = total_detail;
        }
        sortResults(total_detail, 'time_js', false);
    }

    data_threshold_station = detail_threshold_station.data;
    length_station_threshold = detail_threshold_station.data.length;

    /*** Filter Object để loại bỏ các trạm có độ dài detail bằng 0 ***/
    data_threshold_station = data_threshold_station.filter(function (obj) {
        return obj.total_detail.length !== 0;
    });

    detail_threshold_station.data = data_threshold_station;
    var resutl_total_threshold_station = detail_threshold_station;

    return resutl_total_threshold_station;
}

/*** Hàm này được thực hiện sau khi tạo được bảng con hoàn chỉnh ***/
function DOM_data_child_Threshold(row_detail, time) {
    var total_threshold_station = onChangeTime_feature(time, "hour");
    var total_detail = total_threshold_station.data[row_detail].total_detail;

    for (var i_dom_threshold = 0; i_dom_threshold < total_detail.length; i_dom_threshold++) {
        var detail_data_value = total_detail[i_dom_threshold].data;
        var detail_data_daytime = total_detail[i_dom_threshold].time.split(", ");
        var detail_data_day = detail_data_daytime[1];
        var detail_data_time = detail_data_daytime[0];
        var j_threshold;
        var td_id_threshold;
        var valueinlimit;

        /*** DOM daytimes into Cell with class `row + _daytimes` ***/
        $("." + i_dom_threshold + "_" + row_detail + "_daytimes").css("white-space", "nowrap")
        $("." + i_dom_threshold + "_" + row_detail + "_daytimes").html(detail_data_time + " | " + detail_data_day)

        for (j_threshold = 0; j_threshold < detail_data_value.length; j_threshold++) {
            spidID = Object.keys(detail_data_value[j_threshold]);
            td_id_threshold = spidID + "_" + i_dom_threshold;

            value = Object.values(detail_data_value[j_threshold]);
            for (var k_value_threshold = 0; k_value_threshold < total_std_param.length; k_value_threshold++) {
                /*** Chỉ DOM các dữ liệu vượt ngưỡng (xét value[0].inlimit) ***/
                if (parseInt(spidID) == total_std_param[k_value_threshold].id && value[0].inlimit == "Y") {
                    valueinlimit = value[0].v;
                    unitName = total_std_param[k_value_threshold].unitName;
                    /*** DOM values into Cell with ID ***/
                    $("#" + td_id_threshold + "_" + row_detail + " b").css("white-space", "nowrap")
                    if (unitName != null) {
                        $("#" + td_id_threshold + "_" + row_detail + " b").html(valueinlimit + " " + unitName)
                    } else {
                        $("#" + td_id_threshold + "_" + row_detail + " b").html(valueinlimit)
                    }
                }
            }
        }
    }
}

/*** Biến row_detail phải là biến toàn cục
 để có thể gắn ID cho việc tạo bảng DOM thresholdModal ***/
var row_detail;
function getData_threshold_station() {
    /*---- Datables danh sách vượt ngưỡng ----*/
    var data_onchange = onChangeTime_feature(1, "hour");

    if ($.fn.DataTable.isDataTable('#table_threshold')) {
        /*** Trigger nút button 1 giờ để reload dữ liệu 1 giờ khi người dùng tắt, bật lại ***/
        $('#filter_1h').trigger('click');
    }
    if (!$.fn.DataTable.isDataTable('#table_threshold')) {
        $(document).ready(function () {
            /*** Datatable Vượt ngưỡng ***/
            var table_threshold = $('#table_threshold').DataTable({
                data: data_onchange.data,
                columns: [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                    {"data": "name"},
                    {"data": "obstype_namelist"},
                    {"data": "categoryName"},
                    {"data": "districtName"}
                ],
                order: [
                    [1, 'asc']
                ],
                dom: "<'row'<'col-sm-7'B><'col-sm-3'l><'col-sm-2'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                buttons: [
                    {extend: 'pdf', className: 'btn btn-danger btn-sm'},
                    {extend: 'excel', className: 'btn btn-danger btn-sm'}
                ],
                paging: false,
                autoWidth: false,
                "language": {
                    pagingType: "full_numbers",
                    search: '<span>Tìm kiếm:</span> _INPUT_',
                    searchPlaceholder: 'Gõ để tìm...',
                    paginate: {
                        'first': 'First',
                        'last': 'Last',
                        'next': $('html').attr('dir') == 'rtl' ? '<span style="font-size:13px;">Trước</span>' : '<span style="font-size:13px;">Sau</span>',
                        'previous': $('html').attr('dir') == 'rtl' ? '<span style="font-size:13px;">Sau</span>' : '<span style="font-size:13px;">Trước</span>'
                    },
                    sLengthMenu: "<span>Hiển thị&nbsp;</span> _MENU_<span> kết quả</span>",
                    sZeroRecords: "Không tìm thấy kết quả",
                    sInfo: "Hiển thị _START_ đến _END_ trên _TOTAL_ dòng",
                    sInfoFiltered: "(tất cả _MAX_ dòng)",
                    sInfoEmpty: "Hiển thị 0 đến _END_ trên _TOTAL_ dòng",
                },
            });

            table_threshold.buttons().container()
                .appendTo('#table_threshold_wrapper .col-md-12:eq(0)');

            $('<button class="dt-button buttons-html5 btn btn-sm active" id="filter_1h" ' +
                'type="button" aria-controls="table_threshold" tabindex="0" ' +
                'style="margin-right: 4.5px; margin-left: 30%;">' +
                '<span>1 giờ</span>' +
                '</button>' +
                '<button class="dt-button buttons-html5 btn btn-sm" id="filter_8h" ' +
                'type="button" aria-controls="table_threshold" tabindex="0" style="margin-right: 4.5px;">' +
                '<span>8 giờ</span>' +
                '</button>' +
                '<button class="dt-button buttons-html5 btn btn-sm" id="filter_24h" ' +
                'type="button" aria-controls="table_threshold" tabindex="0">' +
                '<span>24 giờ</span>' +
                '</button>'
            ).appendTo("#table_threshold_wrapper .dt-buttons");

            $('#table_threshold tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table_threshold.row(tr);

                if (row.child.isShown()) {
                    /*** This row is already open - close it ***/
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    /*** Tạo biến lấy vị trí hàng dữ liệu được chọn để mở row_child ***/
                    row_detail = row.child(format(row.data()))[0][0];
                    /*** Open this row ***/
                    row.child(format(row.data())).show();
                    tr.addClass('shown');

                    /*** Onchange Dữ liệu theo time ***/
                    if ($("#filter_1h").hasClass("active")) {
                        DOM_data_child_Threshold(row_detail, 1);
                    } else if ($("#filter_8h").hasClass("active")) {
                        DOM_data_child_Threshold(row_detail, 8);
                    } else {
                        DOM_data_child_Threshold(row_detail, 24);
                    }
                }
            });

            /*** Control Button filter Times ***/
            $('#filter_1h').on('click', function () {
                $('#filter_1h').addClass('active');
                /*** Phải remove các Class Active sau khi nhấn 1 Button ***/
                $('#filter_8h').removeClass('active');
                $('#filter_24h').removeClass('active');
                /*** Xử lý Change dữ liệu ***/
                /*** Remove dữ liệu cũ ***/
                $('#table_threshold').DataTable().clear().draw();
                /*** Thêm dữ liệu mới ***/
                data_onchange = onChangeTime_feature(1, "hour");
                table_threshold = $('#table_threshold').DataTable();
                table_threshold.rows.add(data_onchange.data);
                table_threshold.columns.adjust().draw();
            });

            $('#filter_8h').on('click', function () {
                $('#filter_8h').addClass('active');
                $('#filter_1h').removeClass('active');
                $('#filter_24h').removeClass('active');
                /*** Xử lý Change dữ liệu ***/
                /*** Remove dữ liệu cũ ***/
                $('#table_threshold').DataTable().clear().draw();
                /*** Thêm dữ liệu mới ***/
                data_onchange = onChangeTime_feature(8, "hour");
                table_threshold = $('#table_threshold').DataTable();
                table_threshold.rows.add(data_onchange.data);
                table_threshold.columns.adjust().draw();
            });

            $('#filter_24h').on('click', function () {
                $('#filter_24h').addClass('active');
                $('#filter_1h').removeClass('active');
                $('#filter_8h').removeClass('active');
                /*** Xử lý Change dữ liệu ***/
                /*** Remove dữ liệu cũ ***/
                $('#table_threshold').DataTable().clear().draw();
                /*** Thêm dữ liệu mới ***/
                data_onchange = onChangeTime_feature(24, "hour");
                table_threshold = $('#table_threshold').DataTable();
                table_threshold.rows.add(data_onchange.data);
                table_threshold.columns.adjust().draw();
            });
        });
    }
}
getData_threshold_station()
/*** Các lần tiếp theo ***/
setInterval(function(){
    getData_threshold_station()
}, 30000)
