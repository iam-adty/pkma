<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Library Base_image.
 * Upload, get, resize, crop, convert and delete inline image
 * 
 * Load Codeigniter library : upload, image_lib
 */
class Image {
    
	var $CI;
	var $upload_dir = 'upload/image/';

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('upload');
		$this->CI->load->library('image_lib');
	}
	
	/**
	 * Upload image to folder "upload/image"
	 * @param  string $image The image post name
	 * @param  string $name  The image name to be use to save the image
	 * @return array         The image uploaded data. status => TRUE, data => CI uploaded data
	 */
	public function upload($image = '', $name = '')
	{
		$config['upload_path'] = './' . $this->upload_dir;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $name;
        $config['overwrite'] = $name == '' ? FALSE : TRUE;
		
		$this->CI->upload->initialize($config);
		
		if(!$this->CI->upload->do_upload($image))
		{
			exit($this->CI->upload->display_errors());
		}
		else
		{
			return array(
				'status' => TRUE,
				'data' => $this->CI->upload->data()
			);
		}
	}
	
	/**
	 * Funtion to get the orientation and size (width & height) of source and target image
	 * @param  array  $source Source image array. "orientation", "width", "height"
	 * @param  array  $target Target image array. "orientation", "width", "height"
	 * @return array          The calculated orientation and size of image to be use
	 */
	private function _calculate_size($source = array(), $target = array())
	{
		$return = $target;
		switch($target['orientation'])
		{
			case 'portrait' :
				if($source['orientation'] == 'portrait')
				{
					if($source['height'] > $target['height'])
					{
						$test_width = $source['width'] / ($source['height'] / $target['height']);
					}
					else
					{
						$test_width = $source['width'] * ($target['height'] / $source['height']);
					}
						
					if($test_width >= $target['width'])
					{
						$return['height'] = $target['height'];
						$return['width'] = '';
					}
					else
					{
						$return['width'] = $target['width'];
						$return['height'] = '';
					}
				}
				else
				{
					$return['height'] = $target['height'];
					$return['width'] = '';
				}
				break;
			case 'landscape' :
				if($source['orientation'] == 'landscape')
				{
					if($source['width'] > $target['width'])
					{
						$test_height = $source['height'] / ($source['width'] / $target['width']);
					}
					else
					{
						$test_height = $source['height'] * ($target['width'] / $source['width']);
					}
						
					if($test_height >= $target['height'])
					{
						$return['width'] = $target['width'];
						$return['height'] = '';
					}
					else
					{
						$return['height'] = $target['height'];
						$return['width'] = '';
					}
				}
				else
				{
					$return['width'] = $target['width'];
					$return['height'] = '';
				}
				break;
			case 'box' :
				if($source['orientation'] == 'portrait')
				{
					$return['width'] = $target['width'];
					$return['height'] = '';
				}
				elseif($source['orientation'] == 'landscape')
				{
					$return['height'] = $target['height'];
					$return['width'] = '';
				}
				break;
		}
		return $return;
	}
	
	/**
	 * Function to resize uploaded image
	 * @param  array  $source   The source image. Usually using array data from function upload
	 * @param  string $new_name The name to be use on new image ($config['create_new'] = TRUE)
	 * @param  array  $config   The config for image. 'create_new' if you want to create new image, 'mark' if you want to set the image mark (default "resized-" if you create new image and not set mark)
	 * @return array           The image data. "status" => TRUE
	 */
	public function resize($source = array(), $new_name = '', $config = array())
	{
		$source_width = $source['image_width'];
		$source_height = $source['image_height'];
		$width = $config['width'];
		$height = $config['height'];
		
		$max = FALSE;
		if(array_key_exists('max', $config))
			$max = $config['max'];

		$mark = '';
		if(array_key_exists('mark', $config))
			$mark = $config['mark'];

		$create_new = FALSE;
		if(array_key_exists('create_new', $config))
			$create_new = $config['create_new'];

		if($create_new && $mark == '')
			$mark = 'resized-';
		
		$orientation = 'box';
		if($height > $width)
		{
			$orientation = 'portrait';
		}
		elseif($height < $width)
		{
			$orientation = 'landscape';
		}
		
		$source_orientation = 'box';
		if($source_height > $source_width)
		{
			$source_orientation = 'portrait';
		}
		elseif($source_height < $source_width)
		{
			$source_orientation = 'landscape';
		}
		
		if($max)
		{
			$size = array(
				'width' => $width,
				'height' => $height
			);
		}
		else
		{
			$size = $this->_calculate_size(array(
				'orientation' => $source_orientation, 'width' => $source_width, 'height' => $source_height
			), array(
				'orientation' => $orientation, 'width' => $width, 'height' => $height
			));
		}
		
		$thumb['image_library'] = 'gd2';
		$thumb['source_image'] = $source['full_path'];
		$thumb['width'] = $size['width'];
		$thumb['height'] = $size['height'];
		$thumb['maintain_ratio'] = TRUE;
		$thumb['quality'] = 100;
		if($create_new)
		{
			$thumb['new_image'] = './' . $this->upload_dir . $mark . $new_name . $source['file_ext'];
		}
		$this->CI->image_lib->initialize($thumb);
		if($this->CI->image_lib->resize())
		{
			return array(
				'status' => TRUE
			);
		}
		else
		{
			exit($this->image_lib->display_errors());
		}
	}
	
	/**
	 * Crop image center of it's
	 * @param  array  $source   The source image. Usually using array data from function upload
	 * @param  string $new_name The name to be use on new image ($config['create_new'] = TRUE)
	 * @param  array  $config   The config for image. 'create_new' if you want to create new image, 'mark' if you want to set the image mark (default "resized-" if you create new image and not set mark)
	 * @return array           The image data. "result" => TRUE
	 */
	public function crop($source = array(), $new_name, $config = array())
	{
		$source_width = $source['image_width'];
		$source_height = $source['image_height'];
		$width = $config['width'];
		$height = $config['height'];

		$mark = '';
		if(array_key_exists('mark', $config))
			$mark = $config['mark'];

		$create_new = FALSE;
		if(array_key_exists('create_new', $config))
			$create_new = $config['create_new'];

		if($create_new && $mark == '')
			$mark = 'cropped-';

		$orientation = 'box';
		if($height > $width)
		{
			$orientation = 'portrait';
		}
		elseif($height < $width)
		{
			$orientation = 'landscape';
		}
		
		$source_orientation = 'box';
		if($source_height > $source_width)
		{
			$source_orientation = 'portrait';
		}
		elseif($source_height < $source_width)
		{
			$source_orientation = 'landscape';
		}
		
		$size = $this->_calculate_size(array(
			'orientation' => $source_orientation, 'width' => $source_width, 'height' => $source_height
		), array(
			'orientation' => $orientation, 'width' => $width, 'height' => $height
		));
		
		$thumb['image_library'] = 'gd2';
		$thumb['source_image'] = $source['full_path'];
		$thumb['width'] = $size['width'];
		$thumb['height'] = $size['height'];
		$thumb['maintain_ratio'] = TRUE;
		$thumb['quality'] = 100;
		if($create_new)
		{
			$thumb['new_image'] = './' . $this->upload_dir . $mark . $new_name;
		}
		$this->CI->image_lib->initialize($thumb);
		if($this->CI->image_lib->resize())
		{
			$this->CI->image_lib->clear();
			if($create_new)
			{
				$thumb['source_image'] = $source['file_path'] . $mark . $new_name;
			}
			else
			{
				$thumb['source_image'] = $source['file_path'] . $new_name;
			}
			$thumb['width'] = $width;
			$thumb['height'] = $height;
			$thumb['maintain_ratio'] = FALSE;
			$thumb['quality'] = 100;
			$thumb['new_image'] = '';
			if($create_new)
			{
				list($thumb_width, $thumb_height) = getimagesize($source['file_path'] . $mark . $new_name);
			}
			else
			{
				list($thumb_width, $thumb_height) = getimagesize($source['file_path'] . $new_name);
			}
			if($thumb_height == $height)
			{
				$thumb['x_axis'] = ($thumb_width - $width) / 2;
				$thumb['y_axis'] = 0;
			}
			else
			{
				$thumb['y_axis'] = ($thumb_height - $height) / 2;
				$thumb['x_axis'] = 0;
			}
			$this->CI->image_lib->initialize($thumb);
			if($this->CI->image_lib->crop())
			{
				return array(
					'status' => TRUE
				);
			}
			else
			{
				exit($this->image_lib->display_errors());
			}
		}
		else
		{
			exit($this->image_lib->display_errors());
		}
	}
	
	/**
	 * Function to get image(s) in folder "upload/image"
	 * @param  string  $name     The name of image
	 * @param  string  $mark     The mark of the image (if any) or a wildcard (*)
	 * @param  boolean $wildcard Set the wildcard at the end of name (includes extension)
	 * @return array             The image(s) found
	 */
	public function get($name = '', $mark = '', $wildcard = FALSE)
	{
		$img = array();
		$wildcard_character = $wildcard ? '*.*' : '';
		$search = '';
		$search = ($mark != '') ? $search . $mark : '' ;
		$search = ($name == '') ? $search . $wildcard_character : $search . $name . $wildcard_character ;
		foreach(glob($this->upload_dir . $search) as $filename){
			$img[] = $filename;
		}
		return $img;
	}
	
	/**
	 * Function to convert base64 image source to actual image (saved in folder "upload/image/")
	 * from textarea
	 * 
	 * @param  string $str      The string to convert contain base64 image source from your textarea
	 * @param  string $new_name The name to be use to save the image. It will followed by -img-[1~~]
	 * @param  string $mark     Mark for image. Default is "inline-"
	 * @return string           The string with converted image (it's url)
	 */
    public function convert_inline($str = '', $new_name = '', $mark = 'inline-')
    {
		$img = array();
		$start = '<img';
		$end = '>';
		$pattern = sprintf('/%s(.+?)%s/ims', preg_quote($start, '/'), preg_quote($end, '/'));
		$search = true;
        $i = 1;
		while($search)
		{
			if (preg_match($pattern, $str, $matches))
            {
				list(, $match) = $matches;
				$img[$i] = $start . $match . $end;
				$str = str_replace($start . $match . $end, "{gambar_$i}", $str);
                $i++;
			}
            else
            {
				$search = false;
				break;
			}
		}
        
        $start = 'src="data:image/';
		$end = '"';
        $pattern = sprintf('/%s(.+?)%s/ims', preg_quote($start, '/'), preg_quote($end, '/'));
        $img_to_check = array();
        foreach ($img as $key=>$val)
        {
            if (preg_match($pattern, $val, $matches))
            {
                list(, $match) = $matches;
                $img[$key] = str_replace($start . $match . $end, '{new_src}', $img[$key]);
                $ex_match = explode(',', $match);
                $base64_image = trim($ex_match[1]);
                $ex_type = explode(';', $ex_match[0]);
                $type = $ex_type[0];
                $image = base64_decode($base64_image);
                $image_name = $mark . $new_name . '-img-' . $key . '.' . $type;
                file_put_contents($this->upload_dir . $image_name, $image);
				$new_source = base_url($this->upload_dir . $image_name);
                $img[$key] = str_replace('{new_src}', 'src="' . $new_source . '"', $img[$key]);
            }
            else
            {
            	if(strpos($val, base_url($this->upload_dir)) !== FALSE)
            	{
            		$ex_val = explode(base_url(), $val);
            		$to_check = substr($ex_val[1], 0, strpos($ex_val[1], '"'));
            		$img_nm = str_replace($this->upload_dir, '', $to_check);
            		$img_nm_2 = substr($img_nm, 0, strpos($img_nm, '-img'));
            		if(!in_array($img_nm_2, $img_to_check))
            			$img_to_check[] = $img_nm_2;
            	}
            }
            $str = str_replace("{gambar_$key}", $img[$key], $str);
        }
        
		foreach ($img_to_check as $k => $v)
		{
			$old_images = $this->get($v, '', TRUE);
			foreach($old_images as $k2 => $v2)
			{
				$found = FALSE;
				$file = base_url($v2);
				foreach($img as $k3 => $v3)
				{
					if(strpos($v3, $file) !== FALSE)
					{
						$found = TRUE;
					}
				}
				if(!$found)
				{
					unlink($v2);
				}
			}
		}

        return $str;
        
	}
    
    /**
     * Function to delete image(s) in folder "upload/image/" from string (textarea)
     * 
     * @param  string $str The string contain image(s) url
     */
	public function delete_inline($str = '')
	{
		$img = array();
		$start = '<img';
		$end = '>';
		$pattern = sprintf('/%s(.+?)%s/ims', preg_quote($start, '/'), preg_quote($end, '/'));
		$search = true;
        $i = 1;
		while($search)
		{
			if (preg_match($pattern, $str, $matches))
            {
				list(, $match) = $matches;
				$img[$i] = $start . $match . $end;
				$str = str_replace($start . $match . $end, "{gambar_$i}", $str);
                $i++;
			}
            else
            {
				$search = false;
				break;
			}
		}
        
        $img_to_check = array();
        foreach ($img as $key=>$val)
        {
            if(strpos($val, base_url($this->upload_dir)) !== FALSE)
        	{
        		$ex_val = explode(base_url(), $val);
        		$to_check = substr($ex_val[1], 0, strpos($ex_val[1], '"'));
        		$img_nm = str_replace($this->upload_dir, '', $to_check);
        		$img_nm_2 = substr($img_nm, 0, strpos($img_nm, '-img'));
        		if(!in_array($img_nm_2, $img_to_check))
        			$img_to_check[] = $img_nm_2;
        	}
        }

		foreach ($img_to_check as $k => $v)
		{
			$old_images = $this->get($v, '', TRUE);
			foreach($old_images as $k2 => $v2)
			{
				unlink($v2);
			}
		}
	}

	/**
	 * Function to copy image
	 * @param  string $source The full path of the source image
	 * @param  string $target The full path of the target image
	 * @return boolean        TRUE / FALSE
	 */
	public function copy($source, $target)
	{
		if(!copy($source, $target))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
}
