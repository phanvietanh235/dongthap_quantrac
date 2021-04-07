/*---- Group Chart của nhiều trạm quan trắc ----*/
function render_groupColumnchart_quantrac(div_id, data_chart, name_title, unit, key, station_text, station, min, max) {
    am4core.useTheme(am4themes_animated);
    am4core.ready(function () {

        /** Remove Logo **/
        $("g[opacity='0.3']").remove();
        $("g[opacity='0.4']").remove();
        var chart = am4core.create(div_id, am4charts.XYChart);
        chart.data = data_chart;

        chart.language.locale = am4lang_vi_VN;
        chart.logo.height = -9999;
        chart.fontSize = 13;
        chart.dateFormatter.inputDateFormat = "HH:mm:ss, dd/MM/yyyy";

        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.grid.template.location = 0;
        /*** Label thời gian nằm giữa column ***/
        dateAxis.renderer.labels.template.location = 0.5;
        dateAxis.renderer.minGridDistance = 50;
        dateAxis.baseInterval = {
            "timeUnit": "minute",
            "count": 5
        }
        dateAxis.tooltipDateFormat = "HH:mm:ss, dd/MM/yyyy";

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        if (unit != "") {
            valueAxis.title.text = "(" + unit + ")";
        }
        valueAxis.min = 0;
        // valueAxis.max = max;

        function createSeries(field, name, color) {
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = field;
            series.dataFields.dateX = key;
            series.name = name;
            series.stroke = color;
            series.fill = color;
            series.fillOpacity = 0.3;
            series.tooltipText = "Trạm quan trắc: [bold font-size: 13]{name}\n" +
                "Thời gian: [bold font-size: 13]{dateX.formatDate(\"dd/MM/yyyy\")}\n" +
                "Giá trị: [bold font-size: 13]{valueY} " + unit + "[/]";
        }

        /*** Tạo Column Series theo từng trạm với mỗi thông số ***/
        var color =  ["#ffb157", "#007bff", "#1ab400", "#b43c29", "#7d61b4"];
        var length = Object.keys(data_chart[0]).length;
        for (var i = 0; i < length; i++) {
            if (Object.keys(data_chart[0])[i] != 'time' &&
                Object.keys(data_chart[0])[i] != 'time_js') {
                for (var j = 0; j < station.length; j++) {
                    if (station[j] == Object.keys(data_chart[0])[i])
                        createSeries(Object.keys(data_chart[0])[i], station_text[j], color[j]);
                }
            }
        }

        chart.cursor = new am4charts.XYCursor();

        chart.legend = new am4charts.Legend();
        chart.legend.position = "bottom";
        chart.legend.fontSize = 15;
        chart.legend.maxWidth = undefined;

        var markerTemplate = chart.legend.markers.template;
        markerTemplate.width = 30;
        markerTemplate.height = 30;

        var title = chart.titles.create();
        title.text = name_title;
        title.fontSize = 25;
        title.fontFamily = "Arial";
        title.marginBottom = 30;

        /*** Delay Time Export ***/
        chart.exporting.timeoutDelay = 500;

        /* chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.menu.align = "left";
        chart.exporting.menu.verticalAlign = "top";
        chart.exporting.menu.items = [{
            "label": "XUẤT FILE",
            "menu": [
                {"type": "png", "label": "PNG"},
                {"type": "xlsx", "label": "Excel"},
                {"type": "pdf", "label": "PDF"}
            ]
        }]; */

        /*** Min Max Range ***/
        if (min != null) {
            var min_range = valueAxis.axisRanges.create();
            min_range.value = min;
            min_range.grid.stroke = am4core.color("#ff0000");
            min_range.grid.strokeWidth = 2;
            min_range.grid.strokeOpacity = 1;
            min_range.label.inside = true;
            if (unit == "") {
                min_range.label.text = "[font-style: italic] Giá trị nhỏ nhất: [font-style: italic]" + min;
            } else {
                min_range.label.text = "[font-style: italic] Giá trị nhỏ nhất: " +
                    "[font-style: italic]" + min + " [font-style: italic]" + unit;
            }
            min_range.label.fill = min_range.grid.stroke;
            min_range.label.align = "right";
            min_range.label.verticalCenter = "bottom";
            min_range.label.dy = 10;
        }

        if (max != null) {
            var max_range = valueAxis.axisRanges.create();
            max_range.value = max;
            max_range.grid.stroke = am4core.color("#ff0000");
            max_range.grid.strokeWidth = 2;
            max_range.grid.strokeOpacity = 1;
            max_range.label.inside = true;
            if (unit == "") {
                max_range.label.text = "[font-style: italic] Giá trị lớn nhất: [font-style: italic]" + max;
            } else {
                max_range.label.text = "[font-style: italic] Giá trị lớn nhất: " +
                    "[font-style: italic]" + max + " [font-style: italic]" + unit;
            }
            max_range.label.fill = max_range.grid.stroke;
            max_range.label.align = "right";
            max_range.label.verticalCenter = "bottom";
            max_range.label.dy = 10;
        }

        chart.scrollbarX = new am4core.Scrollbar();
        chart.scrollbarX.parent = chart.bottomAxesContainer;
    });
}

