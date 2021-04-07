# QUẢN TRỊ HỆ THỐNG Chất lượng môi trường Đồng Tháp
### Reference: 
+ Template: http://www.themenate.net/espire/index.html
+ Leaflet legend: https://codepen.io/haakseth/pen/KQbjdO

### Config Xampp have Domain and ProxyPass
+ Sửa lỗi VPS không thể truy cập: https://kb.hostvn.net/huong-dan-sua-loi-this-could-be-due-to-credssp-encryption-oracle-remediation-khi-remote-des_412.html
+ Cài IIS trên Window Server: https://adminvietnam.org/iis-8-cau-hinh-web-tren-windows-server-2012/639/
+ Mở port 80 và 8080 nếu có block port
+ Tắt Firewall
+ Config ProxyPass (do Tomcat trong Geoserver chạy thông qua Apache) - <b color="red">IMPORTANT</b>
+ Enabel Module: https://gist.github.com/ralphcrisostomo/4036231
```
    LoadModule rewrite_module modules/mod_rewrite.so
    LoadModule proxy_module modules/mod_proxy.so
    LoadModule proxy_http_module modules/mod_proxy_http.so
```
```
    <Directory C:/xampp/htdocs>
        AllowOverride All
        Require all granted
    </Directory>
    
    ##This is the Default address of XAMPP    
    <VirtualHost *:80>
        DocumentRoot "C:/xampp/htdocs/"
        ServerName localhost
    </VirtualHost>
    
    ##Create Vhost Geoserver - Using Ip local
    <VirtualHost *:80>
        ServerName geo.projgis.link
        
        <Proxy *>
            Order deny,allow
            Allow from all
        </Proxy>
      
        ProxyPreserveHost On
        #SetEnv NS_ENV variable_value
        ProxyPass / http://10.151.45.15:8080/
        ProxyPassReverse / http://10.151.45.15:8080/
    </VirtualHost>
    
    <VirtualHost *:443>
        ServerName geo.projgis.link
        SSLEngine On
        SSLCertificateFile "C:/xampp/apache/conf/ssl.crt/server.crt"
        SSLCertificateKeyFile "C:/xampp/apache/conf/ssl.key/server.key"
        <Proxy *>
            Order deny,allow
            Allow from all
        </Proxy>
      
        ProxyPreserveHost On
        #SetEnv NS_ENV variable_value
        ProxyPass / http://10.151.45.15:8080/
        ProxyPassReverse / http://10.151.45.15:8080/
    </VirtualHost>
```
+ Chuyển Domain đằng ký sang Cloudflare: https://wiki.matbao.net/kb/huong-dan-ket-noi-ten-mien-voi-cloudflare/
+ Bật SSL: Chọn Flexible (khi debug: bật chế độ Developer Mode hoặc Tắt đám mây DNS)
+ Sau khi config trong xampp: ta sửa các file sau:
    + file config.js: đổi protocol, subdomain_geoserver thành subdomain đã đăng ký trên cloudflare
    + file config.php: đổi host = ip local máy chủ
    + file datastore.xml: đổi host = ip local máy chủ, đổi mật khẩu postgres máy chủ

### Note (Important)
+ Danh sách các component cần reponsive:
    + Tiền cấp quyền khai thác (KTSD_NDD và KTSD_NM)
    + Giám sát công trình tài nguyên nước
+ Bổ sung bảng dữ liệu Category (Loại trạm)
+ Chỉnh sửa Frontend bên trang `index.php` => Khi sửa xong cần paste sang các trang khác (nằm trong từng Folder Index)
+ Path đường dẫn trang (trong thẻ `nav`):
    + index.php: sub_path - `tên folder/tên trang.php`
    + Các trang html trong folder:
        + Với trang chủ: `../index.php`
        + Với trang trong folder: `tên trang.php`
        + Với trang ngoài folder: `../tên folder/tên trang.php`
    + Path đường dẫn trang php:
        + Với trang có DOM phần HTML, CSS, JS xen kẽ: nằm trong thư mục của chức năng - thêm `../`
        + Thư viện JS và CSS: thêm `../../`
        + Trong Services:
            + Nằm trong thư mục chức năng: giữ nguyên
            + Nằm ngoài thư mục chức năng thêm `../`
