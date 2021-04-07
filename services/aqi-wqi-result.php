<?php
include "config.php"
?>
<?php
$quantrac = $_GET['quantrac_WA'];
$loaihinh = $_GET['loaihinh_WA'];
$loaitram = $_GET['loaitram_WA'];
$quanhuyen = $_GET['district_WA'];
$fromDate_WA = date($_GET['fromDate_WA']);
$toDate_WA = date($_GET['toDate_WA']);

/***  Querry Result WQI/AQI ***/
if ($quantrac == '1') {
    $querry_from = 'FROM "Observation_GiengQT_NDD" "obs"';
} else {
}
$querry_select = 'SELECT "station"."id", "station"."ma_giengqt_ndd",
        "obs"."day", "obs"."value", "district"."tenDVHC" "districtName",
        "district"."id" "districtID",
        "quality"."id" "qualityID", "quality"."purpose" "qualityPurpose",
        "quality"."colorcode" "qualityColorcode"'.
        $querry_from.
        'LEFT JOIN "GiengQT_NDD" "station" ON "obs"."stationid" = "station"."id"
        LEFT JOIN "Qualityindex" "quality" ON "obs"."qualityindexid" = "quality"."id"
        LEFT JOIN "Category" "category" ON "category"."id" = "station"."categoryid"
        LEFT JOIN "ObstypeStation" "obs_station" ON "obs_station"."stationid" = "station"."id"
        LEFT JOIN "ObservationType" "obs_type" ON "obs_type"."id" = "obs_station"."obstypesid"
        LEFT JOIN "CT_KTSD" "ctktsd" ON station.ma_congtrinhktsd = ctktsd.id
        LEFT JOIN "District" "district" ON ctktsd.ma_dvhc = district.ma_dvhc
        WHERE "obs"."qualityindexid" IS NOT NULL';

$querry_where = ' AND 1=1';
if ($loaihinh != '1=1') {
    $querry_where.=' AND "obs_type"."id" = '.$loaihinh;
}
if ($loaitram != '1=1') {
    $querry_where.=' AND "category"."id" = '.$loaitram;
}
if ($quanhuyen != '1=1') {
    $querry_where.=' AND "district"."ma_dvhc" ='. "'" . "'/87/.".$quanhuyen."'". "'";
}

$querry_where.= ' AND "obs"."day" BETWEEN '.$fromDate_WA.' AND '.$toDate_WA;

$querry_orderby = 'ORDER BY "quality"."id" DESC, "obs"."day" DESC';

$querry_qualities = $querry_select.$querry_where.$querry_orderby;
$result = pg_query($tiengiang_db, $querry_qualities);
if (!$result) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
$option = array();
foreach ($original_data as $key => $value) {
    $option[] = array(
        'id' => $value['id'],
        'code' => $value['ma_giengqt_ndd'],
        // 'name' => $value['name'],
        'day' => $value['day'],
        'value' => $value['value'],
        'qualityID' => $value['qualityID'],
        'qualityPurpose' => $value['qualityPurpose'],
        'qualityColorcode' => $value['qualityColorcode']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
