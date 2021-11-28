<?php
session_start();
include('sql.php');
include('include/index/loader.php');

$params = array(
	'client_id'     => '645277568542-t3ucpvhkam68p9o8d4g1uct65ut56i3r.apps.googleusercontent.com',
	'redirect_uri'  => 'https://marketser.ru/auth/check_login.google',
	'response_type' => 'code',
	'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
	'state'         => ''
);
$url_google = 'https://accounts.google.com/o/oauth2/auth?' . urldecode(http_build_query($params));
//echo '<a href="' . $url_google . '">Авторизация через Google</a>';
$params = array(
	'client_id'     => '79b32e3914b1439b8928b227ecfc9867',
	'redirect_uri'  => 'https://marketser.ru/auth/check_login.yandex',
	'response_type' => 'code',
	'state'         => ''
);
$url_yandex = 'https://oauth.yandex.ru/authorize?' . urldecode(http_build_query($params));
//echo '<a href="' . $url_yandex . '">Авторизация через Яндекс</a>';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<script src="https://kit.fontawesome.com/3fe25a1a6d.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="js/script_auth.korz.js" type="text/javascript"></script>

	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" type="text/css" href="styles/style_font-face.css">
	<link rel="stylesheet" type="text/css" href="styles/style_index_content.css">
	<link rel="stylesheet" type="text/css" href="styles/style_product.css">
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
	<title>Интернет-магазин украшений из бисера</title>


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    

	<style type="text/css">
		@font-face {
			font-family: Kurale; /* Имя шрифта */
			src: url(../fonts/font.ttf); /* Путь к файлу со шрифтом */
		}

		.popup-fade-auth {
			display: none;
		}
		.popup-fade-auth:before {
			content: '';
			background: #000;
			position: fixed; 
			left: 0;
			top: 0;
			width: 100%; 
			height: 100%;
			opacity: 0.7;
			z-index: 9999;
		}
		.popup-auth {
			position: fixed;
			margin-left: 35%;
			margin-top: 200px;
			padding: 20px;
			width: 33%;
			background: #fff;
			border: 1px solid orange;
			border-radius: 4px; 
			z-index: 999999;
			opacity: 1;	
		}
		.popup-close-auth {
			position: absolute;
			top: 15px;
			right: 15px;
		}


		.popup-fade-korz {
			display: none;
		}
		.popup-fade-korz:before {
			content: '';
			background: #000;
			position: fixed; 
			left: 0;
			top: 0;
			width: 100%; 
			height: 100%;
			opacity: 0.7;
			z-index: 99999;
		}
		.popup-korz {
			position: fixed;
			margin-top: 200px;
			margin-left: 30%;
			padding: 20px;
			width: 40%;
			background: #fff;
			border: 1px solid orange;
			border-radius: 4px; 
			z-index: 999999;
			opacity: 1;	
		}
		.popup-close-korz {
			position: absolute;
			top: 10px;
			right: 10px;
		}

		.containerTovars {
	        text-align: center;
	        overflow-x: hidden;
	        position: relative;
		}

		.content {
			border: 1px solid black;
			border-radius: 5px;
			box-shadow: 1px 1px 5px black;
			margin: auto;
			width: 100%;
			margin-top: 2%;
			text-align: center;
			font-size: 18px;
			padding: 5px;
		}
		.punkt {
			margin: auto;
			width: 100%;
			border: 1px solid black;
			background-color: #ebebeb;
			color: black;

			border-radius: 10px;
		}
		.punkt:hover {

			padding: 10px;
			width: 90%;
			border: 1px solid black;
			margin-left: 4px;
			transform: scale(1.1);
			color: #fd7532;
		}

		.product_body {
			width: 230px;
			padding: 10px;
			border: 1px double black;
			display: inline-block;
			margin: 5px;
			border-radius: 4px;
			text-align: center;
		}

		.product_price {
			font-size: 17px;
		}

		.container_index{
			margin: auto;
			text-align: center;
		}

		.tovar_in_korz {
			border: 1px solid black;
			border-radius: 5px;
			padding: 5px;
			margin: 5px;
		}
	</style>

</head>
<body>

<div class="popup-fade-auth">
	<div class="popup-auth">
		<a class="popup-close-auth" href="#"><i class="fas fa-times-circle"></i></a>
		<p>Выберите способ авторизации:</p>
		<div style="border-bottom: black 1px solid;"></div>

			<div class="content">
				<a class="text-decoration-none" href="<?php echo $url_google ?>">
					<div class="punkt" style="margin-bottom: 6px;">
						<p><i class="fab fa-google"></i> Google</p>
					</div>
				</a>

				<a class="text-decoration-none" href="<?php echo $url_yandex ?>">
					<div class="punkt" style="margin-bottom: 4px;">
						<p><i class="fab fa-yandex"></i> Yandex</p>
					</div>
				</a>

				<a class="text-decoration-none" target="_blank" href="https://oauth.vk.com/authorize?client_id=8006855&scope=email&display=page&redirect_uri=https://marketser.ru/auth/check_login.vk&response_type=code&v=5.131">
					<div class="punkt" style="margin-bottom: 4px;">
						<p><i class="fab fa-vk"></i> Vk</p>
					</div>
				</a>
			</div>


	</div>		
