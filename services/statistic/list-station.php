<?php
    include "../config.php"
?>
<?php
    header('Content-Type: application/json');
    $get = $_GET["data"];
    $data = json_decode($get);
    $congtrinh = $data->congtrinh;
    $district = $data->district;
    $quychuan = $data->quychuan;

    $query = '';
    if ($congtrinh == "ktsd_nm") {
        $query = 'SELECT distinct obser_xt.stationid, diemnm."soHieuDiem" "kyhieu_tram", obser_xt.note "quychuan", ktsd."tenCongTrinh"
                    FROM "Observation_DiemKTSD_NM" obser_xt
                    LEFT JOIN "DiemKTSD_NM" diemnm ON stationid = diemnm.id
                    LEFT JOIN "CT_KTSD" ktsd ON diemnm.ma_congtrinhktsd = ktsd.id
                    WHERE note = '."'".$quychuan."'";
    } else if ($congtrinh == "ktsd_ndd") {
        $query = 'SELECT distinct obser_xt.stationid, diemndd."soHieuGieng" "kyhieu_tram", obser_xt.note "quychuan", ktsd."tenCongTrinh"
                    FROM "Observation_DiemKTSD_NDD" obser_xt
                    LEFT JOIN "DiemKTSD_NDD" diemndd ON stationid = diemndd.id 
                    LEFT JOIN "CT_KTSD" ktsd ON diemndd.ma_congtrinhktsd = ktsd.id
                    WHERE note = '."'".$quychuan."'";
    } else if ($congtrinh == "xt") {
        $query = 'SELECT distinct obser_xt.stationid, diemxt."soHieuDiem" "kyhieu_tram", obser_xt.note "quychuan", ktsd."tenCongTrinh"
                    FROM "Observation_DiemXT" obser_xt
                    LEFT JOIN "DiemXT" diemxt ON stationid = diemxt.id
                    LEFT JOIN "CT_KTSD" ktsd ON diemxt.ma_congtrinhktsd = ktsd.id
                    WHERE note = '."'".$quychuan."'";
    } else if ($congtrinh == "td") {
        $query = 'SELECT distinct obser_xt.stationid, diemtd_ndd."soHieuGiengTD" "kyhieu_tram", obser_xt.note "quychuan", ktsd."tenCongTrinh"
                    FROM "Observation_DiemTD_NDD" obser_xt
                    LEFT JOIN "DiemTD_NDD" diemtd_ndd ON stationid = diemtd_ndd.id
                    LEFT JOIN "CT_KTSD" ktsd ON diemtd_ndd.ma_congtrinhktsd = ktsd.id
                    WHERE note = '."'".$quychuan."'";
    } else if ($congtrinh == "qt_ndd") {
        $query = 'SELECT distinct obser_qtndd.stationid, giengqt_ndd.ma_giengqt_ndd "kyhieu_tram", obser_qtndd.note "quychuan", ktsd."tenCongTrinh"
                    FROM "Observation_GiengQT_NDD" obser_qtndd
                    LEFT JOIN "GiengQT_NDD" giengqt_ndd ON stationid = giengqt_ndd.id
                    LEFT JOIN "CT_KTSD" ktsd ON giengqt_ndd.ma_congtrinhktsd = ktsd.id
                    LEFT JOIN "District" district ON ktsd.ma_dvhc = district.ma_dvhc
                    WHERE obser_qtndd.note = '."'".$quychuan."'";
        if ($district != 'none') {
            $query.= " AND district.ma_dvhc_cha LIKE"."'/".$district."/%'";
        }
    }

    $query_1 = "AND stationid IN (SELECT SPLIT_PART(id, '_', '1')::integer from list_all_station where \"TinhTrang\" = "."'t'";
    if ($district != 'none') {
        $query_1.= ' AND ma_dvhc_cha LIKE '."'/".$district."/%'";
    }

    if ($congtrinh == "ktsd_nm") {
        $query_2 = " AND id LIKE '%nm%')";
    } else if ($congtrinh == "ktsd_ndd") {
        $query_2 = " AND id LIKE '%ndd%')";
    } else if ($congtrinh == "xt") {
        $query_2 = " AND id LIKE '%xt%')";
    } else if ($congtrinh == "td") {
        $query_2 = " AND id LIKE '%td%')";
    }

    if (!array_key_exists("searchTerm", $data)) {
        if ($congtrinh == "qt_ndd") {
            $result = pg_query($tiengiang_db, $query);
        } else {
            $result = pg_query($tiengiang_db, $query.$query_1.$query_2);
        }

        if (!$result) {
            echo "Không có dữ liệu";
        }

        $final_data = [];
        while ($row = pg_fetch_assoc($result)) {
            $final_data[] = array(
                "id" => $row['stationid'],
                "text" => $row['kyhieu_tram']." (".$row['tenCongTrinh'].")"
            );
        }
    } else {
        $search = $data->searchTerm;
        /*** Nếu biến searchTerm có tồn tại thì thêm điều kiện Like ***/
        $query_like = '';
        if ($congtrinh == "ktsd_nm") {
            $query_like = 'AND Lower(diemnm."soHieuDiem") LIKE Lower(' . "'" . '%' . $search . '%' . "'" . ')';
        } else if ($congtrinh == "ktsd_ndd") {
            $query_like = 'AND Lower(diemndd."soHieuGieng") LIKE Lower(' . "'" . '%' . $search . '%' . "'" . ')';
        } else if ($congtrinh == "xt") {
            $query_like = 'AND Lower(diemxt."soHieuDiem") LIKE Lower(' . "'" . '%' . $search . '%' . "'" . ')';
        } else if ($congtrinh == "td") {
            $query_like = 'AND Lower(diemtd_ndd."soHieuGiengTD") LIKE Lower(' . "'" . '%' . $search . '%' . "'" . ')';
        } else if ($congtrinh == "qt_ndd") {
            $query_like = 'AND Lower(giengqt_ndd.ma_giengqt_ndd) LIKE Lower(' . "'" . '%' . $search . '%' . "'" . ')';
        }

        if ($congtrinh != "qt_ndd") {
            $result = pg_query($tiengiang_db, $query.$query_like);
        } else {
            $result = pg_query($tiengiang_db, $query.$query_like.$query_1.$query_2);
        }
        if (!$result) {
            echo "Không có dữ liệu";
        }
        $final_data = [];
        if (pg_num_rows($result) != 0) {
            while ($row = pg_fetch_assoc($result)) {
                $final_data[] = array(
                    "id" => $row['stationid'],
                    "text" => $row['kyhieu_tram']." (".$row['tenCongTrinh'].")"
                );
            }
        } else {
            $final_data[] = array(
                "id" => "0",
                "text" => "Không tìm thấy dữ liệu"
            );
        }
    }
    echo json_encode($final_data);
?>
