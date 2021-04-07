<?php
include "../config.php";
include "../standard-parameter.php"
?>
<?php
$idpoi = $_GET["idpoi"];
$type = $_GET["type"];

/*** Observation_DiemKTSD_NDD ***/
if ($type == "ktsd_ndd") {
    $query_data = 'SELECT detail->' . "'data' as para " . 'FROM "Observation_DiemKTSD_NDD"' .
        ' WHERE stationid = ' . $idpoi .
        ' ORDER BY day DESC, time DESC LIMIT 1';
    $result = pg_query($tiengiang_db, $query_data);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
} else if ($type == "xt") {
    $query_data = 'SELECT detail->' . "'data' as para " . 'FROM "Observation_DiemXT"' .
        ' WHERE stationid = ' . $idpoi .
        ' ORDER BY day DESC, time DESC LIMIT 1';
    $result = pg_query($tiengiang_db, $query_data);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
} else if ($type == "td") {
    $query_data = 'SELECT detail->' . "'data' as para " . 'FROM "Observation_DiemTD_NDD"' .
        ' WHERE stationid = ' . $idpoi .
        ' ORDER BY day DESC, time DESC LIMIT 1';
    $result = pg_query($tiengiang_db, $query_data);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
} else if ($type == "ktsd_nm") {
    $query_data = 'SELECT detail->' . "'data' as para " . 'FROM "Observation_DiemKTSD_NM"' .
        ' WHERE stationid = ' . $idpoi .
        ' ORDER BY day DESC, time DESC LIMIT 1';
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
if (count($data) != 0) {
    $para = json_decode($data[0]['para']);
    $option_para = array();
    for ($i = 0; $i < count($para); $i++) {
        $std_key = key($para[$i]);
        for ($j = 0; $j < count($final_std_para); $j++) {
            if ($std_key == $final_std_para[$j]["id"]) {
                $option_para[] = array(
                    'id' => $std_key,
                    'code' => $final_std_para[$j]["parameterCode"],
                    'name' => $final_std_para[$j]["parameterName"],
                    'unitname' => $final_std_para[$j]["unitName"] != '' ? $final_std_para[$j]["unitName"] : ""
                );
            }
        }
    }
    echo json_encode($option_para);
}
?>
