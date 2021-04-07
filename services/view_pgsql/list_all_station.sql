CREATE FUNCTION intval(character varying) RETURNS integer AS
$$
    SELECT CASE
        WHEN length(btrim(regexp_replace($1, '[^0-9]', '','g')))>0 THEN btrim(regexp_replace($1, '[^0-9]', '','g'))::integer
        ELSE 0
        END AS intval;
$$
    LANGUAGE SQL
    IMMUTABLE
    RETURNS NULL ON NULL INPUT;

CREATE VIEW list_all_station AS
SELECT concat(diemktsd_ndd.id, '_ndd') as ID, diemktsd_ndd."soHieuGieng" as "soHieu", diemktsd_ndd."tinhTrangGieng" as "TinhTrang",
       ctktsd_1."tenCongTrinh" as "ten_ct", ctktsd_1."id" as "id_ct", ctktsd_1."diaChiCongTrinh" as "diachi_ct", ctktsd_1.ma_loaicongtrinh as "maLoaiCongTrinh",
       loaicongtrinh_1.name "LoaiCongTrinh", 'ktsd_ndd' as "type_ct",
       district_1."tenDVHC" as "tenDVHC", district_1."ma_dvhc" as "ma_dvhc", district_1."ma_dvhc_cha" as "ma_dvhc_cha",
       NULL as "luuvucsong_id", NULL as "LuuVucSong",
       tangchuanuoc_1."id" as "tangchuanuoc_id", tangchuanuoc_1.name as "TangChuaNuoc",
       enterprise.id as "doanhnghiep_id", enterprise.name as "doanhnghiep_name",
       diemktsd_ndd."luuLuongKTCP" as "luuluongchophep",
       intval(split_part(diemktsd_ndd."luuLuongKTCP", 'm3', '1')) as "llcp_num"
FROM "DiemKTSD_NDD" diemktsd_ndd
         LEFT JOIN "CT_KTSD" ctktsd_1 ON diemktsd_ndd.ma_congtrinhktsd = ctktsd_1.id
         LEFT JOIN "ThongTinCP_NDD" ttcp_ndd ON ctktsd_1.id = ttcp_ndd.ma_congtrinhktsd
         LEFT JOIN "Enterprise" enterprise ON ttcp_ndd.ma_doanhnghiep = enterprise.id
         LEFT JOIN "LoaiCongTrinh" loaicongtrinh_1 ON ctktsd_1.ma_loaicongtrinh = loaicongtrinh_1.id
         LEFT JOIN "District" district_1 ON ctktsd_1.ma_dvhc = district_1.ma_dvhc
         LEFT JOIN "TangChuaNuoc" tangchuanuoc_1 ON diemktsd_ndd.ma_tangchuanuoc = tangchuanuoc_1.id
UNION
SELECT concat(diemktsd_nm.id, '_nm')as ID, diemktsd_nm."soHieuDiem" as "soHieu", diemktsd_nm."tinhtrangkhaithac" as "TinhTrang",
       ctktsd_2."tenCongTrinh" as "ten_ct", ctktsd_2."id" as "id_ct", ctktsd_2."diaChiCongTrinh" as "diachi_ct", ctktsd_2.ma_loaicongtrinh as "maLoaiCongTrinh",
       loaicongtrinh_2.name "LoaiCongTrinh", 'ktsd_nm' as "type_ct",
       district_2."tenDVHC" as "tenDVHC", district_2."ma_dvhc" as "ma_dvhc", district_2."ma_dvhc_cha" as "ma_dvhc_cha",
       basin_2."id" as "luuvucsong_id", basin_2.name as "LuuVucSong",
       NULL as "tangchuanuoc_id", NULL as "TangChuaNuoc",
       enterprise.id as "doanhnghiep_id", enterprise.name as "doanhnghiep_name",
       diemktsd_nm."luuLuongKTLN" as "luuluongchophep",
       intval(split_part(diemktsd_nm."luuLuongKTLN", 'm3', '1')) as "llcp_num"
FROM "DiemKTSD_NM" diemktsd_nm
         LEFT JOIN "CT_KTSD" ctktsd_2 ON diemktsd_nm.ma_congtrinhktsd = ctktsd_2.id
         LEFT JOIN "ThongTinCP_NM" ttcp_nm ON ctktsd_2.id = ttcp_nm.ma_congtrinhktsd
         LEFT JOIN "Enterprise" enterprise ON ttcp_nm.ma_doanhnghiep = enterprise.id
         LEFT JOIN "LoaiCongTrinh" loaicongtrinh_2 ON ctktsd_2.ma_loaicongtrinh = loaicongtrinh_2.id
         LEFT JOIN "District" district_2 ON ctktsd_2.ma_dvhc = district_2.ma_dvhc
         LEFT JOIN "Basin" basin_2 ON diemktsd_nm.ma_luuvucsong = basin_2.id