function render_groupLinechart_quantrac(div_id, data_chart, name_title, unit, key, station_text, station, min, max) {
    am4core.useTheme(am4themes_animated);
    /* Khoảng cách bao nhiêu pixel thì show Lines */
    am4core.options.minPolylineStep = 5;
    am4core.ready(function () {

        /** Remove Logo **/
        $("g[opacity='0.3']").remove();
        $("g[opacity='0.4']").remove();
        var chart = am4core.create(div_id, am4charts.XYChart);
        chart.data = data_chart;

        chart.language.locale = am4lang_vi_VN;
        chart.logo.height = -9999;
        chart.fontSize = 13;
        chart.dateFormatter.inputDateFormat = "HH:mm:ss, dd/MM/yyyy";

        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.grid.template.location = 0;
        /*** Label thời gian nằm giữa column ***/
        dateAxis.renderer.labels.template.location = 0.5;
        dateAxis.renderer.minGridDistance = 50;
        dateAxis.baseInterval = {
            "timeUnit": "minute",
            "count": 5
        }
        dateAxis.tooltipDateFormat = "HH:mm:ss, dd/MM/yyyy";

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        if (unit != "") {
            valueAxis.title.text = "(" + unit + ")";
        }
        valueAxis.min = 0;

        function createSeries(field, name, color, bullet) {
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = field;
            series.dataFields.dateX = key;
            series.name = name;
            series.strokeWidth = 2;
            series.tensionX = 0.7;
            series.stroke = color;
            series.fill = color;
            series.fillOpacity = 0.3;
            series.tooltipText = "Trạm quan trắc: [bold font-size: 13]{name}\n" +
                "Thời gian: [bold font-size: 13]{dateX.formatDate(\"dd/MM/yyyy\")}\n " +
                "Giá trị: [bold font-size: 13]{valueY}[/] " + unit + "[/]";
            /* Thu nhỏ Bullet */
            series.minBulletDistance = 20;

            var interfaceColors = new am4core.InterfaceColorSet();

            switch (bullet) {
                case "triangle":
                    var bullet_1 = series.bullets.push(new am4charts.Bullet());
                    bullet_1.width = 12;
                    bullet_1.height = 12;
                    bullet_1.horizontalCenter = "middle";
                    bullet_1.verticalCenter = "middle";

                    var triangle = bullet_1.createChild(am4core.Triangle);
                    triangle.stroke = interfaceColors.getFor("background");
                    triangle.strokeWidth = 2;
                    triangle.direction = "top";
                    triangle.width = 12;
                    triangle.height = 12;
                    break;
                case "rectangle":
                    var bullet_2 = series.bullets.push(new am4charts.Bullet());
                    bullet_2.width = 12;
                    bullet_2.height = 12;
                    bullet_2.horizontalCenter = "middle";
                    bullet_2.verticalCenter = "middle";

                    var rectangle = bullet_2.createChild(am4core.Rectangle);
                    rectangle.stroke = interfaceColors.getFor("background");
                    rectangle.strokeWidth = 2;
                    rectangle.direction = "top";
                    rectangle.width = 12;
                    rectangle.height = 12;

                    var shadow = new am4core.DropShadowFilter();
                    shadow.dx = 2;
                    shadow.dy = 2;
                    rectangle.filters.push(shadow);
                    break;
                case "circle":
                    var bullet_3 = series.bullets.push(new am4charts.Bullet());
                    bullet_3.width = 12;
                    bullet_3.height = 12;
                    bullet_3.horizontalCenter = "left";
                    bullet_3.verticalCenter = "left";

                    var circle = bullet_3.createChild(am4core.Circle);
                    circle.stroke = interfaceColors.getFor("background");
                    circle.strokeWidth = 2;
                    circle.direction = "top";
                    circle.width = 12;
                    circle.height = 12;
                    break;
                case "arrow":
                    var bullet_4 = series.bullets.push(new am4charts.Bullet());
                    bullet_4.width = 12;
                    bullet_4.height = 12;
                    bullet_4.horizontalCenter = "middle";
                    bullet_4.verticalCenter = "bottom";

                    var arrow = bullet_4.createChild(am4core.Triangle);
                    arrow.stroke = interfaceColors.getFor("background");
                    arrow.strokeWidth = 2;
                    arrow.direction = "top";
                    arrow.width = 12;
                    arrow.height = 15;
                    break;
                case "square":
                    var bullet_5 = series.bullets.push(new am4charts.Bullet());
                    bullet_5.width = 12;
                    bullet_5.height = 12;
                    bullet_5.horizontalCenter = "middle";
                    bullet_5.verticalCenter = "middle";

                    var square = bullet_5.createChild(am4core.Rectangle);
                    square.stroke = interfaceColors.getFor("background");
                    square.strokeWidth = 2;
                    square.direction = "top";
                    square.width = 12;
                    square.height = 12;
                    break;
            }
        }

        /*** Tạo Column Series theo từng trạm với mỗi thông số ***/
        var bullet = ["triangle", "rectangle", "circle", "arrow", "square"]
        var color =  ["#ffb157", "#007bff", "#1ab400", "#b43c29", "#7d61b4"];
        var length = Object.keys(data_chart[0]).length;
        for (var i = 0; i < length; i++) {
            if (Object.keys(data_chart[0])[i] != 'time' &&
                Object.keys(data_chart[0])[i] != 'time_js') {
                for (var j = 0; j < station.length; j++) {
                    if (station[j] == Object.keys(data_chart[0])[i])
                        createSeries(Object.keys(data_chart[0])[j],
                            station_text[j], color[j], bullet[j]);
                }
            }
        }

        chart.cursor = new am4charts.XYCursor();

        chart.legend = new am4charts.Legend();
        chart.legend.position = "bottom";
        chart.legend.fontSize = 15;
        chart.legend.maxWidth = undefined;

        var markerTemplate = chart.legend.markers.template;
        markerTemplate.width = 30;
        markerTemplate.height = 30;

        var title = chart.titles.create();
        title.text = name_title;
        title.fontSize = 25;
        title.fontFamily = "Arial";
        title.marginBottom = 30;

        /*** Delay Time Export ***/
        chart.exporting.timeoutDelay = 500;

        /* chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.menu.align = "left";
        chart.exporting.menu.verticalAlign = "top";
        chart.exporting.menu.items = [{
            "label": "XUẤT FILE",
            "menu": [
                {"type": "png", "label": "PNG"},
                {"type": "xlsx", "label": "Excel"},
                {"type": "pdf", "label": "PDF"}
            ]
        }]; */

        /*** Min Max Range ***/
        if (min != null) {
            var min_range = valueAxis.axisRanges.create();
            min_range.value = min;
            min_range.grid.stroke = am4core.color("#ff0000");
            min_range.grid.strokeWidth = 2;
            min_range.grid.strokeOpacity = 1;
            min_range.label.inside = true;
            if (unit == "") {
                min_range.label.text = "[font-style: italic] Giá trị nhỏ nhất: [font-style: italic]" + min;
            } else {
                min_range.label.text = "[font-style: italic] Giá trị nhỏ nhất: " +
                    "[font-style: italic]" + min + " [font-style: italic]" + unit;
            }
            min_range.label.fill = min_range.grid.stroke;
            min_range.label.align = "right";
            min_range.label.verticalCenter = "bottom";
            min_range.label.dy = 10;
        }

        if (max != null) {
            var max_range = valueAxis.axisRanges.create();
            max_range.value = max;
            max_range.grid.stroke = am4core.color("#ff0000");
            max_range.grid.strokeWidth = 2;
            max_range.grid.strokeOpacity = 1;
            max_range.label.inside = true;
            if (unit == "") {
                max_range.label.text = "[font-style: italic] Giá trị lớn nhất: [font-style: italic]" + max;
            } else {
                max_range.label.text = "[font-style: italic] Giá trị lớn nhất: " +
                    "[font-style: italic]" + max + " [font-style: italic]" + unit;
            }
            max_range.label.fill = max_range.grid.stroke;
            max_range.label.align = "right";
            max_range.label.verticalCenter = "bottom";
            max_range.label.dy = 10;
        }

        chart.scrollbarX = new am4core.Scrollbar();
        chart.scrollbarX.parent = chart.bottomAxesContainer;
    });
}
