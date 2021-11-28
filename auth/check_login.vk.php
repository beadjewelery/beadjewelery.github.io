<?php
if (!$_GET['code']) {
	exit('Ошибка - не введён код пользователя.'); //проверка на пустоту $code ($_GET)
}

$token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id=8006855&redirect_uri=https://marketser.ru/auth/check_login.vk&client_secret=9OKz6BTI4MvHk4tC9vOG&2fa_supported=1&code='.$_GET['code'].'&v=5.131'), true); //получение токена для получение информации о пользователе

if (!$token) {
	exit('Ошибка токена.'); //проверка на пустоту $token
}


$data = json_decode(file_get_contents('https://api.vk.com/method/users.get?user_id='.$token['user_id'].'&access_token='.$token['access_token'].'&fields=uid,first_name,last_name,photo_big,email&v=5.131'), true); //получение информации пользователя

if (!$data) {
	exit('Ошибка получения данных.'); //проверка на пустоту $data
}

$in_vk_name = $data['response']['0']['first_name'].' '.$data['response']['0']['last_name'];
$in_vk_pic = $data['response']['0']['photo_big'];
$in_vk_id = $data['response']['0']['id'];
$query_post = 'type=vk&name='.$in_vk_name.'&picture='.$in_vk_pic.'&id_user='.$in_vk_id;
header('Location: create_session?'.$query_post.'');

// откладка
//
//echo '<pre>';
//print_r($data);
//echo '</pre>';
?>