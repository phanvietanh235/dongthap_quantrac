/*---- Điểm KTSD_NDD ----*/
CREATE VIEW feat_ktsd_ndd AS
SELECT diemktsd_ndd.id AS idgieng,
       diemktsd_ndd.ma_congtrinhktsd,
       diemktsd_ndd."toaDoX" AS "toaDoX",
       diemktsd_ndd."toaDoY" AS "toaDoY",
       st_astext(st_transform(st_geomfromtext(concat(
           'POINT(', diemktsd_ndd."toaDoX", ' ', diemktsd_ndd."toaDoY", ')'
           ), 9211), 4326)) AS latlng,
       diemktsd_ndd."soHieuGieng",
       diemktsd_ndd."cheDoKhaiThac",
       diemktsd_ndd."ketCauGiengKhoan",
       diemktsd_ndd."luuLuongKTCP",
       diemktsd_ndd."tinhTrangGieng",
       diemktsd_ndd."vungBHVS",
       diemktsd_ndd."moTaVungBHVS",
       ctkt_sd.id AS macongtrinh,
       ctkt_sd."tenCongTrinh",
       district."tenDVHC",
       district."ma_dvhc_cha",
       ctkt_sd."diaChiCongTrinh",
       ctkt_sd."coSoKTSD",
       ctkt_sd."namXDVH",
       ctkt_sd."thoiHanKTSD",
       thongtincp_ndd.id AS idgp,
       thongtincp_ndd.ma_doanhnghiep,
       enterprise.name "TenDoanhNghiep",
       loaigiayphep.name AS "LoaiGiayPhep",
       thongtincp_ndd."soGiayPhepNDD",
       thongtincp_ndd."ngayCapPhep",
       thongtincp_ndd."tinhTrangGiayPhep"
FROM "DiemKTSD_NDD" diemktsd_ndd
LEFT JOIN "CT_KTSD" ctkt_sd ON diemktsd_ndd.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "District" district ON ctkt_sd.ma_dvhc = district.ma_dvhc
LEFT JOIN "ThongTinCP_NDD" thongtincp_ndd ON thongtincp_ndd.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "Enterprise" enterprise ON thongtincp_ndd.ma_doanhnghiep = enterprise.id
LEFT JOIN "LoaiGiayPhep" loaigiayphep ON thongtincp_ndd.ma_loaigiayphep = loaigiayphep.id
WHERE thongtincp_ndd."tinhTrangGiayPhep" = diemktsd_ndd."tinhTrangGieng";

/*---- Điểm KTSD_NM ----*/
CREATE VIEW feat_ktsd_nm AS
SELECT diemktsd_nm.id AS idgieng,
       diemktsd_nm.ma_congtrinhktsd,
       diemktsd_nm."toaDoX" AS "toaDoX",
       diemktsd_nm."toaDoY" AS "toaDoY",
       st_astext(st_transform(st_geomfromtext(concat(
            'POINT(', diemktsd_nm."toaDoX", ' ', diemktsd_nm."toaDoY", ')'
            ), 9211), 4326)) AS latlng,
       diemktsd_nm."soHieuDiem",
       diemktsd_nm."luuLuongKTLN",
       diemktsd_nm."luuLuongKTLNMuaKho",
       diemktsd_nm."cheDoKT",
       diemktsd_nm."nguonKhaiThac",
       diemktsd_nm."phuongThucKT",
       diemktsd_nm."vungBHVS",
       diemktsd_nm."moTaVungBHVS",
       diemktsd_nm."tinhtrangkhaithac",
       ctkt_sd.id AS macongtrinh,
       ctkt_sd."tenCongTrinh",
       district."tenDVHC",
       district."ma_dvhc_cha",
       ctkt_sd."diaChiCongTrinh",
       ctkt_sd."coSoKTSD",
       ctkt_sd."namXDVH",
       ctkt_sd."thoiHanKTSD",
       thongtincp_nm.id AS idgp,
       thongtincp_nm.ma_doanhnghiep,
       enterprise.name "TenDoanhNghiep",
       loaigiayphep.name AS "LoaiGiayPhep",
       thongtincp_nm."soGiayPhepNM",
       thongtincp_nm."ngayCapPhep",
       thongtincp_nm."tinhTrangGiayPhep"
