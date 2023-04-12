<?php
	function compress($source, $destination, $quality){
		$info = getimagesize($source);
		
		if($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source);
		else if($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source);
		else if($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source);
		
		imagejpeg($image, $destination, $quality);
		
		return $destination;
	}
	

?>