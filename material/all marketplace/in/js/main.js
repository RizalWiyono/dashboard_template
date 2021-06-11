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
        var href = '?market='+market+'&date='+picker.startDate.format('YYYY-MM-DD')+'&type='+type+'&todate='+picker.endDate.format('YYYY-MM-DD');
        window.location.href = href;
        console.log(market);
        });

      $('#costum_date').daterangepicker({
          startDate: start,
          endDate: end,
          maxDate: max,
          minDate: min,
          // ranges: {
          // 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          // 'This Month': [moment().startOf('month'), moment().endOf('month')],
          // 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              
          // }
      }, cb);
  
  
      cb(start, end);
  
    });
  
    $(function() {
  
      var start = moment().subtract(29, 'days');
      var end = moment();
      var max = data['1']['month']+'/'+data['1']['day']+'/'+data['1']['year'];
      var min = data['0']['month']+'/'+data['0']['day']+'/'+data['0']['year'];
  
      function cb(start, end) {
          $('#report').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
          
      }
  
      $ ( '#costum_sub' ) . on ( 'apply.daterangepicker' ,  function ( ev ,  picker )  {
        var href = '?market='+market+'&date='+picker.startDate.format('YYYY-MM-DD')+'&type='+type+'&name='+name+'&todate='+picker.endDate.format('YYYY-MM-DD');
        window.location.href = href;
        console.log(market);
        });

      $('#costum_sub').daterangepicker({
          startDate: start,
          endDate: end,
          maxDate: max,
          minDate: min,
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


window.onload = function(){
    setTimeout(function() {
    
    document.getElementById('one_year_detail').click();
    },100);
        
        var scriptTag = document.createElement("script");
    //   scriptTag.src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js";
        document.getElementsByTagName("head")[0].appendChild(scriptTag);
}

// $(document).ready(function() {
//   var ckbox = $("input[name='type[]']");
//   var chkId = '';
//   $('input').on('click', function() {
    
//     if (ckbox.is(':checked')) {
//       $("input[name='type[]']:checked").each ( function() {
//                chkId = $(this).val() + ",";
//         chkId = chkId.slice(0, -1);
//        });
       
//        console.log(chkId); // return value of checkbox checked
//     }     
//   });
// });

var mySelect = new BVSelect({
  selector: "#selectbox",
  offset: true
});

var mySelect = new BVSelect({
  selector: "#coba",
  offset: true
});

