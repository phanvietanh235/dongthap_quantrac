CREATE VIEW giayphepnuocduoidat AS
SELECT row_number() OVER (ORDER BY thongtincp_ndd."soGiayPhepNDD") AS id,
    thongtincp_ndd.id "idgp",
    thongtincp_ndd."soGiayPhepNDD",
    thongtincp_ndd."ngayCapPhep",
    thongtincp_ndd."ngayHetHan",
    thongtincp_ndd."tinhTrangGiayPhep",
    thongtincp_ndd."thoiHanGiayPhep",
    thongtincp_ndd."tongLuuLuongKT",
    enterprise.name AS "tenDoanhNghiep",
    enterprise.address AS "diachiDoanhNghiep",
    ct_ktsd.id "macongtrinh",
    ct_ktsd."coSoKTSD",
    ct_ktsd."diaChiCongTrinh" AS "diachiCSSX",
    ct_ktsd."tenCongTrinh",
    ct_ktsd."diaChiCongTrinh",
    mucdichktsd."moTa",
    tangchuanuoc.name AS "tangChuaNuoc",
    diemktsdndd."soHieuGieng",
    diemktsdndd."toaDoX",
    diemktsdndd."toaDoY",
    diemktsdndd."chieuSauMNTinh" "mucNuocTinh",
    diemktsdndd."chieuSauMNDongLonNhat" "mucNuocDong"
   FROM ((((("ThongTinCP_NDD" thongtincp_ndd
     LEFT JOIN "Enterprise" enterprise ON ((thongtincp_ndd.ma_doanhnghiep = enterprise.id)))
     LEFT JOIN "CT_KTSD" ct_ktsd ON ((thongtincp_ndd.ma_congtrinhktsd = ct_ktsd.id)))
     LEFT JOIN "MucDichKTSD" mucdichktsd ON ((ct_ktsd.ma_mucdichktsd = mucdichktsd.id)))
     LEFT JOIN "DiemKTSD_NDD" diemktsdndd ON ((diemktsdndd.ma_congtrinhktsd = ct_ktsd.id)))
     LEFT JOIN "TangChuaNuoc" tangchuanuoc ON ((diemktsdndd.ma_tangchuanuoc = tangchuanuoc.id)));
