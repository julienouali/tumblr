<?php
session_start();
define('APP_PATH', __DIR__);
include (APP_PATH.'/conf/_conf.php');
include (INC_DIR.'/functions.php');

unset($_SESSION['error']);
unset($_SESSION['msg']);

$idImage = filter_input(INPUT_GET, 'idImage', FILTER_SANITIZE_NUMBER_INT);

$delImage = deleteImage($idImage,$_SESSION['ID']);

if($delImage !== TRUE) {
    $_SESSION['error'] = $delImage;
}

header('Location: tumblrBD.php');