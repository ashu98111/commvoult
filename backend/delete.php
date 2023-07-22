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
$postdata = json_decode(file_get_contents('php://input'), true);
$item->id = $postdata['id'];
if(empty($item->id))
{
	$errors[] = 'Id can not be empty';
}

if(empty($errors))
{
	if($item->deletepost()){
	$returnarray['status'] = 1;
	$returnarray['message'] = 'Deleted sucessfully';
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