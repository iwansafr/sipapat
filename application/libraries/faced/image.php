<?php

require "FaceDetector.php";


use svay\FaceDetector;


$faceDetect = new FaceDetector();
if($faceDetect->faceDetect($_FILES['image']['tmp_name']))
{
	$faceDetect->toJpeg();
}else{
	echo 'wajah tidak terdeteksi';
}
// $faceDetect->cropFaceToJpeg();
// print_r($faceDetect->getFace());
// print_r($faceDetect->canvas());

// require 'compare-images.php';
// $compare = new compareImages();
// print_r($compare->compare($_FILES['image']['tmp_name'],$_FILES['image2']['tmp_name']));

