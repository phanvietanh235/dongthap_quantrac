function Identify(e, layer) {
    var latlngStr = '(' + e.latlng.lat.toFixed(3) + ',' + e.latlng.lng.toFixed(3) + ')';
    var BBOX = map.getBounds()._southWest.lng + "," + map.getBounds()._southWest.lat + "," + map.getBounds()._northEast.lng + "," + map.getBounds()._northEast.lat;
    var W = map.getSize().x;
    var H = map.getSize().y;
    var X = map.layerPointToContainerPoint(e.layerPoint).x;
    var Y = map.layerPointToContainerPoint(e.layerPoint).y;
    var zoom = map.getZoom();
    var lon = e.latlng.lng;
    var lat = e.latlng.lat;
    var xtile = parseInt(Math.floor((lon + 180) / 360 * (1 << zoom)));
    var ytile = parseInt(Math.floor((1 - Math.log(Math.tan(lat * Math.PI / 180) + 1 / Math.cos(lat * Math.PI / 180)) / Math.PI) / 2 * (1 << zoom)));

    var URL_ranhthua = "http://" + subdomain_geoserver + host_geoserver + workspace + "/wms?" +
        'service=WMS&' +
        'request=GetFeatureInfo&' +
        'version=1.1.1&' +
        'layers=' + workspace + ':rtdc_4326&' +
        'styles=&' +
        'exceptions=application%2Fvnd.ogc.se_inimage&' +
        'format=image%2Fpng&' +
        'transparent=true&' +
        'info_format=application/json&' +
        'tiled=true&' +
        'width=' + W + '&height=' + H +
        '&srs=EPSG:4326&bbox=' + BBOX +
        '&query_layers=' + workspace + ':rtdc_4326&' +
        'FEATURE_COUNT=1&' +
        'X=' + parseInt(X) + '&Y=' + parseInt(Y);

    var proxy = 'services/proxy.php';
    URL_ranhthua = proxy + '?url=' + encodeURIComponent(URL_ranhthua);

    $.ajax({
        url: URL_ranhthua,
        dataType: "json",
        type: "GET",
        success: function(data) {
            var noidung = showInfo(data);

            var popup_hientrang = L.popup({
                maxWidth: 800
            }).setLatLng(e.latlng).setContent(noidung)
            map.openPopup(popup_hientrang);
        }
    })
}

/* map.addEventListener('click', Identify); */
/*---- Check Layer Ranh thửa địa chính ON/OFF ----*/
map.on("click", function () {
    if (map.hasLayer(view_diagioi)) {
        map.addEventListener('click', Identify);
    } else {
        map.off('click', Identify);
    }
})
