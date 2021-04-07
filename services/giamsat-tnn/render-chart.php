<?php
include "../config.php";
include "../standard-parameter.php";
?>
<?php
$idpoi = $_GET["idpoi"];
$type = $_GET["type"];
/*** Option User ***/
$para = $_GET["para_opt"];
$min_max = array();
for ($i = 0; $i < count($final_std_para); $i++) {
    if ($para == $final_std_para[$i]["id"]) {
        $min_max = array(
            'unit' => $final_std_para[$i]["unitName"] != "" ? $final_std_para[$i]["unitName"] : "",
            'min' => $final_std_para[$i]["min_value"],
            'max' => $final_std_para[$i]["max_value"],
        );
    }
}

$fromDate = $_GET["fromDate"];
$toDate = $_GET["toDate"];
/*** Observation_DiemKTSD_NDD ***/
if ($type == "ktsd_ndd") {
    $query_data = 'SELECT day, time, 
            jsonb_array_elements(detail->' . "'data'" . ')' . '->' . "'" . $para . "'" . '->' . "'" . 'v' . "' as val" .
        ' FROM "Observation_DiemKTSD_NDD" 
            WHERE stationid = ' . $idpoi .
        ' AND day BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'" .
        ' ORDER BY day ASC, time ASC';
    $result = pg_query($tiengiang_db, $query_data);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
} else if ($type == "xt") {
    $query_data = 'SELECT day, time, 
            jsonb_array_elements(detail->' . "'data'" . ')' . '->' . "'" . $para . "'" . '->' . "'" . 'v' . "' as val" .
        ' FROM "Observation_DiemXT" 
            WHERE stationid = ' . $idpoi .
        ' AND day BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'" .
        ' ORDER BY day ASC, time ASC';
    $result = pg_query($tiengiang_db, $query_data);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
} else if ($type == "td") {
    $query_data = 'SELECT day, time, 
            jsonb_array_elements(detail->' . "'data'" . ')' . '->' . "'" . $para . "'" . '->' . "'" . 'v' . "' as val" .
        ' FROM "Observation_DiemTD_NDD" 
            WHERE stationid = ' . $idpoi .
        ' AND day BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'" .
        ' ORDER BY day ASC, time ASC';
    $result = pg_query($tiengiang_db, $query_data);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
} else if ($type == "ktsd_nm") {
    $query_data = 'SELECT day, time, 
            jsonb_array_elements(detail->' . "'data'" . ')' . '->' . "'" . $para . "'" . '->' . "'" . 'v' . "' as val" .
        ' FROM "Observation_DiemKTSD_NM" 
            WHERE stationid = ' . $idpoi .
        ' AND day BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'" .
        ' ORDER BY day ASC, time ASC';
    $result = pg_query($tiengiang_db, $query_data);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
}

$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

$data_notNull_label = array();
$data_notNull_val = array();
/*** Convert to Timestamp to view Chart faster ***/
for ($i = 0; $i < count($data); $i++) {
    $ymd = explode("-", $data[$i]["day"]);
    if ($data[$i]["val"] != '') {
        $data_notNull[] = array(
            "datetime" => $data[$i]["day"] . " " . $data[$i]["time"],
            "val" => (float)$data[$i]["val"]
        );
    }
}

$res = array(
    "range" => $min_max,
    "data" => $data_notNull
);
echo json_encode($res);
?>
