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
var this_value = getUrlParameter('date');
var this_values = getUrlParameter('todate');
var name = getUrlParameter('item');
var type = getUrlParameter('type');
var id = getUrlParameter('id');

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(loadBarChartCountry);
// google.charts.setOnLoadCallback(drawMultSeries);

function loadBarChartCountry()
{   
    $.ajax({
        url:"process/country-chart.php",
        method:"POST",
        data:{this_value:this_value, this_values:this_values, type:type},
        dataType:"JSON",
        success:function(data)
        {
          drawChartCountry(data);
        }
        
    });
}

function drawChartCountry(chart_data) {
  var jsonData = chart_data;
  var data = new google.visualization.DataTable();

  data.addColumn('string', 'Month');
    data.addColumn('number', 'Total');
    $.each(jsonData, function(i, jsonData){
        var COUNTRY = jsonData.COUNTRY;
        var TOTAL = parseFloat($.trim(jsonData.TOTAL));
        data.addRows([[COUNTRY, TOTAL]]);
        
    });
    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" }
                      ]);

    var options = {
    allowHtml: true,
    // legend: {alignment: 'center'},
    legend: {position: 'none',maxLines: 20}, 
    bar: {groupWidth: '90%'},
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
    chartArea: {width: '100%',
        top: 60,
        left: 150,
        right: 30,
        bottom: 20,
        height: '100%'
    },
    height: 2800,
    lineWidth: 1,
    pointsVisible: true,

    hAxis: 
        {textStyle:{color: '#C0C7CE', fontName: 'Poppins', fontSize: '14'},
        gridlines: {color: '#e2e2e2'},
        baselineColor: {color: '#e2e2e2'}
    },
    vAxis: 
        {textStyle:{color: '#000', fontName: 'Poppins', fontSize: '14', bold: true},
            gridlines: {color: '#e2e2e2'},
            }
                        
    };
    var chart = new google.visualization.BarChart(document.getElementById("country-chart"));
    chart.draw(view, options);
}

function loadBarChartCountrySearch(this_value, this_values, type, search)
{   
  // console.log();
    $.ajax({
        url:"process/country-chart-search.php",
        method:"POST",
        data:{this_value:this_value, this_values:this_values, type:type, search:search},
        dataType:"JSON",
        success:function(data)
        {
          drawChartCountry(data);
        }
        
    });
}

function search_country() {
  var s = document.getElementById("search");
  var search = s.value;
  loadBarChartCountrySearch(this_value, this_values, type, search)

  // if(search.length >= 1){
  //     $('#select_count').prop('disabled', 'disabled');
  // }else{
  //     $('#select_count').prop('disabled', false);
  // }
}

// $(document).ready(function(){
//   $("select.select-country").change(function(){
//       var select = $(this).children("option:selected").val();
//       console.log(select);
//       // loadBarChartCountry(this_value, name, date, todate);
//   });
// });

// Item Details

function loadBarChartDetails(this_value, name, date, todate)
{   
    $.ajax({
        url:"process/barchart-detail.php",
        method:"POST",
        data:{this_value:this_value, name:name, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
          drawBarChartDetails(data);
          console.log(data);
      }
        
    });
}

function drawBarChartDetails(chart_data)
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
              textStyle: {fontSize: 12, color: '#52575C', fontName: 'Poppins', opacity: 0 },
              stem: {
                  color: 'none', length: '12',
              },

            },
            color: "#DDDDDD",
          },
          1: {
            annotations: {
              textStyle: {fontSize: 12, color: '#52575C', fontName: 'Poppins'},
              stem: {
                  color: 'none', length: '12',
              },
            },
            color: "#3365FF",
          }
        },
      curveType: 'function',
      chartArea: {width: '100%',
      top: 40,
      left: 40,
      right: 20,
      bottom: 20,
    },
    lineWidth: 3,
    // pointsVisible: true,

    hAxis: 
        {textStyle:{color: '#C0C7CE', fontName: 'Poppins', fontSize: '14'}},
    vAxis: 
        {textStyle:{color: '#C0C7CE', fontName: 'Poppins', fontSize: '14'},
         gridlines: {color: '#e2e2e2'},
         }
    
  };

  var chart = new google.visualization.LineChart(document.getElementById('chart_area'));
  chart.draw(view, options);

  $(window).resize(function(){
    chart.draw(data, options);
  });
}

function getDetailCountry(this_value, name, date, todate)
{
  $.ajax({
    url: 'process/table-detail-country.php',
    type: "POST",
    data:{this_value:this_value, name:name, date:date, todate:todate},
    cache: false,
    success: function(data){
        $('#table-detail').html(data); 
        console.log(this_value)
    }
  });
}
// Top Items Details

