$(document).ready(function() {
    $.ajax({
      type: "GET",
      url: "php/modify.php", 
      dataType: "json",
      success: function(response) {
        $("#mytable tbody").empty();
       
       
        var len = response.length
        for (var i = 0; i < len; i++) {
        var id = response[i].id
        var user_id = response[i].userid
        var post_name = response[i].Title
        var post_description = response[i].Description
        var tr_str =
            '<tr>' +
            '<td>' + id + '</td>' +
            '<td>' + user_id + '</td>' +
            '<td>' + post_name +  '</td>' +
            '<td>' +  post_description +  '</td>' + '</tr>'
            $('#mytable tbody').append(tr_str);
      }
    }, error: function(xhr, status, error) {
        console.log("Error:", error);
    }

    });
  });
  