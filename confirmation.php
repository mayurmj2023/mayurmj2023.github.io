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
    
?>