function getTableItemView(this_value, this_values, type, select, this_value, this_values) {

  $.ajax({
      url: 'process/view-table-item.php',
      type: "POST",
      data:{this_value:this_value, this_values:this_values, type:type, select:select, date:this_value, todate:this_values},
      cache: false,
      success: function(data){
          $('#table-items').html(data); 
      }
  });

}

function getTableItemSearch(this_value, this_values, type, search) {

  $.ajax({
      url: 'process/search-table-item.php',
      type: "POST",
      data:{this_value:this_value, this_values:this_values, type:type, search:search},
      cache: false,
      success: function(data){
          $('#table-items').html(data); 
      }
  });

}

$(document).ready(function(){
  $("select.select-item").change(function(){
      var select = $(this).children("option:selected").val();
      getTableItemView(this_value, this_values, type, select, this_value, this_values)
  });
});

function search() {
  var s = document.getElementById("search");
  var search = s.value;
  getTableItemSearch(this_value, this_values, type, search)
  
  if(search.length >= 1){
      $('#select_count').prop('disabled', 'disabled');
  }else{
      $('#select_count').prop('disabled', false);
  }
}

function getCountryView(this_value, this_values, type, select)
{   
    $.ajax({
        url:"process/select-country.php",
        method:"POST",
        data:{this_value:this_value, this_values:this_values, type:type, select:select},
        dataType:"JSON",
        success:function(data)
        {
          drawChartCountry(data);
          console.log(select);
        }
        
    });
}

$(document).ready(function(){
  $("select.select-country").change(function(){
      var select = $(this).children("option:selected").val();
      getCountryView(this_value, this_values, type, select)
  });
});

// Item Type

function getTableItemSearchType(type, search, id) {

  $.ajax({
      url: 'process/search-table-type.php',
      method: "POST",
      data:{type:type, search:search, id:id},
      dataType:"text",
      cache: false,
      success: function(data){
        $('#employee_table').html(data); 
      }
  });

}

function getTableItemSearchItem(search) {

  $.ajax({
      url: 'process/search-table-it.php',
      type: "POST",
      data:{search:search},
      cache: false,
      success: function(data){
          $('#table-items').html(data); 
      }
  });

}

function getTableItemSelectType(type, select) {

  $.ajax({
      url: 'process/select-table-item.php',
      type: "POST",
      data:{type:type, select:select},
      cache: false,
      success: function(data){
          $('#table-items').html(data); 
      }
  });

}

$(document).ready(function(){
  $("select.select-upd").change(function(){
      var select = $(this).children("option:selected").val();
      getTableItemSelectType(type, select)
  });
});

function getTableItemSelectTypeAll(type, select) {

  $.ajax({
      url: 'process/select-all.php',
      type: "POST",
      data:{type:type, select:select},
      cache: false,
      success: function(data){
          $('#table-items').html(data); 
      }
  });

}

$(document).ready(function(){
  $("select.select-upd-all").change(function(){
      var select = $(this).children("option:selected").val();
      getTableItemSelectTypeAll(type, select)
  });
});


function search_upd() {
  var s = document.getElementById("search");
  var search = s.value;
  getTableItemSearchType(type, search, id)
  
  if(search.length >= 1){
      $('#select_count_upd').prop('disabled', 'disabled');
  }else{
      $('#select_count_upd').prop('disabled', false);
  }
}

function search_it() {
  var s = document.getElementById("search");
  var search = s.value;
  getTableItemSearchItem(search)
  
  if(search.length >= 1){
      $('#select_count').prop('disabled', 'disabled');
  }else{
      $('#select_count').prop('disabled', false);
  }
}

function getTableItemSearchTypeUpd(type, search) {

  $.ajax({
      url: 'process/search-upd.php',
      method: "POST",
      data:{type:type, search:search},
      dataType:"text",
      cache: false,
      success: function(data){
        $('#employee_table').html(data); 
      }
  });

}

function search_upd_count() {
  var s = document.getElementById("search");
  var search = s.value;
  getTableItemSearchTypeUpd(type, search)
  
  if(search.length >= 1){
      $('#select_count').prop('disabled', 'disabled');
  }else{
      $('#select_count').prop('disabled', false);
  }
}

function getTableItemSearchTypeAll(type, search) {

  $.ajax({
      url: 'process/search-all.php',
      method: "POST",
      data:{type:type, search:search},
      dataType:"text",
      cache: false,
      success: function(data){
        $('#table-items').html(data); 
      }
  });

}

function search_all() {
  var s = document.getElementById("search");
  var search = s.value;
  getTableItemSearchTypeAll(type, search)
  
  if(search.length >= 1){
      $('#select_count').prop('disabled', 'disabled');
  }else{
      $('#select_count').prop('disabled', false);
  }
}

function search_tools() {
  var s = document.getElementById("search");
  var searchs = s.value;
  
}