+ Thêm ngưỡng min/max (số liệu mới nhất) - done 23/11
+ Thêm đường line min/max - done 23/11
+ Thêm filescan (xem file và download file - done 23/11)
+ Đính kèm file (từ trực tiếp máy người dùng và lưu về server của kho - done 24/11) => Chuyển sang lưu trực tiếp về source
+ Đóng modal tìm kiếm (đổi tiếng việt close) - done 23/11
+ Menu panel: để "Bản đồ" - done 23/11
+ Datecuz: format ngày tháng năm (giấy phép) - done 23/11
+ <b>Link giấy phép sang trang chỉnh sửa giấy phép (NDD, NM, XT, TD)</b> - done 24/11
+ <b>Xuất báo cáo giấy phép (Xuất theo kết quả tìm kiếm)</b>

### Note (15/12)
+ Thêm lớp địa chất thủy văn - thêm chú thích bản đồ (Đẩy vào Geoserver - done 29/12)
+ Thêm tên doanh nghiệp (trước tên giếng) - phần tìm kiếm và tên hiển thị - done 25/12
+ Setup màu hiển thị cluster theo đơn vị hành chính - done 25/12
+ Chỉnh sửa hiển thị 3 độ và 6 độ song song (chỉnh sửa form nhập - thêm 3 và 6 độ, sửa truy vấn sql)
+ Thêm bộ công cụ đo chiều dài, diện tích của bản đồ (done 25/12)
+ Buffer vùng bảo hộ (Đẩy vào Geoserver - done dự kiến 29/12)
+ Tên "CTKT_NM" theo giấy phép (done - 25/12)
+ Đối với "XT": Tối thiểu phải có 2 trường là `tên chủ giấy phép` và `địa chỉ doanh nghiệp` - done 25/12 (không có trường `tên chủ giấy phép`)
+ Lỗi tìm kiếm công trình khai thác (thay đổi thành cơ chế hiện alert thông báo) - (done - 25/12)
+ Đổi label XY (done - 25/12)
+ Thay đổi cơ chế chọn DD/MM/YYYY (chọn từng năm tháng ngày) - Không thay đổi
+ Trường thuộc tính `Năm xây dựng` để trống (done 25/12)
+ Cảnh báo SMS: Vượt ngưỡng quan trắc, Giấy phép hết hạn, Thông báo doanh nghiệp chưa nhập liệu nếu > 2 ngày
+ FORM nhập liệu cho doanh nghiệp (done 28/12)
+ Xuất danh sách báo cáo toàn bộ hoặc xuất theo thông tin tìm kiếm (Công trình quan trắc và Giấy phép - done 25/12)
+ Công trình quan trắc (giống Công trình khai thác)
+ Công cụ thống kê (Chuyển file bán tự động, Đánh giá AQI - WQI, Danh sách vượt ngưỡng) - (done 3/4 mục - 25/12)

### Note (31/12)
+ Màu điểm bản đồ giống quận huyện (done)
+ Thêm option tất cả các tỉnh giấy phép (done)
+ Sửa label: thống kê khai thác nước dưới đất (done)
+ Xuất báo cáo Excel số lượng giấy phép (done)
+ Thêm công trình quan trắc - GiengQT_NDD (Form CRUD - done và load dữ liệu bản đồ)
+ Form nhập thêm mới toàn bộ 1 công trình
+ Lập danh sách các trạm bị văng tọa độ (done - còn nhiều điểm chưa được đưa về đúng)
+ Redirect lại link href (done)
+ Tạo bảng User và phân quyền phần mềm
+ Check SMS (Thông báo 3 lần: Trước 150 ngày sắp hết hạn; Trước 90 ngày; Khi hết hạn) 
+ Chỉnh sửa Tool nhập liệu doanh nghiệp (done)

