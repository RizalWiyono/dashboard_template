  $.ajax({
      url:"process/notif.php",
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
      url:"process/notif.php",
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

  $.ajax({
      url: 'process/view.php',
      type: "POST",
      data:{},
      cache: false,
      success: function(data){
          $('#table-team').html(data);
      }
  });
}, 1000);

var mySelect = new BVSelect({
    selector: "#selectbox",
    offset: true
});

function updateAccount(value)
{   
    $.ajax({
        url:"process/update.php",
        method:"POST",
        data:{value:value},
        dataType:"JSON",
        success:function(data)
        {
          console.log(value);
        }
        
    });
}

function getvalue() {
  var value = event.target.value;
  console.log(value);
  updateAccount(value);
}
