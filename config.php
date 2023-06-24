<?PHP
	// NO NEED TO CHANGE TO LOCAL DB remote MySQL DB created 
	$dbhost = 'sql12.freemysqlhosting.net';  
	$dbuser = 'sql12628317';
	$dbpass = 'BbK5RInU1A';
	$dbname = 'sql12628317';
	

// php functions starts here
function Redirect($url, $permanent = false)
{
	if (headers_sent() === false)
	{
		header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	}
	exit();
}
    
function error($msg, $http_response_code = 200) {
	global $accepts_json, $url_not_found;

	if(($http_response_code == 404) && (strlen($url_not_found) > 0)) {
		header("Location: $url_not_found");
		exit;
	}

	http_response_code($http_response_code);

	if($accepts_json) {
		echo json_encode(array('error' => $msg));
	} else {
		echo $msg;
	}

	exit;
}
function addhttp($url) {
	if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
		$url = "http://" . $url;
	}
	return $url;
}    
function random_strings($length_of_string)
{
	$str_result = '0123456789abcdefghijklmnopqrstuvwxyz';    
	return substr(str_shuffle($str_result),
					0, $length_of_string);
}

function xss_cleaner($input_str) {
	$return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
	$return_str = str_ireplace( '%3Cscript', '', $return_str );
	return $return_str;
}
	?>
