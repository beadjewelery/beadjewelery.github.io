<?php 
session_start();
include('sql.php');
if ($_SESSION['auth']['is_admin'] == "1") {
} else {
	header('Location: /');
	exit();
}

$id = $_GET['id'];
$file = $_GET['file'];

$query_del = mysqli_query($connection, "DELETE FROM `tovars` WHERE `id` = $id");
$image = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$file;
unlink('upload'.'/'.$file);

if (!$query_del) {
	echo 'Произошла ошибка!';
} else {
	echo 'Успешно!';
	header('Location: /');
}
?>