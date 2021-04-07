CREATE VIEW giayphepnuocmat AS
SELECT row_number() OVER (ORDER BY thongtincp_nm."soGiayPhepNM") AS id,
    thongtincp_nm.id "idgp",
    thongtincp_nm."soGiayPhepNM",
    thongtincp_nm."ngayCapPhep",
    thongtincp_nm."ngayHetHan",
    thongtincp_nm."thoiHanGiayPhep",
    thongtincp_nm."tinhTrangGiayPhep",
    thongtincp_nm."tongLLKTLonNhatTungThoiKy",
    enterprise.name AS "tenDoanhNghiep",
    enterprise.address AS "diachiDoanhNghiep",
    ct_ktsd.id "macongtrinh",
    ct_ktsd."coSoKTSD",
    ct_ktsd."diaChiCongTrinh" AS "diachiCSSX",
    ct_ktsd."tenCongTrinh",
    ct_ktsd."diaChiCongTrinh",
    loaicongtrinh.name AS "Loaicongtrinh",
    mucdichktsd."moTa",
    diemktsdnm."toaDoX",
    diemktsdnm."toaDoY",
    diemktsdnm."nguonKhaiThac",
    basin.id "id_lvs", basin.name "TenSong"
   FROM (((((("ThongTinCP_NM" thongtincp_nm
     LEFT JOIN "Enterprise" enterprise ON ((thongtincp_nm.ma_doanhnghiep = enterprise.id)))
     LEFT JOIN "CT_KTSD" ct_ktsd ON ((thongtincp_nm.ma_congtrinhktsd = ct_ktsd.id)))
     LEFT JOIN "LoaiCongTrinh" loaicongtrinh ON ((ct_ktsd.ma_loaicongtrinh = loaicongtrinh.id)))
     LEFT JOIN "MucDichKTSD" mucdichktsd ON ((ct_ktsd.ma_mucdichktsd = mucdichktsd.id)))
     LEFT JOIN "DiemKTSD_NM" diemktsdnm ON ((diemktsdnm.ma_congtrinhktsd = ct_ktsd.id)))
     LEFT JOIN "Basin" basin ON ((diemktsdnm.ma_luuvucsong = basin.id)))
