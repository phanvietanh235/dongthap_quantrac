/*---- Control Base Map ----*/
var Basemaps_Control = [
    L.tileLayer('https://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}', {
        attribution: 'Google Satellite',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Ảnh vệ tinh Google',
        iconURL: 'https://mt0.google.com/vt/lyrs=s&hl=en&x=101&y=60&z=7'
    }),

    L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.png', {
        attribution: 'Simple Map ',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ đơn giản',
        /* optional label used for tooltip */
        iconURL: 'assets/images/b_tile.stamen.png'
    }),

    L.tileLayer('https://mt1.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        attribution: 'Google Terrain',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ địa hình Google',
        iconURL: 'https://mt1.google.com/vt/lyrs=p&x=101&y=60&z=7'
    }),

    /* L.tileLayer('http://gis.chinhphu.vn/BaseMap/{z}/{x}/{y}.png', {
        attribution: 'Map tiles by gis.chinhphu.vn',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ hành chính',
        iconURL: 'assets/images/gis_chinhphu.png'
    }), */

    L.tileLayer('https://{s}.dothanhlong.org/basemap/hanhchinh/zxy/t6/VBD/{z}/{x}/{y}.png', {
        attribution: 'Map tiles by Việt Bản đồ',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Việt Bản đồ',
        /* iconURL: '../assets/img/map_thumb/Map_tiles_by_Việt_Bản_đồ.png' */
        iconURL: 'http://images.vietbando.com/ImageLoader/GetImage.ashx?Ver=2016&LayerIds=VBD&Level=7&X=101&Y=60'
    }),

    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Map tiles by Esri',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Ảnh vệ tinh ESRI',
        iconURL: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/7/60/101'
    }),
]

/*---- Đem biến map ra ngoài cấu trúc nested của getJSON để không bị lỗi invalidateSize bên main.js ----*/
var map = L.map('map', {
    center: [10.54583, 105.55829],
    zoomSnap: 0.25,
    zoom: 9.8,
    maxZoom: 20,
    minZoom: 9.8,
    zoomControl: false,
});

/*---- Search Leaflet Geocoding ----*/
L.Control.geocoder({
    geocoder: L.Control.Geocoder.google(),
    showUniqueResult: true,
    showResultIcons: false,
    collapsed: false,
    expand: 'touch',
    position: 'topleft',
    placeholder: 'Tìm kiếm địa điểm...',
    errorMessage: 'Không tìm thấy địa điểm',
    iconLabel: 'Tìm kiếm địa điểm mới',
    query: '',
    queryMinLength: 1,
    suggestMinLength: 3,
    suggestTimeout: 250,
    defaultMarkGeocode: true
}).addTo(map);

/*---- Fullscreen Leaflet ----*/
L.control.fullscreen({
    position: 'topleft',
    title: 'Phóng to bản đồ',
    titleCancel: 'Thu nhỏ bản đồ ',
}).addTo(map);

/*---- Zoom Home ----*/
var zoomHome = L.Control.zoomHome();
zoomHome.addTo(map);

/*---- Measure Tool ----*/
var measureControl = new L.Control.Measure({
    position: 'topleft',
    primaryLengthUnit: 'meters',
    secondaryLengthUnit: 'kilometers',
    primaryAreaUnit: 'hectares',
    secondaryAreaUnit: 'sqmeters',
    popupOptions: {
        className: 'leaflet-measure-resultpopup',
        autoPanPadding: [10, 10]
    },
    activeColor: '#ff0000',
    completedColor: '#f27000'
})
measureControl.addTo(map);

/*---- Tạo Pulse Marker ----*/
var pulse_marker;
var pulsingIcon = L.icon.pulse({
    popupAnchor: [0, 0],
    iconAnchor: [6, -6],
    iconSize: [13, 13],
    color: '#ff0000',
    fillColor: 'rgba(255,255,255,0)',
    heartbeat: 1
});

