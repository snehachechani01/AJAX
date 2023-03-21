$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "php/modify.php",
    dataType: "json",
    success: function (response) {
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
          '<td>' + post_name + '</td>' +
          '<td>' + post_description + '</td>' + 
          "<td><button class='deleteBtn' data-id='" + id + "'>Delete</button></td>" +
          "<td><button class='updateeBtn' data-id='" + id + "'>Update</button></td>" +
          "</tr>";
        $('#mytable tbody').append(tr_str);
    





      }
      $(".deleteBtn").on("click", function () {
        var id = $(this).data("id");
        var row = $(this).closest("tr");
        $.ajax({
          type: "POST",
          url: "php/delete.php",
          data: { id: id },
          success: function () {

            row.remove();
          }
        });
      });
      $(".updateeBtn").on("click", function () {
        var id = $(this).data("id");
        sessionStorage.setItem("id", id);
        window.location.href = 'edit.html';
        
        
        
    });

    }, error: function (xhr, status, error) {
      console.log("Error:", error);
    }

  });
});
