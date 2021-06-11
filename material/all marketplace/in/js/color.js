var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
  
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
  
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

var type = getUrlParameter('type');
var date = getUrlParameter('date');
var todate = getUrlParameter('todate');
var item = getUrlParameter('item');

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(loadBarChartColor);

function loadBarChartColor()
{   
    $.ajax({
        url:"process/color-chart.php",
        method:"POST",
        data:{type:type, item:item, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            drawBarChartColor(data);
            console.log(data);
        }
        
    });
}

function drawBarChartColor(chart_data) {
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();

    data.addColumn('string', 'Month');
    data.addColumn('number', 'Total');
    $.each(jsonData, function(i, jsonData){
        var COLOR = jsonData.COLOR;
        var TOTAL = parseFloat($.trim(jsonData.TOTAL));
        data.addRows([[COLOR, TOTAL]]);
        
    });

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" }
                      ]);

                      var options = {
                      legend: {position: 'none',maxLines: 20}, 
                      series: {
                          0: {
                            annotations: {
                              textStyle: {fontSize: 12, color: '#52575C', fontName: 'Poppins', opacity: 0 },
                              stem: {
                                  color: 'none', length: '12',
                              },
                
                            },
                            color: "#CACACA",
                          }
                        },
                      curveType: 'function',
                      chartArea: {
                        width: '100%', 
                        top: 60,
                        left: 80,
                        bottom: 20,
                    },
                    height: 1000,
                    lineWidth: 1,
                    pointsVisible: true,
                
                    hAxis: 
                        {textStyle:{color: '#C0C7CE', fontName: 'Poppins', fontSize: '14'}},
                    vAxis: 
                        {textStyle:{color: '#000', fontName: 'Poppins', fontSize: '14', bold: true},
                          gridlines: {color: '#e2e2e2'},
                          }
                    
    };
    var chart = new google.visualization.BarChart(document.getElementById("color-chart"));
    chart.draw(view, options);
}

function loadBarChartColorSearch(type, item, date, todate, search)
{   
    $.ajax({
        url:"process/color-chart-search.php",
        method:"POST",
        data:{type:type, item:item, date:date, todate:todate ,search:search},
        dataType:"JSON",
        success:function(data)
        {
            drawBarChartColorSearch(data);
            console.log(data);
        }
        
    });
}

function drawBarChartColorSearch(chart_data) {
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();

    data.addColumn('string', 'Month');
    data.addColumn('number', 'Total');
    $.each(jsonData, function(i, jsonData){
        var COLOR = jsonData.COLOR;
        var TOTAL = parseFloat($.trim(jsonData.TOTAL));
        data.addRows([[COLOR, TOTAL]]);
        
    });

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
            { calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation" }
            ]);

            var options = {
            legend: {position: 'none',maxLines: 20}, 
            series: {
                0: {
                annotations: {
                    textStyle: {fontSize: 12, color: '#52575C', fontName: 'Poppins', opacity: 0 },
                    stem: {
                        color: 'none', length: '12',
                    },
    
                },
                color: "#CACACA",
                }
            },
            curveType: 'function',
            chartArea: {
            width: '100%', 
            top: 60,
            left: 80,
            bottom: 20,
        },
        height: 1000,
        lineWidth: 1,
        pointsVisible: true,
    
        hAxis: 
            {textStyle:{color: '#C0C7CE', fontName: 'Poppins', fontSize: '14'}},
        vAxis: 
            {textStyle:{color: '#000', fontName: 'Poppins', fontSize: '14', bold: true},
                gridlines: {color: '#e2e2e2'},
                }
        
    };
    var chart = new google.visualization.BarChart(document.getElementById("color-chart"));
    chart.draw(view, options);
}

function search_color() {
    var s = document.getElementById("search");
    var search = s.value;
    loadBarChartColorSearch(type, item, date, todate, search)
  
    console.log(search);
    
    // if(search.length >= 1){
    //     $('#select_count').prop('disabled', 'disabled');
    // }else{
    //     $('#select_count').prop('disabled', false);
    // }
}

// var btn_this = document.getElementById('this_date');
// var btn_30 = document.getElementById('30_date');
// var btn_one_year = document.getElementById('one_year_date');
// var date_todate = document.getElementById('date_todate');
// var btn_costum = document.getElementById('costum_date');

// btn_costum.addEventListener('click', () => {

//     btn_costum.classList.add('but-costum-active');

//     btn_this.classList.remove('but-active');
//     btn_30.classList.remove('but-active');
//     btn_one_year.classList.remove('but-active');

// });


// btn_this.addEventListener('click', () => {

//     btn_this.classList.add('but-active');
    
//     btn_costum.classList.remove('but-costum-active');
//     btn_30.classList.remove('but-active');
//     btn_one_year.classList.remove('but-active');

//     var this_value = document.getElementById("this_date").value;
//     loadBarChartColor(this_value, type, item)

// });


// btn_30.addEventListener('click', () => {

//     btn_30.classList.add('but-active');
    
//     btn_costum.classList.remove('but-costum-active');
//     btn_this.classList.remove('but-active');
//     btn_one_year.classList.remove('but-active');

//     var this_value = document.getElementById("30_date").value;
//     loadBarChartColor(this_value, type, item)
// });

// btn_one_year.addEventListener('click', () => {

//     btn_one_year.classList.add('but-active');
    
//     btn_costum.classList.remove('but-costum-active');
//     btn_30.classList.remove('but-active');
//     btn_this.classList.remove('but-active');

//     var this_value = document.getElementById("one_year_date").value;
//     loadBarChartColor(this_value, type, item)
// });

// date_todate.addEventListener('click', () => {

//     btn_costum.classList.add('but-costum-active');

//     btn_this.classList.remove('but-active');
//     btn_30.classList.remove('but-active');
//     btn_one_year.classList.remove('but-active');

//     var this_value = document.getElementById("date_todate").value;
//     var costum_value = document.getElementById("report").innerHTML;

//     var date = costum_value.substr(0, 10);
//     var todate = costum_value.substr(14, 24);
//     loadBarChartColor(this_value, type, item, date, todate)
// });

