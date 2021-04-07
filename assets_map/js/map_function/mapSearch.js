/*** Fitbound zoom onChange ***/
function Fitbound_zoom(url_data) {
    $.getJSON(url_data, function(data) {
        var extend = bbox(data);
        if (isFinite(extend[0])) {
            var bounds = [
                [extend[1], extend[0]],
                [extend[3], extend[2]]
            ]
            map.fitBounds(bounds, {
                maxZoom: 15
            });
        }
    })
}

function update_Station(url_feat) {
    $('#poi_res').find('option').remove();
    $('#poi_res')
        .append($("<option></option>")
            .attr('value', 'none').text('--Lựa chọn điểm/giếng--'));

    $.getJSON(url_feat, function(data_DOM) {
        var DOM_opt = data_DOM.features;
        console.log(DOM_opt)
        /*** DOM count ***/
        if (DOM_opt.length == 0) {
            $(".search-error").css("display", "block");
            $(".search-success").css("display", "none");
        } else {
            $(".search-success span").text(" Tìm thấy " + DOM_opt.length + " Điểm/Giếng");
            $(".search-success").css("display", "block");
            $(".search-error").css("display", "none");
        }
        /*** Chèn Option ***/
        for (i = 0; i < DOM_opt.length; i++) {
            $('#poi_res')
                .append($("<option></option>")
                    .attr('value', DOM_opt[i].properties.idgieng + "-" + DOM_opt[i].properties.type)
                    .text("Điểm/Giếng " + DOM_opt[i].properties.sohieu_gieng + " thuộc " + DOM_opt[i].properties.tendoanhnghiep));
        }
    })
}

function search_poi() {
    var pois_val = document.getElementById("poi_res").value;
    var id = pois_val.split("-")[0];
    var type = pois_val.split("-")[1];
    for (var attr_modal in marker_url) {
        var datum = marker_url[attr_modal];
        if (id == datum.idpoi && type == datum.type) {
            /*** Đóng Side bar tìm kiếm ***/
            sidebar.close();
            map.fitBounds([
                [datum.lat + 0.009, datum.lng],
                [datum.lat - 0.0001, datum.lng + 0.02]
            ], { maxZoom: 15 });
            if (map._layers[datum.id]) {
                map._layers[datum.id].fire("click");
            }
        }
    }
}

