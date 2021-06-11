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
var id = getUrlParameter('id');
var name = getUrlParameter('name');
var date = getUrlParameter('date');
var todate = getUrlParameter('todate');

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(loadBarChartCategory);
google.charts.setOnLoadCallback(loadBarChartSubCategory);

function loadBarChartCategory()
{   
    $.ajax({
        url:"process/category-chart.php",
        method:"POST",
        data:{type:type, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            drawBarChartCategory(data);
            console.log(data);
        }
        
    });
}

function drawBarChartCategory(chart_data) {
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
    legend: {position: 'none',maxLines: 20}, 
      // legend: {alignment: 'center'},
    bar: {groupWidth: '50%'},
    series: {
        0: {
        annotations: {
            textStyle: {fontSize: 12, color: '#52575C', fontName: 'Poppins', opacity: 0 },
            stem: {
                color: 'none', length: '12',
            },

        },
        color: "#4F99FF",
        }
    },
    chartArea: {width: '100%',
        top: 60,
        left: 200,
        right: 50,
        bottom: 20,
        height: '100%'
    },
    height: 1000,
    lineWidth: 1,
    pointsVisible: true,
    bars: 'horizontal',
    hAxis: 
        {textStyle:{color: '#C0C7CE', fontName: 'Poppins', fontSize: '14'},
        gridlines: {color: '#e2e2e2'},
        baselineColor: {color: '#e2e2e2'}
    },
    vAxis: 
        {textStyle:{color: '#000', fontName: 'Poppins', fontSize: '12'},
            gridlines: {color: '#e2e2e2'},
            }
                        
    };


    var chart = new google.visualization.BarChart(document.getElementById("category-chart"));
    google.visualization.events.addListener(chart, 'select', function() {
        if(todate === undefined){
            document.location.href = "subcategory-bar.php?market=All%20Marketplace&type=All&name="+data.getValue(chart.getSelection()[0].row, 0)+"&date="+date;
        }else{
            document.location.href = "subcategory-bar.php?market=All%20Marketplace&type=All&name="+data.getValue(chart.getSelection()[0].row, 0)+"&date="+date+"&todate="+todate;
        }
    });
    
    chart.draw(view, options);
    $(window).resize(function(){
        chart.draw(view, options);
    });
}

function loadBarChartCategorySearch(type, date, todate, search)
{   
    $.ajax({
        url:"process/category-chart-search.php",
        method:"POST",
        data:{type:type, date:date, todate:todate, search:search},
        dataType:"JSON",
        success:function(data)
        {
            drawBarChartCategory(data);
        }
        
    });
}

function search_bar() {
    var s = document.getElementById("search");
    var search = s.value;
    loadBarChartCategorySearch(type, date, todate, search)
  
}

function loadBarChartSubCategory()
{   
    $.ajax({
        url:"process/subcategory-chart.php",
        method:"POST",
        data:{type:type, name:name, date:date, todate:todate},
        dataType:"JSON",
        success:function(data)
        {
            drawBarChartSubCategory(data);
        }
        
    });
}

function drawBarChartSubCategory(chart_data) {
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
    legend: {position: 'none',maxLines: 20}, 
    // legend: {alignment: 'center'},
    bar: {groupWidth: '90%'},
    series: {
        0: {
        annotations: {
            textStyle: {fontSize: 12, color: '#52575C', fontName: 'Poppins', opacity: 0 },
            stem: {
                color: 'none', length: '12',
            },

        },
        color: "#3365FF",
        }
    },
    chartArea: {width: '100%',
        top: 60,
        left: 100,
        right: 50,
        bottom: 20,
        height: '100%'
    },
    height: 1000,
    lineWidth: 1,
    pointsVisible: true,

    hAxis: 
        {textStyle:{color: '#C0C7CE', fontName: 'Poppins', fontSize: '14'},
        gridlines: {color: '#e2e2e2'},
        baselineColor: {color: '#e2e2e2'}
    },
    vAxis: 
        {textStyle:{color: '#000', fontName: 'Poppins', fontSize: '14'},
            gridlines: {color: '#e2e2e2'},
            }
                        
    };


    var chart = new google.visualization.BarChart(document.getElementById("subcategory-chart"));
    // google.visualization.events.addListener(chart, 'select', function() {
    //     // alert(data.getValue(chart.getSelection()[0].row, 0));
    //     document.location.href = "subcategory-bar.php?market=All%20Marketplace&item=All&name="+data.getValue(chart.getSelection()[0].row, 0);
    // });
    chart.draw(view, options);
    $(window).resize(function(){
        chart.draw(view, options);
    });
}

function loadBarChartSubCategorySearch(type, name, date, todate, search)
{   
    $.ajax({
        url:"process/subcategory-chart-search.php",
        method:"POST",
        data:{type:type, name:name, date:date, todate:todate, search:search},
        dataType:"JSON",
        success:function(data)
        {
            drawBarChartSubCategory(data);
        }
        
    });
}

function search_subcat() {
    var s = document.getElementById("search");
    var search = s.value;
    loadBarChartSubCategorySearch(type, name, date, todate, search)
  
}

// Category Setting

function getTableCategory(type, search, id) {

    $.ajax({
        url: 'process/search-table-category.php',
        type: "POST",
        data:{type:type, search:search, id:id},
        cache: false,
        success: function(data){
            $('#table-category').html(data); 
        }
    });

}

function search_catset() {
    var s = document.getElementById("search");
    var search = s.value;
    getTableCategory(type, search, id)
    console.log(search);
}
