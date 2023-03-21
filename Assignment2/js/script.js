$(document).ready(function () {
    $('#form').submit(function (event) {
        var nameRegex = /^[A-Za-z]+$/
        var pwd = /^(?=.*[!@#$%^&*()\-_=+{}\[\]\\|;:\'",.<>\/?])(?=.{8,})/;
       

        var formData = {
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };
        if (!nameRegex.test(formData.fname)) {
            alert('Please enter valid First Name.')
            return false
          }
          if (!nameRegex.test(formData.lname)) {
            alert('Please enter a valid Last Name.')
            return false
          }
          if (!pwd.test(formData.password)) {
            alert('Password should be of minimum 8 characters and must contain a special character')
            return false
          }
      

  

        $.ajax({
            type: 'POST',
            url: 'php/signin.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function (response) {
                if (response[0]["success"]) {
                    alert(response[0].message);
                    window.location.href = "login.html";
                  
                }
                else{
                    alert(response[0].message);
                }
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            }
        });
        event.preventDefault();
    });
});


$(document).ready(function () {
    $('#tabledata').submit(function (event) {

        var formData = {
            userId: $('#userid').val(),
            title: $('#Post_title').val(),
            description: $('#Post_description').val(),
        };

        $.ajax({
            type: 'POST',
            url: 'php/insert.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function (response) {
                window.location.href = "view.html";
                $('#mytable tbody').empty()
                var len = response.length
                for (var i = 0; i < len; i++) {
                    var id = response[i].id
                    var userid = response[i].userId
                    var title = response[i].Title
                    var description = response[i].description
                    var tr_str =
                        '<tr>' +
                        '<td>' + id + '</td>' +
                        '<td>' + userid + '</td>' +
                        '<td>' + title + '</td>' +
                        '<td>' + description + '</td>' +
                        "<td><button  class='deleteBtn' data-id='" + id + "'>Delete</button></td>" +
                        '</tr>'
                    $('#mytable tbody').append(tr_str)
                    $('#title').val('')
                    $('#rating').val('')

                }
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            }
        });
        event.preventDefault();
    });
});

