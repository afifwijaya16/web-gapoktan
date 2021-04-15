<?php
class shl_rest 
{


	static $status = [
			["code" => "200", "message" => "OK", "description" => "Berhasil"], 
			["code" => "201", "message" => "Created", "description" => "Berhasil dibuat"], 
			["code" => "400", "message" => "Bad Request", "description" => "Gagal dalam proses request"],
			["code" => "500", "message" => "Internal Server Error", "description" => "Terjadi kesalahan pada proses internal"],
			["code" => "501", "message" => "Not implemented", "description" => "Terjadi ketidaksesuaian antara request method yang diizinkan dengan request yang dilakukan consumer. Misalnya yang diizinkan adalah POST sedangkan consumer menggunakan GET."],
			["code" => "503", "message" => "Service unavaliable", "description" => "Jika layanan tidak tersedia"]
		];

	/**
	 * mengatur ulang status
	 * @return shl_rest
	 */
	static function reset()
	{
		self::$status = [
			["code" => "200", "message" => "OK", "description" => "Berhasil"], 
			["code" => "201", "message" => "Created", "description" => "Berhasil dibuat"], 
			["code" => "400", "message" => "Bad Request", "description" => "Gagal dalam proses request"],
			["code" => "500", "message" => "Internal Server Error", "description" => "Terjadi kesalahan pada proses internal"],
			["code" => "501", "message" => "Not implemented", "description" => "Terjadi ketidaksesuaian antara request method yang diizinkan dengan request yang dilakukan consumer. Misalnya yang diizinkan adalah POST sedangkan consumer menggunakan GET."],
			["code" => "503", "message" => "Service unavaliable", "description" => "Jika layanan tidak tersedia"]
		];
		return new self;
	}


	/**
	 *
	 * ==========================================
	 *  Server / Provider
	 * ==========================================
	 * 
	 */

	/**
	 * Menambahkan status
	 * @param int $code kode status
	 * @param string $description deskripsi error
	 * @return shl_rest
	 */
	static function add_status($code, $description)
	{
		array_push(self::$status,["code" => $code, "description" => $description]);
		return new self;
	}


	/**
	 * Mengubah deskripsi status
	 * @param int $code kode status
	 * @param string $message pesan status
	 * @param string $description deskripsi status yang baru
	 * @return shl_rest
	 */
	static function set_status($code, $message, $description = "")
	{
		$index = array_search($code, array_column(self::$status, "code"));
		self::$status[$index]["message"] = $message;
		self::$status[$index]["description"] = $description;
		return new self;
	}


	/**
	 * mendapatkan request method client
	 * @return string
	 */
	static function request_method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}


	/**
	 * mendapatkan nilai request dari client
	 * @return array|string
	 */	
	static function request()
	{
		$method = self::request_method();
		if ($method == "POST")
		{
			return $_POST;
		}
		else
		{
			return $_GET;
		}
		//return (isset($_REQUEST)) ?  $_REQUEST : array();
	}


	/**
	 * menamplkan/memberi respon ke client
	 * @param array $response 
	 * @param int $code kode status
	 * @return type
	 */
	static function output($response, $code = 200)
	{
		$index = array_search($code, array_column(self::$status, "code"));

		$response = ["result" => $response, "status" => self::$status[$index]];

		$type = (isset($_GET['type'])) ? $_GET['type'] : "json";
		if ($type == "xml")
		{
			$xml = new SimpleXMLElement("<xml/>");			
			array_to_xml($response,$xml);
			$dom = new DOMDocument();
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;

			$dom->loadXML($xml->asXML());
			$out = $dom->saveXML();	
			header("Content-Type: application/xml");		
			print_r($out);	
		}
		else if ($type == "php")
		{
			print_r($response);
		}
		else
		{
			print_r(json_encode($response, JSON_PRETTY_PRINT));
		}

	}


	/**
	 *
	 * ==========================================
	 *  Client / Consumer
	 * ==========================================
	 * 
	 */

	function send_request()
	{

	}

	function CallAPI($method, $url, $data = false)
	{
    	$curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
}
?>