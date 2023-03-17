<?php
include  'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$id=$_POST['ID'];
    $title = $_POST['title'];
    $rating = $_POST['rating'];
    

    $sql = "INSERT INTO Movies (title, rating) 
            VALUES ('$title', '$rating')";


    if ($conn->query($sql) === true) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


$sql_select = "SELECT * FROM Movies";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $title = $row["title"];
        $rating = $row["rating"];
    
        $return_arr[] = array("id" => $id,
                        "title" => $title,
                        "rating" => $rating);
    }
    echo json_encode($return_arr);
        
    } else {
        echo "0 results";
    }
}