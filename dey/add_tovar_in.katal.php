<?php 
session_start();
include('../sql.php');
$name_user = $_SESSION['auth']['name']; 
$is_admin = $_SESSION['auth']['is_admin'];
if(empty($_SESSION['auth'])) {
	header('Location: /');
}

if ($is_admin == "1") {

} else {
	header('Location: /');
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Добавление товара в каталог</title>
</head>
<body>

<form action="check.php" method="post" enctype="multipart/form-data">
	<input type="text" name="name_kol" placeholder="Название кольца" required>
	<input type="text" name="price_kol" placeholder="Цена кольца" required>
	<input type="file" name="image" accept="image/*" required>
	<button type="submit">Загрузить</button>
</form>

</body>
</html>