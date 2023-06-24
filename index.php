<?PHP
    require 'config.php'; 
    $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or error('Could not connect to database.', 500);
    // $result = mysqli_query($db, "CREATE TABLE `links` (
    //     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    //     `slug` varchar(15) DEFAULT NULL,
    //     `url` text,
    //     `created` datetime DEFAULT NULL,
    //     `last_visited` datetime DEFAULT NULL,
    //     PRIMARY KEY (`id`),
    //     UNIQUE KEY `slug` (`slug`)
    //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;") or error('Could not fetch slug from database.', 500);        
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
    
    
?>
    <html>
        <form action="<?php echo htmlspecialchars('./confirmation.php');?>" method="post">
        <label for="URL">First name:</label><br>
            <input id="URL" name="url_input" type="text" placeholder="Please enter URL here!" required></input>
            <button type="submit" value ="SubmitButton">Save</button>
        </form>
    </html>
 
