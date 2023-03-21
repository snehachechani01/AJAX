<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email'];
    $password = $_POST['password'];

    $conn->select_db($dbname);

    $query = "SELECT `email`,`password` FROM Registration";
    $result = $conn->query($query);

  

    // fetch all rows into an array
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    if (checkusername($rows, $username)) {
        if (checkpassword($rows, $password)) {
            $return_arr[] = array(
                "success" => true
            );
            echo json_encode($return_arr);
            die();
        } else {

         $return_arr[] = array(
                "message" => "Not valid Password",
            );
            echo json_encode($return_arr);
            
            exit;
        }
    } else {
        $return_arr[] = array(
            "message" => "Not valid Email",
        );
        echo json_encode($return_arr);
        
        exit;
        
    }
}

 
function checkpassword($rows, $password)
{
    foreach ($rows as $row) {
        if ($row["password"] == $password) {
            return true;
        }
    }
    return false;
}

function checkusername($rows, $username)
{
    foreach ($rows as $row) {
        if ($row["email"] == $username) {
            return true;
        }
    }
    return false;
}
