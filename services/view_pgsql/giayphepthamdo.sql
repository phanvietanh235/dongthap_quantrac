CREATE VIEW giayphepthamdo AS
SELECT row_number() OVER (ORDER BY thongtincp_td."soGiayPhepTD") AS id,
    thongtincp_td.id "idgp",
    thongtincp_td."soGiayPhepTD",
    thongtincp_td."ngayCapPhep",
    thongtincp_td."ngayHetHan",
    thongtincp_td."tinhTrangGiayPhep",
    thongtincp_td."thoiHanGiayPhep",
    enterprise.name AS "tenDoanhNghiep",
    enterprise.address AS "diachiDoanhNghiep",
    ct_ktsd.id "macongtrinh",
    ct_ktsd."coSoKTSD",
    ct_ktsd."diaChiCongTrinh" AS "diachiCSSX",
    ct_ktsd."diaChiCongTrinh",
    diemtd."soLuongGiengTD",
    tangchuanuoc.name AS "tangChuaNuoc"
   FROM (((("ThongTinCP_TD" thongtincp_td
     LEFT JOIN "Enterprise" enterprise ON ((thongtincp_td.ma_doanhnghiep = enterprise.id)))
     LEFT JOIN "CT_KTSD" ct_ktsd ON ((thongtincp_td.ma_congtrinhktsd = ct_ktsd.id)))
     LEFT JOIN "DiemTD_NDD" diemtd ON ((diemtd.ma_congtrinhktsd = ct_ktsd.id)))
     LEFT JOIN "TangChuaNuoc" tangchuanuoc ON ((diemtd.ma_tangchuanuoc = tangchuanuoc.id)));
