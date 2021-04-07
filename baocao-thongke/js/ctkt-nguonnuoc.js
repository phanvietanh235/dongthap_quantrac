/*---- Kiểm tra JS để Disable Input ----*/
$("input[name='filter-option']").change(function() {
    if ($(this).val() == "district") {
        $('#quanhuyen').prop("disabled", false);
        $('#phuongxa').prop("disabled", false);
        $('#tangchuanuoc').prop("disabled", true);
        $('#luuvucsong').prop("disabled", true);
    } else if ($(this).val() == "waterfloor") {
        $('#quanhuyen').prop("disabled", true);
        $('#phuongxa').prop("disabled", true);
        $('#tangchuanuoc').prop("disabled", false);
        $('#luuvucsong').prop("disabled", true);
    } else {
        $('#quanhuyen').prop("disabled", true);
        $('#phuongxa').prop("disabled", true);
        $('#tangchuanuoc').prop("disabled", true);
        $('#luuvucsong').prop("disabled", false);
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

/*----- DOM Option Lưu vực sông -----*/
$("#luuvucsong").select2({
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

function search_ctkt_nn() {
    var checked = $("input[name='filter-option']:checked").val();
    var quanhuyen, phuongxa, tangchuanuoc, luuvucsong;
    if (checked == "district") {
        quanhuyen = $("#quanhuyen").val();
        phuongxa = $("#phuongxa").val();
        tangchuanuoc = "all";
        luuvucsong = "all";
    } else if (checked == "waterfloor") {
        quanhuyen = "all";
        phuongxa = "all";
        tangchuanuoc = $("#tangchuanuoc").val();
        if (tangchuanuoc === null) {
            tangchuanuoc = "all";
        }
        luuvucsong = "all";
    } else {
        quanhuyen = "all";
        phuongxa = "all";
        tangchuanuoc = "all";
        luuvucsong = $("#luuvucsong").val();
        if (luuvucsong === null) {
            luuvucsong = "all";
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
                hozAlign: "center",
                width: 450
            }, ],
        },
        {
            title: "Tổng số công trình",
            columns: [
                { title: "Lũy kế đến kỳ trước", columns: [{ title: "(2)", width: 150 }] },
                { title: "Lũy kế đến kỳ báo cáo", columns: [{ title: "(3)", width: 150, field: "tongsotram", hozAlign: "center" }] },
                { title: "Thay đổi", columns: [{ title: "(4) = (3) - (2)" }] },
            ],
        },
        {
            title: "Số lượng công trình khai thác nước mặt",
            columns: [
                { title: "Lũy kế đến kỳ trước", columns: [{ title: "(5)", width: 150 }] },
                { title: "Lũy kế đến kỳ báo cáo", columns: [{ title: "(6)", width: 150, field: "soluongDiemKTSD_NM", hozAlign: "center" }] },
                { title: "Thay đổi", columns: [{ title: "(7) = (6) - (5)" }] },
            ],
        },
        {
            title: "Số lượng công trình khai thác nước dưới đất",
            columns: [
                { title: "Lũy kế đến kỳ trước", columns: [{ title: "(8)", width: 150 }] },
                { title: "Lũy kế đến kỳ báo cáo", columns: [{ title: "(9)", width: 150, field: "soluongDiemKTSD_NDD", hozAlign: "center" }] },
                { title: "Thay đổi", columns: [{ title: "(10) = (9) = (8)" }] },
            ],
        }
    ]

    /*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
    var response_post = $.post("../services/ctkt-nguonnuoc.php", {
        "quanhuyen": quanhuyen,
        "phuongxa": phuongxa,
        "tangchuanuoc": tangchuanuoc,
        "luuvucsong": luuvucsong,
        "checked": checked
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#ctkt_nn_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#ctkt_nn_table", {
                ajaxURL: "../services/ctkt-nguonnuoc.php",
                ajaxParams: {
                    "quanhuyen": quanhuyen,
                    "phuongxa": phuongxa,
                    "tangchuanuoc": tangchuanuoc,
                    "luuvucsong": luuvucsong,
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
            $("#ctkt_nn_table").css("border-top", "none");
            table = new Tabulator("#ctkt_nn_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            })
        }
    })
}

$("#search_ctkt_nn").click(function() {
    search_ctkt_nn()
})