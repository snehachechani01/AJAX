<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = "SELECT `email` FROM Registration";
    $result = $conn->query($query);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
        if ($row["email"] == $email)
        {
            $return_arr[] = array(
                "message" => "Email already exists",
            );
            echo json_encode($return_arr);
            
            exit;
        }
    }



    $sql = "INSERT INTO Registration (first_name, last_name, email, password)
VALUES ('$firstName', '$lastName', '$email', '$password')";
    mysqli_query($conn, $sql);

    $return_arr[] = array(
        "success" => true,
        "message" => "Registered successfully",
    );

    echo json_encode($return_arr);

}
