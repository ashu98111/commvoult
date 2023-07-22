<?php
include_once 'database.php';
class Posts{
private $db;
// Table
private $db_table = "tbl_post";
// Columns
public $id;
public $title;
public $description;
public $status;

// Db dbection
public function __construct($db){
$this->db = $db;
}

// GET ALL
public function getPosts(){
$sqlQuery = "SELECT id, title, description, status FROM " . $this->db_table . " where status=1 order by id desc";
$this->result = $this->db->query($sqlQuery);
return $this->result;
}

// CREATE
public function createPost()
{
$this->title=htmlspecialchars(strip_tags($this->title));
$this->description=htmlspecialchars(strip_tags($this->description));
$sqlQuery = "INSERT INTO
". $this->db_table ." SET title = '".$this->title."',
description = '".$this->description."',
status = 1";
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}


// UPDATE
public function updatePost(){
$this->title=htmlspecialchars(strip_tags($this->title));
$this->description=htmlspecialchars(strip_tags($this->description));
$this->status=1;
$sqlQuery = "UPDATE ". $this->db_table ." SET title = '".$this->title."',
description = '".$this->description."'
WHERE id = ".$this->id;
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// DELETE
function deletePost(){
$sqlQuery = "Update " . $this->db_table . " set status = 0 WHERE id = ".$this->id;
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}
}
?>