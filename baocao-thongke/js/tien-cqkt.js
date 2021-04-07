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

function search_tien_cqkt() {
    var quanhuyen = $("#quanhuyen").val();
    var phuongxa = $("#phuongxa").val();

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
                width: 150
            }, ],
        },
        {
            title: "Tổng số công trình đã phê duyết tiền cấp quyền",
            columns: [{
                    title: "Lũy kế đến kỳ trước",
                    hozAlign: "center",
                    columns: [{ title: "(1)", hozAlign: "center", width: 150 }],
                },
                {
                    title: "Lũy kế đến kỳ báo cáo",
                    hozAlign: "center",
                    columns: [{ title: "(2)", hozAlign: "center", field: "tongTram", width: 150 }],
                },
                {
                    title: "Thay đổi",
                    hozAlign: "center",
                    columns: [{ title: "(3) = (2) - (1)", hozAlign: "center", width: 150 }],
                },
            ],
        },
        {
            title: "Tổng số công trình đã phê duyệt tiền cấp quyền phân theo thẩm quyền",
            columns: [{
                    title: "Bộ TNMT phê duyệt",
                    hozAlign: "center",
                    columns: [{
                            title: "Lũy kế đến kỳ trước",
                            hozAlign: "center",
                            columns: [{ title: "(4)", hozAlign: "center", width: 150 }],
                        },
                        {
                            title: "Lũy kế đến kỳ báo cáo",
                            hozAlign: "center",
                            columns: [{ title: "(5)", hozAlign: "center", field: "tongTram_tw", width: 150 }],
                        },
                        {
                            title: "Thay đổi",
                            hozAlign: "center",
                            columns: [{ title: "(6) = (5) - (4)", hozAlign: "center", width: 150 }],
                        },
                    ]
                },
                {
                    title: "Địa phương phê duyệt",
                    hozAlign: "center",
                    columns: [{
                            title: "Lũy kế đến kỳ trước",
                            hozAlign: "center",
                            columns: [{ title: "(7)", hozAlign: "center", width: 150 }],
                        },
                        {
                            title: "Lũy kế đến kỳ báo cáo",
                            hozAlign: "center",
                            columns: [{ title: "(8)", hozAlign: "center", field: "tongTram_dp", width: 150 }],
                        },
                        {
                            title: "Thay đổi",
                            hozAlign: "center",
                            columns: [{ title: "(9) = (8) - (7)", hozAlign: "center", width: 150 }],
                        },
                    ]
                }
            ],
        },
        {
            title: "Tổng số tiền cấp quyền đã phê duyệt",
            columns: [{
                    title: "Lũy kế đến kỳ trước",
                    hozAlign: "center",
                    columns: [{ title: "(10)", hozAlign: "center", width: 150 }]
                },
                {
                    title: "Lũy kế đến kỳ báo cáo",
                    hozAlign: "center",
                    columns: [{ title: "(11)", hozAlign: "center", field: "tongTien", width: 150 }]
                },
                {
                    title: "Thay đổi",
                    hozAlign: "center",
                    columns: [{ title: "(12) = (11) - (10)", hozAlign: "center", width: 150 }]
                },
            ],
        },
    ];

    /*** Hàm Post lấy dữ liệu để kiểm tra dữ liệu ***/
    var response_post = $.post("../services/tien-cqkt.php", {
        "quanhuyen": quanhuyen,
        "phuongxa": phuongxa
    })

    response_post.done(function(data) {
        if (data.length != 0) {
            $("#tien_cqkt_table").css("border-top", "1px solid #dee2e6");
            table = new Tabulator("#tien_cqkt_table", {
                ajaxURL: "../services/tien-cqkt.php",
                ajaxParams: {
                    "quanhuyen": quanhuyen,
                    "phuongxa": phuongxa,
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
            $("#tien_cqkt_table").css("border-top", "none");
            table = new Tabulator("#tien_cqkt_table", {
                height: "70px",
                placeholder: "<p class='text-danger text-bold font-size-14'>" +
                    "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
            })
        }
    })
}

$("#search_tien_cqkt").click(function() {
    search_tien_cqkt()
})