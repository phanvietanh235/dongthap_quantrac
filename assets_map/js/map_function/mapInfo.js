/*---- Hiển thị thông tin Công trình (Panel) ----*/
function feature_detail(feat, layer) {
    layer.on({
        click: function(e) {
            /*** Diem KTSD_NDD ***/
            if (feat.properties.type == "ktsd_ndd") {
                /*** Get Data From Services ***/
                $.post("services/services-map/feat-poi-ndd.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#poi").html(dom_form)
                })

                $.post("services/services-map/feat-ctkt-ndd.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#ctkt").html(dom_form)
                })

                /* $.post("services/services-map/feat-gp-ndd.php", {
                        "idgieng": feat.properties.idgieng
                    }).done(function(dom_form) {
                        $("#gp").html(dom_form)
                    }) */
                    /*** Diem XT ***/
            } else if (feat.properties.type == "xt") {
                $.post("services/services-map/feat-poi-xt.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#poi").html(dom_form)
                })

                $.post("services/services-map/feat-xt.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#ctkt").html(dom_form)
                })

                /* $.post("services/services-map/feat-gp-xt.php", {
                        "idgieng": feat.properties.idgieng
                    }).done(function(dom_form) {
                        $("#gp").html(dom_form)
                    }) */
                    /*** Diem KTSD_NM ***/
            } else if (feat.properties.type == "ktsd_nm") {
                $.post("services/services-map/feat-poi-nm.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#poi").html(dom_form)
                })

                $.post("services/services-map/feat-ctkt-nm.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#ctkt").html(dom_form)
                })

                /* $.post("services/services-map/feat-gp-nm.php", {
                        "idgieng": feat.properties.idgieng
                    }).done(function(dom_form) {
                        $("#gp").html(dom_form)
                    }) */
                    /*** Diem QT_NM ***/
            } else if (feat.properties.type == "qt_nm") {
                $.post("services/services-map/feat-poi-qt-nm.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#poi").html(dom_form)
                })

                $.post("services/services-map/feat-ctkt-qt-nm.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#ctkt").html(dom_form)
                })
                    /*** Diem TD ***/
            } else if (feat.properties.type == "td") {
                $.post("services/services-map/feat-poi-td.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#poi").html(dom_form)
                })

                $.post("services/services-map/feat-td.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#ctkt").html(dom_form)
                })

                /* $.post("services/services-map/feat-gp-td.php", {
                    "idgieng": feat.properties.idgieng
                }).done(function(dom_form) {
                    $("#gp").html(dom_form)
                }) */
            }

            /* pulse_marker = L.marker([feat.geometry.coordinates[1],
                feat.geometry.coordinates[0]], {
                icon: pulsingIcon
            }) */

            if ($("#side-feature").hasClass("side-panel-open") == false) {
                $("#side-feature").toggleClass("side-panel-open")
            }
        }
    })
}

