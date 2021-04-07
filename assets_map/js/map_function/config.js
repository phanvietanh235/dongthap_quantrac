var protocol = "http://";
// var protocol = "https://";
// var subdomain_geoserver = "10.151.46.88:8080/";
var subdomain_geoserver = "localhost:8080/";
// var subdomain_geoserver = "geo.projgis.link/";

/*---- Geoserver ----*/
var host_geoserver = "geoserver/";
var workspace = "dongthap_tnn";

/*** Services for WMTS ***/
var wmts = "gwc/service/wmts?"
var services = "&style=" +
    "&tilematrixset=EPSG:900913" +
    "&Service=WMTS" +
    "&Request=GetTile" +
    "&Version=1.0.0" +
    "&Format=image/png" +
    "&TileMatrix=EPSG:900913:{z}&TileCol={x}&TileRow={y}";
