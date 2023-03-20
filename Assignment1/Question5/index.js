$(document).ready(function () {
    $('tbody').empty();

    $('#myform').submit(function (event) {

        $('tbody').empty();

        var data1 = {
            title: $("#title").val(),
            rating: $("#rating").val(),
        };

        $.ajax({
            type: "POST",
            url: "insert.php",
            data: data1,
            dataType: "json",
            encode: true,
            success: function (response) {
                // Clear previous table rows
                $("#mytable tbody").empty();

                var len = response.length;
                for (var i = 0; i < len; i++) {
                    var id = response[i].id;
                    var title = response[i].title;
                    var rating = response[i].rating;
                    var tr_str = "<tr>" +
                        "<td>" + id + "</td>" +
                        "<td>" + title + "</td>" +
                        "<td>" + rating + "</td>" +
                        "<td><button class='deleteBtn' data-id='" + id + "'>Delete</button></td>" +
                        "</tr>";
                    $("#mytable tbody").append(tr_str);
                    $('#title').val('');
                    $('#rating').val('');
                }
                $('.deleteBtn').on('click', function () { console.log(111);
                    if (confirm('Are you sure you want to delete this item?')) {
                    var id = $(this).data("id");
                    var row = $(this).closest("tr");
                    $.ajax({
                        type: "POST",
                        url: "delete.php",
                        data: { id: id },
                        success: function () {

                            row.remove();
                        }
                    })
                }
            })
        }
    })
                        


        event.preventDefault();
   
    })
})
$(document).ready(function () {
    $('.up').on('click', function () { 
      sortTable(1, true)
    })
    $('.down').on('click', function () {
      sortTable(1, false)
    })
  
    $('.uprating').on('click', function () {
      sortTable(2, false)
    })
    $('.downrating').on('click', function () {
      sortTable(2, true)
    })

function sortTable(n, asc) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, cmp
    table = document.getElementById('mytable')
    switching = true
    dir = asc ? 1 : -1
    while (switching) {
        switching = false
        rows = table.rows
        for (i = 1; i < rows.length - 1; i++) {
            shouldSwitch = false
            x = rows[i].getElementsByTagName('TD')[n]
            y = rows[i + 1].getElementsByTagName('TD')[n]
            if (n === 2) {
                if (dir * Number(x.innerHTML) < dir * Number(y.innerHTML)) {
                    shouldSwitch = true
                    break
                }
            } else {
                cmp = x.innerHTML
                    .toLowerCase()
                    .localeCompare(y.innerHTML.toLowerCase())
                if (dir * cmp > 0) {
                    shouldSwitch = true
                    break
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i])
            switching = true
        }
    }
}

});






