$.ajax({
  url:"../team/process/notif.php",
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
  url:"../team/process/notif.php",
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

var mySelect = new BVSelect({
    selector: "#selectbox",
    offset: true
  });