<?php
include "header.php";
include "slider.php";
include "class/information_class.php"
?>

<?php

$information = new information;
if(!isset($_GET['information_id']) || $_GET['information_id'] == NULL){
    echo "<script>window.location = 'information_show.php'</script";
} else {
    $information_id = $_GET['information_id'];
}
    $get_information = $information -> get_information($information_id);
    if($get_information) {
        $result = $get_information ->  fetch_assoc();
    }

?>


<?php
$information = new information;
if($_SERVER['REQUEST_METHOD']==='POST'){
    $information_name = $_POST['information_name'];
    $update_information = $information -> update_information($information_name,$information_id);

}
?>

<div class="admin-content-right">
            <div class="admin-content-right-category_add">
                <h1>Thêm Danh mục</h1>
                <form action="" method="POST">
                    <input name="information_name" type="text" placeholder="Nhập tên danh mục" 
                    value="<?php echo $result['information_name'] ?>">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>