<?php
error_reporting(0);
include('../config.php');
$id = $_POST["ma"];
$query = '';
for ($i = 0; $i < count($id); $i++) {
    $query.= 'DELETE FROM "Camera_NM" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "ElectronicBoard_NM" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "Observation_DiemQT_NM" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "SampleBanTuDong_nm" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "KetQua_QTLL_NM" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "KetQua_QTMN_NM" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "StdStation_DiemQT_NM" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "ObstypeStation" WHERE stationid ='.$id[$i]."; ";
    $query.= 'DELETE FROM "DiemQT_NM" WHERE id ='.$id[$i]."; ";

    /* Select CTKT để xóa CT sau khi xóa DiemQT_NDD */
    $select_id_ct = 'SELECT diemqt_nm.ma_congtrinhktsd FROM "DiemQT_NM" diemqt_nm where diemqt_nm.id ='.$id[$i];
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