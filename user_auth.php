<?php
session_start();
date_default_timezone_set('Asia/Singapore');

if(!isset($_SESSION["username"])){
	header("Location: index.php");
	exit();
} else {
	include './connection.php';
	$user = $db->prepare("SELECT * from USER_TABLE WHERE user_name=?");
	$user->execute([$_SESSION['username']]);
	$user = $user->fetch();

	$current_url = basename($_SERVER['REQUEST_URI']);
	$today = Date("Y-m-d H:i:s");
	if($today>$user['expired_date']) {
		if($current_url!="member_reinvest.php" && $current_url!="member-query-updates.php") {
			header("Location: member_reinvest.php");
		}
	}

	function getChildrens(&$users, $user_id) {
		include './connection.php';
		$query = $db->prepare("SELECT * from USER_TABLE WHERE genealogy_user_id=?");
		$query->execute([$user_id]);
		$all_users = $query->fetchAll();
		foreach ($all_users as $value) {
			array_push($users, $value);
			getChildrens($users, $value['user_id']);
		}
	}

	function sponsor_tree($user_id) {
		include './connection.php';
		$query = $db->prepare("SELECT * from USER_TABLE WHERE genealogy_user_id=?");
		$query->execute([$user_id]);
		$all_users = $query->fetchAll();
		
		function child_loop($user_id) {
			include './connection.php';
			$query = $db->prepare("SELECT * from USER_TABLE WHERE genealogy_user_id=?");
			$query->execute([$user_id]);
			$all_users = $query->fetchAll();
			if($query->rowCount()>0) {
				foreach ($all_users as $value) {
					echo '<div class="card">
						<div class="card-header">
							<h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse'.$value["user_id"].'" aria-expanded="false" aria-controls="collapse'.$value["user_id"].'"><i class="fa" aria-hidden="true"></i> '.$value["user_name"].'</h5>
						</div>
						<div id="collapse'.$value["user_id"].'" class="collapse" data-parent="#collapse'.$value["genealogy_user_id"].'">
							<div class="card-body">';
							child_loop($value['user_id']);
						echo	'</div>
						</div>
					</div>';
				}
			}
		}
		
		foreach ($all_users as $value) {
			echo '<div class="card">
			<div class="card-header">
				<h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse'.$value["user_id"].'" aria-expanded="false" aria-controls="collapse'.$value["user_id"].'"><i class="fa" aria-hidden="true"></i> '.$value["user_name"].'</h5>
			</div>
			<div id="collapse'.$value["user_id"].'" class="collapse" data-parent="#collapse'.$value["genealogy_user_id"].'">
				<div class="card-body">';
				child_loop($value['user_id']);
			echo	'</div>
			</div>
		</div>';
			
		}
	}

	function genealogy($user_id) {
		include './connection.php';
		$query = $db->prepare("SELECT * from USER_TABLE WHERE genealogy_user_id=?");
		$query->execute([$user_id]);
		$all_users = $query->fetchAll();
		
		function child_loop($user_id) {
			include './connection.php';
			$query = $db->prepare("SELECT * from USER_TABLE WHERE genealogy_user_id=?");
			$query->execute([$user_id]);
			$all_users = $query->fetchAll();
			if($query->rowCount()>0) {
				echo '<ul>';
				foreach ($all_users as $value) {
					echo '<li><a href="#">'.$value["user_name"].'</a>';
					child_loop($value['user_id']);
					echo '</li>';
				}
				echo '</ul>';
			}
		}
		
		echo '<ul>';
		foreach ($all_users as $value) {
			echo '<li><a href="#">'.$value["user_name"].'</a>';
			child_loop($value['user_id']);
			echo '</li>';
		}
		echo '</ul>';

	}

}
?>