/*---- Show Latlong ----*/
map.removeControl(map.latLngControl);
map.addControl(L.control.latLng({position: "bottomleft"}));

/*---- WMS Geoserver ----*/
var view_hanhchinh = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspace + '/wms?', {
    layers: 'hanhchinh_dongthap',
    tiled: true,
    format: 'image/png',
    transparent: true
});

// var view_giaothong = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspace + '/wms?', {
//     layers: 'giaothong_tiengiang',
//     tiled: true,
//     format: 'image/png',
//     transparent: true
// });

// var view_thuyhe = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspace + '/wms?', {
//     layers: 'thuyhe_tiengiang',
//     tiled: true,
//     format: 'image/png',
//     transparent: true
// });

// var view_diachat_thuyvan = L.tileLayer.wms(protocol + subdomain_geoserver + host_geoserver + workspace + '/wms?', {
//     layers: 'diachat_thuyvan',
//     tiled: true,
//     format: 'image/png',
//     transparent: true
// });

/*---- WMTS Geoserver ----*/
var view_diagioi = new L.tileLayer(protocol + subdomain_geoserver + host_geoserver + wmts +
    "layer=" + workspace + ':rtdc_4326' + services);

/*---- Spatial Data ----*/
var marker_url = [];
var markers = L.markerClusterGroup({
    maxClusterRadius: 100,
    showCoverageOnHover: false,
    spiderLegPolylineOptions: {
        weight: 2,
        opacity: 1
    },
    iconCreateFunction: function (cluster) {
        var markers = cluster.getAllChildMarkers();
        huyen_style = "";
        name_huyen = "";
        markers.forEach(function(m) {
            if (m.feature.properties.huyen == "Thành phố Cao Lãnh") {
                name_huyen = "TPCL"
                huyen_style = 'tp_cl'
            } else if (m.feature.properties.huyen == "Thành phố Sa Đéc") {
                name_huyen = "TPSĐ"
                huyen_style = 'tp_sd'
            } else if (m.feature.properties.huyen == "Thành phố Hồng Ngự") {
                name_huyen = "TPHN"
                huyen_style = 'tp_hongngu'
            } else if (m.feature.properties.huyen == "Huyện Tân Hồng") {
                name_huyen = "TH"
                huyen_style = 'tan_hong'
            } else if (m.feature.properties.huyen == "Huyện Hồng Ngự") {
                name_huyen = "HN"
                huyen_style = 'hong_ngu'
            } else if (m.feature.properties.huyen == "Huyện Tam Nông") {
                name_huyen = "TN"
                huyen_style = 'tam_nong'
            } else if (m.feature.properties.huyen == "Huyện Châu Thành") {
                name_huyen = "CT"
                huyen_style = 'chau_thanh'
            } else if (m.feature.properties.huyen == "Huyện Tháp Mười") {
                name_huyen = "TM"
                huyen_style = 'thap_muoi'
            } else if (m.feature.properties.huyen == "Huyện Cao Lãnh") {
                name_huyen = "CL"
                huyen_style = 'cao_lanh'
            } else if (m.feature.properties.huyen == "Huyện Thanh Bình") {
                name_huyen = "TB"
                huyen_style = 'thanh_binh'
            } else if (m.feature.properties.huyen == "Huyện Lai Vung") {
                name_huyen = "LVU"
                huyen_style = 'lai_vung'
            } else {
                name_huyen = "LV"
                huyen_style = 'lap_vo'
            }
        })
        return L.divIcon({ html: '<div><span class="text-dark" style="text-align: center">' + name_huyen +
                markers.length + '</span></div>', className: "marker-cluster " + huyen_style, iconSize: L.point(40, 40) })
    },
    /*---- Tới mức Zoom 15 sẽ không Cluster ----*/
    disableClusteringAtZoom: 15,
    spiderfyOnMaxZoom: false,
    zoomToBoundsOnClick: true,
});