FROM "DiemKTSD_NM" diemktsd_nm
LEFT JOIN "CT_KTSD" ctkt_sd ON diemktsd_nm.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "District" district ON ctkt_sd.ma_dvhc = district.ma_dvhc
LEFT JOIN "ThongTinCP_NM" thongtincp_nm ON thongtincp_nm.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "Enterprise" enterprise ON thongtincp_nm.ma_doanhnghiep = enterprise.id
LEFT JOIN "LoaiGiayPhep" loaigiayphep ON thongtincp_nm.ma_loaigiayphep = loaigiayphep.id
WHERE thongtincp_nm."tinhTrangGiayPhep" = diemktsd_nm."tinhtrangkhaithac";

/*---- Điểm XT ----*/
CREATE VIEW feat_ktsd_xt AS
SELECT diemxt.id AS idgieng,
       diemxt.ma_congtrinhktsd,
       diemxt."toaDoX" AS "toaDoX",
       diemxt."toaDoY" AS "toaDoY",
       st_astext(st_transform(st_geomfromtext(concat(
            'POINT(', diemxt."toaDoX", ' ', diemxt."toaDoY", ')'
            ), 9211), 4326)) AS latlng,
       diemxt."soHieuDiem",
       diemxt."luuLuongXT",
       diemxt."cheDoXT",
       diemxt."nguonTiepNhanNT",
       diemxt."mucDichXT",
       diemxt."phuongThucXT",
       diemxt."tinhtrangxathai",
       ctkt_sd.id AS macongtrinh,
       ctkt_sd."tenCongTrinh",
       district."tenDVHC",
       district.ma_dvhc_cha,
       ctkt_sd."diaChiCongTrinh",
       ctkt_sd."coSoKTSD",
       ctkt_sd."namXDVH",
       ctkt_sd."thoiHanKTSD",
       thongtincp_xt.id AS idgp,
       thongtincp_xt.ma_doanhnghiep,
       enterprise.name "TenDoanhNghiep",
       loaigiayphep.name AS "LoaiGiayPhep",
       thongtincp_xt."soGiayPhepXT",
       thongtincp_xt."ngayCapPhep",
       thongtincp_xt."tinhTrangGiayPhep"
FROM "DiemXT" diemxt
LEFT JOIN "CT_KTSD" ctkt_sd ON diemxt.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "District" district ON ctkt_sd.ma_dvhc = district.ma_dvhc
LEFT JOIN "ThongTinCP_XT" thongtincp_xt ON thongtincp_xt.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "Enterprise" enterprise ON thongtincp_xt.ma_doanhnghiep = enterprise.id
LEFT JOIN "LoaiGiayPhep" loaigiayphep ON thongtincp_xt.ma_loaigiayphep = loaigiayphep.id
WHERE thongtincp_xt."tinhTrangGiayPhep" = diemxt."tinhtrangxathai";

/*---- Điểm TD_NDD ----*/
CREATE VIEW feat_ktsd_td AS
SELECT diem_td.id AS idgieng,
       diem_td.ma_congtrinhktsd,
       diem_td."toaDoX" AS "toaDoX",
       diem_td."toaDoY" AS "toaDoY",
       st_astext(st_transform(st_geomfromtext(concat(
            'POINT(', diem_td."toaDoX", ' ', diem_td."toaDoY", ')'
            ), 9211), 4326)) AS latlng,
       diem_td."soHieuGiengTD",
       diem_td."chieuSauDuKienTD",
       diem_td."soLuongGiengTD",
       diem_td."vungBHVS",
       diem_td."moTaVungBHVS",
       diem_td."tinhtrangthamdo",
       ctkt_sd.id AS macongtrinh,
       ctkt_sd."tenCongTrinh",
       district."tenDVHC",
       district."ma_dvhc_cha",
       ctkt_sd."diaChiCongTrinh",
       ctkt_sd."coSoKTSD",
       ctkt_sd."namXDVH",
       ctkt_sd."thoiHanKTSD",
       thongtincp_td.id AS idgp,
       thongtincp_td.ma_doanhnghiep,
       enterprise.name "TenDoanhNghiep",
       loaigiayphep.name AS "LoaiGiayPhep",
       thongtincp_td."soGiayPhepTD",
       thongtincp_td."ngayCapPhep",
       thongtincp_td."tinhTrangGiayPhep"
FROM "DiemTD_NDD" diem_td
LEFT JOIN "CT_KTSD" ctkt_sd ON diem_td.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "District" district ON ctkt_sd.ma_dvhc = district.ma_dvhc
LEFT JOIN "ThongTinCP_TD" thongtincp_td ON thongtincp_td.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "Enterprise" enterprise ON thongtincp_td.ma_doanhnghiep = enterprise.id
LEFT JOIN "LoaiGiayPhep" loaigiayphep ON thongtincp_td.ma_loaigiayphep = loaigiayphep.id
WHERE thongtincp_td."tinhTrangGiayPhep" = diem_td."tinhtrangthamdo";

