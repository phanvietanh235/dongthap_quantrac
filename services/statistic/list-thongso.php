<?php
    include "../config.php";
    include "../standard-parameter.php"
?>
<?php
    header('Content-Type: application/json');
    $get = $_GET["data"];
    $data = json_decode($get);
    $congtrinh = $data->congtrinh;
    $station_select = $data->station;

    $query = '';
    if ($congtrinh == "ktsd_nm") {
        $query = 'SELECT detail->' . "'data' as para " . 'FROM "Observation_DiemKTSD_NM" WHERE ';
    } else if ($congtrinh == "ktsd_ndd") {
        $query = 'SELECT detail->' . "'data' as para " . 'FROM "Observation_DiemKTSD_NDD" WHERE ';
    } else if ($congtrinh == "xt") {
        $query = 'SELECT detail->' . "'data' as para " . 'FROM "Observation_DiemXT" WHERE ';
    } else if ($congtrinh == "td") {
        $query = 'SELECT detail->' . "'data' as para " . 'FROM "Observation_DiemTD_NDD" WHERE ';
    } else if ($congtrinh == "qt_ndd") {
        $query = 'SELECT detail->' . "'data' as para " . 'FROM "Observation_GiengQT_NDD" WHERE ';
    }

    foreach ($station_select as $i => $value) {
        if ($i > 0) {
            $query.= ' OR ';
        }
        $query.= 'stationid = '."'".$value."'";
    }

    if (!array_key_exists("searchTerm", $data)) {
        $result = pg_query($tiengiang_db, $query);
        if (!$result) {
            echo "Không có dữ liệu";
        }

        $data = [];
        while ($row = pg_fetch_assoc($result)) {
            $data[] = $row;
        }

        if (count($data) != 0) {
            $option_para = array();
            /* Thêm Option tất cả
            $option_para[0] = array(
                'id' => 'all',
                'text' => 'Tất cả'
            ); */
            for ($i = 0; $i < count($data); $i++) {
                $para = json_decode($data[$i]['para']);
                for ($k = 0; $k < count($para); $k++) {
                    $std_key = key($para[$k]);
                    for ($j = 0; $j < count($final_std_para); $j++) {
                        if ($std_key == $final_std_para[$j]["id"]) {
                            $unit = $final_std_para[$j]["unitName"] != '' ? ", đơn vị: ".$final_std_para[$j]["unitName"] : "";
                            $option_para[] = array(
                                'id' => $std_key,
                                'text' => $final_std_para[$j]["parameterCode"]." (".$final_std_para[$j]["parameterName"].$unit.")"
                            );
                        }
                    }
                }
            }
            echo json_encode(object_array_unique($option_para));
        }
    }

    function object_array_unique($array, $keep_key_assoc = false) {
        $duplicate_keys = array();
        $tmp = array();

        foreach ($array as $key => $val){
            if (is_object($val))
                $val = (array)$val;

            if (!in_array($val, $tmp))
                $tmp[] = $val;
            else
                $duplicate_keys[] = $key;
        }

        foreach ($duplicate_keys as $key)
            unset($array[$key]);

        return $keep_key_assoc ? $array : array_values($array);
    }
?>
