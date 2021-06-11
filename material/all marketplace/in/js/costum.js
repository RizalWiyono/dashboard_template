$.ajax({
	url:"../../team/process/notif.php",
	method:"GET",
	data:{},
	dataType:"JSON",
	success:function(data)
	{
	  document.getElementById("notif").innerHTML = data['0']['count'];
	  if(data['0']['count'] > 0){
		document.getElementById('notif-place').style.display = 'block';
	  }else{
		document.getElementById('notif-place').style.display = 'none';
	  }
	}
	
  });
  
  const interval = setInterval(function() {
  $.ajax({
	url:"../../team/process/notif.php",
	method:"GET",
	data:{},
	dataType:"JSON",
	success:function(data)
	{
	  document.getElementById("notif").innerHTML = data['0']['count'];
	  if(data['0']['count'] > 0){
		document.getElementById('notif-place').style.display = 'block';
	  }else{
		document.getElementById('notif-place').style.display = 'none';
	  }
	}
	
  });
  }, 1000);

$.ajax({
    url:"../process/mindate.php",
    method:"POST",
    dataType:"JSON",
    success:function(data)
    {
  
    $(function() {
  
      var start = moment().subtract(29, 'days');
      var end = moment();
      var max = data['1']['month']+'/'+data['1']['day']+'/'+data['1']['year'];
      var min = data['0']['month']+'/'+data['0']['day']+'/'+data['0']['year'];
  
      function cb(start, end) {
            $('#report').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));  
          
      }
  
      $ ( '#costum_date' ) . on ( 'apply.daterangepicker' ,  function ( ev ,  picker )  {
            $("#date_todate").click();
        });

      $('#costum_date').daterangepicker({
          startDate: start,
          endDate: end,
          maxDate: max,
          minDate: min,
          showDropdowns: true,
          // ranges: {
          // 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          // 'This Month': [moment().startOf('month'), moment().endOf('month')],
          // 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              
          // }
      }, cb);
  
  
      cb(start, end);
  
    });
  
  }
  });

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
    
	window.onload = function(){
	    setTimeout(function() {
	    if(date == 'One Month Last'){
    		document.getElementById('this_detail').click();
    	}if(date == '30 Days'){
    		document.getElementById('30_detail').click();
		}else if(date == 'One Year'){
    		document.getElementById('one_year_detail').click();
		}else if(date == 'Last Month'){
    		document.getElementById('last_month_detail').click();
		}else if(date == 'This Year'){
    		document.getElementById('this_year_detail').click();
		}else if(date == 'Last Year'){
    		document.getElementById('last_year_detail').click();
		}else if(date == 'All Time'){
    		document.getElementById('all_time_detail').click();
		}else if(todate.length != 0){
			$('#report').html(date + ' to ' + todate);
    		document.getElementById('date_todate').click();
		}
	    
	    
	    },100);
	        
	        var scriptTag = document.createElement("script");
	    //   scriptTag.src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js";
	        document.getElementsByTagName("head")[0].appendChild(scriptTag);
	}

// window.onload = function(){
//     setTimeout(function() {
    
//     document.getElementById('one_year_detail').click();
//     },100);
        
//         var scriptTag = document.createElement("script");
//     //   scriptTag.src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js";
//         document.getElementsByTagName("head")[0].appendChild(scriptTag);
// }

var mySelect = new BVSelect({
    selector: "#selectbox",
    offset: true
});