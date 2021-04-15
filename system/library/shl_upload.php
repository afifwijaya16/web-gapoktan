<?php
class shl_upload
{
	static $MaxWidth;
	static $MaxHeight;
	static $MaxSize;
	static $Path;
	static $AllowedType;
	static $Type;
	static $Encrypt;
	static $InputName;
	static $Error;
	static $OpenErrorTag;
	static $EndErrorTag;
	static $FileName;
	static $FileNames;

	// ============================================= GETTER & SETTER PROPERTY ============================================ //

    public static function max_width($value = '')
    {
        if (empty($value))
        {
            return self::$MaxWidth;
        }
        else 
        {
            self::$MaxWidth = $value;
            return new self;
        }
    }

    public static function max_height($value = '')
    {
        if (empty($value))
        {
            return self::$MaxHeight;
        }
        else 
        {
            self::$MaxHeight = $value;
            return new self;
        }
    }

    public static function max_size($value = '')
    {
        if (empty($value))
        {
            return self::$MaxSize;
        }
        else 
        {
            self::$MaxSize = $value;
            return new self;
        }
    }

    public static function path($value = '')
    {
        if (empty($value))
        {
            return self::$Path;
        }
        else 
        {
            self::$Path = $value;
            return new self;
        }
    }

    public static function allowed_type($value = '')
    {
        if (empty($value))
        {
            return self::$AllowedType;
        }
        else 
        {
            self::$AllowedType = $value;
            return new self;
        }
    }

    public static function type($value = '')
    {
        if (empty($value))
        {
            return self::$Type;
        }
        else 
        {
            self::$Type = $value;
            return new self;
        }
    }

    public static function encrypt($value = '')
    {
        if (empty($value))
        {
            return self::$Encrypt;
        }
        else 
        {
            self::$Encrypt = (strtolower($value) == "true") ? TRUE : FALSE;
            return new self;
        }
    }

    public static function input_name($value = '')
    {
        if (empty($value))
        {
            return self::$InputName;
        }
        else 
        {
            self::$InputName = $value;
            return new self;
        }
    }

    public static function file_name($value = '')
    {
        if (empty($value))
        {
            return self::$FileName;
        }
        else 
        {
            self::$FileName = $value;
            return new self;
        }
    }

    public static function file_names($value = '')
    {
        if (empty($value))
        {
            return self::$FileNames;
        }
        else 
        {
            self::$FileNames = $value;
            return new self;
        }
    }

    // ============================================= GETTER & SETTER PROPERTY ============================================ //

	function __construct()
	{
		include "../config/config.php";
		$config = $config['shl_framework']['upload'];
		if (empty(self::$MaxWidth))
		{
			self::$MaxWidth = $config['maxwidth'];
			self::$MaxHeight = $config['maxheight'];
			self::$MaxSize = $config['maxsize'];
			self::$AllowedType = $config['allowedtype'];
			self::$Type = $config['type'];
			self::$Path = $config['path'];
			self::$Encrypt = $config['encrypt'];
			self::$OpenErrorTag = $config['openerrortag'];
			self::$EndErrorTag = $config['enderrortag'];
			self::$FileNames = "";
			self::$Error = array();
		}
	}	



	static function error($name)
	{
		if (!empty(self::$Error[$name]))
		{
			return self::$OpenErrorTag."(".self::$Error[$name].")".self::$EndErrorTag;			
		}
	}

