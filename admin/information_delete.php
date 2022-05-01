<?php
include "class/information_class.php";
$information = new information;
if(!isset($_GET['information_id']) || $_GET['information_id'] == NULL){
    echo "<script>window.location = 'information_show.php'</script";
} else {
    $information_id = $_GET['information_id'];
}
    $delete_information = $information -> delete_information($information_id);
    

?>