</div>

<div class="popup-fade-korz">
	<div class="popup-korz">
		<a class="popup-close-korz" href="#"><i class="fas fa-times-circle"></i></a>
		<?php 
			//$user_id = $_SESSION['auth']['id_user'];
			//$type_oauth = $_SESSION['auth']['type'];
			//$query_all_korz = mysqli_query($connection, "SELECT * FROM tovars_in_korz WHERE `user_id` = '$user_id' AND `type_oauth` = '$type_oauth'");
			//$result_all_korz = mysqli_fetch_assoc($query_all_korz);

			if (empty($_SESSION['auth'])) {
				echo '<p>Пожалуйста, авторизуйтесь, чтобы посмотреть свою корзину.</p>';
			}else {
				if (empty($result_all_korz) && $_SESSION['auth']) {
					echo '<span>Товаров в вашей корзине нету.</span>';
				} else {
					while($res_all_korz = mysqli_fetch_assoc($query_all_korz)) {
						echo '
						<div class="tovar_in_korz">
							<img src="upload/Фенечка однотонная.jpg" width="50px">
							<span>'.$res_all_korz['name'].'</span><span> '.$res_all_korz['price'].' руб.</span>
							<a href="del_tovar_in_korz&id='.$res_all_korz['tovar_id'].'" style="margin-left: 40%;"><i class="fas fa-trash-alt"></i></a>
						</div>
						';
					}
					//$query_all_korz_summa = mysqli_query($connection, "SELECT sum(price) as `summa` FROM tovars_in_korz WHERE `user_id` = '$user_id' AND `type_oauth` = '$type_oauth'");
					//$result_all_korz_summa = mysqli_fetch_assoc($query_all_korz_summa);
					//echo '<a>Оформить заказ на сумму '.$summa.' руб.</a>';
				}
			}


			 


			$user_id = $_SESSION['auth']['id_user'];
			$type_oauth = $_SESSION['auth']['type'];
			$query_all_korz = mysqli_query($connection, "SELECT * FROM tovars_in_korz WHERE `user_id` = '$user_id' AND `type_oauth` = '$type_oauth'");
			$result_all_korz = mysqli_fetch_assoc($query_all_korz);

			if (!empty($result_all_korz)) {
				while($res_all_korz = mysqli_fetch_assoc($query_all_korz)) {
					echo '
					<div class="tovar_in_korz">
						<img src="upload/Фенечка однотонная.jpg" width="50px">
						<span>'.$res_all_korz['name'].'</span><span> '.$res_all_korz['price'].' руб.</span>
						<a href="del_tovar_in_korz&id='.$res_all_korz['tovar_id'].'" style="margin-left: 40%;"><i class="fas fa-trash-alt"></i></a>
					</div>
					';
				}
			} else {
				echo '<span>Товаров в вашей корзине нету.</span>';
			}

		?>
	</div>		
</div>



<header class="bg-info p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img width="250px" class="img-thumbnail bg-info" src="logo.png">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="/" class="nav-link px-2 link-secondary">Главная</a></li>
        </ul>
          <?php 
          if (empty($_SESSION['auth'])) {
          	echo '
          	<div class="dropdown text-end">
          		<a class="nav-link px-2 link-dark popup-open-auth" href="#"><i style="margin-right: 5px;" class="far fa-user"></i>Войти</a>
          	</div>
          	';
          } else {
          	if ($_SESSION['auth']['is_admin'] == "1") {
          		echo '
	          	<div class="dropdown text-end">
		          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
		          <img src="'.$_SESSION['auth']['picture'].'" alt="mdo" width="40" height="40" class="rounded-circle">
		          </a>
		          	<ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
				       	<li><a class="dropdown-item disabled text-success" href="#"><i style="margin-right: 5px;" class="fas fa-user-circle"></i>'.$_SESSION['auth']['name'].'</a></li>

				       	<li><a class="dropdown-item disabled text-success" href="#"><i style="margin-right: 5px;" class="fas fa-code"></i>Администратор</a></li>

				       	<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalAddTovar"><i style="margin-right: 5px;" class="fas fa-cart-plus"></i></i>Добавить товар в каталог</a></li>

				        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalKorz"><i style="margin-right: 5px;" class="fas fa-shopping-basket"></i>Корзина</a></li>

				        <li><hr class="dropdown-divider"></li>
				        <li><a class="dropdown-item" href="auth/exit"><i style="margin-right: 5px;" class="fas fa-sign-out-alt"></i>Выйти</a></li>
			        </ul>
	          	';
          	} else {
	          	echo '
	          	<div class="dropdown text-end">
		          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
		          <img src="'.$_SESSION['auth']['picture'].'" alt="mdo" width="40" height="40" class="rounded-circle">
		          </a>
		          	<ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
				       	<li><a class="dropdown-item disabled text-success" href="#"><i style="margin-right: 5px;" class="fas fa-user-circle"></i>'.$_SESSION['auth']['name'].'</a></li>
				        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Modalkorz"><i style="margin-right: 5px;" class="fas fa-shopping-basket"></i>Корзина</a></li>
				        <li><hr class="dropdown-divider"></li>
				        <li><a class="dropdown-item" href="auth/exit"><i style="margin-right: 5px;" class="fas fa-sign-out-alt"></i>Выйти</a></li>
			        </ul>
	          	';
          		}
          	}
          	?>
        </div>
      </div>
    </div>
  </header>