### Hiển thị dữ liệu trên bản đồ
+ Geojson Ajax Cluster Marker: https://gis.stackexchange.com/questions/146375/using-marker-cluster-plugin-with-the-ajax-plugin-of-leaflet
+ Custom Cluster Marker: https://stackoverflow.com/questions/47507854/coloring-clusters-by-markers-inside, 
https://leaflet.github.io/Leaflet.markercluster/example/marker-clustering-custom.html
+ Điểm quan trắc (GiengQT_NDD, DiemQT_NM)
+ Điểm khai thác sử dụng (DiemTD_NDD, DiemKTSD_NDD, DiemKTSD_NM, DiemXT)
+ Update Leaflet to ver 1.7
+ Dùng Accordions và Side Panel để hiển thị thông tin
+ Truyền link để trigger mở bản đồ và thông tin thuộc tính bao gồm 2 param (id của điểm/giếng và type): `window.open("../../index.php?idpoi=3&type=xt")`
+ DiemKTSD_NDD: done 14/10
+ DiemKTSD_NM, DiemXT, DiemTD_NDD: done 16/10
+ Zooming change layer - done 24/11
+ Enable CORS:
    + Geoserver: https://docs.geoserver.org/latest/en/user/production/container.html
    + Tomcat: https://gist.github.com/essoen/91a1004c1857e68d0b49f953f6a06235
+ Đưa nền địa chính - lên bản đồ - done 25/11 (chưa hiển thị Popup do lỗi forbidden 403)
+ Thao tác trên bản đồ, Zoom view về khung nhìn bản đồ khi luôn panel xuất hiện: `flyTo`
+ <b>Phần tìm kiếm trên bản đồ để view dữ liệu</b> để ở phần Side của bản đồ (done 30/11)

### Báo cáo thống kê (Giấy phép)
+ Change text "Searching ...": https://stackoverflow.com/questions/55827285/change-text-searching-in-jquery-select2
+ Chỉnh sửa Style, Language trong thư viện date range picker `daterangepicker.js`
+ Thay đổi vị trí mũi tên trỏ `.daterangepicker.opensright:before {
                                    left: 49px; 
                               }
                               .daterangepicker.opensright:after {
                                    left: 50px; 
                               }`
+ Sử dụng Select2 khi call Ajax cần viết hàm phía Backend để thực hiện việc gọi dữ liệu và render
+ Disable past date JS: https://stackoverflow.com/questions/37946283/how-to-disable-past-date-in-daterangepicker
+ Export Excel have style: https://www.igniteui.com/javascript-excel-library/excel-formatting
+ Sử dụng thư viện http://tabulator.info/ (Tabulator)
#### Thống kê giấy phép nước mặt, Thống kê giấy phép xả thải
+ Truy vấn Php theo Lưu vực sông (basin) - Lưu vực sông (chưa bổ sung trường `ma_lvs`) - đã bổ sung (5/11)
+ Bảng DiemKTSD_NM và DiemXT chưa bổ sung trường `ma_lvs` - đã bổ sung (5/11)
#### Thống kê giấy phép thăm dò
#### Thống kê giấy phép nước dưới đất
+ Đã bổ sung thêm cột "Mực nước tĩnh" và "Mực nước động"
#### Thống kê giấy phép hành nghề (Không có bảng dữ liệu này => Không làm chức năng này)
#### Thống kê số lượng trạm quan trắc
+ Thống kê GiengQT_NDD và DiemQT_NM theo đơn vị hành chính (District) hoặc tầng chứa nước (TangChuaNuoc)
+ DiemQT_NM <b style="color: red">không</b> có trường thuộc tính để thống kê phần theo tầng chứa nước - TangChuaNuoc
+ 27/10: 1/2 chức năng (thống kê theo tầng chứa nước - TangChuaNuoc)
+ 28/10: 2/2 chức năng (thêm phần thống kê theo đơn vị hành chính - District)
#### Tổng hợp Hồ chứa, LVS
+ Load khi người dùng vừa mở trang
#### Thống kê số lượng điểm KTSD theo nguồn nước
+ Thống kê DiemKTSD_NDD và DiemKTSD_NM theo đơn vị hành chính (District), tầng chứa nước (TangChuaNuoc) hoặc lưu vực sông (Basin)
+ DiemKTSD_NM <b style="color: red">không</b> có trường thuộc tính để thống kê phần theo tầng chứa nước - TangChuaNuoc
+ DiemKTSD_NDD <b style="color: red">không có</b> trường thuộc tính để thống kê phần theo lưu vực sông - Basin
+ 28/10: 2/3 chức năng (thống kê theo tầng chứa nước - TangChuaNuoc và theo đơn vị hành chính - District)
+ 5/11: 3/3 chức năng (thông kê theo lưu vực sông - Basin)
#### Thống kê số lượng điểm KTSD theo mục đích sử dụng
+ Avoid PHP notice "Undefined Offset" (nguyên nhân là khi phân chia theo đơn vị hành chính, 
cùng 1 đơn vị hành chính có 2 công trình với 2 mục đích khác nhau): https://stackoverflow.com/questions/7688814/how-to-avoid-php-notice-undefined-offset-0-without-checking-each-field-of-arr
+ 5/11: 3/3 chức năng (thông kê theo lưu vực sông - Basin)
#### Thống kê số lượng điểm KTSD theo loại hình (Không có trường thuộc tính để phân chia => Không làm chức năng này)
#### Số lượng Giấp phép đã cấp
+ Load khi người dùng vừa mở trang
#### Danh mục CTKT
+ Load khi người dùng vừa mở trang
+ Bảng DiemKTSD_NM chưa bổ sung trường `ma_lvs`
#### Tiền cấp quyền KT (chưa có dữ liệu)
+ Đã có dữ liệu (done 9/11) 
#### Lượng nước KTSD (chưa có dữ liệu)

