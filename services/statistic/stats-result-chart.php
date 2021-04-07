<?php
    include "../config.php";
?>

<?php
    header('Content-Type: application/json');
    $thongso = $_POST["thongso"];
    $station = $_POST["station"];
    $congtrinh = $_POST["congtrinh"];
    $start = $_POST["start"];
    $end = $_POST["end"];

    /* Select Distinc Time */
    $query_distinc = '';
    if ($congtrinh == "ktsd_nm") {
        $query_distinc.= 'SELECT distinct translate((detail->\'time\')::text, \'"\', \'\') as "time", day FROM "Observation_DiemKTSD_NM" ';
    } else if ($congtrinh == "ktsd_ndd") {
        $query_distinc.= 'SELECT distinct translate((detail->\'time\')::text, \'"\', \'\') as "time", day FROM "Observation_DiemKTSD_NDD" ';
    } else if ($congtrinh == "xt") {
        $query_distinc.= 'SELECT distinct translate((detail->\'time\')::text, \'"\', \'\') as "time", day FROM "Observation_DiemXT" ';
    } else if ($congtrinh == "td") {
        $query_distinc.= 'SELECT distinct translate((detail->\'time\')::text, \'"\', \'\') as "time", day FROM "Observation_DiemTD_NDD" ';
    } else if ($congtrinh == "qt_ndd") {
        $query_distinc.= 'SELECT distinct translate((detail->\'time\')::text, \'"\', \'\') as "time", day FROM "Observation_GiengQT_NDD" ';
    }

    $query_distinc.= ' CROSS JOIN LATERAL jsonb_array_elements(detail->\'data\') as para 
                        WHERE (day between '."'".$start."'".' AND '."'".$end."'".') AND (';
    $query_station = '';
    foreach ($station as $i => $value) {
        if ($i > 0) {
            $query_station.= ' OR ';
        }
        $query_station.= 'stationid = '."'".$value."'";
    }
    $query_station.= ') AND (';

    $query_thongso = '';
    foreach ($thongso as $i => $value) {
        if ($i > 0) {
            $query_thongso.= ' OR ';
        }
        $query_thongso.= 'para  ? '."'".$value."'";
    }
    $query_thongso.= ')';
    $query_order = ' ORDER BY day, time';

    $result_time = pg_query($tiengiang_db, $query_distinc.$query_station.$query_thongso.$query_order);
    if (!$result_time) {
        echo "Không có dữ liệu";
    }

    $data_time = [];
    while ($row = pg_fetch_assoc($result_time)) {
        $data_time[] = $row;
    }

    $query_thongso = '';
    $query_station = '';
    $origin_rs = array();

    for ($k = 0; $k < count($thongso); $k++) {
        $origin_rs[$thongso[$k]] = null;
        for ($i = 0; $i < count($data_time); $i++) {
            /* Process Date */
            $time = explode(", ", $data_time[$i]['time'])[0];
            $date = explode(", ", $data_time[$i]['time'])[1];
            $hour = explode(":", $time)[0];
            /* if ((int)$hour < 10 && $hour != '00') {
                $hour = "0".$hour;
            } */
            $minute = explode(":", $time)[1];
            /* if ((int)$minute < 10 && $minute != '00') {
                $minute = "0".$minute;
            } */
            $second = explode(":", $time)[2];
            /* if ((int)$second < 10 && $second != '00') {
                $second = "0".$second;
            } */
            $day = explode("/", $date)[0];
            if ((int)$day < 10) {
                $day = "0".$day;
            }
            $month = explode("/", $date)[1];
            /* if ((int)$month < 10) {
                $month = "0".$month;
            } */
            $year = explode("/", $date)[2];

            $origin_rs[$thongso[$k]][$i]['time'] = $data_time[$i]['time'];
            $origin_rs[$thongso[$k]][$i]['timejs'] = $year."-".$month."-".$day." ".$hour.":".$minute.":".$second;

            for ($j = 0; $j < count($station); $j++) {
                $query = '';
                $query = "SELECT stationid,
                translate(split_part(para::text, ':', 1), '{ \":,}', '') as para,
                translate(replace(split_part(para::text, ':', 3),'inlimit',''), '{ \":,}', '') as value,
                translate((detail->'time')::text, '\"', '') as \"time\"";

                if ($congtrinh == "ktsd_nm") {
                    $query.= ' FROM "Observation_DiemKTSD_NM" ';
                } else if ($congtrinh == "ktsd_ndd") {
                    $query.= ' FROM "Observation_DiemKTSD_NDD" ';
                } else if ($congtrinh == "xt") {
                    $query.= ' FROM "Observation_DiemXT" ';
                } else if ($congtrinh == "td") {
                    $query.= ' FROM "Observation_DiemTD_NDD" ';
                } else if ($congtrinh == "qt_ndd") {
                    $query.= ' FROM "Observation_GiengQT_NDD" ';
                }

                $query.= ' CROSS JOIN LATERAL jsonb_array_elements(detail->\'data\') as para
                WHERE translate((detail->\'time\')::text, \'"\', \'\') = '."'".$data_time[$i]['time']."' AND ";
                $query_station = 'stationid = '."'".$station[$j]."'";
                $query_station.= ' AND ';
                $query_thongso = 'para  ? '."'".$thongso[$k]."'";
                $query_order = ' ORDER BY time, para, stationid';

                $result = pg_query($tiengiang_db, $query.$query_station.$query_thongso.$query_order);
                if (!$result) {
                    echo "Không có dữ liệu";
                }

                $data = [];
                while ($row = pg_fetch_assoc($result)) {
                    $data[] = $row;
                }

                if (count($data) != 0) {
                    $origin_rs[$thongso[$k]][$i][$station[$j]] = (int)$data[0]['value'];
                } else {
                    $origin_rs[$thongso[$k]][$i][$station[$j]] = null;
                }
            }
        }
    }
    echo json_encode(array("data" => $origin_rs));
?>
