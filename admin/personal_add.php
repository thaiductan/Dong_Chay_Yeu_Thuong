<?php
include "header.php";
include "slider.php";
include "class/personal_class.php"
?>

<?php
$personal = new personal;
if($_SERVER['REQUEST_METHOD']==='POST'){
    $information_id = $_POST['information_id'];
    $personal_name = $_POST['personal_name'];
    $insert_personal = $personal -> insert_personal($information_id, $personal_name);

}
?>

<style>
    select{
        height: 30px;
        width: 200px;
    }
</style>

<div class="admin-content-right">
            <div class="admin-content-right-category_add">
                <h1>Thêm Người Hiến Máu</h1> <br>
                <form action="" method="POST">
                    <select name="information_id" id="">
                        <option value="#">--Chọn danh mục</option>
                        <?php
                        $show_information = $personal -> show_information();
                        if($show_information){
                            while($rusult=$show_information -> fetch_assoc()){

                           
                        ?>
                        <option value=" <?php echo $rusult['information_id'] ?> " ><?php echo $rusult['information_name'] ?></option>

                        <?php
                            }
                        }
                        ?>

                    </select> <br>

                    <input name="personal_name" type="text" placeholder="Nhập người hiến máu" >
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>