<?php
include "config.php";
?>
<?php
header('Content-Type: application/json');
/*** Querry lựa chọn Trạm vượt ngưỡng ***/
/* GiengQT_NDD */
$querry_option = 'SELECT
    "station"."id", "station"."ma_giengqt_ndd",
    "district"."tenDVHC" "districtName",
    "district"."ma_dvhc" "districtID",
    "category"."name" "categoryName",
    "category"."id" "categoryID",
    /*** Ghép cột Name của bảng ObservationType cần có hàm distinct để trở nên duy nhất ***/
    string_agg(distinct "obs_type"."name", \'; \') "obstype_namelist",
    jsonb_agg(obs.detail) as "total_detail"
    /* concat(\'[\', string_agg(distinct "obs"."detail", \', \'), \']\') "total_detail" */

    FROM "GiengQT_NDD" "station"
    LEFT JOIN "Category" "category" ON "category"."id" = "station"."categoryid"
    LEFT JOIN "CT_KTSD" "ctktsd" ON station.ma_congtrinhktsd = ctktsd.id
    LEFT JOIN "District" "district" ON ctktsd.ma_dvhc = district.ma_dvhc
    LEFT JOIN "ObstypeStation" "obs_station" ON "obs_station"."stationid" = "station"."id"
    LEFT JOIN "ObservationType" "obs_type" ON "obs_type"."id" = "obs_station"."obstypesid"
    LEFT JOIN "Observation_GiengQT_NDD" "obs" ON "obs"."stationid" = "station"."id"

    WHERE "category"."id" = \'1\' OR "category"."id" = \'3\'
    GROUP BY "station"."id",
    "category"."name", "category"."id",
    "district"."ma_dvhc", "district"."id"
    ORDER BY "station"."ma_giengqt_ndd" ASC';
$result = pg_query($tiengiang_db, $querry_option);
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

function stripslashes_deep($value)
{
    $value = is_array($value) ?
        array_map('stripslashes_deep', $value) :
        stripslashes($value);
    return $value;
}

foreach ($original_data as $key => $value) {
    $option[] = array(
        'id' => $value['id'],
        'name' => $value['ma_giengqt_ndd'],
        'districtID' => $value['districtID'],
        'districtName' => $value['districtName'],
        'categoryID' => $value['categoryID'],
        'categoryName' => $value['categoryName'],
        'obstype_namelist' => $value['obstype_namelist'],
        'total_detail' => json_decode($value['total_detail'])
    );
}

/*** Để Dom dữ liệu vào Danh sách vượt ngưỡng ***/
$option_final = array(
    'data' => $option
);

$final_data = json_encode($option_final);
echo $final_data;
?>