### Công trình khai thác
+ Cập nhật tiền cấp quyền theo thời gian thực (vì nó không phụ thuộc và số tiền hằng năm) - (done 11/11)
+ Tiền cấp quyền: TienCapQuyen_NDD và TienCapQuyen_NM
+ Chuyển "ngayGiayPhep" lên các cột đầu tiền `ktsd-ndd-info`, `ktsd-nm-info`, `ktsd-td-info`, `ktsd-xt-info`
+ Update date bị lỗi nếu không nhập vào input (done 16/11)
+ Chức năng xóa toàn bộ công trình (sẽ được phân quyền chức năng)
+ Chức năng thêm công trình (dự kiến)
+ ILIKE loại bỏ các trường hợp NULL

#### Công trình KTSD Nước dưới đất
+ Jquery fix click auto scroll to top: https://stackoverflow.com/questions/1061580/jquery-click-on-anchor-element-forces-scroll-to-top
+ Language datepicker: https://bootstrap-datepicker.readthedocs.io/en/latest/i18n.html
+ Eye Slash JS (Custom bằng Jquery): https://stackoverflow.com/questions/45494301/changing-font-awesome-icon-onclick-function
+ Show/Hide or Toggle Nested Table Child In Tabulator: https://jsfiddle.net/ustvnz5a/2/
+ Selected in Select2: https://stackoverflow.com/questions/38873508/how-to-set-select-value-in-select2-plugin-jquery
+ Chức năng `Thêm công trình khai thác`
+ Các bảng sử dụng: CT_KTSD, ThongTinCP_NDD, DiemKTSD_NDD
+ Truy vấn SQL: Tạo View `list_ktsd_ndd`
+ Thêm thông tin `Phạm vi cấp nước`: chưa update dữ liệu (done 5/11)
+ Auto Scroll: `$('html,body').animate({scrollTop: 330});`
+ Thêm thông tin `Tiền cấp quyền`: chưa update dữ liệu (done 5/11)
+ CRUD các thông tin trong công trình KTSD
    + 1/5: Update `Thông tin công trình` (6/11)
    + 2/5: CRUD `DiemKTSD_NDD` (7/11)
    + 3/5: CRUD `ThongTinCP_NDD` (8/11)
    + 4/5: CRUD `TienCapQuyen_NDD` (8/11) - chỉnh sửa thực hiện quản lý theo thời gian thực (11/11)
    + 5/5: CRUD `TinhhinhViPham_NDD` (done 11/11)
    
