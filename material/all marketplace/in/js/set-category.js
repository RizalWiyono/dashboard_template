// $('#tbl-list').DataTable( {
//     "order": false,
//     "ordering": false,
//     "info":     false
// } );

function edit_data() { 

    var e_id = document.querySelectorAll('#id');
    var e_name = document.querySelectorAll('#name');
    var e_color = document.querySelectorAll('#color');
    var e_category = document.querySelectorAll('#category');
    var e_subcategory = document.querySelectorAll('#sub_category');
    var array = [];

    for (var i = 0; i < e_color.length; i++) {
        array.push({id: e_id[i].value, color: e_color[i].value, category: e_category[i].value, subcategory: e_subcategory[i].value, name: e_name[i].value});
    }

    $.each(array, function(i, array){
        var param_id            = array.id;
        var name                = array.name;
        var param_name          = name.split(' ').slice(0,2).join(' ');
        var param_color         = array.color;
        var param_category      = array.category;
        var param_subcategory   = array.subcategory;
        console.log(param_color);

        $.ajax({
            url:"process/input-all-change.php",
            method:"POST",
            data:{param_id:param_id, param_category:param_category, param_subcategory:param_subcategory, param_name:param_name, param_color:param_color,},
            dataType:"JSON",
            success:function(data)
            {
                console.log(data);
            }
            
        });

    });

} 