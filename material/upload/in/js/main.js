

var filter  = document.getElementById('filter-btn');
filter.addEventListener('click', () => {
   

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
  
var url = getUrlParameter('id');

var e = document.getElementById("month");
var selecte = e.options[e.selectedIndex].value;

var f = document.getElementById("year");
var selectf = e.options[e.selectedIndex].value;

console.log(selecte);
console.log(selectf);

var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "rrgraph"
});

con.connect(function(err) {
  if (err) throw err;
  //Delete all customers with the address "Mountain 21":
  var sql = "DELETE FROM tb_sales WHERE id='1'";
  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("Number of records deleted: " + result.affectedRows);
  });
});


});
