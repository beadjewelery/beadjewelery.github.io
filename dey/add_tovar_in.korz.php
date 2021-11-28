<?php 
session_start();
include('../sql.php');

if (empty($_SESSION['auth'])) {
	header('Location: /');
	exit();
}

if (empty($_GET['id'])) {
	header('Location: /');
	exit();
}

$tovar_id = $_GET['id']; // ID добавляемого товара
$user_id = $_SESSION['auth']['id_user'];
$type_oauth = $_SESSION['auth']['type'];

$query_s_tovars = mysqli_query($connection, "SELECT * FROM tovars WHERE `id` = $tovar_id");
$result_s_tovars = mysqli_fetch_assoc($query_s_tovars);

$tovar_name = $result_s_tovars['name'];
$tovar_price = $result_s_tovars['price'];

$query = mysqli_query($connection, "INSERT INTO `tovars_in_korz` (`id`, `tovar_id`, `user_id`, `type_oauth`, `name`, `price`) VALUES (NULL, '$tovar_id', '$user_id', '$type_oauth', '$tovar_name', '$tovar_price')");
if ($query) {
	header('Location: /');
}
?>