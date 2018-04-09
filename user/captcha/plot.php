<?php
	header('content-type:png');
	$code = $_GET['code'];
	$width = 30;
	$height = 30;
	$img = imagecreate($width,$height);
	
	
	$bakcground_color = imagecolorallocate($img,r(),r(),r());
	$border_color = imagecolorallocate($img,r(),r(),r());
	$text_color = imagecolorallocate($img,r(),r(),r());
	$pixel_color = imagecolorallocate($img,r(),r(),r());

	for($i=1;$i<=80;$i++){
		imagesetpixel($img,r($width),r($height),$pixel_color);
	}
	imagestring($img,5,r($width-10,10),r($height-20,1),$code,$text_color);
	imagepng($img);
	imagedestroy($img);
	function r($max=255,$min=0){
		return mt_rand($min,$max);	
	}
?>