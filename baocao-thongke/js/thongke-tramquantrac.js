/*---- Kiểm tra JS để Disable Input ----*/
$("input[name='filter-option']").change(function() {
    if ($(this).val() == "district") {
        $('#quanhuyen').prop("disabled", false);
        $('#phuongxa').prop("disabled", false);
        $('#tangchuanuoc').prop("disabled", true);
    } else {
        $('#quanhuyen').prop("disabled", true);
        $('#phuongxa').prop("disabled", true);
        $('#tangchuanuoc').prop("disabled", false);
    }
})

/*---- DOM Option Quận/huyện và Phường/xã ----*/
$.getJSON("../services/quanhuyen.php", function(quanhuyen) {
    $('#quanhuyen')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Quận/Huyện--"));
    $.each(quanhuyen, function(key, value) {
        $('#quanhuyen')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

/*** DOM Option depended Phường/Xã ***/
$('#quanhuyen').change(function() {
    $.post("../services/phuongxa.php", {
        "maHuyen": $(this).val()
    }).done(function(data) {
        if (data.length != 0) {
            /*** Remove Option trước đó ***/
            $('#phuongxa').find('option').remove();
            $('#phuongxa')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn Phường/Xã--"));
            $.each(data, function(key, value) {
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

/*** DOM Option Tầng chứa nước ***/
$("#tangchuanuoc").select2({
    ajax: {
        url: "../services/tangchuanuoc.php",
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
    placeholder: "--Lựa chọn Tầng chứa nước--",
    allowClear: true,
    width: "resolve",
    language: {
        searching: function() {
            return "Đang tìm ...";
        }
    },
});

function search_tram() {
    var checked = $("input[name='filter-option']:checked").val();
    var quanhuyen, phuongxa, tangchuanuoc;
    if (checked == "district") {
        quanhuyen = $("#quanhuyen").val();
        phuongxa = $("#phuongxa").val();
        tangchuanuoc = "all";
    } else {
        quanhuyen = "all";
        phuongxa = "all";
        tangchuanuoc = $("#tangchuanuoc").val();
        if (tangchuanuoc === null) {
            tangchuanuoc = "all";
        }
    }

    /*** DOM Table using Tabulator ***/
    var table;
    var columns_title = [{
            title: "STT",
            frozen: true,
            hozAlign: "center",
            formatter: "rownum"
        },
        {
            title: "Đơn vị hành chính",
            frozen: true,
            columns: [{
                title: "(1)",
                field: "filter",
                hozAlign: "center"
            }, ],
        },
        {
            title: "Tổng số trạm quan trắc",
            columns: [
                { title: "Kỳ trước", columns: [{ title: "(2)", width: 81 }] },
                { title: "Kỳ báo cáo", columns: [{ title: "(3)", width: 81, field: "tongsotram", hozAlign: "center" }] },
                { title: "Thay đổi", columns: [{ title: "(4) = (3) - (2)" }] },
            ],
        },
        {
            title: "Loại trạm",
            columns: [{
                    title: "Khí tượng",
                    columns: [
                        { title: "Kỳ trước", columns: [{ title: "(5)", width: 81 }] },
                        { title: "Kỳ báo cáo", columns: [{ title: "(6)", width: 81 }] },
                        { title: "Thay đổi", columns: [{ title: "(7) = (6) - (5)" }] },
                    ]
                },
                {
                    title: "Thủy văn, thủy văn kết hợp tài nguyên nước",
                    columns: [
                        { title: "Kỳ trước", columns: [{ title: "(8)", width: 81 }] },
                        { title: "Kỳ báo cáo", columns: [{ title: "(9)", width: 81 }] },
                        { title: "Thay đổi", columns: [{ title: "(10) = (9) - (8)" }] },
                    ]
                },
                {
                    title: "Quan trắc nước mặt",
                    columns: [
                        { title: "Kỳ trước", columns: [{ title: "(11)", width: 81 }] },
                        {
                            title: "Kỳ báo cáo",
                            columns: [{ title: "(12)", width: 81, field: "soluongDiemQT_NM", hozAlign: "center" }]
                        },
                        { title: "Thay đổi", columns: [{ title: "(13) = (12) - (11)" }] },
                    ]
                },
                {
                    title: "Giếng QT Nước dưới đất",
                    columns: [
                        { title: "Kỳ trước", columns: [{ title: "(14)", width: 81 }] },
                        {
                            title: "Kỳ báo cáo",
                            columns: [{ title: "(15)", width: 81, field: "soluongGiengQT_NDD", hozAlign: "center" }]
                        },
                        { title: "Thay đổi", columns: [{ title: "(14) - (15) = (16)" }] },
                    ]
                },
            ],
        }
    ]

    /*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
    var response_post = $.post("../services/thongke-tramquantrac.php", {
        "quanhuyen": quanhuyen,
        "phuongxa": phuongxa,
        "tangchuanuoc": tangchuanuoc,
        "checked": checked
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#tram_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#tram_table", {
                ajaxURL: "../services/thongke-tramquantrac.php",
                ajaxParams: {
                    "quanhuyen": quanhuyen,
                    "phuongxa": phuongxa,
                    "tangchuanuoc": tangchuanuoc,
                    "checked": checked
                },
                ajaxConfig: "post",
                height: "310px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
                columnVertAlign: "middle",
                columns: columns_title,
                rowFormatter: function(row) {
                    var data = row.getData();
                    if (data.quanhuyen == true) {
                        row.getElement().style.fontWeight = "bold";
                        row.getElement().style.backgroundColor = "#4f8aff";
                    }
                },
            })
            table.setData();
        } else {
            $("#tram_table").css("border-top", "none");
            table = new Tabulator("#tram_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            })
        }
    })
}

$("#search_tram").click(function() {
    search_tram()
})
