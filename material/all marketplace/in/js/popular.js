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

var date = getUrlParameter('date');
var todate = getUrlParameter('todate');

$.ajax({
    url:"process/total-popular.php",
    method:"POST",
    data:{date:date, todate:todate},
    dataType:"JSON",
    success:function(data)
    {
        $('.total_gr_week').text(data['0']['GR_WEEK']);
        $('.total_rrg_week').text(data['1']['RRG_WEEK']);
        $('.total_gr_right').text(data['2']['GR_YEAR']);
        $('.total_rrg_right').text(data['3']['RRG_YEAR']);
        $('#title-param').text(data['4']['TITLE']);
    }
});

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(loadPopular);

function loadPopular() {
    $.ajax({
        url:"process/popular-chart.php",
        method:"POST",
        data:{date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            drawChartPopular(data);
        }
    });
}


function drawChartPopular(chart_data) {

    var jsonData = chart_data;
    var data = new google.visualization.DataTable();

    data.addColumn('string', 'Month');
    data.addColumn('number', 'Graphicriver');
    data.addColumn('number', 'RRGraph');
    $.each(jsonData, function(i, jsonData){
        var month = jsonData.month;
        var TOTAL = parseFloat($.trim(jsonData.TOTAL));
        var JUMLAH = parseFloat($.trim(jsonData.JUMLAH));
        data.addRows([[month, TOTAL, JUMLAH]]);
        
    });

    // var data = google.visualization.arrayToDataTable([
    //     ['Year', 'Sales', 'Expenses'],
    //     ['2014', 1000, 400],
    //     ['2017', 1030, 540]
    // ]);

    var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation",},

                       2,
                     { calc: "stringify",
                       sourceColumn: 2,
                       type: "string",
                       role: "annotation",},
      ]);

    var options = {
      legend: {position: 'top',maxLines: 20, alignment: 'end', textStyle: {color: '#000', fontSize: 16, fontName: 'Poppins', bold: true}}, 
      series: {
          0: {
            annotations: {
              textStyle: {fontSize: 16, color: '#7CB342', fontName: 'Poppins'},
              stem: {
                  color: 'none', length: '12',
              },

            },
            color: "#7CB342",
          },
          1: {
            annotations: {
              textStyle: {fontSize: 16, color: '#FFB600', fontName: 'Poppins'},
              stem: {
                  color: 'none', length: '12',
              },
            },
            color: "#FFB600",
          }
        },
      curveType: 'function',
      chartArea: {width: '100%',
      top: 60,
      left: 60,
      bottom: 20,
    },
    lineWidth: 5,
    // pointsVisible: true,

    hAxis: 
        {textStyle:{color: '#777777', fontName: 'Poppins', fontSize: '14'}},
    vAxis: 
        {textStyle:{color: '#777777', fontName: 'Poppins', fontSize: '14'},
         gridlines: {color: '#e2e2e2'},
         }
    
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
  chart.draw(view, options);

  $(window).resize(function(){
    chart.draw(view, options);
  });
}

function loadTablePopular(select, date, todate) {
  $.ajax({
    url: 'process/select-table-popular.php',
    type: "POST",
    data:{select:select, date:date, todate:todate},
    cache: false,
    success: function(data){
        $('#table-popular').html(data); 
    }
  });
}

$(document).ready(function(){
  $("select.select-popular").change(function(){
      var select = $(this).children("option:selected").val();
      loadTablePopular(select, date, todate);
  });
});