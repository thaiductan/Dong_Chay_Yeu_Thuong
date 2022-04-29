<?php
include "database.php";
?>

<?php

class information{
    private $db;

    public function __construct()
    {
        $this -> db = new Database();

    }

    public function insert_information($information_name){
        $query = "INSERT INTO tbl_information(information_name) VALUES ('$information_name')"   ;
        $result = $this -> db -> insert($query);
        return $result;
    }

    public function show_information(){
        $query = "SELECT * from tbl_information order by information_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function get_information($information_id){
        $query = "SELECT * FROM tbl_information WHERE information_id = '$information_id' ";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function update_information($information_name,$information_id){
        $query = "UPDATE tbl_information set information_name='$information_name' where information_id='$information_id' ";
        $result = $this -> db -> update($query);
        header('Location: information_show.php');
        return $result;
    
    }

    public function  delete_information($information_id){
        $query = "DELETE FROM tbl_information where information_id='$information_id'";
        $result = $this -> db -> delete($query);
        header('Location: information_show.php');
        return $result;
    }

}


?>