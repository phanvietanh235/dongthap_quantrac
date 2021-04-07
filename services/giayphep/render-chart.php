<?php
    include "../config.php";
?>
<?php
    $fromDate = $_GET["fromDate"];
    $toDate = $_GET["toDate"];
    $type_ct = $_GET["type_ct"];
    $district = $_GET["district"];

    if ($type_ct == "ndd") {
        if ($district == "none") {
            $query_ndd = 'select count("ThongTinCP_NDD".id) as "SoLuong", 
 CASE
    WHEN D."ma_dvhc_cha" LIKE '. "'"."%815%". "'". 'THEN' . "'"."Thành phố Mỹ Tho". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%816%". "'". 'THEN' . "'"."Thị xã Gò Công". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%817%". "'". 'THEN' . "'"."Thị xã Cai Lậy". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%818%". "'". 'THEN'. "'". "Huyện Tân Phước". "'". 
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%819%". "'". 'THEN'. "'". "Huyện Cái Bè". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%820%". "'". 'THEN'. "'". "Huyện Cai Lậy". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%821%". "'". 'THEN' . "'"."Huyện Châu Thành". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%822%". "'". 'THEN' . "'"."Huyện Chợ Gạo". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%823%". "'". 'THEN' . "'"."Huyện Gò Công Tây". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%824%". "'". 'THEN' . "'"."Huyện Gò Công Đông". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%825%". "'". 'THEN' . "'"."Huyện Tân Phú Đông". "'".
  ' END AS group_district
, EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) as "NamCapPhep"
                    from "ThongTinCP_NDD"
                    LEFT JOIN "CT_KTSD" ON "ThongTinCP_NDD".ma_congtrinhktsd = "CT_KTSD".id
                    LEFT JOIN "District" D on "CT_KTSD".ma_dvhc = D.ma_dvhc ';

            $query_ndd.= 'where "ThongTinCP_NDD"."ngayCapPhep" BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'";
            $query_ndd.= ' group by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)), 
 CASE
    WHEN D."ma_dvhc_cha" LIKE '. "'"."%815%". "'". 'THEN' . "'"."Thành phố Mỹ Tho". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%816%". "'". 'THEN' . "'"."Thị xã Gò Công". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%817%". "'". 'THEN' . "'"."Thị xã Cai Lậy". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%818%". "'". 'THEN'. "'". "Huyện Tân Phước". "'". 
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%819%". "'". 'THEN'. "'". "Huyện Cái Bè". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%820%". "'". 'THEN'. "'". "Huyện Cai Lậy". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%821%". "'". 'THEN' . "'"."Huyện Châu Thành". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%822%". "'". 'THEN' . "'"."Huyện Chợ Gạo". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%823%". "'". 'THEN' . "'"."Huyện Gò Công Tây". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%824%". "'". 'THEN' . "'"."Huyện Gò Công Đông". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%825%". "'". 'THEN' . "'"."Huyện Tân Phú Đông". "'".
  ' END
order by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) ASC';

            $result_ndd = pg_query($tiengiang_db, $query_ndd);
            if (!$result_ndd) {
                echo "Không có dữ liệu.\n";
                exit;
            }

            $data_ndd = array();
            while ($row = pg_fetch_assoc($result_ndd)) {
                $data_ndd[] = $row;
            }

            $unique = array();
            for ($i = 0; $i < count($data_ndd); $i++) {
                array_push($unique, $data_ndd[$i]['NamCapPhep']);
            }
            /* Đánh Index lại cho mảng duy nhất */
            $year = array_values(array_unique($unique));

            $jsonData_ndd = json_encode($data_ndd);
            $original_data_ndd = json_decode($jsonData_ndd, true);
            $option_ndd = array();
            for ($i = 0; $i < count($year); $i++) {
                $option_ndd[] = array(
                    'year' => $year[$i],
                    '815' => '',
                    '816' => '',
                    '817' => '',
                    '818' => '',
                    '819' => '',
                    '820' => '',
                    '821' => '',
                    '822' => '',
                    '823' => '',
                    '824' => '',
                    '825' => '',
                    'none' => 0
                );
                foreach ($original_data_ndd as $key => $value) {
                    if ($year[$i] == $value['NamCapPhep']) {
                        if ($value['group_district'] == "Thành phố Mỹ Tho") {
                            $option_ndd[$i]['815'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Thị xã Gò Công") {
                            $option_ndd[$i]['816'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Thị xã Cai Lậy") {
                            $option_ndd[$i]['817'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Tân Phước") {
                            $option_ndd[$i]['818'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Cái Bè") {
                            $option_ndd[$i]['819'] = intval($value['SoLuong']);               
                        } else if ($value['group_district'] == "Huyện Cai Lậy") {
                            $option_ndd[$i]['820'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Châu Thành") {
                            $option_ndd[$i]['821'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Chợ Gạo") {
                            $option_ndd[$i]['822'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Gò Công Tây") {
                            $option_ndd[$i]['823'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Gò Công Đông") {
                            $option_ndd[$i]['824'] = intval($value['SoLuong']);
                        } else {
                            $option_ndd[$i]['825'] = intval($value['SoLuong']);
                        }
                    }
                }
            }
        } else {
            $query_ndd = 'select count("ThongTinCP_NDD".id) as "SoLuong", EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) as "NamCapPhep"
                    from "ThongTinCP_NDD"
                    LEFT JOIN "CT_KTSD" ON "ThongTinCP_NDD".ma_congtrinhktsd = "CT_KTSD".id
                    LEFT JOIN "District" D on "CT_KTSD".ma_dvhc = D.ma_dvhc ';

            $query_ndd.= "where D.ma_dvhc_cha LIKE "."'%".$district."%'".' AND "ThongTinCP_NDD"."ngayCapPhep" BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'";
            $query_ndd.= ' group by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE))
                     order by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) ASC';
            $result_ndd = pg_query($tiengiang_db, $query_ndd);
            if (!$result_ndd) {
                echo "Không có dữ liệu.\n";
                exit;
            }

            $data_ndd = array();
            while ($row = pg_fetch_assoc($result_ndd)) {
                $data_ndd[] = $row;
            }

            $jsonData_ndd = json_encode($data_ndd);
            $original_data_ndd = json_decode($jsonData_ndd, true);
            $option_ndd = array();
            foreach ($original_data_ndd as $key => $value) {
                $option_ndd[] = array(
                    'year' => $value['NamCapPhep'],
                    'ndd' =>  intval($value['SoLuong']),
                );
            }
        }
        echo json_encode(array("data" => $option_ndd));
    } else if ($type_ct == "nm") {
        if ($district == "none") {
            $query_nm = 'select count("ThongTinCP_NM".id) as "SoLuong", 
 CASE
    WHEN D."ma_dvhc_cha" LIKE '. "'"."%815%". "'". 'THEN' . "'"."Thành phố Mỹ Tho". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%816%". "'". 'THEN' . "'"."Thị xã Gò Công". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%817%". "'". 'THEN' . "'"."Thị xã Cai Lậy". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%818%". "'". 'THEN'. "'". "Huyện Tân Phước". "'". 
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%819%". "'". 'THEN'. "'". "Huyện Cái Bè". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%820%". "'". 'THEN'. "'". "Huyện Cai Lậy". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%821%". "'". 'THEN' . "'"."Huyện Châu Thành". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%822%". "'". 'THEN' . "'"."Huyện Chợ Gạo". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%823%". "'". 'THEN' . "'"."Huyện Gò Công Tây". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%824%". "'". 'THEN' . "'"."Huyện Gò Công Đông". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%825%". "'". 'THEN' . "'"."Huyện Tân Phú Đông". "'".
  ' END AS group_district
, EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) as "NamCapPhep"
                    from "ThongTinCP_NM"
                    LEFT JOIN "CT_KTSD" ON "ThongTinCP_NM".ma_congtrinhktsd = "CT_KTSD".id
                    LEFT JOIN "District" D on "CT_KTSD".ma_dvhc = D.ma_dvhc ';

            $query_nm.= 'where "ThongTinCP_NM"."ngayCapPhep" BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'";
            $query_nm.= ' group by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)), 
 CASE
    WHEN D."ma_dvhc_cha" LIKE '. "'"."%815%". "'". 'THEN' . "'"."Thành phố Mỹ Tho". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%816%". "'". 'THEN' . "'"."Thị xã Gò Công". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%817%". "'". 'THEN' . "'"."Thị xã Cai Lậy". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%818%". "'". 'THEN'. "'". "Huyện Tân Phước". "'". 
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%819%". "'". 'THEN'. "'". "Huyện Cái Bè". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%820%". "'". 'THEN'. "'". "Huyện Cai Lậy". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%821%". "'". 'THEN' . "'"."Huyện Châu Thành". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%822%". "'". 'THEN' . "'"."Huyện Chợ Gạo". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%823%". "'". 'THEN' . "'"."Huyện Gò Công Tây". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%824%". "'". 'THEN' . "'"."Huyện Gò Công Đông". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%825%". "'". 'THEN' . "'"."Huyện Tân Phú Đông". "'".
  ' END
order by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) ASC';

            $result_nm = pg_query($tiengiang_db, $query_nm);
            if (!$result_nm) {
                echo "Không có dữ liệu.\n";
                exit;
            }

            $data_nm = array();
            while ($row = pg_fetch_assoc($result_nm)) {
                $data_nm[] = $row;
            }

            $unique = array();
            for ($i = 0; $i < count($data_nm); $i++) {
                array_push($unique, $data_nm[$i]['NamCapPhep']);
            }
            /* Đánh Index lại cho mảng duy nhất */
            $year = array_values(array_unique($unique));

            $jsonData_nm = json_encode($data_nm);
            $original_data_nm = json_decode($jsonData_nm, true);
            $option_nm = array();
            for ($i = 0; $i < count($year); $i++) {
                $option_nm[] = array(
                    'year' => $year[$i],
                    '815' => '',
                    '816' => '',
                    '817' => '',
                    '818' => '',
                    '819' => '',
                    '820' => '',
                    '821' => '',
                    '822' => '',
                    '823' => '',
                    '824' => '',
                    '825' => '',
                    'none' => 0
                );
                foreach ($original_data_nm as $key => $value) {
                    if ($year[$i] == $value['NamCapPhep']) {
                        if ($value['group_district'] == "Thành phố Mỹ Tho") {
                            $option_nm[$i]['815'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Thị xã Gò Công") {
                            $option_nm[$i]['816'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Thị xã Cai Lậy") {
                            $option_nm[$i]['817'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Tân Phước") {
                            $option_nm[$i]['818'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Cái Bè") {
                            $option_nm[$i]['819'] = intval($value['SoLuong']);               
                        } else if ($value['group_district'] == "Huyện Cai Lậy") {
                            $option_nm[$i]['820'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Châu Thành") {
                            $option_nm[$i]['821'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Chợ Gạo") {
                            $option_nm[$i]['822'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Gò Công Tây") {
                            $option_nm[$i]['823'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Gò Công Đông") {
                            $option_nm[$i]['824'] = intval($value['SoLuong']);
                        } else {
                            $option_nm[$i]['825'] = intval($value['SoLuong']);
                        }
                    }
                }
            }
        } else {
            $query_nm = 'select count("ThongTinCP_NM".id) as "SoLuong", EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) as "NamCapPhep"
                        from "ThongTinCP_NM"
                        LEFT JOIN "CT_KTSD" ON "ThongTinCP_NM".ma_congtrinhktsd = "CT_KTSD".id
                        LEFT JOIN "District" D on "CT_KTSD".ma_dvhc = D.ma_dvhc ';
            if ($district == "none") {
                $query_nm.= "where 1=1";
            } else {
                $query_nm.= "where D.ma_dvhc_cha LIKE"."'%".$district."%'".' AND "ThongTinCP_NM"."ngayCapPhep" BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'";;
            }
            $query_nm.= ' group by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE))
                         order by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) ASC';
            $result_nm = pg_query($tiengiang_db, $query_nm);
            if (!$result_nm) {
                echo "Không có dữ liệu.\n";
                exit;
            }

            $data_nm = array();
            while ($row = pg_fetch_assoc($result_nm)) {
                $data_nm[] = $row;
            }

            $jsonData_nm = json_encode($data_nm);
            $original_data_nm = json_decode($jsonData_nm, true);
            $option_nm = array();
            foreach ($original_data_nm as $key => $value) {
                $option_nm[] = array(
                    'year' => $value['NamCapPhep'],
                    'nm' => intval($value['SoLuong']),
                );
            }
        }
        echo json_encode(array("data" => $option_nm));
    } else if ($type_ct == "xt") {
        if ($district == "none") {
$query_xt = 'select count("ThongTinCP_XT".id) as "SoLuong", 
 CASE
    WHEN D."ma_dvhc_cha" LIKE '. "'"."%815%". "'". 'THEN' . "'"."Thành phố Mỹ Tho". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%816%". "'". 'THEN' . "'"."Thị xã Gò Công". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%817%". "'". 'THEN' . "'"."Thị xã Cai Lậy". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%818%". "'". 'THEN'. "'". "Huyện Tân Phước". "'". 
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%819%". "'". 'THEN'. "'". "Huyện Cái Bè". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%820%". "'". 'THEN'. "'". "Huyện Cai Lậy". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%821%". "'". 'THEN' . "'"."Huyện Châu Thành". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%822%". "'". 'THEN' . "'"."Huyện Chợ Gạo". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%823%". "'". 'THEN' . "'"."Huyện Gò Công Tây". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%824%". "'". 'THEN' . "'"."Huyện Gò Công Đông". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%825%". "'". 'THEN' . "'"."Huyện Tân Phú Đông". "'".
  ' END AS group_district
, EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) as "NamCapPhep"
                    from "ThongTinCP_XT"
                    LEFT JOIN "CT_KTSD" ON "ThongTinCP_XT".ma_congtrinhktsd = "CT_KTSD".id
                    LEFT JOIN "District" D on "CT_KTSD".ma_dvhc = D.ma_dvhc ';

            $query_xt.= 'where "ThongTinCP_XT"."ngayCapPhep" BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'";
            $query_xt.= ' group by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)), 
 CASE
    WHEN D."ma_dvhc_cha" LIKE '. "'"."%815%". "'". 'THEN' . "'"."Thành phố Mỹ Tho". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%816%". "'". 'THEN' . "'"."Thị xã Gò Công". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%817%". "'". 'THEN' . "'"."Thị xã Cai Lậy". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%818%". "'". 'THEN'. "'". "Huyện Tân Phước". "'". 
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%819%". "'". 'THEN'. "'". "Huyện Cái Bè". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%820%". "'". 'THEN'. "'". "Huyện Cai Lậy". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%821%". "'". 'THEN' . "'"."Huyện Châu Thành". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%822%". "'". 'THEN' . "'"."Huyện Chợ Gạo". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%823%". "'". 'THEN' . "'"."Huyện Gò Công Tây". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%824%". "'". 'THEN' . "'"."Huyện Gò Công Đông". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%825%". "'". 'THEN' . "'"."Huyện Tân Phú Đông". "'".
  ' END
order by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) ASC';

            $result_xt = pg_query($tiengiang_db, $query_xt);
            if (!$result_xt) {
                echo "Không có dữ liệu.\n";
                exit;
            }

            $data_xt = array();
            while ($row = pg_fetch_assoc($result_xt)) {
                $data_xt[] = $row;
            }

            $unique = array();
            for ($i = 0; $i < count($data_xt); $i++) {
                array_push($unique, $data_xt[$i]['NamCapPhep']);
            }
            /* Đánh Index lại cho mảng duy nhất */
            $year = array_values(array_unique($unique));

            $jsonData_xt = json_encode($data_xt);
            $original_data_xt = json_decode($jsonData_xt, true);
            $option_xt = array();
            for ($i = 0; $i < count($year); $i++) {
                $option_xt[] = array(
                    'year' => $year[$i],
                    '815' => '',
                    '816' => '',
                    '817' => '',
                    '818' => '',
                    '819' => '',
                    '820' => '',
                    '821' => '',
                    '822' => '',
                    '823' => '',
                    '824' => '',
                    '825' => '',
                    'none' => 0
                );
                foreach ($original_data_xt as $key => $value) {
                    if ($year[$i] == $value['NamCapPhep']) {
                        if ($value['group_district'] == "Thành phố Mỹ Tho") {
                            $option_xt[$i]['815'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Thị xã Gò Công") {
                            $option_xt[$i]['816'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Thị xã Cai Lậy") {
                            $option_xt[$i]['817'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Tân Phước") {
                            $option_xt[$i]['818'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Cái Bè") {
                            $option_xt[$i]['819'] = intval($value['SoLuong']);               
                        } else if ($value['group_district'] == "Huyện Cai Lậy") {
                            $option_xt[$i]['820'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Châu Thành") {
                            $option_xt[$i]['821'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Chợ Gạo") {
                            $option_xt[$i]['822'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Gò Công Tây") {
                            $option_xt[$i]['823'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Gò Công Đông") {
                            $option_xt[$i]['824'] = intval($value['SoLuong']);
                        } else {
                            $option_xt[$i]['825'] = intval($value['SoLuong']);
                        }
                    }
                }
            }
        } else {
            $query_xt = 'select count("ThongTinCP_XT".id) as "SoLuong", EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) as "NamCapPhep"
                    from "ThongTinCP_XT"
                    LEFT JOIN "CT_KTSD" ON "ThongTinCP_XT".ma_congtrinhktsd = "CT_KTSD".id
                    LEFT JOIN "District" D on "CT_KTSD".ma_dvhc = D.ma_dvhc ';
            if ($district == "none") {
                $query_xt.= "where 1=1";
            } else {
                $query_xt.= "where D.ma_dvhc_cha LIKE"."'%".$district."%'".' AND "ThongTinCP_XT"."ngayCapPhep" BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'";;
            }
            $query_xt.= ' group by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE))
                         order by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) ASC';
            $result_xt = pg_query($tiengiang_db, $query_xt);
            if (!$result_xt) {
                echo "Không có dữ liệu.\n";
                exit;
            }

            $data_xt = array();
            while ($row = pg_fetch_assoc($result_xt)) {
                $data_xt[] = $row;
            }

            $jsonData_xt = json_encode($data_xt);
            $original_data_xt = json_decode($jsonData_xt, true);
            $option_xt = array();
            foreach ($original_data_xt as $key => $value) {
                $option_xt[] = array(
                    'year' => $value['NamCapPhep'],
                    'xt' => intval($value['SoLuong']),
                );
            }
        }
        echo json_encode(array("data" => $option_xt));
    } else {
        if ($district == "none") {
            $query_td = 'select count("ThongTinCP_TD".id) as "SoLuong", 
 CASE
    WHEN D."ma_dvhc_cha" LIKE '. "'"."%815%". "'". 'THEN' . "'"."Thành phố Mỹ Tho". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%816%". "'". 'THEN' . "'"."Thị xã Gò Công". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%817%". "'". 'THEN' . "'"."Thị xã Cai Lậy". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%818%". "'". 'THEN'. "'". "Huyện Tân Phước". "'". 
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%819%". "'". 'THEN'. "'". "Huyện Cái Bè". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%820%". "'". 'THEN'. "'". "Huyện Cai Lậy". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%821%". "'". 'THEN' . "'"."Huyện Châu Thành". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%822%". "'". 'THEN' . "'"."Huyện Chợ Gạo". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%823%". "'". 'THEN' . "'"."Huyện Gò Công Tây". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%824%". "'". 'THEN' . "'"."Huyện Gò Công Đông". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%825%". "'". 'THEN' . "'"."Huyện Tân Phú Đông". "'".
  ' END AS group_district
, EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) as "NamCapPhep"
                    from "ThongTinCP_TD"
                    LEFT JOIN "CT_KTSD" ON "ThongTinCP_TD".ma_congtrinhktsd = "CT_KTSD".id
                    LEFT JOIN "District" D on "CT_KTSD".ma_dvhc = D.ma_dvhc ';

            $query_td.= 'where "ThongTinCP_TD"."ngayCapPhep" BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'";
            $query_td.= ' group by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)), 
 CASE
    WHEN D."ma_dvhc_cha" LIKE '. "'"."%815%". "'". 'THEN' . "'"."Thành phố Mỹ Tho". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%816%". "'". 'THEN' . "'"."Thị xã Gò Công". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%817%". "'". 'THEN' . "'"."Thị xã Cai Lậy". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%818%". "'". 'THEN'. "'". "Huyện Tân Phước". "'". 
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%819%". "'". 'THEN'. "'". "Huyện Cái Bè". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%820%". "'". 'THEN'. "'". "Huyện Cai Lậy". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%821%". "'". 'THEN' . "'"."Huyện Châu Thành". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%822%". "'". 'THEN' . "'"."Huyện Chợ Gạo". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%823%". "'". 'THEN' . "'"."Huyện Gò Công Tây". "'".
    'WHEN D."ma_dvhc_cha" LIKE '. "'"."%824%". "'". 'THEN' . "'"."Huyện Gò Công Đông". "'".
'WHEN D."ma_dvhc_cha" LIKE '. "'"."%825%". "'". 'THEN' . "'"."Huyện Tân Phú Đông". "'".
  ' END
order by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) ASC';

            $result_td = pg_query($tiengiang_db, $query_td);
            if (!$result_td) {
                echo "Không có dữ liệu.\n";
                exit;
            }

            $data_td = array();
            while ($row = pg_fetch_assoc($result_td)) {
                $data_td[] = $row;
            }

            $unique = array();
            for ($i = 0; $i < count($data_td); $i++) {
                array_push($unique, $data_td[$i]['NamCapPhep']);
            }
            /* Đánh Index lại cho mảng duy nhất */
            $year = array_values(array_unique($unique));

            $jsonData_td = json_encode($data_td);
            $original_data_td = json_decode($jsonData_td, true);
            $option_td = array();
            for ($i = 0; $i < count($year); $i++) {
                $option_td[] = array(
                    'year' => $year[$i],
                    '815' => '',
                    '816' => '',
                    '817' => '',
                    '818' => '',
                    '819' => '',
                    '820' => '',
                    '821' => '',
                    '822' => '',
                    '823' => '',
                    '824' => '',
                    '825' => '',
                    'none' => 0
                );
                foreach ($original_data_td as $key => $value) {
                    if ($year[$i] == $value['NamCapPhep']) {
                        if ($value['group_district'] == "Thành phố Mỹ Tho") {
                            $option_td[$i]['815'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Thị xã Gò Công") {
                            $option_td[$i]['816'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Thị xã Cai Lậy") {
                            $option_td[$i]['817'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Tân Phước") {
                            $option_td[$i]['818'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Cái Bè") {
                            $option_td[$i]['819'] = intval($value['SoLuong']);               
                        } else if ($value['group_district'] == "Huyện Cai Lậy") {
                            $option_td[$i]['820'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Châu Thành") {
                            $option_td[$i]['821'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Chợ Gạo") {
                            $option_td[$i]['822'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Gò Công Tây") {
                            $option_td[$i]['823'] = intval($value['SoLuong']);
                        } else if ($value['group_district'] == "Huyện Gò Công Đông") {
                            $option_td[$i]['824'] = intval($value['SoLuong']);
                        } else {
                            $option_td[$i]['825'] = intval($value['SoLuong']);
                        }
                    }
                }
            }
        } else {
            $query_td = 'select count("ThongTinCP_TD".id) as "SoLuong", EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) as "NamCapPhep"
                        from "ThongTinCP_TD"
                        LEFT JOIN "CT_KTSD" ON "ThongTinCP_TD".ma_congtrinhktsd = "CT_KTSD".id
                        LEFT JOIN "District" D on "CT_KTSD".ma_dvhc = D.ma_dvhc ';
            if ($district == "none") {
                $query_td.= "where 1=1";
            } else {
                $query_td.= "where D.ma_dvhc_cha LIKE"."'%".$district."%'".' AND "ThongTinCP_TD"."ngayCapPhep" BETWEEN ' . "'" . $fromDate . "'" . 'AND' . "'" . $toDate . "'";;
            }
            $query_td.= ' group by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE))
                         order by EXTRACT(YEAR FROM CAST("ngayCapPhep" AS DATE)) ASC';
            $result_td = pg_query($tiengiang_db, $query_td);
            if (!$result_td) {
                echo "Không có dữ liệu.\n";
                exit;
            }

            $data_td = array();
            while ($row = pg_fetch_assoc($result_td)) {
                $data_td[] = $row;
            }

            $jsonData_td = json_encode($data_td);
            $original_data_td = json_decode($jsonData_td, true);
            $option_td = array();
            foreach ($original_data_td as $key => $value) {
                $option_td[] = array(
                    'year' => $value['NamCapPhep'],
                    'td' =>  intval($value['SoLuong']),
                );
            }
        }
        echo json_encode(array("data" => $option_td));
    }
?>