#### Công trình KTSD Nước mặt (done 9/11 - 10/11)
+ CRUD các thông tin trong công trình KTSD:
    + 5/5: thêm CRUD `TinhhinhViPham_NDD` (done 11/11)
#### Công trình Xả thải (done 10/11)
+ CRUD các thông tin trong công trình KTSD:
    + 5/5: thêm CRUD `TinhhinhViPham_NDD` (done 11/11)
#### Công trình Thăm dò (done 10/11)

#### <b>IMPORTANT</b> Upload File
+ Upload file using FTP: https://stackoverflow.com/questions/14280688/ftp-upload-via-php-form
+ HTML get file: https://stackoverflow.com/questions/57285984/failed-to-construct-formdata
+ Get name file Jquery: https://stackoverflow.com/questions/10683192/how-to-get-the-filename-from-input-type-file-html-element-using-javascript-or-jq
+ Thêm vào ở 3 file cấu trúc `ktsd-(ndd, nm, xt, td)-info`, `form-gp`, `save-gp` và tạo thêm file cấu trúc `upload-gp`, cụ thể:
    + File `ktsd-(ndd, nm, xt, td)-info`
    ```
       Thêm thư viện PDFobject
       <!-- Preview Giấy phép -->
       <div class="modal fade" id="modal-gp" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-lg" style="max-width: 70%">
             <div class="modal-content">
                <div class="modal-header">
                   <h4 style="text-transform: uppercase; color: #0f9aee">
                      <b>Xem giấy phép</b>
                   </h4>
                </div>
                <div class="modal-body">
                   <div class="row">
                      <div class="col-md-12">
                         <div id="pdf_preview"></div>
                      </div>
                   </div>
                </div>
                <div class="modal-footer">
                   <button class="btn btn-info" data-dismiss="modal"
                      type="button">Đóng</button>
                </div>
             </div>
          </div>
       </div>
       var view_downPDF = function (cell, formatterParams, onRendered){
       var cell_stt = cell._cell.row.data.STT
       return '<button class="PDF_show_' + cell_stt + ' btn-xs btn-outline-info" ' +
           'style="cursor: pointer" data-target="#modal-gp" data-toggle="modal">' +
           '<i class="PDF_show fa fa-eye pdd-right-5 font-size-12"></i>' +
           '<span class="PDF_show text-bold font-size-10">Xem file</span>' +
           '</button>' +
           '<button class="PDF_down_' + cell_stt + ' mrg-left-5 btn-xs btn-outline-success">' +
           '<i class="PDF_down ti-import pdd-right-5 font-size-12"></i>' +
           '<span class="PDF_down text-bold font-size-10">Tải về</span>' +
           '</button>';
       };
       {formatter: view_downPDF, title: "Bản số giấy phép", field: "banso_giayphep",
       hozAlign: "center",  width: 200,
       headerSort: false, cellClick: function (e, row, formatterParams) {
               var target_class = e.target.classList[0];
               const link_gp = row.getData().link_giayphep;
               if (target_class.includes("PDF_show")) {
                   PDFObject.embed(link_gp, "#pdf_preview", {height: "25rem"});
                   $("#modal-gp").show();
               } else {
               var a = $("<a>")
                   .attr("style", "display:none")
                   .attr("href", link_gp)
                   .attr("target", "_blank")
                   .appendTo("body");
                   a[0].click();
                   a.remove();
               }
           }
       }
    ```
    + File `form-gp`
    ```
       <div class="form-group row list-ctkt">
          <label style="margin-top: 7px" class="col-md-2 control-label">
          <b>Bản số giấy phép</b>
          </label>
          <div class="col-md-4">
             <input type="file" name="uploaded_qp_ndd" style="margin-top: 3px; width: 165px">
             <?php
                /*---- Khi có idgq thì cần tạo 1 input ẩn để lưu input nhằm upload file----*/
                if (isset($_GET['idgp'])) {
                    if (isset(explode("/", $data_gp_ndd[0]['taiLieuDinhKem'])[9])) {
                        $filename = explode("/", $data_gp_ndd[0]['taiLieuDinhKem'])[9];
                    } else {
                        $filename = explode("/", $data_gp_ndd[0]['taiLieuDinhKem'])[6];
                    }
                
                    echo '<input type="hidden" id="id_gp" name="id_gp" value="'.$_GET['idgp'].'">
                            <span class="text-info" id="gp_ndd_file">'.$filename.'</span>';
                }
                ?>
          </div>
          <div class="col-md-6" style="margin-left: -55px">
             <?php
                if (isset($_GET['idgp'])) {
                    echo '<a id="modal-gp-ndd" class="btn-xs btn btn-info btn-sm" style="cursor: pointer"
                               data-target="#modal-gp" data-toggle="modal">
                                <i class="fa fa-eye pdd-right-5 font-size-12 text-white"></i>
                                <span class="text-bold text-white font-size-10">Xem file</span>
                            </a>';
                }
                ?>
             <!-- <a class="btn-xs btn-outline-success" style="cursor: pointer"
                data-target="#modal-gp" data-toggle="modal">
                <i class="ti-import pdd-right-5 font-size-12"></i>
                <span class="text-bold font-size-10">Tải về</span>
                </a> -->
          </div>
       </div>
       ...
       /*** Get Name file ***/
       <?php
          if (isset($_GET['idgp'])) {
              echo '$("input[name='."'"."uploaded_qp_ndd"."'".']").change(function(){
                  $("#gp_ndd_file").hide();
                  $("#modal-gp-ndd").hide();
                  });';
          }
       ?>
       ...
       var fileName = $("input[name='uploaded_qp_ndd']").val().split('/').pop().split('\\').pop();
       var tailieudinhkem = "http://210.245.96.141/Upload/14/" +
       <?php
          if (isset($_GET['idgp'])) {
              echo $_GET['idgp'].'+ "/" + fileName;';
          } else {
              $cur_count_select = pg_query($tiengiang_db, 'SELECT id FROM "ThongTinCP_NDD" ORDER BY id DESC LIMIT 1');
              $cur_arr = array();
              while ($row = pg_fetch_assoc($cur_count_select)) {
                  $cur_arr[] = $row;
              }
              /*** Lấy giá trị cur = ID ***/
              $cur_count = $cur_arr[0]['id'] + 1;
              echo $cur_count.' + "/" + fileName;';
          }
       ?>
       ...
       "tailieudinhkem": tailieudinhkem,
       ...
       /*---- Upload File ----*/
       var fd = new FormData(document.getElementById("fileinfo"));
       fd.append("label", "WEBUPLOAD");
       $.ajax({
           url: "upload-gp-ndd.php",
           type: "POST",
           data: fd,
           cache: false,
           contentType: false,
           processData: false
       })
    ```
    + File `save-gp`: Thêm insert và update `tailieudinhkem`
    + Thêm file `upload-gp`
    ```
        <?php
            include "../config.php"
        ?>
        <?php
            $ftp_server = "10.151.45.15";
            $ftp_username = "administrator";
            $ftp_password = "Sciren@654321";
        
            $conn_id = ftp_connect($ftp_server) or die("could not connect to $ftp_server");
            if (@ftp_login($conn_id, $ftp_username, $ftp_password)) {
                echo "conectd as $ftp_username@$ftp_server\n";
            } else {
                echo "could not connect as $ftp_username\n";
            }
        
            if (isset($_POST['id_gp'])) {
                $cur_count = $_POST['id_gp'];
                ftp_mkdir($conn_id, $cur_count);
            } else {
                $cur_count_select = pg_query($tiengiang_db, 'SELECT id FROM "ThongTinCP_NDD" 
                                ORDER BY id DESC LIMIT 1');
                $cur_arr = array();
                while ($row = pg_fetch_assoc($cur_count_select)) {
                    $cur_arr[] = $row;
                }
                /*** Lấy giá trị cur = ID ***/
                $cur_count = $cur_arr[0]['id'];
                /*** Tạo Folder ***/
                ftp_mkdir($conn_id, $cur_count);
            }
            ftp_chdir($conn_id, "\\");
        
            $file = $_FILES["uploaded_qp_ndd"]["name"];
            $remote_file_path = $cur_count."/".$file;
            ftp_put($conn_id, $remote_file_path, $_FILES["uploaded_qp_ndd"]["tmp_name"],FTP_ASCII);
            ftp_close($conn_id);
        ?>
    ```