/*---- Giếng QT_NDD ----*/
select id,
       ma_congtrinhktsd,
       ma_giengqt_ndd,
       ma_tangchuanuoc,
       ma_diadanhqt,
       "coordX",
       "coordY",
       "doSauGieng",
       "tinhTrangHoatDong"
from "GiengQT_NDD"
left join "CT_KTSD" CK on "GiengQT_NDD".ma_congtrinhktsd = CK.id
left join "Location" L on "GiengQT_NDD".ma_diadanhqt = L.id
left join "TangChuaNuoc" TCN on "GiengQT_NDD".ma_tangchuanuoc = TCN.id;

/*---- Điểm QT_NM ----*/
select id,
       ma_congtrinhktsd,
       ma_diemtq_nm,
       ma_luuvucsong,
       "soHieuDiemQT",
       "coordX",
       "coordY",
       "tuanSuatBaoTri",
       "tinhTrangHoatDong"
from "DiemQT_NM"
left join "CT_KTSD" CK on "DiemQT_NM".ma_congtrinhktsd = CK.id
left join "Basin" B on "DiemQT_NM".ma_luuvucsong = B.id;

/*---- Điểm QT_NM ----*/
CREATE VIEW feat_qt_nm AS
SELECT diemqt_nm.id AS idgieng,
       diemqt_nm.ma_congtrinhktsd,
       diemqt_nm."coordX" AS "coordX",
       diemqt_nm."coordY" AS "coordY",
       st_astext(st_transform(st_geomfromtext(concat(
            'POINT(', diemqt_nm."coordX", ' ', diemqt_nm."coordY", ')'
            ), 9211), 4326)) AS latlng,
       diemqt_nm."ma_diemqt_nm",
       diemqt_nm."soHieuDiemQT",
       diemqt_nm."ma_diadanhqt",
       diemqt_nm."ma_tramcu",
       diemqt_nm."categoryid",
       diemqt_nm."tuanSuatBaoTri",
       diemqt_nm."tinhTrangHoatDong",
       ctkt_sd.id AS macongtrinh,
       ctkt_sd."tenCongTrinh",
       district."tenDVHC",
       district."ma_dvhc_cha",
       ctkt_sd."diaChiCongTrinh",
       ctkt_sd."coSoKTSD",
       ctkt_sd."namXDVH",
       ctkt_sd."thoiHanKTSD",
       thongtincp_nm.id AS idgp,
       thongtincp_nm.ma_doanhnghiep,
       enterprise.name "TenDoanhNghiep",
       loaigiayphep.name AS "LoaiGiayPhep",
       thongtincp_nm."soGiayPhepNM",
       thongtincp_nm."ngayCapPhep",
       thongtincp_nm."tinhTrangGiayPhep"
FROM "DiemQT_NM" diemqt_nm
LEFT JOIN "CT_KTSD" ctkt_sd ON diemqt_nm.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "District" district ON ctkt_sd.ma_dvhc = district.ma_dvhc
LEFT JOIN "ThongTinCP_NM" thongtincp_nm ON thongtincp_nm.ma_congtrinhktsd = ctkt_sd.id
LEFT JOIN "Enterprise" enterprise ON thongtincp_nm.ma_doanhnghiep = enterprise.id
LEFT JOIN "LoaiGiayPhep" loaigiayphep ON thongtincp_nm.ma_loaigiayphep = loaigiayphep.id
-- WHERE diemqt_nm."tinhTrangHoatDong" = 'true';

/*---- Vị trí lấy mẫu ----*/
CREATE VIEW sample_feature_pois AS
select id,
       ma_dvhc,
       kyhieu_mau,
       vitri_mau,
       "toado_X",
       "toado_Y",
       st_astext(st_transform(st_geomfromtext(concat(
            'POINT(', diemxt."toado_X", ' ', diemxt."toado_Y", ')'
            ), 9211), 4326)) AS latlng,
       ngaylay_mau,
       khoiluong,
       ma_loaiquantrac, LQT.name "LoaiQuanTrac"
from "Mau_QT"
left join "LoaiQuanTrac" LQT on "Mau_QT".ma_loaiquantrac = LQT.id
