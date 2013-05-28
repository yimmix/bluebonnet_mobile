<?php

class ThumbGenerator extends Products {

	var $allowable_types = array(
		 'gif',
		 'jpg',
		 'jpeg',
		 'png'
		);
	var $thumb_dir = "thumbs";
	var $thumb_ext = ".jpg";
	
	
	public function imageCreateFromFile($filename, $imageType) {

		switch($imageType) {

         case "jpg"  : 
		 case "jpeg" :
					return imagecreatefromjpeg($filename);

         case "gif" : return imagecreatefromgif($filename);

         case "png" : return imagecreatefrompng($filename);

         default
				: return false;

		}

	}
  	
	
	public function generateThumb($src_file, $thumb_path = "", $desired_width = 100, $target_format = 'jpg') {	
					
			$src_file_details =  pathinfo($src_file);
			//print_r($src_file_details);
			$src_file_type = strtolower($src_file_details['extension']);
			$src_file_name = $src_file_details['filename'];
			
			if(!in_array($src_file_type, $this->allowable_types)) {
				
				return false;

			}else {
			
				$src_resource =  $this->imageCreateFromFile($src_file,$src_file_type);
				$width = imagesx($src_resource);
				$height = imagesy($src_resource);	
				
				//find the desired height of this thumbnail, relative to the desired width  
				$desired_height = floor($height*($desired_width/$width));
				
				// create a new temp image 
				$temp_image = imagecreatetruecolor($desired_width,$desired_height);
				
				imagecopyresampled($temp_image, $src_resource, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
				$dest = $this->thumb_dir."/".$src_file_name.$this->thumb_ext;
				
				//creating jpeg thumbnail for a given image with quality being 100 
				if(imagejpeg($temp_image,$dest,100)){
				
					//statement to put thumb path for a given product in a database
					
					imagedestroy($src_resource); 
					return $dest;
					//return true;
					
					
				}
				
			}
		
	}

}
	
?>	
