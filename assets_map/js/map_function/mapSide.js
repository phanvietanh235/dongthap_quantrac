/*---- Option Quận/Huyện ----*/
$.getJSON("services/quanhuyen.php", function(quanhuyen) {
    $('#district')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn Thị xã/Huyện/Thành phố--"));
    $.each(quanhuyen, function(key, value) {
        $('#district')
            .append($("<option></option>")
                .attr('value', value.id).text(value.name));
    });
})

/*---- Option Loại công trình ----*/
$.getJSON("services/loaicongtrinh-option.php", function(loaicongtrinh) {
    /* $('#loaicongtrinh')
        .append($("<option></option>")
            .attr('value', 'none').text("--Lựa chọn loại công trình--")); */
    $.each(loaicongtrinh, function(key, value) {
        if (value.id != 5 && value.id != 7) {
            $('#loaicongtrinh')
                .append($("<option></option>")
                    .attr('value', value.id).text(value.name))
        }
    });
})

/*** Lựa chọn loại công trình quan trắc mới hiển thị loại hình và loại trạm ***/
$('#loaicongtrinh').on("change", function() {
    var val = $('#loaicongtrinh').val();
    if (val > 4) {
        $(".leaflet-sidebar-content").css("overflow", "scroll")
        $(".ctqt").show()
    } else {
        $(".leaflet-sidebar-content").css("overflow", "unset")
        $(".ctqt").hide()
    }
})

/*---- Create the Sidebar Instance and Add it to the map ----*/
var sidebar = L.control.sidebar({
    autopan: false,
    container: 'sidebar'
}).addTo(map);