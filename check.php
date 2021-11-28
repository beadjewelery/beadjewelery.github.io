<?php
// Подключение к базе данных
include('sql.php');
// File upload.php
// Если в $_FILES существует "image" и она не NULL
if (isset($_FILES['image'])) {
// Получаем данные из формы
$name_iz = $_POST['name'];
$price_iz = $_POST['price'];
// Получаем нужные элементы массива "image"
$fileTmpName = $_FILES['image']['tmp_name'];
$errorCode = $_FILES['image']['error'];
// Проверим на ошибки
if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
    // Массив с названиями ошибок
    $errorMessages = [
      UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
      UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
      UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
      UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
      UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
      UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
      UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
    ];
    // Зададим неизвестную ошибку
    $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
    // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
    $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
    // Выведем название ошибки
    die($outputMessage);
} else {

    // Создадим ресурс FileInfo
    $fi = finfo_open(FILEINFO_MIME_TYPE);
    // Получим MIME-тип
    $mime = (string) finfo_file($fi, $fileTmpName);
    // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
    if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

    // Результат функции запишем в переменную
    $image = getimagesize($fileTmpName);

    // Зададим ограничения для картинок
    $limitBytes  = 1024 * 1024 * 5;

    // Проверим нужные параметры
    if (filesize($fileTmpName) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');

    // Даём название картинки из переменной названия изделия
    $name = $name_iz;

    // Сгенерируем расширение файла на основе типа картинки
    $extension = image_type_to_extension($image[2]);

    // Сократим .jpeg до .jpg
    $format = str_replace('jpeg', 'jpg', $extension);

    $query_msql = mysqli_query($connection, "INSERT INTO `tovars` (`id`, `name`, `price`, `file`) VALUES (NULL, '$name_iz', '$price_iz', '$name_iz$format');");
    if ($query_msql) {
        
    } else {
        echo 'Ошибка, запись не передалась в базу данных! Обратитесь к администратору!<br>';
        echo 'Останавливаю работу...';
        exit();
    }

    // Переместим картинку с новым именем и расширением в папку /upload
    if (!move_uploaded_file($fileTmpName, __DIR__ . '/upload/' . $name . $format)) {
        die('При записи изображения на диск произошла ошибка.');
    }

    echo 'Картинка успешно загружена!';
    header('Location: /');
  }
};

?>