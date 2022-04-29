<?php
include "header.php";
include "slider.php";
include "class/information_class.php"
?>

<?php
$information = new information;
$show_information = $information -> show_information();
?>

<div class="admin-content-right">
<div class="admin-content-right-category_show">
               <h1>Danh sách người hiến máu</h1>
               <table>
                   <tr>
                       <th>STT</th>
                       <th>ID</th>
                       <th>Danh mục</th>
                       <th>Tuỳ biến</th>
                   </tr>

                   <?php
                    if($show_information){ $i=0;
                        while($result = $show_information->fetch_assoc()){ $i++;
                   ?>

                   <tr>
                       <td><?php echo  $i ?></td>
                       <td><?php echo  $result['information_id'] ?></td>
                       <td><?php echo  $result['information_name'] ?></td>
                       <td><a href="information_edit.php?information_id=<?php echo  $result['information_id'] ?>">Sửa</a><a href="information_delete.php?information_id=<?php echo  $result['information_id'] ?>">Xoá</a></td>
                   </tr>

                   <?php
                        }
                    }
                   ?>

               </table>
            </div>
        </div>
    </section>
</body>
</html>