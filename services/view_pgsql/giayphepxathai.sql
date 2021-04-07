CREATE VIEW giayphepxathai AS
SELECT row_number() OVER (ORDER BY thongtincp_xt."soGiayPhepXT") AS id,
    thongtincp_xt.id "idgp",
    thongtincp_xt."soGiayPhepXT",
    thongtincp_xt."ngayCapPhep",
    thongtincp_xt."ngayHetHan",
    thongtincp_xt."thoiHanGiayPhep",
    thongtincp_xt."tinhTrangGiayPhep",
    thongtincp_xt."tongLLXaLonNhatMuaKho",
    enterprise.name AS "tenDoanhNghiep",
    enterprise.address AS "diachiDoanhNghiep",
    ct_ktsd.id "macongtrinh",
    ct_ktsd."coSoKTSD",
    ct_ktsd."diaChiCongTrinh" AS "diachiCSSX",
    ct_ktsd."tenCongTrinh",
    ct_ktsd."diaChiCongTrinh",
    diemxt."toaDoX",
    diemxt."toaDoY",
    diemxt."phuongThucXT" AS "LoaihinhXT",
    diemxt."nguonTiepNhanNT",
    basin.id "id_lvs", basin.name "TenSong"
   FROM (((("ThongTinCP_XT" thongtincp_xt
     LEFT JOIN "Enterprise" enterprise ON ((thongtincp_xt.ma_doanhnghiep = enterprise.id)))
     LEFT JOIN "CT_KTSD" ct_ktsd ON ((thongtincp_xt.ma_congtrinhktsd = ct_ktsd.id)))
     LEFT JOIN "DiemXT" diemxt ON ((diemxt.ma_congtrinhktsd = ct_ktsd.id)))
     LEFT JOIN "Basin" basin ON ((diemxt.ma_luuvucsong = basin.id)))