#### Giám sát dữ liệu tài nguyên nước
+ Show dữ liệu
    + Tìm kiếm theo các chỉ tiêu (done)
    + Link với trang bản đồ (done)
    + Xem chi tiết dữ liệu
        + Show dữ liệu mới nhất: kết hợp `giữa .setData và .replaceData` gửi service riêng + `setInterval`
        + Show kết quả qua tìm kiếm các trường: done (21/11)
        + Show chart tìm kiếm các trường - dùng ChartJS: done(21/11)
            => Fix lỗi giật màn hình của biểu đồ => Chuyển qua sử dụng Amchart
		+ Chuyển kiểu dữ liệu từ `json` sang `jsonb` cho các bảng Observation (DiemKTSD_NDD, DiemKTSD_NM, DiemQT_NM, DiemXT, DiemTD_NDD, GiengQT_NDD)
+ Danh sách vượt ngưỡng (dự kiến 2/12)

#### DANH MỤC
+ Tạo bộ 6 file bao gồm `danhmuc.html, danhmuc.js, list-danhmuc.php, form-danhmuc.php, save-danhmuc.php, delete-danhmuc.php`
+ Hoàn thành (done 3/12)

### Login
+ Kiểm tra session
```
<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
?>
```
+ Thay Username
```
<div class="user-info">
   <span class="name pdd-right-5">
   <?php
      require_once("../services/config.php");
      if (isset($_SESSION['username'])) {
          $sql = 'select fullname from users where username ='."'".$_SESSION['username']."'";
          $result = pg_query($tiengiang_db, $sql);
          if (!$result) {
              echo "Không có dữ liệu.\n";
              exit;
          }
          $data = array();
          while ($row = pg_fetch_assoc($result)) {
              $data[] = $row;
          }
          echo $data[0]['fullname'];
      }
      ?>
   </span>
   <i class="ti-angle-down font-size-10"></i>
</div>
```
+ Thêm Logout
```
<li>
   <a href="../logout.php">
   <i class="ti-power-off pdd-right-10"></i>
   <span>Đăng xuất</span>
   </a>
</li>
```

