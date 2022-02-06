<?php

include './connection.php';


$data = json_decode(file_get_contents("php://input"), true);
if($data['username']) {
	$username = trim(htmlentities(strip_tags($data['username'])));
	$query = $db->prepare("SELECT * from USER_TABLE WHERE user_name=?");
	$query->execute([$username]);
	if($query->rowCount()>0) {
		echo json_encode(array('error'=>true));
	} else {
		echo json_encode(array('response'=>true));
	}

} else {
	http_response_code(400);
	echo json_encode(array('error'=>'Invalid Params'));
}

