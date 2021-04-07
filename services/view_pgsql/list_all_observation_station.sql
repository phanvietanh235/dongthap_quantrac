CREATE VIEW list_all_observation_station AS
SELECT diemktsd_ndd.day, diemktsd_ndd.time, diemktsd_ndd.detail,
       list_all_1.id "id", list_all_1."soHieu" "soHieu", list_all_1.type_ct "type_ct",
       list_all_1.ten_ct "tenCongTrinh", list_all_1."TinhTrang" "TinhTrang",
       CASE WHEN diemktsd_ndd.detail::text LIKE '%"inlimit": "Y"%'
                THEN 'TRUE' ELSE 'FALSE' END AS "inlimit_stats"
FROM "Observation_DiemKTSD_NDD" diemktsd_ndd
    LEFT JOIN list_all_station "list_all_1" ON diemktsd_ndd.stationid = split_part(list_all_1.id, '_', '1')::integer
    WHERE list_all_1.type_ct = 'ktsd_ndd'
UNION
SELECT diemktsd_nm.day, diemktsd_nm.time, diemktsd_nm.detail,
       list_all_2.id "id", list_all_2."soHieu" "soHieu", list_all_2.type_ct "type_ct",
       list_all_2.ten_ct "tenCongTrinh", list_all_2."TinhTrang" "TinhTrang",
       CASE WHEN diemktsd_nm.detail::text LIKE '%"inlimit": "Y"%'
                THEN 'TRUE' ELSE 'FALSE' END AS "inlimit_stats"
FROM "Observation_DiemKTSD_NM" diemktsd_nm
    LEFT JOIN list_all_station "list_all_2" ON diemktsd_nm.stationid = split_part(list_all_2.id, '_', '1')::integer
    WHERE list_all_2.type_ct = 'ktsd_nm'
UNION
SELECT diemxt.day, diemxt.time, diemxt.detail,
       list_all_3.id "id", list_all_3."soHieu" "soHieu", list_all_3.type_ct "type_ct",
       list_all_3.ten_ct "tenCongTrinh", list_all_3."TinhTrang" "TinhTrang",
       CASE WHEN diemxt.detail::text LIKE '%"inlimit": "Y"%'
                THEN 'TRUE' ELSE 'FALSE' END AS "inlimit_stats"
FROM "Observation_DiemXT" diemxt
    LEFT JOIN list_all_station "list_all_3" ON diemxt.stationid = split_part(list_all_3.id, '_', '1')::integer
    WHERE list_all_3.type_ct = 'xt'
UNION
SELECT diemtd.day, diemtd.time, diemtd.detail,
       list_all_4.id "id", list_all_4."soHieu" "soHieu", list_all_4.type_ct "type_ct",
       list_all_4.ten_ct "tenCongTrinh", list_all_4."TinhTrang" "TinhTrang",
       CASE WHEN diemtd.detail::text LIKE '%"inlimit": "Y"%'
                THEN 'TRUE' ELSE 'FALSE' END AS "inlimit_stats"
FROM "Observation_DiemTD_NDD" diemtd
    LEFT JOIN list_all_station "list_all_4" ON diemtd.stationid = split_part(list_all_4.id, '_', '1')::integer
    WHERE list_all_4.type_ct = 'td'
