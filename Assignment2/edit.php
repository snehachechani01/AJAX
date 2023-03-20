<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateuid= $_POST["user_id"];
    $updatepost= $_POST["post_name"];
    $updatedes = $_POST["post_description"];
    $id = $_POST["id"];
    $check = "SELECT `id` FROM Post";
    $result1 = mysqli_query($conn, $check);
    $num = $result1->num_rows;
    for ($i = 0; $i < $num; $i++) {
        $arr = mysqli_fetch_assoc($result1);
        if ($arr['id'] == $id) {
            if ($updatedes != null && $updatepost != null && $updateuid != null) {
                $query = "UPDATE Post SET userid='$updateuid' , Description='$updatedes', Title='$updatepost'  WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "user id,Post name and Description Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
            else if ($updatedes != null) {
                $query = "UPDATE Post SET Description='$updatedes' WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "Post Description Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
           else if ($updateuid != null) {
                $query = "UPDATE Post SET userid='$updateuid' WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "user id Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
           else if ($updatepost != null) {
                $query = "UPDATE Post SET Title='$updatepost'  WHERE id='$id'";
                if($conn -> query($query)){
                    $return_arr[] = array("message" => "Post name Updated");
                    echo json_encode($return_arr);
                    exit;
                }
            }
        }
    }

}

?>