#### Fix 1 - 22/02/2021
+ Thêm chức năng "Thống kê quan trắc môi trường" (dự kiến 24/02)
+ Thêm chức năng "Thêm công trình khai thác" (dự kiến 26/02)

#### Thêm dữ liệu vị trí lấy mẫu từ bên Đối tác
+ Thêm 2 bảng có mỗi quan hệ với nhau `Mau_QT` và `LoaiQuanTrac`
+ Tạo liên kết cho 2 bảng dữ liệu

#### Phân quyền
+ Tạo phân quyền user: không truy cập vào danh mục và ko có khả năng chỉnh sửa dữ liệu

#### Note 17/3:
+ Object array unique: https://stackoverflow.com/questions/24558484/php-removing-duplicate-objects-from-array
+ DOM data Tabulator Statistics (done)
+ DOM data Chart Statisitcs (done)
+ Typecast string to integer - Postgres: https://stackoverflow.com/questions/10518258/typecast-string-to-integer-postgres
+ Chia Tab giám sát tài nguyên nước (done)
+ Thêm "Công trình quan trắc" (done)

#### Note fix 19/3:
+ View `list_all_station` thêm dữ liệu bảng quan trắc "nước dưới đất"
+ Sửa label DOM option "Công trình" bên phần "Thống kê quan trắc môi trường"
