<?PHP
	require 'config.php'; 
    $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or error('Could not connect to database.', 500);
    $message = "";
    if(isset($_POST['url_input'])){ //check if form was submitted
        $inputPost = filter_var($_POST['url_input'], FILTER_SANITIZE_STRING);//Sanitize input URL  
        $inputPost = filter_var($inputPost, FILTER_SANITIZE_URL); // Sanitize url
        $url = addhttp($inputPost);  
        if (!filter_var($url, FILTER_VALIDATE_URL)) { // validate url
            error('Invalid input URL.', 404); 
            exit();
        } 
        $short_url = random_strings(5); // genarate short url
        $result = mysqli_query($db, "SELECT slug FROM links WHERE url = '$url'") or error('Could not fetch slug from database.', 500); // check input url exit in DB or not to avoid dublicate entery
        if($result === false || mysqli_num_rows($result) == 0){
            mysqli_query($db, "INSERT INTO links (slug, url,created) VALUES('$short_url', '$url', NOW());") or error('Could not insert the URL.', 500); 
        }else{
            mysqli_query($db, "UPDATE links set slug = '$short_url', created = NOW() where url = '$url';") or error('Could not update the URL.', 500);
        }
        $message = "SHORT URL: ".$_SERVER['HTTP_HOST']."/".$short_url;
        echo $message;        
    }else{
        header('Location: ' . '/', true, ($permanent === true) ? 301 : 302);
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
    function xss_cleaner($input_str) {
        $return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
        $return_str = str_ireplace( '%3Cscript', '', $return_str );
        return $return_str;
    }
    
?>