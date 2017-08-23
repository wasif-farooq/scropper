<?php
require_once('src/AbstractHandler.php');

require_once('src/handlers/jpg.php');
require_once('src/handlers/png.php');
require_once('src/handlers/bmp.php');
require_once('src/handlers/gif.php');

require_once('src/SCropper.php');
require_once('src/SCropperFactory.php');


$cropper = new SCropperFactory();
$data = array(
    'src' => '/home/wasif/PartialScreenshot.jpg',
    'width' => 100,
    'height' => 100,
    'x' => 1,
    'y' => 1
);

echo $cropper->getCropper($data)->crop();