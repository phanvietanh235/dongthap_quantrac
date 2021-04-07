<?php
include "../config.php";
include "../standard-parameter.php";
?>
<?php
error_reporting(0);
$idpoi = $_GET["idpoi"];
$type = $_GET["type"];
/*---- View Newest Data realtime ----*/
if ($type == "ktsd_ndd") {
    $query_newest = 'SELECT * FROM "Observation_DiemKTSD_NDD" WHERE stationid = ' . $idpoi .
        'ORDER BY id DESC LIMIT 1';
    $result = pg_query($tiengiang_db, $query_newest);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
} else if ($type == "xt") {
    $query_newest = 'SELECT * FROM "Observation_DiemXT" WHERE stationid = ' . $idpoi .
        'ORDER BY id DESC LIMIT 1';
    $result = pg_query($tiengiang_db, $query_newest);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
} else if ($type == "td") {
    $query_newest = 'SELECT * FROM "Observation_DiemTD_NDD" WHERE stationid = ' . $idpoi .
        'ORDER BY id DESC LIMIT 1';
    $result = pg_query($tiengiang_db, $query_newest);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
} else if ($type == "ktsd_ndd") {
    $query_newest = 'SELECT * FROM "Observation_DiemKTSD_NM" WHERE stationid = ' . $idpoi .
        'ORDER BY id DESC LIMIT 1';
    $result = pg_query($tiengiang_db, $query_newest);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }
}

$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

$detail = json_decode($data[0]["detail"]);
$time = $detail->time;
$data = $detail->data;

$new_data = array();
for ($i = 0; $i < count($data); $i++) {
    $std_key = key($data[$i]);
    $v = $data[$i]->$std_key->v;
    $inlimit = $data[$i]->$std_key->inlimit;
    for ($j = 0; $j < count($final_std_para); $j++) {
        if ($std_key == $final_std_para[$j]["id"]) {
            $new_data[] = array(
                "time" => $time,
                "thongso" => $final_std_para[$j]["parameterCode"],
                "v" => $v,
                "inlimit" => $inlimit,
                "min" => $final_std_para[$j]["min_value"],
                "max" => $final_std_para[$j]["max_value"],
                "donvi" => $final_std_para[$j]["unitName"],
            );
        }
    }
}
$newest = json_encode($new_data);
echo $newest;
?>
