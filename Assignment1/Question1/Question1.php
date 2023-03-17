<?php
if(isset($_POST['new_text'])){
    $new_text=$_POST['new_text'];
    echo $new_text;

}
else{
    echo "error: no data received.";
}
?>