<?PHP
    require 'config.php'; 
    $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or error('Could not connect to database.', 500);
	$short_url = $_SERVER['REQUEST_URI'];
    $short_req_url = str_replace("/","",$short_url);

    if($short_req_url && $short_req_url != 'index.php' && $short_req_url != '/'){
        $result = mysqli_query($db, "SELECT url FROM links WHERE slug = '$short_req_url'") or error('Could not fetch slug from database.', 500);
        $row = mysqli_fetch_row($result);
        if($row)
        {              
            Redirect($row[0],false);
        }else{
            error('URL provided doesn’t exist.', 404);
        } 
        exit();        
    }
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
    
?>
    <html>
        <form action="<?php echo htmlspecialchars('./confirmation.php');?>" method="post">
        <label for="URL">First name:</label><br>
            <input id="URL" name="url_input" type="text" placeholder="Please enter URL here!" required></input>
            <button type="submit" value ="SubmitButton">Save</button>
        </form>
    </html>
 