function getTableItemSelectType() {

  $.ajax({
      url: 'process/select-table-item.php',
      type: "POST",
      data:{type:type, select:select},
      cache: false,
      success: function(data){
          $('#table-items').html(data); 
      }
  });

}

function getTableItemSelectTypeUpd(select, type) {

  $.ajax({
      url: 'process/select-upd.php',
      type: "POST",
      data:{select:select, type:type},
      cache: false,
      success: function(data){
        $('#employee_table').html(data); 
      }
  });

}

$(document).ready(function(){
  $("select.select-upd-count").change(function(){
      var select = $(this).children("option:selected").val();
      getTableItemSelectTypeUpd(select, type)
  });
});



var btn_this = document.getElementById('this_detail');
var btn_30 = document.getElementById('30_detail');
var btn_one_year = document.getElementById('one_year_detail');
var date_todate = document.getElementById('date_todate');
var btn_costum = document.getElementById('costum_date');
var btn_last_month = document.getElementById('last_month_detail');
var btn_this_year = document.getElementById('this_year_detail');
var btn_year = document.getElementById('last_year_detail');
var btn_all = document.getElementById('all_time_detail');
var dropdown = document.getElementById('dropdownMenu2');

btn_costum.addEventListener('click', () => {

    btn_costum.classList.add('but-costum-active');

    btn_this.classList.remove('but-active');
    btn_30.classList.remove('but-active');
    btn_one_year.classList.remove('but-active');

});

date_todate.addEventListener('click', () => {

  btn_costum.classList.add('but-costum-active');

  btn_this.classList.remove('but-active');
  btn_30.classList.remove('but-active');
  btn_one_year.classList.remove('but-active');

  var this_value = document.getElementById("date_todate").value;
  var costum_value = document.getElementById("report").innerHTML;

  var date = costum_value.substr(0, 10);
  var todate = costum_value.substr(14, 24);

  loadBarChartDetails(this_value, name, date, todate)
  getDetailCountry(this_value, name, date, todate)
});

btn_this.addEventListener('click', () => {

    btn_this.classList.add('but-active');
    
    // btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_one_year.classList.remove('but-active');

    var this_value = document.getElementById("this_detail").value;
    loadBarChartDetails(this_value, name)
    getDetailCountry(this_value, name)
    
});

btn_30.addEventListener('click', () => {

    btn_30.classList.add('but-active');
    
    // btn_costum.classList.remove('but-costum-active');
    btn_this.classList.remove('but-active');
    btn_one_year.classList.remove('but-active');

    var this_value = document.getElementById("30_detail").value;
    loadBarChartDetails(this_value, name)
    getDetailCountry(this_value, name)
});

btn_one_year.addEventListener('click', () => {

    btn_one_year.classList.add('but-active');
    
    // btn_costum.classList.remove('but-costum-active');
    btn_30.classList.remove('but-active');
    btn_this.classList.remove('but-active');

    var this_value = document.getElementById("one_year_detail").value;
    loadBarChartDetails(this_value, name)
    getDetailCountry(this_value, name)
});

btn_last_month.addEventListener('click', () => {

  dropdown.classList.add('but-active');
  
  btn_one_year.classList.remove('but-active');
  btn_costum.classList.remove('but-costum-active');
  btn_30.classList.remove('but-active');
  btn_this.classList.remove('but-active');

  var this_value = document.getElementById("last_month_detail").value;
  loadBarChartDetails(this_value, name)
  // loadBarChartCountry(this_value, name, date, todate)
  getDetailCountry(this_value, name)
});

btn_year.addEventListener('click', () => {

  dropdown.classList.add('but-active');
  
  btn_one_year.classList.remove('but-active');
  btn_costum.classList.remove('but-costum-active');
  btn_30.classList.remove('but-active');
  btn_this.classList.remove('but-active');

  var this_value = document.getElementById("last_year_detail").value;
  loadBarChartDetails(this_value, name)
  getDetailCountry(this_value, name)
});

btn_this_year.addEventListener('click', () => {

  dropdown.classList.add('but-active');
  
  btn_one_year.classList.remove('but-active');
  btn_costum.classList.remove('but-costum-active');
  btn_30.classList.remove('but-active');
  btn_this.classList.remove('but-active');

  var this_value = document.getElementById("this_year_detail").value;
  loadBarChartDetails(this_value, name)
  getDetailCountry(this_value, name)
});

btn_all.addEventListener('click', () => {

  dropdown.classList.add('but-active');
  
  btn_one_year.classList.remove('but-active');
  btn_costum.classList.remove('but-costum-active');
  btn_30.classList.remove('but-active');
  btn_this.classList.remove('but-active');

  var this_value = document.getElementById("all_time_detail").value;
  loadBarChartDetails(this_value, name)
  getDetailCountry(this_value, name)
});

var it_upd = document.getElementById('it_upd');

it_upd.addEventListener('click', () => {

  var but = document.getElementById("it_upd").value;
});