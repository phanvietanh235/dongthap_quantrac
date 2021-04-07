CREATE VIEW list_ktsd_xt AS
SELECT
    ctktsd."id" "ma_ctkt", ctktsd."tenCongTrinh", ctktsd."diaChiCongTrinh",
    ctktsd."namXDVH", ctktsd."coSoKTSD",
    loaicongtrinh.name "LoaiCongTrinh",
    thongtincpxt."soGiayPhepXT",
    district."tenDVHC", district.ma_dvhc, district.ma_dvhc_cha,
    doanhnghiep.name "tenDoanhNghiep"

FROM "CT_KTSD" ctktsd
         LEFT JOIN "ThongTinCP_XT" thongtincpxt ON thongtincpxt.ma_congtrinhktsd = ctktsd.id
         LEFT JOIN "District" district ON ctktsd.ma_dvhc = district.ma_dvhc
         LEFT JOIN "LoaiCongTrinh" loaicongtrinh ON ctktsd.ma_loaicongtrinh = loaicongtrinh.id
         LEFT JOIN "Enterprise" doanhnghiep ON thongtincpxt.ma_doanhnghiep = doanhnghiep.id

WHERE loaicongtrinh.id = 4 /* AND thongtincpndd."tinhTrangGiayPhep" = 't' */
