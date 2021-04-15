<?php
class meta extends shl_library
{
	static $title, $description, $keywords, $name, $url, $main_url, $image, $date, $facebook, $twitter, $favicon;

	public static function title($value = '')
	{
		if (empty($value))
		{
			return self::$title;
		}
		else
		{
			self::$title = $value;
			return new self;
		}
	}

	public static function description($value = '')
	{
		if (empty($value))
		{
			return self::$description;
		}
		else
		{
			self::$description = $value;
			return new self;
		}
	}

	public static function keywords($value = '')
	{
		if (empty($value))
		{
			return self::$keywords;
		}
		else
		{
			self::$keywords = $value;
			return new self;
		}
	}

	public static function name($value = '')
	{
		if (empty($value))
		{
			return self::$name;
		}
		else
		{
			self::$name = $value;
			return new self;
		}
	}

	public static function url($value = '')
	{
		if (empty($value))
		{
			return self::$url;
		}
		else
		{
			self::$url = $value;
			return new self;
		}
	}

	public static function main_url($value = '')
	{
		if (empty($value))
		{
			return self::$main_url;
		}
		else
		{
			self::$main_url = $value;
			return new self;
		}
	}


	public static function image($value = '')
	{
		if (empty($value))
		{
			return self::$image;
		}
		else
		{
			self::$image = $value;
			return new self;
		}
	}

	public static function date($value = '')
	{
		if (empty($value))
		{
			return self::$date;
		}
		else
		{
			self::$date = $value;
			return new self;
		}
	}

	public static function facebook($value = '')
	{
		if (empty($value))
		{
			return self::$facebook;
		}
		else
		{
			self::$facebook = $value;
			return new self;
		}
	}

	public static function twitter($value = '')
	{
		if (empty($value))
		{
			return self::$twitter;
		}
		else
		{
			self::$twitter = $value;
			return new self;
		}
	}

	public static function favicon($value = '')
	{
		if (empty($value))
		{
			return self::$favicon;
		}
		else
		{
			self::$favicon = $value;
			return new self;
		}
	}

	public static function set_meta($datasource)
	{
		$data = $datasource;

		self::$title = $data['nama_website'];
		self::$name = $data['nama_website'];
		self::$description = $data['meta_deskripsi'];
		self::$keywords = $data['meta_keyword'];
		self::$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		self::$image = $data['url']."/clickinspot/resources/public/images/".$data['logo'];
		self::$date = date("Y-m-d g:h:s");
		self::$facebook = $data['facebook'];
		self::$twitter = $data['twitter'];
		self::$favicon = $data['url'].'/clickinspot/resources/public/images/'.$data['favicon'];
		return new self;
	}

	public static function get_meta()
	{
		$result = '<title>'.self::$title.'</title>
					<meta name="robots" content="noodp,noydir"/>
					<meta name="description" content="'.self::$description.'"/>
					<meta name="keywords" content="'.self::$keywords.'"/>
					<link rel="canonical" href="'.self::$url.'" />

					<meta property="og:locale" content="en_US" />
					<meta property="og:type" content="article" />
					<meta property="og:title" content="'.self::$title.'" />
					<meta property="og:description" content="'.self::$description.'" />
					<meta property="og:url" content="'.self::$url.'" />
					<meta property="og:site_name" content="'.self::$name.'" />
					<meta property="og:image" content="'.self::$image.'" />

					<meta property="article:publisher" content="'.self::$facebook.'" />
					<meta property="article:author" content="'.self::$facebook.'" />
					<meta property="article:section" content="'.self::$title.'" />
					<meta property="article:published_time" content="'.self::$date.'" />

					<meta name="twitter:card" content="summary_large_image"/>
					<meta name="twitter:description" content="'.self::$description.'"/>
					<meta name="twitter:title" content="'.self::$title.'"/>
					<meta name="twitter:site" content="'.self::$twitter.'"/>
					<meta name="twitter:domain" content="'.self::$name.'"/>
					<meta name="twitter:image:src" content="'.self::$image.'"/>
					<meta name="twitter:creator" content="'.self::$twitter.'"/>
					<link rel="shortcut icon" href="'.self::$favicon.'" type="image/x-icon" />

				    <link rel = "alternatif" hreflang = "id" href = "'.self::$main_url.'" />
  				    <link rel = "alternatif" hreflang = "en" href = "'.self::$main_url.'" />

  				    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

					';
		return $result;
	}
}
?>