/*---- Hiển thị thông tin Công trình, Điểm (Popup) ----*/
function feature_info(feat) {
    var content;
    if (feat.properties.tendoanhnghiep != null){
    content = '<div class="text-uppercase text-center" colspan="4" style="margin-bottom: 5px"><b>'+
        feat.properties.tendoanhnghiep + '</b></div>';
    }
    else{
        content='<div class="text-uppercase text-center" colspan="4" style="margin-bottom: 5px"><b>'+
        feat.properties.coSoKTSD + '</b></div>';
    }
    if (feat.properties.type == "ktsd_ndd") {
        content += '<div class="text-uppercase text-center" colspan="4" style="margin-bottom: 5px">' +
            'Giếng ' + feat.properties.sohieu_gieng + '</div>';
    } else if (feat.properties.type == "td") {
        content += '<div class="text-uppercase text-center" colspan="4" style="margin-bottom: 5px">' +
            'Giếng thăm dò ' + feat.properties.sohieu_gieng + '</div>';
    } else {
        content += '<div class="text-uppercase text-center" colspan="4" style="margin-bottom: 5px">' +
            'Điểm ' + feat.properties.sohieu_gieng + '</div>';
    }
    content += '<table class="table table-bordered table-feat-info">';
    content += '<tbody>';

    /*** Tọa độ ***/
    content += '<tr>';
    content += '<td class="text-bold text-center table-feat-info" style="white-space: nowrap">Tọa độ X</td>';
    content += '<td class="table-feat-info">' + feat.properties.toadoX + '</td>';
    content += '<td class="text-bold text-center table-feat-info" style="white-space: nowrap">Tọa độ Y</td>';
    content += '<td class="table-feat-info">' + feat.properties.toadoY + '</td>';
    content += '</tr>';
    content += '<tr>';

    /*** Đơn vị hành chính ***/
    content += '<tr>';
    content += '<td class="text-bold text-center table-feat-info">Huyện</td>';
    content += '<td class="table-feat-info">' + feat.properties.huyen + '</td>';
    content += '<td class="text-bold text-center table-feat-info">Xã</td>';
    content += '<td class="table-feat-info">' + feat.properties.xa + '</td>';
    content += '</tr>';

    /* Tình trạng */
    if (feat.properties.type == "ktsd_ndd" || feat.properties.type == "td" || feat.properties.type == "qt_nm") {
        if (feat.properties.tinhtrang_gieng == 't') {
            tinhtrang_gieng = "<span class='badge bg-info font-size-12'>Còn hoạt động</span>";
        } else {
            tinhtrang_gieng = "<span class='badge bg-warning font-size-12' " +
                "style='color: #000'>Đã trám lấp</span>";
        }
    } else {
        if (feat.properties.tinhtrang_gieng == 't') {
            tinhtrang_gieng = "<span class='badge bg-info font-size-12'>Còn hoạt động</span>";
        } else {
            tinhtrang_gieng = "<span class='badge bg-warning font-size-12' " +
                "style='color: #000'>Không hoạt động</span>";
        }
    }

    /*** Thông tin Giếng/Điểm ***/
    if (feat.properties.type == "ktsd_ndd") {
        chedo = "Chế độ khai thác";
        luuluong = "Lưu lượng khai thác";
        tinhtrang = "Tình trạng giếng"
    } else if (feat.properties.type == "xt") {
        chedo = "Chế độ xả thải";
        luuluong = "Lưu lượng xả thải";
        tinhtrang = "Tình trạng xả thải"
    } else if (feat.properties.type == "ktsd_nm") {
        chedo = "Chế độ khai thác";
        luuluong = "Lưu lượng khai thác lớn nhất";
        tinhtrang = "Tình trạng khai thác"
    } else if (feat.properties.type == "qt_nm") {
        chedo = "Chế độ khai thác";
        luuluong = "Lưu lượng khai thác lớn nhất";
        tinhtrang = "Tình trạng điểm"
    }

    if (feat.properties.type == "ktsd_ndd" ||
        feat.properties.type == "xt" || feat.properties.type == "ktsd_nm") {
        content += '<tr>'
        content += '<td class="text-bold text-center table-feat-info" colspan="2">' + chedo + '</td>';
        content += '<td class="table-feat-info" colspan="2">' + 'Chưa cập nhật' + '</td>';
        content += '</tr>';
        content += '<tr>';
        content += '<td class="text-bold text-center table-feat-info" colspan="2">' + luuluong + '</td>';
        content += '<td class="table-feat-info" colspan="2">' + 'Chưa cập nhật' + '</td>';
        content += '</tr>';
        content += '<tr>';
        content += '<td class="text-bold text-center table-feat-info" colspan="2">' + tinhtrang + '</td>';
        content += '<td class="table-feat-info text-white" colspan="2">' + tinhtrang_gieng + '</td>';
        content += '</tr>';
    } else if (feat.properties.type == "td") {
        content += '<tr>'
        content += '<td class="text-bold text-center table-feat-info" colspan="2">' + 'Chiều sâu dự kiến thăm dò' + '</td>';
        content += '<td class="table-feat-info" colspan="2">' + feat.properties.chieusau + '</td>';
        content += '</tr>';
        content += '<tr>';
        content += '<td class="text-bold text-center table-feat-info" colspan="2">' + 'Số lượng giếng thăm dò' + '</td>';
        content += '<td class="table-feat-info" colspan="2">' + feat.properties.soluong + '</td>';
        content += '</tr>';
        content += '<tr>';
        content += '<td class="text-bold text-center table-feat-info" colspan="2">' + 'Tình trạng thăm dò' + '</td>';
        content += '<td class="table-feat-info text-white" colspan="2">' + tinhtrang_gieng + '</td>';
        content += '</tr>';
    } else if (feat.properties.type == "qt_nm") {
        content += '<tr>'
        content += '<td class="text-bold text-center table-feat-info" colspan="2">' + chedo + '</td>';
        content += '<td class="table-feat-info" colspan="2">' + 'Chưa cập nhật' + '</td>';
        content += '</tr>';
        content += '<tr>';
        content += '<td class="text-bold text-center table-feat-info" colspan="2">' + luuluong + '</td>';
        content += '<td class="table-feat-info" colspan="2">' + 'Chưa cập nhật' + '</td>';
        content += '</tr>';
        content += '<tr>';
        content += '<td class="text-bold text-center table-feat-info" colspan="2">' + tinhtrang + '</td>';
        content += '<td class="table-feat-info text-white" colspan="2">' + tinhtrang_gieng + '</td>';
        content += '</tr>';
    }

    if (typeof feat.properties.vung_baoho != "undefined") {
        content += '<tr>';
        content += '<td class="text-bold text-center table-feat-info" colspan="2">Vùng bảo hộ vệ sinh</td>';
        if (feat.properties.vung_baoho != null) {
            content += '<td class="table-feat-info" colspan="2">' + feat.properties.vung_baoho + ' m</td>';
        } else {
            content += '<td class="table-feat-info" colspan="2">Chưa cập nhật dữ liệu</td>';
        }
        content += '</tr>';
    }
    content += '</tbody>';
    content += '</table>';
    return content
}

