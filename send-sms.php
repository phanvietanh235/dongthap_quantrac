<?php
	include "services/config.php"
?>

<?php
/*---- Send SMS Data ----*/
$query = 'select ttcp_ndd."soGiayPhepNDD", E.name, E.phone
			from "ThongTinCP_NDD" ttcp_ndd 
			left join "Enterprise" E on ttcp_ndd.ma_doanhnghiep = E.id
			where "ngayHetHan" <='."CURRENT_DATE + 7".' AND "tinhTrangGiayPhep" ='."'t'";
$result = pg_query($tiengiang_db, $query);
if (!$result) {
	echo "Không có dữ liệu.\n";
	exit;
}

$data = array();
while ($row = pg_fetch_assoc($result)) {
	$data[] = $row;
}

$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
foreach ($original_data as $key => $value) {
	$noidung = "Giay phep ".$value['soGiayPhepNDD']. " cua doanh nghiep ". $value['name']. " sap het han. Vui long lien he so TNMT Tien Giang de gia han";
	$sdt = $value['phone'];

	echo $noidung."<br>";
	// send_sms($noidung, $sdt);
}

/*---- Send SMS Data ----*/
$query = 'select ttcp_nm."soGiayPhepNM", E.name, E.phone
			from "ThongTinCP_NM" ttcp_nm
			left join "Enterprise" E on ttcp_nm.ma_doanhnghiep = E.id
			where "ngayHetHan" <='."CURRENT_DATE + 7".' AND "tinhTrangGiayPhep" ='."'t'";
$result = pg_query($tiengiang_db, $query);
if (!$result) {
	echo "Không có dữ liệu.\n";
	exit;
}

$data = array();
while ($row = pg_fetch_assoc($result)) {
	$data[] = $row;
}

$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
foreach ($original_data as $key => $value) {
	$noidung = "Giay phep ".$value['soGiayPhepNM']. " cua doanh nghiep ". $value['name']. " sap het han. Vui long lien he so TNMT Tien Giang de gia han";
	$sdt = $value['phone'];

	echo $noidung."<br>";
	// send_sms($noidung, $sdt);
}

/*---- Send SMS Data ----*/
$query = 'select ttcp_xt."soGiayPhepXT", E.name, E.phone
			from "ThongTinCP_XT" ttcp_xt
			left join "Enterprise" E on ttcp_xt.ma_doanhnghiep = E.id
			where "ngayHetHan" <='."CURRENT_DATE + 7".' AND "tinhTrangGiayPhep" ='."'t'";
$result = pg_query($tiengiang_db, $query);
if (!$result) {
	echo "Không có dữ liệu.\n";
	exit;
}

$data = array();
while ($row = pg_fetch_assoc($result)) {
	$data[] = $row;
}

$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
foreach ($original_data as $key => $value) {
	$noidung = "Giay phep ".$value['soGiayPhepXT']. " cua doanh nghiep ". $value['name']. " sap het han. Vui long lien he so TNMT Tien Giang de gia han";
	$sdt = $value['phone'];

	echo $noidung."<br>";
	// send_sms($noidung, $sdt);
}

/*---- Send SMS Data ----*/
$query = 'select ttcp_td."soGiayPhepTD", E.name, E.phone
			from "ThongTinCP_TD" ttcp_td 
			left join "Enterprise" E on ttcp_td.ma_doanhnghiep = E.id
			where "ngayHetHan" <='."CURRENT_DATE + 7".' AND "tinhTrangGiayPhep" ='."'t'";
$result = pg_query($tiengiang_db, $query);
if (!$result) {
	echo "Không có dữ liệu.\n";
	exit;
}

$data = array();
while ($row = pg_fetch_assoc($result)) {
	$data[] = $row;
}

$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
foreach ($original_data as $key => $value) {
	$noidung = "Giay phep ".$value['soGiayPhepTD']. " cua doanh nghiep ". $value['name']. " sap het han. Vui long lien he so TNMT Tien Giang de gia han";
	$sdt = $value['phone'];

	echo $noidung."<br>";
	// send_sms($noidung, $sdt);
}

send_sms("Giay phep ABC cua Doanh nghiep A sap het han Vui long lien he so TNMT Tien Giang de gia han", "0377033505");
function send_sms($noidung, $sdt) {
	$username="testapi"; // Tài khoản do Bluesea cung cấp
	$password="testapi668899@#AHIF";
	$url="http://sms.8x77.vn:8077/mt-services/MTService";
	$text = base64_encode($noidung);
	$BrandName ="Smarketing";
	$input_data= "<soapenv:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:mts=\"MTService\">"
		."<soapenv:Header/>"
		."<soapenv:Body>"
		."<mts:sendMT soapenv:encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\">"
		/* ."<string xsi:type=\"xsd:string\">84934571283</string>" */
		."<string xsi:type=\"xsd:string\">".$sdt."</string>"
		."<string0 xsi:type=\"xsd:string\">".$text."</string0>"
		."<string1 xsi:type=\"xsd:string\">".$BrandName."</string1>"
		."<string2 xsi:type=\"xsd:string\">".$BrandName."</string2>"
		."<string3 xsi:type=\"xsd:string\">0</string3>"
		."<string4 xsi:type=\"xsd:string\">0</string4>"
		."<string5 xsi:type=\"xsd:string\">0</string5>"
		."<string6 xsi:type=\"xsd:string\">0</string6>"
		."<string7 xsi:type=\"xsd:string\">0</string7>"
		."<string8 xsi:type=\"xsd:string\">0</string8>"
		."</mts:sendMT>"
		."</soapenv:Body>"
		."</soapenv:Envelope>";
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "8077",
		CURLOPT_URL => "http://sms.8x77.vn:8077/mt-services/MTService",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $input_data,
		CURLOPT_HTTPHEADER => array(
			"Cache-Control: no-cache",
			"Content-Type: text/xml",
			"Authorization: Basic " . base64_encode("$username:$password")
		),
	));

	$response = curl_exec($curl);
	// = 0: đẩy Nội dung sang Bluesea thành công
	// -4: Gửi sai BrandName, IP hoặc Bluesea chưa khai báo thông tin

	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		echo $response;
	}
}
?>
