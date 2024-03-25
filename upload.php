<?php
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

// Проверка наличия загруженного файла
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Файл является изображением - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Файл не является изображением.";
        $uploadOk = 0;
    }
}

// Проверка существования файла
if (file_exists($targetFile)) {
    echo "Извините, файл уже существует.";
    $uploadOk = 0;
}

// Проверка размера файла
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Извините, ваш файл слишком большой.";
    $uploadOk = 0;
}

// Загрузка файла
if ($uploadOk == 0) {
    echo "Извините, ваш файл не был загружен.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        echo "Файл ". basename( $_FILES["fileToUpload"]["name"]). " успешно загружен.<br>";
    } else {
        echo "Произошла ошибка при загрузке файла.";
    }
}
?>
