<?php

function getStoredImageName($image) {
	$fileName = $image['name'];
	$fileTmpLoc =$image['tmp_name'];
	$fileType = $image['type'];
	$fileSize = $image['size'];
	$fileErrorMsg = $image['error'];
	$kaboom = explode(".", $fileName);
	$fileExt = end($kaboom);

	list($width, $height) = getimagesize($fileTmpLoc);
	if ( $width < 10 || $height < 10 ) {
		$errors[] = 'That image has no dimensions';
	}

	$db_file_name = rand(100000000000, 999999999999) . "." . $fileExt;
	if ( $fileSize > 2097152 ) {
		$errors[] = 'Размер вашего изображения превышает 2 Мбайт';
	} else if ( !preg_match("/\.(gif|jpg|jpeg|png)$/i", $fileName) ) {
		$errors[] = 'Ваше изображения не соответствует типам gif, jpg, jpeg, png';
	} else if ( $fileErrorMsg == 1 ) {
		$errors[] = 'Произошла неизвестная ошибка';
	}

	$photoFolderLocation = ROOT . 'data/films/full/';
	$photoFolderLocationMin = ROOT . 'data/films/min/';

	$uploadfile = $photoFolderLocation . $db_file_name;
	$moveResult = move_uploaded_file($fileTmpLoc, $uploadfile);

	if ( $moveResult != true ) {
		$errors[] = 'Не удалось загрузить файл';
	}

	require_once(ROOT . "functions/image_resize_imagick.php");

	$target_file = $photoFolderLocation . $db_file_name;
	$resized_file = $photoFolderLocationMin . $db_file_name;
	$wmax = 137;
	$hmax = 200;
	$img = createThumbnail($target_file, $wmax, $hmax);
	$img->writeImage($resized_file);

	return $db_file_name;
}

?>