/*---- Hàm Zoom on Click marker ----*/
function markerOnClick(e) {
    var latLngs, lat, lng;
    var markerBounds;
    latLngs = [e.target.getLatLng()];
    lat = latLngs[0]['lat'];
    lng = latLngs[0]['lng'];

    if (map._zoom != 15) {
        markerBounds = L.latLngBounds([lat + 0.009, lng], [lat - 0.0001, lng + 0.02]);
        /* console.log(markerBounds); */
        map.fitBounds(markerBounds, {
            maxZoom: 15
        });
    } else {
        /*---- 1/2 Latlng Bounds ----*/
        map.flyTo([lat + 0.00445, lng + 0.01], 15, {
            animate: true,
        })
    }
}

var feat_ktsd_ndd, feat_ktsd_xt, feat_ktsd_nm, feat_ktsd_td, feat_qt_nm
var feat_qt_ndd
var sample_mau
function poi_district_bgcolor(district) {
    if (district == "Thành phố Cao Lãnh") {
        return "tp_cl"
    } else if (district == "Thành phố Sa Đéc") {
        return "tp_sd"
    } else if (district == "Thành phố Hồng Ngự") {
        return "tp_hongngu"
    } else if (district == "Huyện Tân Hồng") {
        return "tan_hong"
    } else if (district == "Huyện Hồng Ngự") {
        return "hong_ngu"
    } else if (district == "Huyện Tam Nông") {
        return "tam_nong"
    } else if (district == "Huyện Châu Thành") {
        return "chau_thanh"
    } else if (district == "Huyện Tháp Mười") {
        return "thap_muoi"
    } else if (district == "Huyện Cao Lãnh") {
        return "cao_lanh"
    } else if (district == "Huyện Thanh Bình") {
        return "thanh_binh"
    } else if (district == "Huyện Lai Vung") {
        return "lai_vung"
    } else if (district == "Huyện Lấp Vò") {
        return "lap_vo"
    }
}

