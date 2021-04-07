CREATE VIEW list_diemqt_nm AS
SELECT
    ctktsd."id" "ma_ctkt", ctktsd."tenCongTrinh", ctktsd."diaChiCongTrinh", ctktsd."coSoKTSD",
    loaicongtrinh.name "LoaiCongTrinh",
    district."tenDVHC", district.ma_dvhc, district.ma_dvhc_cha,
    location."name" "tendiadanh", diemqt_nm."ma_tramcu",
    diemqt_nm.id "idSohieu", diemqt_nm."soHieuDiemQT" "Sohieu", diemqt_nm."coordY" "ToadoY", diemqt_nm."coordX" "ToadoX"

FROM "CT_KTSD" ctktsd      
         LEFT JOIN "DiemQT_NM" diemqt_nm ON ctktsd.id = diemqt_nm.ma_congtrinhktsd
         LEFT JOIN "Location" location ON diemqt_nm.ma_diadanhqt = location.id
         LEFT JOIN "District" district ON ctktsd.ma_dvhc = district.ma_dvhc
         LEFT JOIN "LoaiCongTrinh" loaicongtrinh ON ctktsd.ma_loaicongtrinh = loaicongtrinh.id

WHERE loaicongtrinh.id = 5 /* AND thongtincpndd."tinhTrangGiayPhep" = 't' */