/*---- Hiển thị thông tin vị trí lấy mẫu (Popup) ----*/
function sample_info(feat) {
    var content;
    content = '<div class="text-uppercase text-center" colspan="4" style="margin-bottom: 5px"><b>'+
        feat.properties.LoaiQuanTrac + '</b></div>';
    content += '<div class="text-uppercase text-center" colspan="4" style="margin-bottom: 5px">' +
        'Ký hiệu mẫu ' + feat.properties.idgieng + '</div>';
    content += '<table class="table table-bordered table-feat-info">';
    content += '<tbody>';

    /*** Tọa độ ***/
    content += '<tr>';
    content += '<td class="text-bold text-center table-feat-info" style="white-space: nowrap">Tọa độ X</td>';
    content += '<td class="table-feat-info">' + feat.properties.toadoX + '</td>';
    content += '<td class="text-bold text-center table-feat-info" style="white-space: nowrap">Tọa độ Y</td>';
    content += '<td class="table-feat-info">' + feat.properties.toadoY + '</td>';
    content += '</tr>';
    content += '<tr>';

    /*** Đơn vị hành chính và ngày lấy mẫu ***/
    content += '<tr>';
    content += '<td class="text-bold text-center table-feat-info">Huyện</td>';
    content += '<td class="table-feat-info">' + feat.properties.huyen + '</td>';
    content += '<td class="text-bold text-center table-feat-info">Ngày lấy mẫu</td>';
    content += '<td class="table-feat-info">' + feat.properties.ngaylay_mau + '</td>';
    content += '</tr>';

    content += '<tr>'
    content += '<td class="text-bold text-center table-feat-info" colspan="2">' + 'Vị trí lấy mẫu' + '</td>';
    content += '<td class="table-feat-info" colspan="2">' + feat.properties.vitri_mau + '</td>';
    content += '</tr>';

    content += '</tbody>';
    content += '</table>';
    return content
}
