CREATE VIEW list_ktsd_td AS
SELECT
    ctktsd."id" "ma_ctkt", ctktsd."tenCongTrinh", ctktsd."diaChiCongTrinh",
    ctktsd."namXDVH", ctktsd."coSoKTSD",
    loaicongtrinh.name "LoaiCongTrinh",
    thongtincptd."soGiayPhepTD",
    district."tenDVHC", district.ma_dvhc, district.ma_dvhc_cha,
    doanhnghiep.name "tenDoanhNghiep"

FROM "CT_KTSD" ctktsd
         LEFT JOIN "ThongTinCP_TD" thongtincptd ON thongtincptd.ma_congtrinhktsd = ctktsd.id
         LEFT JOIN "District" district ON ctktsd.ma_dvhc = district.ma_dvhc
         LEFT JOIN "LoaiCongTrinh" loaicongtrinh ON ctktsd.ma_loaicongtrinh = loaicongtrinh.id
         LEFT JOIN "Enterprise" doanhnghiep ON thongtincptd.ma_doanhnghiep = doanhnghiep.id

WHERE loaicongtrinh.id = 3 /* AND thongtincpndd."tinhTrangGiayPhep" = 't' */
