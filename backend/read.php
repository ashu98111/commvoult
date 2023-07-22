<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once 'database.php';
include_once 'Posts.php';
$database = new Database();

$db = $database->getConnection();
$items = new Posts($db);
$records = $items->getPosts();
$itemCount = $records->num_rows;
if($itemCount > 0){
$postArr = array();
$postArr["data"] = array();
$postArr["itemCount"] = $itemCount;
while ($row = $records->fetch_assoc())
{
array_push($postArr["data"], $row);
}
echo json_encode($postArr);
}
else{
http_response_code(404);
echo json_encode(
array("message" => "No record found.")
);
}
?>