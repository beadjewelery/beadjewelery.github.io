<?php
$connection = mysqli_connect('localhost', 'root', '', 'in-ma');

if( $connection == false ) 
{
	echo 'Не удалось подключиться к базе данных!<br>';
	echo mysqli_connect_error();
	exit();
}
?>