function poi_search() {
    var tencongtrinh = $("#tencongtrinh").val();
    var giayphep = $("#giayphep").val();
    var doanhnghiep = $("#doanhnghiep").val();
    var loaicongtrinh = $("#loaicongtrinh").val();
    var district = $("#district").val();

    var response = $.get("services/services-map/search-feat-poi.php", {
        "tencongtrinh": tencongtrinh,
        "giayphep": giayphep,
        "doanhnghiep": doanhnghiep,
        "loaicongtrinh": loaicongtrinh,
        "district": district,
    }).done(function(data) {
        /* if (loaicongtrinh == 'none') {

        } else */
        if (loaicongtrinh == 1) {
            /*** Tạo Marker mới ***/
            marker_url = [];
            /*** Remove lớp layer cũ ***/
            markers.removeLayer(feat_qt_nm);
            markers.removeLayer(feat_ktsd_ndd);
            markers.removeLayer(feat_ktsd_nm);
            markers.removeLayer(feat_ktsd_xt);
            markers.removeLayer(feat_ktsd_td);

            url_ktsd_nm = "services/services-map/search-feat-poi.php?tencongtrinh=" +
                tencongtrinh + "&giayphep=" + giayphep + "&doanhnghiep=" + doanhnghiep +
                "&loaicongtrinh=" + loaicongtrinh + "&district=" + district
            feat_ktsd_nm = new L.GeoJSON.AJAX(url_ktsd_nm, {
                onEachFeature: function(feat, layer) {
                    feature_detail(feat, layer)
                    marker_url.push({
                        type: feat.properties.type,
                        lat: feat.geometry.coordinates[1],
                        lng: feat.geometry.coordinates[0],
                        idpoi: feat.properties.idgieng,
                        id: L.stamp(layer)
                    })
                },
                pointToLayer: function(feat, latlng) {
                    var label
                    var html_style = "<i class='icon-air diem_ktsd_symbol'></i>";
                    var className_style;
                    if (feat.properties.tinhtrang_gieng == "t") {
                        html_style = "<i class='icon-air diem_ktsd_symbol_t'></i>";
                        label = '<p class="diem_ktsd_label_t"><b>Điểm ' + feat.properties.sohieu_gieng + '</b></p>'
                        className_style = "mouse-pointer diem_ktsd_divIcon_t " + poi_district_bgcolor(feat.properties.huyen)
                    } else {
                        html_style = "<i class='icon-air diem_ktsd_symbol_f'></i>";
                        label = '<p class="diem_ktsd_label_f"><b>Điểm ' + feat.properties.sohieu_gieng + '</b></p>'
                        className_style = "mouse-pointer diem_ktsd_divIcon_f " + poi_district_bgcolor(feat.properties.huyen)
                    }

                    return L.marker(latlng, {
                        icon: L.divIcon({
                            html: html_style,
                            popupAnchor: [0, 0],
                            iconAnchor: [12, -2],
                            className: className_style
                        }),
                        title: feat.properties.sohieu_gieng,
                        riseOnHover: true,
                    }).bindTooltip(label, {
                        permanent: false,
                        direction: "center",
                        opacity: 1
                    }).openTooltip({}).on('click', markerOnClick).bindPopup(feature_info(feat), {
                        'maxWidth': '500'
                    })
                }
            })

            feat_ktsd_nm.on("data:loaded", function() {
                /*** Zoom tới vùng Search ***/
                Fitbound_zoom(url_ktsd_nm)
                markers.addLayer(feat_ktsd_nm);
                map.addLayer(markers);

                /*** Thêm Option Giếng/Điểm ***/
                update_Station(url_ktsd_nm)
            })
        } else if (loaicongtrinh == 2) {
            /*** Tạo Marker mới ***/
            marker_url = [];
            /*** Remove lớp layer cũ ***/
            markers.removeLayer(feat_qt_nm);
            markers.removeLayer(feat_ktsd_ndd);
            markers.removeLayer(feat_ktsd_nm);
            markers.removeLayer(feat_ktsd_xt);
            markers.removeLayer(feat_ktsd_td);

            url_ktsd_ndd = "services/services-map/search-feat-poi.php?tencongtrinh=" +
                tencongtrinh + "&giayphep=" + giayphep + "&doanhnghiep=" + doanhnghiep +
                "&loaicongtrinh=" + loaicongtrinh + "&district=" + district
            feat_ktsd_ndd = new L.GeoJSON.AJAX(url_ktsd_ndd, {
                onEachFeature: function(feat, layer) {
                    feature_detail(feat, layer)
                    marker_url.push({
                        type: feat.properties.type,
                        lat: feat.geometry.coordinates[1],
                        lng: feat.geometry.coordinates[0],
                        idpoi: feat.properties.idgieng,
                        id: L.stamp(layer)
                    })
                },
                pointToLayer: function(feat, latlng) {
                    var label
                    var html_style = "<i class='fa fa-dot-circle-o diem_ktsd_symbol'></i>";
                    var className_style;
                    if (feat.properties.tinhtrang_gieng == "t") {
                        html_style =  "<i class='fa fa-dot-circle-o diem_ktsd_symbol_t'></i>";
                        label = '<p class="diem_ktsd_label_t"><b>Giếng ' + feat.properties.sohieu_gieng + '</b></p>'
                        className_style = "mouse-pointer diem_ktsd_divIcon_t " + poi_district_bgcolor(feat.properties.huyen)
                    } else {
                        html_style =  "<i class='fa fa-dot-circle-o diem_ktsd_symbol_f'></i>";
                        label = '<p class="diem_ktsd_label_f"><b>Giếng ' + feat.properties.sohieu_gieng + '</b></p>'
                        className_style = "mouse-pointer diem_ktsd_divIcon_f " + poi_district_bgcolor(feat.properties.huyen)
                    }

                    return L.marker(latlng, {
                        icon: L.divIcon({
                            html: html_style,
                            popupAnchor: [0, 0],
                            iconAnchor: [12, -2],
                            className: className_style
                        }),
                        title: feat.properties.sohieu_gieng,
                        riseOnHover: true,
                    }).bindTooltip(label, {
                        permanent: false,
                        direction: "center",
                        opacity: 1
                    }).openTooltip({}).on('click', markerOnClick).bindPopup(feature_info(feat), {
                        'maxWidth': '500'
                    })
                }
            })

            feat_ktsd_ndd.on("data:loaded", function() {
                /*** Zoom tới vùng Search ***/
                Fitbound_zoom(url_ktsd_ndd)
                markers.addLayer(feat_ktsd_ndd);
                map.addLayer(markers);

                /*** Thêm Option Giếng/Điểm ***/
                update_Station(url_ktsd_ndd)
            })
        } else if (loaicongtrinh == 3) {
            /*** Tạo Marker mới ***/
            marker_url = [];
            /*** Remove lớp layer cũ ***/
            markers.removeLayer(feat_ktsd_ndd);
            markers.removeLayer(feat_ktsd_nm);
            markers.removeLayer(feat_ktsd_xt);
            markers.removeLayer(feat_ktsd_td);

            url_ktsd_td = "services/services-map/search-feat-poi.php?tencongtrinh=" +
                tencongtrinh + "&giayphep=" + giayphep + "&doanhnghiep=" + doanhnghiep +
                "&loaicongtrinh=" + loaicongtrinh + "&district=" + district
            feat_ktsd_td = new L.GeoJSON.AJAX(url_ktsd_td, {
                onEachFeature: function(feat, layer) {
                    feature_detail(feat, layer)
                    marker_url.push({
                        type: feat.properties.type,
                        lat: feat.geometry.coordinates[1],
                        lng: feat.geometry.coordinates[0],
                        idpoi: feat.properties.idgieng,
                        id: L.stamp(layer)
                    })
                },
                pointToLayer: function(feat, latlng) {
                    var label
                    var html_style = "<i class='icon-server diem_ktsd_symbol'></i>";
                    var className_style;
                    if (feat.properties.tinhtrang_gieng == "t") {
                        html_style = "<i class='icon-server diem_ktsd_symbol_t'></i>";
                        label = '<p class="diem_ktsd_label_t"><b>Giếng thăm dò ' + feat.properties.sohieu_gieng + '</b></p>'
                        className_style = "mouse-pointer diem_ktsd_divIcon_t " + poi_district_bgcolor(feat.properties.huyen)
                    } else {
                        html_style = "<i class='icon-server diem_ktsd_symbol_f'></i>";
                        label = '<p class="diem_ktsd_label_f"><b>Giếng thăm dò ' + feat.properties.sohieu_gieng + '</b></p>'
                        className_style = "mouse-pointer diem_ktsd_divIcon_f " + poi_district_bgcolor(feat.properties.huyen)
                    }

                    return L.marker(latlng, {
                        icon: L.divIcon({
                            html: html_style,
                            popupAnchor: [0, 0],
                            iconAnchor: [12, -2],
                            className: className_style
                        }),
                        title: feat.properties.sohieu_gieng,
                        riseOnHover: true,
                    }).bindTooltip(label, {
                        permanent: false,
                        direction: "center",
                        opacity: 1
                    }).openTooltip({}).on('click', markerOnClick).bindPopup(feature_info(feat), {
                        'maxWidth': '500'
                    })
                }
            })

            feat_ktsd_td.on("data:loaded", function() {
                /*** Zoom tới vùng Search ***/
                Fitbound_zoom(url_ktsd_td)
                markers.addLayer(feat_ktsd_td);
                map.addLayer(markers);

                /*** Thêm Option Giếng/Điểm ***/
                update_Station(url_ktsd_td)
            })
        } else if (loaicongtrinh == 4) {
            /*** Tạo Marker mới ***/
            marker_url = [];
            /*** Remove lớp layer cũ ***/
            markers.removeLayer(feat_ktsd_ndd);
            markers.removeLayer(feat_ktsd_nm);
            markers.removeLayer(feat_ktsd_xt);
            markers.removeLayer(feat_ktsd_td);

            url_ktsd_xt = "services/services-map/search-feat-poi.php?tencongtrinh=" +
                tencongtrinh + "&giayphep=" + giayphep + "&doanhnghiep=" + doanhnghiep +
                "&loaicongtrinh=" + loaicongtrinh + "&district=" + district
            feat_ktsd_xt = new L.GeoJSON.AJAX(url_ktsd_xt, {
                onEachFeature: function(feat, layer) {
                    feature_detail(feat, layer)
                    marker_url.push({
                        type: feat.properties.type,
                        lat: feat.geometry.coordinates[1],
                        lng: feat.geometry.coordinates[0],
                        idpoi: feat.properties.idgieng,
                        id: L.stamp(layer)
                    })
                },
                pointToLayer: function(feat, latlng) {
                    var label
                    var html_style = "<i class='fa fa-recycle diem_ktsd_symbol'></i>";
                    var className_style;
                    if (feat.properties.tinhtrang_gieng == "t") {
                        html_style = "<i class='fa fa-recycle diem_ktsd_symbol_t'></i>";
                        label = '<p class="diem_ktsd_label_t"><b>Điểm ' + feat.properties.sohieu_gieng + '</b></p>'
                        className_style = "mouse-pointer diem_ktsd_divIcon_t " + poi_district_bgcolor(feat.properties.huyen)
                    } else {
                        html_style = "<i class='fa fa-recycle diem_ktsd_symbol_f'></i>";
                        label = '<p class="diem_ktsd_label_f"><b>Điểm ' + feat.properties.sohieu_gieng + '</b></p>'
                        className_style = "mouse-pointer diem_ktsd_divIcon_f " + poi_district_bgcolor(feat.properties.huyen)
                    }

                    return L.marker(latlng, {
                        icon: L.divIcon({
                            html: html_style,
                            popupAnchor: [0, 0],
                            iconAnchor: [12, -2],
                            className: className_style
                        }),
                        title: feat.properties.sohieu_gieng,
                        riseOnHover: true,
                    }).bindTooltip(label, {
                        permanent: false,
                        direction: "center",
                        opacity: 1
                    }).openTooltip({}).on('click', markerOnClick).bindPopup(feature_info(feat), {
                        'maxWidth': '500'
                    })
                }
            })

            feat_ktsd_xt.on("data:loaded", function() {
                /*** Zoom tới vùng Search ***/
                Fitbound_zoom(url_ktsd_xt)
                markers.addLayer(feat_ktsd_xt);
                map.addLayer(markers);

                /*** Thêm Option Giếng/Điểm ***/
                update_Station(url_ktsd_xt)
            })
        }
    })
}

