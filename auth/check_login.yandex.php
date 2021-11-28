<?php
$state = $_GET['state'];
 
if (!empty($_GET['code'])) {
	// Отправляем код для получения токена (POST-запрос).
	$params = array(
		'grant_type'    => 'authorization_code',
		'code'          => $_GET['code'],
		'client_id'     => '79b32e3914b1439b8928b227ecfc9867',
		'client_secret' => '679dc5aa1b274c9bb0891df8ebeeedc3',
	);

	
	$ch = curl_init('https://oauth.yandex.ru/token');
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
		$ch = curl_init('https://login.yandex.ru/info');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('format' => 'json')); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: OAuth ' . $data['access_token']));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$info = curl_exec($ch);
		curl_close($ch);
 
		$info = json_decode($info, true);

		$in_y_name = $info['display_name'];
		$in_y_pic = $info['default_avatar_id'];
		$in_y_id = $info['id'];
		$in_y_email = $info['emails']['0'];

		if ($info['is_avatar_empty'] == "") {
			$in_y_pic = 'https://avatars.mds.yandex.net/get-yapic/'.$info['default_avatar_id'].'/islands-middle';
		} else {
			$in_y_pic = 'https://avatars.mds.yandex.net/get-yapic/';
		}

		$query_post = 'type=yandex&name='.$in_y_name.'&picture='.$in_y_pic.'&id_user='.$in_y_id.'&email='.$in_y_email;
		header('Location: create_session?'.$query_post.'');
		
		// откладка
		//
		//echo '<pre>';
		//print_r($info);
		//echo '</pre>';
	}
}
?>
<!--<script src="https://yastatic.net/s3/passport-sdk/autofill/v1/sdk-suggest-latest.js"></script>
<script src="https://yastatic.net/s3/passport-sdk/autofill/v1/sdk-suggest-token-latest.js"></script>

<script type="text/javascript">
	YaAuthSuggest.init(
    {
        client_id: '79b32e3914b1439b8928b227ecfc9867',
        response_type: 'token',
        redirect_uri: 'https://marketser.ru/auth/check_login.yandex'
    },
    'https://marketser.ru'
)
    .then(({handler}) => handler())
    .then(data => console.log('Сообщение с токеном', data))
    .catch(error => console.log('Обработка ошибки', error));

YaSendSuggestToken(
    'https://marketser.ru',
    { flag: true }
)
</script>-->