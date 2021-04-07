CREATE VIEW list_ktsd_nm AS
SELECT
    ctktsd."id" "ma_ctkt", ctktsd."tenCongTrinh", ctktsd."diaChiCongTrinh",
    ctktsd."namXDVH", ctktsd."coSoKTSD",
    loaicongtrinh.name "LoaiCongTrinh",
    thongtincpnm."soGiayPhepNM",
    district."tenDVHC", district.ma_dvhc, district.ma_dvhc_cha,
    doanhnghiep.name "tenDoanhNghiep"

FROM "CT_KTSD" ctktsd
         LEFT JOIN "ThongTinCP_NM" thongtincpnm ON thongtincpnm.ma_congtrinhktsd = ctktsd.id
         LEFT JOIN "District" district ON ctktsd.ma_dvhc = district.ma_dvhc
         LEFT JOIN "LoaiCongTrinh" loaicongtrinh ON ctktsd.ma_loaicongtrinh = loaicongtrinh.id
         LEFT JOIN "Enterprise" doanhnghiep ON thongtincpnm.ma_doanhnghiep = doanhnghiep.id

WHERE loaicongtrinh.id = 1 /* AND thongtincpndd."tinhTrangGiayPhep" = 't' */
