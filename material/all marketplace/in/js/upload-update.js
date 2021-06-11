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

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(loadPopular);

function loadPopular() {
    $.ajax({
        url:"process/upload-chart.php",
        method:"POST",
        data:{type:type, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            drawChartUplUpd(data);
            console.log(data);
        }
    });
}


function drawChartUplUpd(chart_data) {

    var jsonData = chart_data;
    var data = new google.visualization.DataTable();

    data.addColumn('string', 'Month');
    data.addColumn('number', 'Total Upload');
    data.addColumn('number', 'Total Update');
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

$.ajax({
  url:"process/tot-upload.php",
  method:"POST",
  data:{type:type, date:date, todate:todate},
  dataType:"JSON",
  success:function(data)
  {
      $('#tot-upload').text(data['0']['UPLOAD']);
      $('#tot-update').text(data['0']['UPDATE']);
      // console.log(data);

      $('.upload-rate').text(Number(data['0']['UPLOAD_RATE']).toFixed(0))
      var jum = Number(data['0']['UPLOAD_RATE']).toFixed(0);

      if(jum < 0){
      document.getElementById("plus-rate-upl").innerHTML = "";
      document.getElementById("title-rate-upl").style.color="#F6425E";
      document.getElementById("presentage-upl").style.color="#F6425E";

      document.getElementById("plus-shape-upl").style.backgroundColor ="rgba(246, 78, 96, 0.2)";
      document.getElementById("plus-image-upl").src="../../../src/image/Polygon 1 (1).png";
      }else if(jum > 0){
      document.getElementById("plus-rate-upl").innerHTML = "+";
      document.getElementById("plus-rate-upl").style.color="#38C976";
      document.getElementById("title-rate-upl").style.color="#38C976";
      document.getElementById("presentage-upl").style.color="#38C976";

      document.getElementById("plus-shape-upl").style.backgroundColor ="rgba(56, 201, 118, 0.2)";
      document.getElementById("plus-image-upl").src="../../../src/image/Polygon 1.png";
      }else if(jum == 0){
      document.getElementById("plus-rate-upl").innerHTML = "";
      document.getElementById("title-rate-upl").style.color="#38C976";
      document.getElementById("presentage-upl").style.color="#38C976";

      document.getElementById("plus-shape-upl").style.backgroundColor ="rgba(56, 201, 118, 0.2)";
      document.getElementById("plus-image-upl").src="../../../src/image/Polygon 1.png";
      }

      $('.update-rate').text(Number(data['0']['UPDATE_RATE']).toFixed(0))
      var jam = Number(data['0']['UPDATE_RATE']).toFixed(0);

      if(jam < 0){
      document.getElementById("plus-rate-upd").innerHTML = "";
      document.getElementById("title-rate-upd").style.color="#F6425E";
      document.getElementById("presentage-upd").style.color="#F6425E";

      document.getElementById("plus-shape-upd").style.backgroundColor ="rgba(246, 78, 96, 0.2)";
      document.getElementById("plus-image-upd").src="../../../src/image/Polygon 1 (1).png";
      }else if(jum > 0){
      document.getElementById("plus-rate-upd").innerHTML = "+";
      document.getElementById("plus-rate-upd").style.color="#38C976";
      document.getElementById("title-rate-upd").style.color="#38C976";
      document.getElementById("presentage-upd").style.color="#38C976";

      document.getElementById("plus-shape-upd").style.backgroundColor ="rgba(56, 201, 118, 0.2)";
      document.getElementById("plus-image-upd").src="../../../src/image/Polygon 1.png";
      }else if(jum == 0){
      document.getElementById("plus-rate-upd").innerHTML = "";
      document.getElementById("title-rate-upd").style.color="#38C976";
      document.getElementById("presentage-upd").style.color="#38C976";

      document.getElementById("plus-shape-upd").style.backgroundColor ="rgba(56, 201, 118, 0.2)";
      document.getElementById("plus-image-upd").src="../../../src/image/Polygon 1.png";
      }
    }
});