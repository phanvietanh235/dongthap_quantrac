<?php
include "../config.php";
include "../standard-parameter.php";
?>
<?php
$idpoi = $_GET["idpoi"];
$type = $_GET["type"];
/*** Option User ***/
$para = $_GET["para_opt"];
$fromDate = $_GET["fromDate"];
$toDate = $_GET["toDate"];
/*** Observation_DiemKTSD_NDD ***/
if ($type == "ktsd_ndd") {
    $query_data = 'SELECT day, time, 
            jsonb_array_elements(detail->' . "'data'" . ')' . '->' . "'" . $para . "'" . '->' . "'" . 'v' . "' as val" .
        ' FROM "Observation_DiemKTSD_NDD" 
            WHERE stationid = ' . $idpoi .
        ' AND day BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'" .
        ' ORDER BY day DESC, time DESC';
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
        ' ORDER BY day DESC, time DESC';
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
        ' ORDER BY day DESC, time DESC';
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
        ' ORDER BY day DESC, time DESC';
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

$data_notNull = array();
/*** Convert to Timestamp to view Chart faster ***/
for ($i = 0; $i < count($data); $i++) {
    $ymd = explode("-", $data[$i]["day"]);
    if ($data[$i]["val"] != '') {
        $data_notNull[] = array(
            'day' => $ymd[2] . "/" . $ymd[1] . "/" . $ymd[0],
            'time' => $data[$i]["time"],
            'val' => $data[$i]["val"]
        );
    }
}
echo json_encode($data_notNull);
?>
