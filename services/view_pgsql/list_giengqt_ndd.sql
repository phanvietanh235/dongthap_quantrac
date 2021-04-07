CREATE VIEW list_giengqt_ndd AS
SELECT
    ctktsd."id" "ma_ctkt", ctktsd."tenCongTrinh", ctktsd."diaChiCongTrinh", ctktsd."coSoKTSD",
    loaicongtrinh.name "LoaiCongTrinh",
    district."tenDVHC", district.ma_dvhc, district.ma_dvhc_cha,
    tangchuanuoc.id "TangChuaNuoc", tangchuanuoc.name "TangChuaNuoc_name",
    giengqt_ndd.id "idSohieu", giengqt_ndd.sohieugiengqt "Sohieu", giengqt_ndd."coordY" "ToadoY", giengqt_ndd."coordX" "ToadoX"

FROM "CT_KTSD" ctktsd
         LEFT JOIN "GiengQT_NDD" giengqt_ndd ON ctktsd.id = giengqt_ndd.ma_congtrinhktsd
         LEFT JOIN "District" district ON ctktsd.ma_dvhc = district.ma_dvhc
         LEFT JOIN "LoaiCongTrinh" loaicongtrinh ON ctktsd.ma_loaicongtrinh = loaicongtrinh.id
         LEFT JOIN "TangChuaNuoc" tangchuanuoc ON giengqt_ndd.ma_tangchuanuoc = tangchuanuoc.id

WHERE loaicongtrinh.id = 6 /* AND thongtincpndd."tinhTrangGiayPhep" = 't' */
