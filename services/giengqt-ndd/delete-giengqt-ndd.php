<?php
error_reporting(0);
include('../config.php');
$id = $_POST["ma"];
$query = '';
for ($i = 0; $i < count($id); $i++) {
    $query.= 'DELETE FROM "Camera_NDD" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "ElectronicBoard_NDD" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "Observation_GiengQT_NDD" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "SampleBanTuDong_ndd" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "KetQua_QTLL_NDD" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "KetQua_QTMN_NDD" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "StdStation_GiengQT_NDD" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "ObstypeStation" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "GiengQT_NDD" WHERE id ='.$id[$i]."; ";

    /* Select CTKT để xóa CT sau khi xóa GiengQT_NDD */
    $select_id_ct = 'SELECT giengqt_ndd.ma_congtrinhktsd FROM "GiengQT_NDD" giengqt_ndd where giengqt_ndd.id ='.$id[$i];
    $rs_select = pg_query($tiengiang_db, $select_id_ct);
    if(!$rs_select) {
        echo 'error';
    }
    $data = array();
    while ($row = pg_fetch_assoc($rs_select)) {
        $data[] = $row;
    }

    $query.= 'DELETE FROM "CT_KTSD" WHERE id = '.$data[0]['ma_congtrinhktsd']."; ";
}
echo $query;

$result = pg_query($tiengiang_db, $query);
if(!$result) {
    echo 'error';
}