<div class="containerTovars">
<?php 
$query_tovars = mysqli_query($connection, "SELECT * FROM `tovars`");
echo '<div class="row row-cols-1 row-cols-md-4 g-1">';

if ($_SESSION['auth']['is_admin'] == "1") {
		while($result_kat = mysqli_fetch_assoc($query_tovars)) {
			echo '
			<div class="col">
				<div class="card h-100">
					<img src="upload/'.$result_kat['file'].'" class="card-img-top img-thumbnail" alt="Ошибка загрузки изображения.">

					<div class="card-body">
						<h5 class="card-title">'.$result_kat['name'].'</h5>
					</div>

					<div class="card-footer">
						<div class="d-grid gap-2">
							<a class="btn btn-primary" href="dey/add_tovar_in.korz?id='.$result_kat['id'].'">Добавить в корзину</a>

							<a class="btn btn-danger m-t-3" href="#" data-bs-toggle="modal" data-bs-target="#ModalDelTovarID'.$result_kat['id'].'">Удалить из каталога</a>
						</div>
					</div>

				</div>
			</div>

			<div class="modal fade" id="ModalDelTovarID'.$result_kat['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Удаление товара</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>

			      <div class="modal-body">
			        <p>Вы уверены, что хотите удалить товар под название "'.$result_kat['name'].'" c ID "'.$result_kat['id'].'"?</p>
			      </div>

			      <div class="modal-footer">
			        <a href="del_tovar_from.katal?id='.$result_kat['id'].'&file='.$result_kat['file'].'" class="btn btn-danger">Да</a>
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
			      </div>
			    </div>
			  </div>
			</div>
			';
			//<a class="btn btn-danger m-t-3" href="dey/del_tovar_from.katal?id='.$result_kat['id'].'">Удалить из каталога</a>
			}
	} else {
		while($result_kat = mysqli_fetch_assoc($query_tovars)) {
		echo '
		<div class="col">
			<div class="card h-100">
				<img src="upload/'.$result_kat['file'].'" class="card-img-top img-thumbnail" alt="Ошибка загрузки изображения.">

				<div class="card-body">
					<h5 class="card-title">'.$result_kat['name'].'</h5>
				</div>

				<div class="card-footer">
					<div class="d-grid gap-2"><a class="btn btn-primary" href="dey/add_tovar_in.korz?id='.$result_kat['id'].'">Добавить в корзину</a></div>
				</div>

			</div>
		</div>
		';
		}
	}

echo '</div>';

?>
</div>

<!-- ModalAddTovar -->
<div class="modal fade" id="ModalAddTovar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Добавление товара в калатог</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">

				<form class="was-validated" method="POST" action="check" enctype="multipart/form-data">
					<label for="validationDefault01" class="form-label">Название изделия</label>
					<input type="text" class="form-control" name="name" id="validationDefault01" required>
					<br>
					<label for="validationDefault02" class="form-label">Цена изделия</label>
					<input type="text" class="form-control" name="price" id="validationDefault02" required>
					<br>
					<label for="validationDefault03" class="form-label">Фотография изделия</label>
					<input type="file" class="form-control" id="validationDefault03" name="image" accept="image/*" aria-label="file example" required>


			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">Отправить форму</button>
				</form>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
			</div>
		</div>
	</div>
</div>

<!-- ModalKorz -->
<div class="modal fade" id="ModalKorz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Корзина</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <?php
        	$user_id = $_SESSION['auth']['id_user'];
			$type_oauth = $_SESSION['auth']['type'];
			$query_korz = mysqli_query($connection, "SELECT * FROM tovars_in_korz WHERE `user_id` = '$user_id' AND `type_oauth` = '$type_oauth'");
        	$result_korz = mysqli_fetch_assoc($query_korz);
        	if (empty($result_korz)) {
        		echo '<p></p>';
        	}
        ?>
      </div>

      <div class="modal-footer">
        <a href="#" class="btn btn-primary">Оформить заказ на '<''>' руб.</a>
      </div>
    </div>
  </div>
</div>