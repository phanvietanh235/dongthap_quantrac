function showInfo(data) {
    /*** Thông tin địa chính ***/
    soto = data.features[0].properties.soto;
    sothua = data.features[0].properties.sothua;
    loaidat = data.features[0].properties.loaidat;
    if (data.features[0].properties.tencsd != null) {
        chusohuu = data.features[0].properties.tencsd;
    } else {
        chusohuu = "Chưa cập nhật chủ sở hữu"
    }
    dientich_thua = Math.round((data.features[0].properties.dientich / 10000) * 10000, 2);

    noidung = '';
    noidung += '<b style="font-size: 16px">Thông tin ranh thửa địa chính</b><br>';
    noidung += '<b style="font-size: 12px">Chủ sở hữu</b>: ' + chusohuu + '<br>';
    noidung += '<b style="font-size: 12px">Số tờ</b>: ' + soto + '<br>';
    noidung += '<b style="font-size: 12px">Số thửa</b>: ' + sothua + '<br>';
    noidung += '<b style="font-size: 12px">Loại đất</b>: ' + loaidat + '<br>';
    noidung += '<b style="font-size: 12px">Diện tích</b>: ' + dientich_thua + ' m²<br>';

    return noidung
}