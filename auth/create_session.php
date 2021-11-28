<?php 
session_start();
$type = $_GET['type'];
$name = $_GET['name'];
$picture = $_GET['picture'];
$id_user = $_GET['id_user'];
$email = $_GET['email'];

if ($type == "google" and $email == "sergeylogua0000@gmail.com") {
	$is_admin = "1";
} else {
	$is_admin = "0";
}

if ($type == "vk") {
	$size = $_GET['size'];
	$quality = $_GET['quality'];
	$crop = $_GET['crop'];
	$ava = $_GET['ava'];
	
	$_SESSION['auth'] = ['type' => $type, 'name' => $name, 'picture' => $picture.'&quality='.$quality.'&crop='.$crop.'&ava='.$ava, 'id_user' => $id_user];
	header('Location: /');
} else {
	$_SESSION['auth'] = ['type' => $type, 'id_admin' => $is_admin, 'name' => $name, 'picture' => $picture, 'id_user' => $id_user, 'is_admin' => $is_admin];
	header('Location: /');
}


?>