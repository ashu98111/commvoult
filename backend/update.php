<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';
include_once 'Posts.php';

$database = new Database();
$db = $database->getConnection();
$item = new Posts($db);

$errors = [];
$returnarray = [];
$item->id = isset($_POST['id']) ? $_POST['id'] : NULL;
if(empty($item->id))
{
	$errors[] = 'Id can not be empty';
}
$item->title = isset($_POST['title']) ? $_POST['title'] : NULL;
$item->description = isset($_POST['description']) ? $_POST['description'] : NULL;
if(empty($item->title))
{
	$errors[] = 'Title can not be empty';
}
if(empty($item->description))
{
	$errors[] = 'Description can not be empty';
}
if(empty($errors))
{
	if($item->updatePost()){
	$returnarray['status'] = 1;
	$returnarray['message'] = 'Updated sucessfully';
	} else{
	$returnarray['status'] = 0;
	$returnarray['message'] = 'Some error occured';
	}
}
else
{
	$returnarray['status'] = 0;
	$returnarray['message'] = $errors;
}
echo json_encode($returnarray);
?>