/*** Search ***/
$("#poi_search").click(function() {
    poi_search()
})

/*** Reset ***/
$("#reset_search").click(function() {
    /*** Reset Option ***/
    $('#poi_res').find('option').remove();
    $('#poi_res')
        .append($("<option></option>")
            .attr('value', 'none').text('--Lựa chọn điểm/giếng--'));
    $(".search-error").css("display", "none");
    $(".search-success").css("display", "none");

    /*** Tạo Marker mới ***/
    marker_url = [];
    /*** Remove lớp layer cũ ***/
    markers.removeLayer(feat_ktsd_ndd);
    markers.removeLayer(feat_ktsd_nm);
    markers.removeLayer(feat_ktsd_xt);
    markers.removeLayer(feat_ktsd_td);

    feature_pois()
        /*---- Căn cứ vào dữ liệu nào nhiều nhất để load trước ----*/
    map.setView([10.424115, 106.390280], 10.5)
    feat_ktsd_ndd.on("data:loaded", function() {
        markers.addLayer(feat_ktsd_ndd);
        markers.addLayer(feat_ktsd_xt);
        markers.addLayer(feat_ktsd_nm);
        markers.addLayer(feat_ktsd_td);
        map.addLayer(markers);
    })

    sidebar.close();
    $("#side-feature").removeClass("side-panel-open")
})