/*----- Điểm/Giếng KTSD NDD -----*/
function feature_pois() {
    /*--- Điểm KTSD_NDD ---*/
    feat_ktsd_ndd = new L.GeoJSON.AJAX("services/services-map/feat-ktsd-ndd.php", {
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
            var html_style;
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
 /*--- Điểm QT_NM ---*/
 feat_qt_nm = new L.GeoJSON.AJAX("services/services-map/feat-qt-nm.php", {
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
        var html_style;
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

    /*--- Điểm XT ---*/
    feat_ktsd_xt = new L.GeoJSON.AJAX("services/services-map/feat-ktsd-xt.php", {
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
            var html_style;
            var className_style;
            if (feat.properties.tinhtrang_gieng == "t") {
                html_style = "<i class='fa fa-recycle diem_ktsd_symbol_t'></i>";
                label = '<p class="diem_ktsd_label_t ' + + '"><b>Điểm ' + feat.properties.sohieu_gieng + '</b></p>'
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

    /*--- Diem KTSD_NM ---*/
    feat_ktsd_nm = new L.GeoJSON.AJAX("services/services-map/feat-ktsd-nm.php", {
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
            var html_style;
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

    /*--- Diem TD_NDD ---*/
    feat_ktsd_td = new L.GeoJSON.AJAX("services/services-map/feat-ktsd-td.php", {
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
            var html_style;
            var className_style;
            if (feat.properties.tinhtrang_gieng == "t") {
                html_style = "<i class='icon-server diem_ktsd_symbol_t'></i>";
                label = '<p class="diem_ktsd_label_t"><b>Giếng thăm dò '+ feat.properties.sohieu_gieng + '</b></p>'
                className_style = "mouse-pointer diem_ktsd_divIcon_t " + poi_district_bgcolor(feat.properties.huyen)
            } else {
                html_style = "<i class='icon-server diem_ktsd_symbol_f'></i>";
                label = '<p class="diem_ktsd_label_f"><b>Giếng thăm dò '+ feat.properties.sohieu_gieng + '</b></p>'
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
}
feature_pois()

/*----- Show vị trí thu mẫu -----*/
function sample_feature_pois() {
    sample_mau = new L.GeoJSON.AJAX("services/services-map/sample_feature_pois.php", {
        onEachFeature: function(feat, layer) {
            /* feature_detail(feat, layer) */
            marker_url.push({
                type: feat.properties.ma_loaiquantrac,
                lat: feat.geometry.coordinates[1],
                lng: feat.geometry.coordinates[0],
                idpoi: feat.properties.id,
                id: L.stamp(layer)
            })
        },
        pointToLayer: function(feat, latlng) {
            var label
            var html_style;
            var className_style;
            if (feat.properties.ma_loaiquantrac == 1) {
                html_style =  "<i class='fa fa-circle' style='color: #2183f3; font-size: 16px; margin-left: -1px; margin-top: 3px'></i>";
            } else if (feat.properties.ma_loaiquantrac == 2) {
                html_style =  "<i class='fa fa-circle' style='color: #199653; font-size: 16px; margin-left: -1px; margin-top: 3px'></i>";
            } else if (feat.properties.ma_loaiquantrac == 3) {
                html_style =  "<i class='fa fa-square' style='color: red; font-size: 14px; font-size: 16px; margin-left: -1px; margin-top: 3px'></i>";
            } else if (feat.properties.ma_loaiquantrac == 4) {
                html_style =  "<i class='fa fa-caret-up' style='color: #832e2e; font-size: 30px; margin-left: -1px; margin-top: -5px'></i>";
            } else if (feat.properties.ma_loaiquantrac == 5) {
                html_style =  "<i class='fa fa-th-large' style='color: purple; font-size: 16px; margin-left: -1px; margin-top: 3px'></i>";
            } else {
                html_style =  "<i class='fa fa-star' style='color: purple; font-size: 16px; margin-left: -1px; margin-top: 3px'></i>";
            }

            label = '<p class=""><b>Điểm ' + feat.properties.idgieng + '</b></p>'
            className_style = "mouse-pointer diem_mau"

            return L.marker(latlng, {
                icon: L.divIcon({
                    html: html_style,
                    popupAnchor: [0, 0],
                    iconAnchor: [12, -2],
                    className: className_style
                }),
                title: feat.properties.idgieng,
                riseOnHover: true,
            }).bindTooltip(label, {
                permanent: false,
                direction: "center",
                opacity: 1
            }).openTooltip({}).on('click', markerOnClick).bindPopup(sample_info(feat), {
                'maxWidth': '500'
            })
        }
    })
}
sample_feature_pois();

feat_ktsd_xt.on("data:loaded", function() {
    /*---- Căn cứ vào dữ liệu nào nhiều nhất để load trước ----*/
    markers.addLayer(feat_ktsd_xt);
    markers.addLayer(feat_qt_nm);  
    markers.addLayer(feat_ktsd_ndd);
    markers.addLayer(feat_ktsd_nm);
    markers.addLayer(feat_ktsd_td);
    markers.addLayer(sample_mau);
    map.addLayer(markers);

    /*---- Zoom when have Param from URL ----*/
    var current_Url = new URL(window.location.href);
    var idpoi_param = current_Url.search.split("=")[1].split("&type")[0];
    var type_param = current_Url.search.split("=")[2];
    if (typeof idpoi_param != "undefined") {
        for (var attr in marker_url) {
            var datum = marker_url[attr];
            /*---- Dùng id và type để phân loại ----*/
            if (idpoi_param == datum.idpoi && type_param == datum.type) {
                /*---- Đưa về giữa khung nhìn bản đồ ----*/
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
})
feat_qt_nm.on("data:loaded", function() {
    /*---- Căn cứ vào dữ liệu nào nhiều nhất để load trước ----*/
    markers.addLayer(feat_qt_nm);
    markers.addLayer(feat_ktsd_xt);  
    markers.addLayer(feat_ktsd_ndd);
    markers.addLayer(feat_ktsd_nm);
    markers.addLayer(feat_ktsd_td);
    markers.addLayer(sample_mau);
    map.addLayer(markers);

    /*---- Zoom when have Param from URL ----*/
    var current_Url = new URL(window.location.href);
    var idpoi_param = current_Url.search.split("=")[1].split("&type")[0];
    var type_param = current_Url.search.split("=")[2];
    if (typeof idpoi_param != "undefined") {
        for (var attr in marker_url) {
            var datum = marker_url[attr];
            /*---- Dùng id và type để phân loại ----*/
            if (idpoi_param == datum.idpoi && type_param == datum.type) {
                /*---- Đưa về giữa khung nhìn bản đồ ----*/
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
})

/*---- Load BaseMap ----*/
map.addControl(
    L.control.basemaps({
        basemaps: Basemaps_Control,
        tileX: 0,
        tileY: 0,
        tileZ: 1
    })
);
view_hanhchinh.addTo(map);
//view_giaothong.addTo(map);

/*---- Layer Control ----*/
var overlayMaps = {
    "<span class='pdd-left-10 font-size-14'>Huyện/Thị xã</span>": view_hanhchinh,
    // "<span class='pdd-left-10 font-size-14'>Giao thông</span>": view_giaothong,
    // "<span class='pdd-left-10 font-size-14'>Thủy hệ</span>": view_thuyhe,
    // "<span class='pdd-left-10 font-size-14'>Địa chất - Thủy văn</span>": view_diachat_thuyvan,
    // "<span class='pdd-left-10 font-size-14'>Ranh thửa địa chính</span>": view_diagioi
}
var baselayers = '';
L.control.layers(baselayers, overlayMaps, {
    collapsed: false
}).addTo(map);

/* Add Checkbox to Turn ON/OFF layer */
function add_checkbox_cus() {
    $(".leaflet-control-layers-overlays").append('<label>' +
        '<div>' +
        '<input id="on_feat_check" type="checkbox" class="leaflet-control-layers-selector" checked>' +
        '<span>' +
        '<span id="on_feat" class="pdd-left-10 font-size-14" style="color: green">Còn hoạt động</span>' +
        '</span>' +
        '</div>' +
        '</label>')

    $(".leaflet-control-layers-overlays").append('<label>' +
        '<div>' +
        '<input id="off_feat_check" type="checkbox" class="leaflet-control-layers-selector" checked>' +
        '<span>' +
        '<span id="off_feat" class="pdd-left-10 font-size-14" style="color: red">Không hoạt động/Đã trám lấp</span>' +
        '</span>' +
        '</div>' +
        '</label>')
}

/* add_checkbox_cus() */

/*---- Add/Remove Some Layer when Zooming ----*/
map.on('zoomend', function() {
    if (map.getZoom() >= 15 && map.hasLayer(view_hanhchinh)) {
        map.removeLayer(view_hanhchinh);
        //map.addLayer(view_thuyhe);
        /* map.addLayer(view_diagioi); */
    }
    if (map.getZoom() < 15 && map.hasLayer(view_hanhchinh) == false) {
        map.addLayer(view_hanhchinh);
        // map.removeLayer(view_thuyhe);
        // map.removeLayer(view_diagioi);
    }
});

/*---- DOM view LatLng when F5 page or load first times ----*/
$(".leaflet-control-lat").val(10.424115);
$(".leaflet-control-lng").val(106.390280);

/*---- Zoom Home Event ----*/
$(".leaflet-control-zoomhome-home").on("click", function () {
    var searh_loc = map._layers
    var result_loc_search_1 = searh_loc[Object.keys(searh_loc)[Object.keys(searh_loc).length - 1]]
    var result_loc_search_2 = searh_loc[Object.keys(searh_loc)[Object.keys(searh_loc).length - 2]]
    /* Remove point sau khi tìm kiếm địa điểm khi click Zoom home */
    map.removeLayer(result_loc_search_1)
    map.removeLayer(result_loc_search_2)
})
