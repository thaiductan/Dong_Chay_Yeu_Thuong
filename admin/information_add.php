<?php
include "header.php";
include "slider.php";
include "class/information_class.php"
?>

<?php
$information = new information;
if($_SERVER['REQUEST_METHOD']==='POST'){
    $information_name = $_POST['information_name'];
    $insert_information = $information -> insert_information($information_name);

}
?>

<div class="admin-content-right">
            <div class="admin-content-right-category_add">
                <h1>Thêm Danh mục</h1>
                <form action="" method="POST">
                    <input name="information_name" type="text" placeholder="Nhập tên danh mục" >
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>