UNION
SELECT concat(diem_xt.id, '_xt')as ID, diem_xt."soHieuDiem" as "soHieu", diem_xt."tinhtrangxathai" as "TinhTrang",
       ctktsd_3."tenCongTrinh" as "ten_ct", ctktsd_3."id" as "id_ct", ctktsd_3."diaChiCongTrinh" as "diachi_ct", ctktsd_3.ma_loaicongtrinh as "maLoaiCongTrinh",
       loaicongtrinh_3.name "LoaiCongTrinh", 'xt' as "type_ct",
       district_3."tenDVHC" as "tenDVHC", district_3."ma_dvhc" as "ma_dvhc", district_3."ma_dvhc_cha" as "ma_dvhc_cha",
       basin_3."id" as "luuvucsong_id", basin_3.name as "LuuVucSong",
       NULL as "tangchuanuoc_id", NULL as "TangChuaNuoc",
       enterprise.id as "doanhnghiep_id", enterprise.name as "doanhnghiep_name",
       diem_xt."luuLuongXT" as "luuluongchophep",
       intval(split_part(diem_xt."luuLuongXT", 'm3', '1')) as "llcp_num"
FROM "DiemXT" diem_xt
         LEFT JOIN "CT_KTSD" ctktsd_3 ON diem_xt.ma_congtrinhktsd = ctktsd_3.id
         LEFT JOIN "ThongTinCP_XT" ttcp_xt ON ctktsd_3.id = ttcp_xt.ma_congtrinhktsd
         LEFT JOIN "Enterprise" enterprise ON ttcp_xt.ma_doanhnghiep = enterprise.id
         LEFT JOIN "LoaiCongTrinh" loaicongtrinh_3 ON ctktsd_3.ma_loaicongtrinh = loaicongtrinh_3.id
         LEFT JOIN "District" district_3 ON ctktsd_3.ma_dvhc = district_3.ma_dvhc
         LEFT JOIN "Basin" basin_3 ON diem_xt.ma_luuvucsong = basin_3.id
UNION
SELECT concat(diem_td.id, '_td') as ID, diem_td."soHieuGiengTD" as "soHieu", diem_td."tinhtrangthamdo" as "TinhTrang",
       ctktsd_4."tenCongTrinh" as "ten_ct", ctktsd_4."id" as "id_ct", ctktsd_4."diaChiCongTrinh" as "diachi_ct", ctktsd_4.ma_loaicongtrinh as "maLoaiCongTrinh",
       loaicongtrinh_4.name "LoaiCongTrinh", 'td' as "type_ct",
       district_4."tenDVHC" as "tenDVHC", district_4."ma_dvhc" as "ma_dvhc", district_4."ma_dvhc_cha" as "ma_dvhc_cha",
       NULL as "luuvucsong_id", NULL as "LuuVucSong",
       tangchuanuoc_4."id" as "tangchuanuoc_id", tangchuanuoc_4.name as "TangChuaNuoc",
       enterprise.id as "doanhnghiep_id", enterprise.name as "doanhnghiep_name",
       NULL as "luuluongchophep",
       NULL as "llcp_num"
FROM "DiemTD_NDD" diem_td
         LEFT JOIN "CT_KTSD" ctktsd_4 ON diem_td.ma_congtrinhktsd = ctktsd_4.id
         LEFT JOIN "ThongTinCP_TD" ttcp_td ON ctktsd_4.id = ttcp_td.ma_congtrinhktsd
         LEFT JOIN "Enterprise" enterprise ON ttcp_td.ma_doanhnghiep = enterprise.id
         LEFT JOIN "LoaiCongTrinh" loaicongtrinh_4 ON ctktsd_4.ma_loaicongtrinh = loaicongtrinh_4.id
         LEFT JOIN "District" district_4 ON ctktsd_4.ma_dvhc = district_4.ma_dvhc
         LEFT JOIN "TangChuaNuoc" tangchuanuoc_4 ON diem_td.ma_tangchuanuoc = tangchuanuoc_4.id
