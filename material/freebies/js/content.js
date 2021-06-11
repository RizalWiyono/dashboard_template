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

var market = getUrlParameter('type');

google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(loadLineChart);

// Line Chart

function loadLineChart(this_value, market, date, todate)
{   
    $.ajax({
        url:"process/line-chart.php",
        method:"POST",
        data:{this_value:this_value, market:market, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            drawLineChart(data);
            console.log(data);
        }
        
    });
}

function drawLineChart(chart_data)
{
  var jsonData = chart_data;
  var data = new google.visualization.DataTable();

  data.addColumn('string', 'Month');
  data.addColumn('number', 'Total');
  data.addColumn('number', 'Total');
  $.each(jsonData, function(i, jsonData){
      var month = jsonData.month;
      var TOTAL = parseFloat($.trim(jsonData.TOTAL));
      var JUMLAH = parseFloat($.trim(jsonData.JUMLAH));
      data.addRows([[month, TOTAL, JUMLAH]]);
      
  });

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
      legend: {position: 'none',maxLines: 20}, 
      series: {
          0: {
            annotations: {
              textStyle: {fontSize: 12, color: '#D1D1D1', fontName: 'Poppins'},
              stem: {
                  color: 'none', length: '12',
              },

            },
            color: "#DDDDDD",
          },
          1: {
            annotations: {
              textStyle: {fontSize: 16, color: '#000000', fontName: 'Poppins', bold: true},
              stem: {
                  color: 'none', length: '12',
              },
            },
            color: "#3365FF",
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

  var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
  chart.draw(view, options);

  $(window).resize(function(){
    chart.draw(view, options);
  });
}

// Bar Chart

function loadBarChart(this_value, market, date, todate)
{   
    $.ajax({
        url:"process/bar-chart.php",
        method:"POST",
        data:{this_value:this_value, market:market, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            drawBarChart(data);
            console.log(data);
        }
        
    });
}

function drawBarChart(chart_data)
{
  var jsonData = chart_data;
  var data = new google.visualization.DataTable();

  data.addColumn('string', 'Month');
  data.addColumn('number', 'Earnings');
  data.addColumn('number', 'Total Item');
  $.each(jsonData, function(i, jsonData){
      var month = jsonData.month;
      var TOTAL = parseFloat($.trim(jsonData.TOTAL));
      var JUMLAH = parseFloat($.trim(jsonData.JUMLAH));
      data.addRows([[month, TOTAL, JUMLAH]]);
      
  });

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
      legend: {position: 'none',maxLines: 20}, 
      series: {
          0: {
            annotations: {
              textStyle: {fontSize: 12, color: '#D1D1D1', fontName: 'Poppins'},
              stem: {
                  color: 'none', length: '12',
              },

            },
            color: "#DDDDDD",
          },
          1: {
            annotations: {
              textStyle: {fontSize: 16, color: '#000000', fontName: 'Poppins', bold: true},
              stem: {
                  color: 'none', length: '12',
              },
            },
            color: "#3365FF",
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

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
  chart.draw(view, options);

  $(window).resize(function(){
    chart.draw(view, options);
  });
}

function getParamDate(this_value, market, date, todate) {
    $.ajax({
        url:'process/param_date.php',
        method:"POST",
        data:{this_value:this_value, market:market, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            $('#report_start').text(data['0']['start']);
            $('#report_end').text(data['1']['end']);
        }
    });
}

var btn_this = document.getElementById('this_date');
var btn_30 = document.getElementById('30_date');
var btn_one_year = document.getElementById('one_year_date');
var date_todate = document.getElementById('date_todate');
var btn_costum = document.getElementById('costum_date');
var dd_costum = document.getElementById('dropdownMenu2');

btn_costum.addEventListener('click', () => {

    btn_costum.classList.add('but-costum-active');

    btn_this.classList.remove('but-active');
    btn_30.classList.remove('but-active');
    btn_one_year.classList.remove('but-active');
    dd_costum.classList.remove('but-active');

});

btn_this.addEventListener('click', () => {

    btn_this.classList.add('but-active');
    
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_one_year.classList.remove('but-active');
    dd_costum.classList.remove('but-active');

    var this_value = document.getElementById("this_date").value;


    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=One%20Month%20Last"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=One%20Month%20Last"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=One%20Month%20Last"; 
    document.getElementById('href-frb-frb').href = "?market=All Marketplace&type=freebies&date=One%20Month%20Last"; 
    document.getElementById('href-frb-tot').href = "?market=All Marketplace&type=total&date=One%20Month%20Last"; 

    document.getElementById("opt-be").value = "../all marketplace/all-marketplace.php?market=GR-Brandearth&date=One%20Month%20Last";
    document.getElementById("opt-rrg").value = "../all marketplace/all-marketplace.php?market=GR-RRGraph&date=One%20Month%20Last";
    document.getElementById("opt-tm").value = "../all marketplace/all-marketplace.php?market=Templatemonster&date=One%20Month%20Last";
    document.getElementById("opt-cm").value = "../all marketplace/all-marketplace.php?market=Creativemarket&date=One%20Month%20Last";
    document.getElementById("opt-rrs").value = "../all marketplace/all-marketplace.php?market=RRSlide&date=One%20Month%20Last";
    document.getElementById("opt-all").value = "../all marketplace/all-marketplace.php?market=All Marketplace&date=One%20Month%20Last";

    if(market ==  'freebies'){
        loadLineChart(this_value, market)
    }else{
        loadBarChart(this_value, market)
    }
    
    getParamDate(this_value, market);

});

btn_30.addEventListener('click', () => {

    btn_30.classList.add('but-active');
    
    btn_costum.classList.remove('but-costum-active');
    btn_this.classList.remove('but-active');
    btn_one_year.classList.remove('but-active');
    dd_costum.classList.remove('but-active');

    if(market != 'Templatemonster' && market != 'Creativemarket'){
    }

    var this_value = document.getElementById("30_date").value;

    document.getElementById('href-frb-frb').href = "?market=All Marketplace&type=freebies&date=30%20Days"; 
    document.getElementById('href-frb-tot').href = "?market=All Marketplace&type=total&date=30%20Days"; 

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=30%20Days"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=30%20Days"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=30%20Days"; 

    document.getElementById("opt-be").value = "../all marketplace/all-marketplace.php?market=GR-Brandearth&date=30%20Days";
    document.getElementById("opt-rrg").value = "../all marketplace/all-marketplace.php?market=GR-RRGraph&date=30%20Days";
    document.getElementById("opt-tm").value = "../all marketplace/all-marketplace.php?market=Templatemonster&date=30%20Days";
    document.getElementById("opt-cm").value = "../all marketplace/all-marketplace.php?market=Creativemarket&date=30%20Days";
    document.getElementById("opt-rrs").value = "../all marketplace/all-marketplace.php?market=RRSlide&date=30%20Days";
    document.getElementById("opt-all").value = "../all marketplace/all-marketplace.php?market=All Marketplace&date=30%20Days";

    if(market ==  'freebies'){
        loadLineChart(this_value, market)
    }else{
        loadBarChart(this_value, market)
    }
    getParamDate(this_value, market);

});

date_todate.addEventListener('click', () => {

    btn_costum.classList.add('but-costum-active');

    btn_this.classList.remove('but-active');
    btn_30.classList.remove('but-active');
    btn_one_year.classList.remove('but-active');
    dd_costum.classList.remove('but-active');

    var this_value = document.getElementById("date_todate").value;
    var costum_value = document.getElementById("report").innerHTML;

    var date = costum_value.substr(0, 10);
    var todate = costum_value.substr(14, 24);

    document.getElementById('href-frb-frb').href = "?market=All Marketplace&type=freebies&date="+date+"&todate="+todate; 
    document.getElementById('href-frb-tot').href = "?market=All Marketplace&type=total&date="+date+"&todate="+todate; 

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date="+date+"&todate="+todate; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date="+date+"&todate="+todate; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date="+date+"&todate="+todate; 

    document.getElementById("opt-be").value = "../all marketplace/all-marketplace.php?market=GR-Brandearth&date="+date+"&todate="+todate;
    document.getElementById("opt-rrg").value = "../all marketplace/all-marketplace.php?market=GR-RRGraph&date="+date+"&todate="+todate;
    document.getElementById("opt-tm").value = "../all marketplace/all-marketplace.php?market=Templatemonster&date="+date+"&todate="+todate;
    document.getElementById("opt-cm").value = "../all marketplace/all-marketplace.php?market=Creativemarket&date="+date+"&todate="+todate;
    document.getElementById("opt-rrs").value = "../all marketplace/all-marketplace.php?market=RRSlide&date="+date+"&todate="+todate;
    document.getElementById("opt-all").value = "../all marketplace/all-marketplace.php?market=All Marketplace&date="+date+"&todate="+todate;

    if(market ==  'freebies'){
        loadLineChart(this_value, market, date, todate)
    }else{
        loadBarChart(this_value, market, date, todate)
    }
    getParamDate(this_value, market, date, todate)
});

btn_one_year.addEventListener('click', () => {

    btn_one_year.classList.add('but-active');
    
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');
    dd_costum.classList.remove('but-active');
    
    var this_value = document.getElementById("one_year_date").value;
    console.log(this_value);

    document.getElementById('href-frb-frb').href = "?market=All Marketplace&type=freebies&date=One%20Year%20Last"; 
    document.getElementById('href-frb-tot').href = "?market=All Marketplace&type=total&date=One%20Year%20Last"; 

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=One%20Year%20Last"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=One%20Year%20Last"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=One%20Year%20Last"; 

    document.getElementById("opt-be").value = "../all marketplace/all-marketplace.php?market=GR-Brandearth&date=One%20Year%20Last";
    document.getElementById("opt-rrg").value = "../all marketplace/all-marketplace.php?market=GR-RRGraph&date=One%20Year%20Last";
    document.getElementById("opt-tm").value = "../all marketplace/all-marketplace.php?market=Templatemonster&date=One%20Year%20Last";
    document.getElementById("opt-cm").value = "../all marketplace/all-marketplace.php?market=Creativemarket&date=One%20Year%20Last";
    document.getElementById("opt-rrs").value = "../all marketplace/all-marketplace.php?market=RRSlide&date=One%20Year%20Last";
    document.getElementById("opt-all").value = "../all marketplace/all-marketplace.php?market=All Marketplace&date=One%20Year%20Last";

    if(market ==  'freebies'){
        loadLineChart(this_value, market)
    }else{
        loadBarChart(this_value, market)
    }
    getParamDate(this_value, market);

});

var btnLastMonth = document.getElementById('last_month');

btnLastMonth.addEventListener('click', () => {

    dd_costum.classList.add('but-active');

    btn_one_year.classList.remove('but-active');
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');

    var this_value = document.getElementById("last_month").value;

    document.getElementById('href-frb-frb').href = "?market=All Marketplace&type=freebies&date=Last%20Month"; 
    document.getElementById('href-frb-tot').href = "?market=All Marketplace&type=total&date=Last%20Month";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=Last%20Month"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=Last%20Month"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=Last%20Month"; 

    document.getElementById("opt-be").value = "../all marketplace/all-marketplace.php?market=GR-Brandearth&date=Last%20Month";
    document.getElementById("opt-rrg").value = "../all marketplace/all-marketplace.php?market=GR-RRGraph&date=Last%20Month";
    document.getElementById("opt-tm").value = "../all marketplace/all-marketplace.php?market=Templatemonster&date=Last%20Month";
    document.getElementById("opt-cm").value = "../all marketplace/all-marketplace.php?market=Creativemarket&date=Last%20Month";
    document.getElementById("opt-rrs").value = "../all marketplace/all-marketplace.php?market=RRSlide&date=Last%20Month";
    document.getElementById("opt-all").value = "../all marketplace/all-marketplace.php?market=All Marketplace&date=Last%20Month";
    
    if(market ==  'freebies'){
        loadLineChart(this_value, market)
    }else{
        loadBarChart(this_value, market)
    }
	getParamDate(this_value, market);

});

var btnLastYear = document.getElementById('last_year');

btnLastYear.addEventListener('click', () => {

    dd_costum.classList.add('but-active');

    btn_one_year.classList.remove('but-active');
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');
    
    var this_value = document.getElementById("last_year").value;

    document.getElementById('href-frb-frb').href = "?market=All Marketplace&type=freebies&date=Last%20Year"; 
    document.getElementById('href-frb-tot').href = "?market=All Marketplace&type=total&date=Last%20Year";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=Last%20Year"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=Last%20Year"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=Last%20Year"; 

    document.getElementById("opt-be").value = "../all marketplace/all-marketplace.php?market=GR-Brandearth&date=Last%20Year";
    document.getElementById("opt-rrg").value = "../all marketplace/all-marketplace.php?market=GR-RRGraph&date=Last%20Year";
    document.getElementById("opt-tm").value = "../all marketplace/all-marketplace.php?market=Templatemonster&date=Last%20Year";
    document.getElementById("opt-cm").value = "../all marketplace/all-marketplace.php?market=Creativemarket&date=Last%20Year";
    document.getElementById("opt-rrs").value = "../all marketplace/all-marketplace.php?market=RRSlide&date=Last%20Year";
    document.getElementById("opt-all").value = "../all marketplace/all-marketplace.php?market=All Marketplace&date=Last%20Year";
    
    if(market ==  'freebies'){
        loadLineChart(this_value, market)
    }else{
        loadBarChart(this_value, market)
    }
	getParamDate(this_value, market);
});

var btnAllTime = document.getElementById('all_time');

btnAllTime.addEventListener('click', () => {

    dd_costum.classList.add('but-active');

    btn_one_year.classList.remove('but-active');
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');
    
    var this_value = document.getElementById("all_time").value;

    document.getElementById('href-frb-frb').href = "?market=All Marketplace&type=freebies&date=All%20Time"; 
    document.getElementById('href-frb-tot').href = "?market=All Marketplace&type=total&date=All%20Time";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=All%20Time"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=All%20Time"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=All%20Time"; 

    document.getElementById("opt-be").value = "../all marketplace/all-marketplace.php?market=GR-Brandearth&date=All%20Time";
    document.getElementById("opt-rrg").value = "../all marketplace/all-marketplace.php?market=GR-RRGraph&date=All%20Time";
    document.getElementById("opt-tm").value = "../all marketplace/all-marketplace.php?market=Templatemonster&date=All%20Time";
    document.getElementById("opt-cm").value = "../all marketplace/all-marketplace.php?market=Creativemarket&date=All%20Time";
    document.getElementById("opt-rrs").value = "../all marketplace/all-marketplace.php?market=RRSlide&date=All%20Time";
    document.getElementById("opt-all").value = "../all marketplace/all-marketplace.php?market=All Marketplace&date=All%20Time";

    if(market ==  'freebies'){
        loadLineChart(this_value, market)
    }else{
        loadBarChart(this_value, market)
    }
    getParamDate(this_value, market);
});

var btnThisYear = document.getElementById('this_year');

btnThisYear.addEventListener('click', () => {

    dd_costum.classList.add('but-active');

    btn_one_year.classList.remove('but-active');
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');
    
    var this_value = document.getElementById("this_year").value;

    document.getElementById('href-frb-frb').href = "?market=All Marketplace&type=freebies&date=This%20Year"; 
    document.getElementById('href-frb-tot').href = "?market=All Marketplace&type=total&date=This%20Year";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=This%20Year"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=This%20Year"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=This%20Year"; 

    document.getElementById("opt-be").value = "../all marketplace/all-marketplace.php?market=GR-Brandearth&date=This%20Year";
    document.getElementById("opt-rrg").value = "../all marketplace/all-marketplace.php?market=GR-RRGraph&date=This%20Year";
    document.getElementById("opt-tm").value = "../all marketplace/all-marketplace.php?market=Templatemonster&date=This%20Year";
    document.getElementById("opt-cm").value = "../all marketplace/all-marketplace.php?market=Creativemarket&date=This%20Year";
    document.getElementById("opt-rrs").value = "../all marketplace/all-marketplace.php?market=RRSlide&date=This%20Year";
    document.getElementById("opt-all").value = "../all marketplace/all-marketplace.php?market=All Marketplace&date=This%20Year";

    if(market ==  'freebies'){
        loadLineChart(this_value, market)
    }else{
        loadBarChart(this_value, market)
    }
    getParamDate(this_value, market);
});