<?php include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'];
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];

    $sql = "CREATE TABLE IF NOT EXISTS Post (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Title VARCHAR(100) NOT NULL,
        Description VARCHAR(100) NOT NULL,
        userid VARCHAR(100) NOT NULL

    )";

    if ($conn->query($sql) === TRUE) {
        // echo "Table posts created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $stmt = $conn->prepare("INSERT INTO Post (userid,Title, Description) 
VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $userid, $Title, $Description);
    if ($stmt->execute()) {
        $stmt->close();

        $stmt_select = $conn->prepare("SELECT * FROM Post");
        if ($stmt_select->execute()) {
            $result = $stmt_select->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $id = $row['id'];
                    $userId = $row['userid'];
                    $title = $row["Title"];
                    $description = $row["Description"];

                    $return_arr[] = array(
                        "id" => $id,
                        "userid" => $userId,
                        "Title" => $title,
                        "Description" => $description
                    );
                }
                echo json_encode($return_arr);
            } else {
                echo "0 results";
            }

            $stmt_select->close();
        } else {
            echo "Error selecting posts: " . $conn->error;
        }

    } else {
        echo "Error inserting post: " . $conn->error;
        $stmt->close();
    }
}