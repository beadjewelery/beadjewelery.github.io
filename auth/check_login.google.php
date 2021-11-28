<?php
if (!empty($_GET['code'])) {
	// Отправляем код для получения токена (POST-запрос).
	$params = array(
		'client_id'     => '645277568542-t3ucpvhkam68p9o8d4g1uct65ut56i3r.apps.googleusercontent.com',
		'client_secret' => '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',
		'redirect_uri'  => 'https://marketser.ru/auth/check_login.google',
		'grant_type'    => 'authorization_code',
		'code'          => $_GET['code']
	);	
			
	$ch = curl_init('https://accounts.google.com/o/oauth2/token');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$data = curl_exec($ch);
	curl_close($ch);	
 
	$data = json_decode($data, true);
	if (!empty($data['access_token'])) {
		// Токен получили, получаем данные пользователя.
		$params = array(
			'access_token' => $data['access_token'],
			'id_token'     => $data['id_token'],
			'token_type'   => 'Bearer',
			'expires_in'   => 3599
		);
 
		$info = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?' . urldecode(http_build_query($params)));
		$info = json_decode($info, true);

		$in_g_name = $info['name'];
		$in_g_pic = $info['picture'];
		$in_g_id = $info['id'];
		$in_g_email = $info['email'];
		$query_post = 'type=google&name='.$in_g_name.'&picture='.$in_g_pic.'&id_user='.$in_g_id.'&email='.$in_g_email;
		header('Location: create_session?'.$query_post.'');

		// откладка
		//
		//echo '<pre>';
		//print_r($info);
		//echo '</pre>';
		
		
	}
}