	static function upload()
	{
		if (isset($_FILES[self::$InputName]))
		{
			// validasi jenis gambar
			$imagetype = strtolower(pathinfo($_FILES[self::$InputName]['name'],PATHINFO_EXTENSION));

			$arr_type = explode(",",self::$AllowedType);
			if (!in_array($imagetype, $arr_type))
			{
				self::$Error[self::$InputName] = "Jenis file tidak valid, extensi file yang diijinkan : ".self::$AllowedType;
				return FALSE;
			}
		
			if ($_FILES[self::$InputName]['size'] > self::$MaxSize)
			{
				self::$Error[self::$InputName] = "Ukuran file terlalu besar";
				return FALSE;
			}

			if (self::$Encrypt == TRUE)
			{
				$name = md5(date("Y-m-d G:i:s").$_FILES[self::$InputName]['name']).".".$imagetype;
				self::$FileName = $name;
			}
			else 
			{
				$name = $_FILES[self::$InputName]['name'];
				self::$FileName = $name;
			}

			$v_dir = self::$Path;
			$v_fileupload = $v_dir.$name;

			move_uploaded_file($_FILES[self::$InputName]['tmp_name'],$v_dir.$name);				
            
            if ($imagetype == 'jpg' || $imagetype == 'png' || $imagetype == 'wbmp' || $imagetype == 'gif')
            {
			    switch ($imagetype)
			    {
				    case 'jpg':
					    $img_src = imagecreatefromjpeg($v_fileupload);
                        break;
				    case 'png':
					    $img_src = imagecreatefrompng($v_fileupload);
                        break;
			    	case 'wbmp':
			    		$img_src = imagecreatefromwbmp($v_fileupload);
                        break;
			    	case 'gif':
			    		$img_src = imagecreatefromgif($v_fileupload);
                        break;
			    }

    			$src_width = imageSX($img_src);
		    	$src_height = imageSY($img_src);

			    if ($src_width > self::$MaxWidth)
			    {
				    $dst_width = self::$MaxWidth;
				    $dst_height = ($dst_width/$src_width) * $src_height;
			    }
			    else if ($src_height > self::$MaxHeight)
			    {
				    $dst_height = self::$MaxHeight;
				    $dst_width = ($dst_height/$src_height) * $src_width;
			    }
			    else 
			    {
			    	$dst_height = $src_height;
			    	$dst_width = $src_width;
			    }	

		    	$im = imagecreatetruecolor($dst_width,$dst_height);
		    	imagecopyresampled($im, $img_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);


			    switch(self::$Type)
			    {
				    case 'png':
				    	imagepng($im,$v_dir.$name,9);
                        break;
				    case 'jpg':
				    	imagejpeg($im,$v_dir.$name,100);
                        break;
				    case 'wbmp':
					    imagewbmp($im,$v_dir.$name,ImageColorClosest(255,255,255));
                        break;
				    case 'gif':
					    imagegif($im,$v_dir.$name,99);
                        break;
			    }

			    return TRUE;
            }
            return TRUE;
		}
		return FALSE;
	}

	static function upload_multiple()
	{

		if (isset($_FILES[self::$InputName]))
		{
			for ($i = 0; $i < count($_FILES[self::$InputName]["name"]); $i++)
			{
				// validasi jenis gambar
				$imagetype = strtolower(pathinfo($_FILES[self::$InputName]['name'][$i],PATHINFO_EXTENSION));

				$arr_type = explode(",",self::$AllowedType);

				if (!in_array($imagetype, $arr_type))
				{
					self::$Error[self::$InputName] = "Jenis file tidak valid";
					return FALSE;
				}
		
				if ($_FILES[self::$InputName]['size'][$i] > self::$MaxSize)
				{
					self::$Error[self::$InputName] = "Ukuran file terlalu besar";
					return FALSE;
				}

				if (self::$Encrypt == TRUE)
				{
					$name = md5(date("Y-m-d G:i:s").$_FILES[self::$InputName]['name'][$i]).".".$imagetype;
				}
				else 
				{
					$name = $_FILES[self::$InputName]['name'][$i];
				}

				$v_dir = self::$Path;
				$v_fileupload = $v_dir.$name;

				move_uploaded_file($_FILES[self::$InputName]['tmp_name'][$i],$v_dir.$name);

				self::$FileNames[] = $name;


            	if ($imagetype == 'jpg' || $imagetype == 'png' || $imagetype == 'wbmp' || $imagetype == 'gif')
            	{
			    	switch ($imagetype)
			    	{
				    	case 'jpg':
					    	$img_src = imagecreatefromjpeg($v_fileupload);
                        	break;
				    	case 'png':
						    $img_src = imagecreatefrompng($v_fileupload);
                    	    break;
			    		case 'wbmp':
			    			$img_src = imagecreatefromwbmp($v_fileupload);
                   		     break;
			    		case 'gif':
			    			$img_src = imagecreatefromgif($v_fileupload);
                        	break;
			   		}

	    			$src_width = imageSX($img_src);
			    	$src_height = imageSY($img_src);

				    if ($src_width > self::$MaxWidth)
				    {
					    $dst_width = self::$MaxWidth;
				    	$dst_height = ($dst_width/$src_width) * $src_height;
			    	}
			    	else if ($src_height > self::$MaxHeight)
			    	{
				    	$dst_height = self::$MaxHeight;
				    	$dst_width = ($dst_height/$src_height) * $src_width;
			    	}
			    	else 
			    	{
			    		$dst_height = $src_height;
			    		$dst_width = $src_width;
			    	}	

		    		$im = imagecreatetruecolor($dst_width,$dst_height);
		    		imagecopyresampled($im, $img_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);


				    switch(self::$Type)
				    {
					    case 'png':
					    	imagepng($im,$v_dir.$name,9);
                	        break;
				   	 	case 'jpg':
				    		imagejpeg($im,$v_dir.$name,100);
                        	break;
				    	case 'wbmp':
					    	imagewbmp($im,$v_dir.$name,ImageColorClosest(255,255,255));
                       		break;
				    	case 'gif':
					    	imagegif($im,$v_dir.$name,99);
                        	break;
			    	}
           		}

			}
			
            return TRUE;
		}
		return FALSE;
	}
}
?>