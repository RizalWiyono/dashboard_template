$(document).ready(function(){  
    $('#add').click(function(){  
         $('#insert').val("Insert");  
         $('#insert_form')[0].reset();  
    });  
    $(document).on('click', '.edit_data', function(){  
         var employee_id = $(this).attr("id");  
         $.ajax({  
              url:"fetch.php",  
              method:"POST",  
              data:{employee_id:employee_id},  
              dataType:"json",  
              success:function(data){  
                   $('#name').val(data.name);  
                   $('#param_like').val(data.name.substr(0, 7));  
                   $('#color').val(data.color);  
                   $('#employee_id').val(data.item_id);
                   document.getElementById("color_op").innerHTML = data.color;
                   $('#category').val(data.category);  
                   document.getElementById("category_op").innerHTML = data.category;
                   $('#sub_category').val(data.sub_category);  
                   document.getElementById("sub_category_op").innerHTML = data.sub_category;
                   $('#type').val(data.slug);  
                   document.getElementById("type_op").innerHTML = data.slug;
                   $('#insert').val("Update");  
                   $('#add_data_Modal').modal('show');  
              }  
         });  
    });  
    $('#insert_form').on("submit", function(event){  
         event.preventDefault();  
              $.ajax({  
                   url:"process/edit/insert.php",  
                   method:"POST",  
                   data:$('#insert_form').serialize(),  
                   beforeSend:function(){  
                        $('#insert').val("Inserting");  
                   },  
                   success:function(data){  
                        $('#insert_form')[0].reset();  
                        $('#add_data_Modal').modal('hide');  
                        $('#employee_table').html(data);  
                   }  
              });  
    });  
    $(document).on('click', '.view_data', function(){  
         var employee_id = $(this).attr("id");  
         if(employee_id != '')  
         {  
              $.ajax({  
                   url:"select.php",  
                   method:"POST",  
                   data:{employee_id:employee_id},  
                   success:function(data){  
                        $('#employee_detail').html(data);  
                        $('#dataModal').modal('show');  
                   }  
              });  
         }            
    });  
});  