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

var market = getUrlParameter('market');

google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(loadCircleChart);
google.charts.setOnLoadCallback(loadBarChart);

// Bar Chart

function loadBarChart(this_value, market, date, todate)
{   
    $.ajax({
        url:"process/barchart.php",
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



// Circle Chart

function loadCircleChart(this_value, date, todate) {

$.ajax({
    url:'process/marketplace_allmarket.php',
    method:"POST",
    data:{this_value:this_value, date:date, todate:todate},
    dataType:"JSON",
    success:function(data)
    {
    drawCircleChart(data);
    }
});
}

function drawCircleChart(chart_data)  
{ 
  var jsonData = chart_data;

  var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    $.each(jsonData, function(i, jsonData){
      var TOTALBE = parseFloat($.trim(jsonData.TOTALBE));
      var TOTALRRG = parseFloat($.trim(jsonData.TOTALRRG));
      var TOTALTM = parseFloat($.trim(jsonData.TOTALTM));
      var TOTALCM = parseFloat($.trim(jsonData.TOTALCM));
      var TOTALRRS = parseFloat($.trim(jsonData.TOTALRRS));
      data.addRows([
        ['GR - Brandearth', TOTALBE], 
        ['GR - RRGraph', TOTALRRG], 
        ['Templatemonster', TOTALTM], 
        ['Creativemarket', TOTALCM], 
        ['RRSlide', TOTALRRS], 
      ]);

    });
  var options = {  
          legend: 'none',
           position:'left',
           chartArea: {width: '100%',
              top: 0,
              bottom: 0,
              left: 0,
            },
           fontSize: 9,
           fontFamily: 'Poppins',
           height: 300,
           pieHole: 0.7,
           slices:{0: {color: '#343FD5'}, 1:{color: '#3EBEF4'}, 2:{color: '#F6425E'}, 3:{color: '#2BE870'}, 4:{color: '#FBA146'}}
  };  
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
    
  $(window).resize(function(){
    chart.draw(data, options);
  });
} 

// Easy Circle Chart

function loadEasyCirle(this_value, market) {
    
    if(market == 'RRSlide'){
        $.ajax({
            url:'process/easy_circle.php',
            method:"POST",
            data:{this_value:this_value, market:market},
            dataType:"JSON",
            success:function(data)
            {
                let sumppt = Number((Number(data['1']['PPT']) / Number(data['0']['TOTAL'])) * 100);
                let sumky = Number((Number(data['2']['KY']) / Number(data['0']['TOTAL'])) * 100);
                let sumpt = Number((Number(data['3']['PT']) / Number(data['0']['TOTAL'])) * 100);
    
                $('.chart-ppt').data('easyPieChart').update(Math.floor(sumppt));
                $('.ppt-percent').text(Math.floor(sumppt)+'%');
                $('.chart-keynote').data('easyPieChart').update(Math.floor(sumky));
                $('.keynote-percent').text(Math.floor(sumky)+'%');
                $('.chart-potrait').data('easyPieChart').update(Math.floor(sumpt));
                $('.potrait-percent').text(Math.floor(sumpt)+'%');

                $('#total-sales').text(data['0']['TOTAL']);
                $('#ppt-sales').text(data['1']['PPT']);
                $('#keynote-sales').text(data['2']['KY']);
                $('#potrait-sales').text(data['3']['PT']);
            },
            error: function(xhr, statusText, err){
                console.log("Error:" + err); 
            }
        });
    }else{
        $.ajax({
            url:'process/easy_circle.php',
            method:"POST",
            data:{this_value:this_value, market:market},
            dataType:"JSON",
            success:function(data)
            {
                let sumppt = Number((Number(data['1']['PPT']) / Number(data['0']['TOTAL'])) * 100);
                let sumky = Number((Number(data['2']['KY']) / Number(data['0']['TOTAL'])) * 100);
                let sumpt = Number((Number(data['3']['PT']) / Number(data['0']['TOTAL'])) * 100);
                let sumetc = Number((Number(data['4']['ETC']) / Number(data['0']['TOTAL'])) * 100);
                let sumgs = Number((Number(data['5']['GS']) / Number(data['0']['TOTAL'])) * 100);
    
                $('.chart-ppt').data('easyPieChart').update(Math.floor(sumppt));
                $('.ppt-percent').text(Math.floor(sumppt)+'%');
                $('.chart-keynote').data('easyPieChart').update(Math.floor(sumky));
                $('.keynote-percent').text(Math.floor(sumky)+'%');
                $('.chart-potrait').data('easyPieChart').update(Math.floor(sumpt));
                $('.potrait-percent').text(Math.floor(sumpt)+'%');
                $('.chart-gs').data('easyPieChart').update(Math.floor(sumgs));
                $('.gs-percent').text(Math.floor(sumgs)+'%');
                $('.chart-etc').data('easyPieChart').update(Math.floor(sumetc));
                $('.etc-percent').text(Math.floor(sumetc)+'%');
    
                $('#total-sales').text(data['0']['TOTAL']);
                $('#ppt-sales').text(data['1']['PPT']);
                $('#keynote-sales').text(data['2']['KY']);
                $('#potrait-sales').text(data['3']['PT']);
                $('#etc-sales').text(data['4']['ETC']);
                $('#gs-sales').text(data['5']['GS']);
            },
            error: function(xhr, statusText, err){
                console.log("Error:" + err); 
            }
        });
    }
    
}

// Table

function getTableMarketplace(this_value, date, todate) {

    $.ajax({
        url: 'process/table-marketplace.php',
        type: "POST",
        data:{this_value:this_value, date:date, todate:todate},
        cache: false,
        success: function(data){
            $('#table-market').html(data); 
        }
    });

}

function getTableItem(this_value, market, date, todate) {

    $.ajax({
        url: 'process/table-item.php',
        type: "POST",
        data:{this_value:this_value, market:market, date:date, todate:todate},
        cache: false,
        success: function(data){
            $('#table-items').html(data); 
        }
    });

}

function getTableCountry(this_value, market, date, todate) {

    $.ajax({
        url: 'process/table-country.php',
        type: "POST",
        data:{this_value:this_value, market:market, date:date, todate:todate},
        cache: false,
        success: function(data){
            $('#table-country').html(data); 
        }
    });

}

// Sales Summary

function getTotalSales(this_value, market, date, todate) {
    $.ajax({
        url:'process/total_sales.php',
        method:"POST",
        data:{this_value:this_value, market:market, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            let sum   = 0;
            let count = 0;
            $.each(data, function(i, jsonData){
                sum = sum + Number(jsonData.TOTAL);
            count ++;
            });
            $('.total-sales').text(sum);
            $('.avg-sales').text(Math.floor(Number(sum / count)));
    }
    });
}

function getTotalItem(this_value, market, date, todate) {
    $.ajax({
        url:'process/total_item.php',
        method:"POST",
        data:{this_value:this_value, market:market, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            $('.total_ppt_text').text(data['0']['PPT']);
            $('.total_keynote_text').text(data['1']['KY']);
            $('.total_potrait_text').text(data['2']['PT']);
            $('#report_start').text(data['3']['start']);
            $('#report_end').text(data['4']['end']);
            $('#totdat-day').text(data['5']['totdat_days']+' Days');
        }
    });
}

function getSalesRate(this_value, market, date, todate) {
    $.ajax({
        url:"process/sales_rate.php",
        method:"POST",
        data:{this_value:this_value, market:market, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            $('.sales-rate').text(Number(data.rate).toFixed(0))
            let jum = Number(data.rate).toFixed(0);

            if(jum < 0){
            document.getElementById("plus-rate").innerHTML = "";
            document.getElementById("title-rate").style.color="#FFF";
            document.getElementById("presentage").style.color="#FFF";

            document.getElementById("plus-shape").style.backgroundColor ="#FFF";
            document.getElementById("plus-image").src="../../src/image/Polygon 1 (1).png";
            }else if(jum > 0){
            document.getElementById("plus-rate").innerHTML = "+";
            document.getElementById("plus-rate").style.color="#FFF";
            document.getElementById("title-rate").style.color="#FFF";
            document.getElementById("presentage").style.color="#FFF";

            document.getElementById("plus-shape").style.backgroundColor ="#FFF";
            document.getElementById("plus-image").src="../../src/image/Polygon 1.png";
            }else if(jum == 0){
            document.getElementById("plus-rate").innerHTML = "";
            document.getElementById("title-rate").style.color="#FFF";
            document.getElementById("presentage").style.color="#FFF";

            document.getElementById("plus-shape").style.backgroundColor ="#FFF";
            document.getElementById("plus-image").src="../../src/image/Polygon 1.png";
            }
        }
    });
}

// Info

function getInfo(this_value, market, date, todate) {
    $.ajax({
        url:'process/info.php',
        method:"POST",
        data:{this_value:this_value, market:market, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            $('#num-upl').text(data['0']['UPLOAD']);
            $('#num-upd').text(data['0']['UPDATE']);
            $('#min-upl').text(data['0']['UPLOAD_MIN']);
            $('#min-upd').text(data['0']['UPDATE_MIN']);
        }
    });
}

function search_all_m() {
    var s = document.getElementById("search");
    var search = s.value;
  
    
  }

var btn_more_detail = document.getElementById('btn_more_detail');
var btn_more_country = document.getElementById('btn_more_country');

btn_more_detail.addEventListener('click', () => {

    var p_market = document.getElementById("param_more_market").value;
    var date = document.getElementById("param_more_date").value;
    var todate = document.getElementById("param_more_todate").value;
    if(todate.length != 0){
    window.location.assign("in/item-download.php?market=All%20Marketplace&type="+p_market+"&date="+date+"&todate="+todate)
    }else{
    window.location.assign("in/item-download.php?market=All%20Marketplace&type="+p_market+"&date="+date)
    }
});

btn_more_country.addEventListener('click', () => {

    var p_market = document.getElementById("param_more_market").value;
    var date = document.getElementById("param_more_date").value;
    var todate = document.getElementById("param_more_todate").value;
    if(todate.length != 0){
    window.location.assign("in/top-country.php?market=All%20Marketplace&type="+p_market+"&date="+date+"&todate="+todate)
    }else{
    window.location.assign("in/top-country.php?market=All%20Marketplace&type="+p_market+"&date="+date)
    }
});

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

    if(market != 'Templatemonster' && market != 'Creativemarket'){
        document.getElementById("title_info").innerHTML = "This Month";
    }

    document.getElementById("param_more_date").value = "One%20Month%20Last";
    document.getElementById("param_more_date").value = "One%20Month%20Last";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=One%20Month%20Last"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=One%20Month%20Last"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=One%20Month%20Last"; 

    document.getElementById("opt-be").value = "?market=GR-Brandearth&date=One%20Month%20Last";
    document.getElementById("opt-rrg").value = "?market=GR-RRGraph&date=One%20Month%20Last";
    document.getElementById("opt-tm").value = "?market=Templatemonster&date=One%20Month%20Last";
    document.getElementById("opt-cm").value = "?market=Creativemarket&date=One%20Month%20Last";
    document.getElementById("opt-rrs").value = "?market=RRSlide&date=One%20Month%20Last";
    document.getElementById("opt-all").value = "?market=All Marketplace&date=One%20Month%20Last";

    var this_value = document.getElementById("this_date").value;
    getTotalSales(this_value, market)
    getTotalItem(this_value, market)
    getSalesRate(this_value, market)
    loadBarChart(this_value, market)
    loadCircleChart(this_value)
    getTableMarketplace(this_value)
    getTableItem(this_value, market)
    getTableCountry(this_value, market)
    getInfo(this_value, market)

});

btn_30.addEventListener('click', () => {

    btn_30.classList.add('but-active');
    
    btn_costum.classList.remove('but-costum-active');
    btn_this.classList.remove('but-active');
    btn_one_year.classList.remove('but-active');
    dd_costum.classList.remove('but-active');

    if(market != 'Templatemonster' && market != 'Creativemarket'){
        document.getElementById("title_info").innerHTML = "30 Days";
    }
    document.getElementById("param_more_date").value = "30%20Days";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=30%20Days"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=30%20Days"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=30%20Days"; 

    document.getElementById("opt-be").value = "?market=GR-Brandearth&date=30%20Days";
    document.getElementById("opt-rrg").value = "?market=GR-RRGraph&date=30%20Days";
    document.getElementById("opt-tm").value = "?market=Templatemonster&date=30%20Days";
    document.getElementById("opt-cm").value = "?market=Creativemarket&date=30%20Days";
    document.getElementById("opt-rrs").value = "?market=RRSlide&date=30%20Days";
    document.getElementById("opt-all").value = "?market=All Marketplace&date=30%20Days";
    
    var this_value = document.getElementById("30_date").value;
    getTotalSales(this_value, market)
    getTotalItem(this_value, market)
    getSalesRate(this_value, market)
    loadBarChart(this_value, market)
    loadCircleChart(this_value)
    getTableMarketplace(this_value)
    getTableItem(this_value, market)
    getTableCountry(this_value, market)
    getInfo(this_value, market)
});

date_todate.addEventListener('click', () => {

    btn_costum.classList.add('but-costum-active');

    btn_this.classList.remove('but-active');
    btn_30.classList.remove('but-active');
    btn_one_year.classList.remove('but-active');
    dd_costum.classList.remove('but-active');

    var this_value = document.getElementById("date_todate").value;
    var costum_value = document.getElementById("report").innerHTML;

    if(market != 'Templatemonster' && market != 'Creativemarket'){
        document.getElementById("title_info").innerHTML = costum_value;
    }

    var date = costum_value.substr(0, 10);
    var todate = costum_value.substr(14, 24);

    document.getElementById("param_more_date").value = date;
    document.getElementById("param_more_todate").value = todate;

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date="+date+"&todate="+todate; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date="+date+"&todate="+todate; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date="+date+"&todate="+todate; 

    document.getElementById("opt-be").value = "?market=GR-Brandearth&date="+date+"&todate="+todate;
    document.getElementById("opt-rrg").value = "?market=GR-RRGraph&date="+date+"&todate="+todate;
    document.getElementById("opt-tm").value = "?market=Templatemonster&date="+date+"&todate="+todate;
    document.getElementById("opt-cm").value = "?market=Creativemarket&date="+date+"&todate="+todate;
    document.getElementById("opt-rrs").value = "?market=RRSlide&date="+date+"&todate="+todate;
    document.getElementById("opt-all").value = "?market=All Marketplace&date="+date+"&todate="+todate;

    getTotalSales(this_value, market, date, todate)
    getTotalItem(this_value, market, date, todate)
    getSalesRate(this_value, market, date, todate)
    loadBarChart(this_value, market, date, todate)
    loadCircleChart(this_value, date, todate)
    getTableMarketplace(this_value, date, todate)
    getTableItem(this_value, market, date, todate)
    getTableCountry(this_value, market, date, todate)
    loadEasyCirle(this_value, market)
    getInfo(this_value, market, date, todate)
});

btn_one_year.addEventListener('click', () => {

    btn_one_year.classList.add('but-active');
    
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');
    dd_costum.classList.remove('but-active');

    if(market != 'Templatemonster' && market != 'Creativemarket'){
        document.getElementById("title_info").innerHTML = 'One Year';
    }

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=One%20Year%20Last"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=One%20Year%20Last"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=One%20Year%20Last"; 

    document.getElementById("param_more_date").value = "One%20Year%20Last";
    document.getElementById("opt-be").value = "?market=GR-Brandearth&date=One%20Year%20Last";
    document.getElementById("opt-rrg").value = "?market=GR-RRGraph&date=One%20Year%20Last";
    document.getElementById("opt-tm").value = "?market=Templatemonster&date=One%20Year%20Last";
    document.getElementById("opt-cm").value = "?market=Creativemarket&date=One%20Year%20Last";
    document.getElementById("opt-rrs").value = "?market=RRSlide&date=One%20Year%20Last";
    document.getElementById("opt-all").value = "?market=All Marketplace&date=One%20Year%20Last";

    var this_value = document.getElementById("one_year_date").value;
    getTotalSales(this_value, market)
    getTotalItem(this_value, market)
    getSalesRate(this_value, market)
    loadBarChart(this_value, market)
    loadCircleChart(this_value)
    getTableMarketplace(this_value)
    getTableItem(this_value, market)
    getTableCountry(this_value, market)
    loadEasyCirle(this_value, market)
    getInfo(this_value, market)
});

var btnLastMonth = document.getElementById('last_month');

btnLastMonth.addEventListener('click', () => {

    dd_costum.classList.add('but-active');

    btn_one_year.classList.remove('but-active');
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');

    var this_value = document.getElementById("last_month").value;
    document.getElementById("param_more_date").value = "Last%20Month";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=Last%20Month"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=Last%20Month"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=Last%20Month";

    document.getElementById("opt-be").value = "?market=GR-Brandearth&date=Last%20Month";
    document.getElementById("opt-rrg").value = "?market=GR-RRGraph&date=Last%20Month";
    document.getElementById("opt-tm").value = "?market=Templatemonster&date=Last%20Month";
    document.getElementById("opt-cm").value = "?market=Creativemarket&date=Last%20Month";
    document.getElementById("opt-rrs").value = "?market=RRSlide&date=Last%20Month";
    document.getElementById("opt-all").value = "?market=All Marketplace&date=Last%20Month";

    getTotalSales(this_value, market)
    getTotalItem(this_value, market)
    loadBarChart(this_value, market)
    getSalesRate(this_value, market)
    loadCircleChart(this_value)
    getTableMarketplace(this_value)
    getTableItem(this_value, market)
    getTableCountry(this_value, market)
    loadEasyCirle(this_value, market)
    getInfo(this_value, market)

    if(market != 'Templatemonster' && market != 'Creativemarket'){
        document.getElementById("title_info").innerHTML = 'Last Month';
    }

});

var btnLastYear = document.getElementById('last_year');

btnLastYear.addEventListener('click', () => {

    dd_costum.classList.add('but-active');

    btn_one_year.classList.remove('but-active');
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');
    
    var this_value = document.getElementById("last_year").value;

    document.getElementById("param_more_date").value = "Last Year";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=Last%20Year"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=Last%20Year"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=Last%20Year";

    document.getElementById("opt-be").value = "?market=GR-Brandearth&date=Last%20Year";
    document.getElementById("opt-rrg").value = "?market=GR-RRGraph&date=Last%20Year";
    document.getElementById("opt-tm").value = "?market=Templatemonster&date=Last%20Year";
    document.getElementById("opt-cm").value = "?market=Creativemarket&date=Last%20Year";
    document.getElementById("opt-rrs").value = "?market=RRSlide&date=Last%20Year";
    document.getElementById("opt-all").value = "?market=All Marketplace&date=Last%20Year";

    getTotalSales(this_value, market)
    getTotalItem(this_value, market)
    loadBarChart(this_value, market)
    getSalesRate(this_value, market)
    loadCircleChart(this_value)
    getTableMarketplace(this_value)
    getTableItem(this_value, market)
    getTableCountry(this_value, market)
    loadEasyCirle(this_value, market)
    getInfo(this_value, market)

    if(market != 'Templatemonster' && market != 'Creativemarket'){
        document.getElementById("title_info").innerHTML = 'Last%20Year';
    }

});

var btnAllTime = document.getElementById('all_time');

btnAllTime.addEventListener('click', () => {

    dd_costum.classList.add('but-active');

    btn_one_year.classList.remove('but-active');
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');
    
    var this_value = document.getElementById("all_time").value;
    document.getElementById("param_more_date").value = "All%20Time";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=All%20Time"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=All%20Time"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=All%20Time";

    document.getElementById("opt-be").value = "?market=GR-Brandearth&date=All%20Time";
    document.getElementById("opt-rrg").value = "?market=GR-RRGraph&date=All%20Time";
    document.getElementById("opt-tm").value = "?market=Templatemonster&date=All%20Time";
    document.getElementById("opt-cm").value = "?market=Creativemarket&date=All%20Time";
    document.getElementById("opt-rrs").value = "?market=RRSlide&date=All%20Time";
    document.getElementById("opt-all").value = "?market=All Marketplace&date=All%20Time";

    getTotalSales(this_value, market)
    getTotalItem(this_value, market)
    loadBarChart(this_value, market)
    getSalesRate(this_value, market)
    loadCircleChart(this_value)
    getTableMarketplace(this_value)
    getTableItem(this_value, market)
    getTableCountry(this_value, market)
    loadEasyCirle(this_value, market)
    getInfo(this_value, market)

    if(market != 'Templatemonster' && market != 'Creativemarket'){
        document.getElementById("title_info").innerHTML = 'All Time';
    }

});

var btnThisYear = document.getElementById('this_year');

btnThisYear.addEventListener('click', () => {

    dd_costum.classList.add('but-active');

    btn_one_year.classList.remove('but-active');
    btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');
    
    var this_value = document.getElementById("this_year").value;
    document.getElementById("param_more_date").value = "This%20Year";

    document.getElementById('href-all').href = "../all marketplace/all-marketplace.php?market=All Marketplace&date=This%20Year"; 
    document.getElementById('href-frb').href = "../freebies/freebies.php?market=All Marketplace&type=freebies&date=This%20Year"; 
    document.getElementById('href-nl').href = "../news letter/news_letter.php?market=All Marketplace&date=This%20Year";

    document.getElementById("opt-be").value = "?market=GR-Brandearth&date=This%20Year";
    document.getElementById("opt-rrg").value = "?market=GR-RRGraph&date=This%20Year";
    document.getElementById("opt-tm").value = "?market=Templatemonster&date=This%20Year";
    document.getElementById("opt-cm").value = "?market=Creativemarket&date=This%20Year";
    document.getElementById("opt-rrs").value = "?market=RRSlide&date=This%20Year";
    document.getElementById("opt-all").value = "?market=All Marketplace&date=This%20Year";

    getTotalSales(this_value, market)
    getTotalItem(this_value, market)
    loadBarChart(this_value, market)
    getSalesRate(this_value, market)
    loadCircleChart(this_value)
    getTableMarketplace(this_value)
    getTableItem(this_value, market)
    getTableCountry(this_value, market)
    loadEasyCirle(this_value, market)
    getInfo(this_value, market)

    if(market != 'Templatemonster' && market != 'Creativemarket'){
        document.getElementById("title_info").innerHTML = 'All Time';
    }

});