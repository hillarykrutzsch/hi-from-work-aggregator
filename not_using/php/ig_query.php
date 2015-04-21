<?php
header('Content-type: application/json');

$client = "850f7b03f55946a9a91900882c3bb8b8";
$query = $_POST['query'];
$clnum = mt_rand(1,3);

$api_tags = "https://api.instagram.com/v1/tags/".$query."/media/recent?client_id=".$client;
$api_user = "https://api.instagram.com/v1/users/34434940/media/recent?client_id=".$client;





function get_curl($url) {
    if(function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        $output = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);
        return $output;
    } else{
        return file_get_contents($url);
    }
}


//Also Perhaps you should cache the results as the instagram API is slow
$cache = './'.sha1($api_tags).'.json';
if(file_exists($cache) && filemtime($cache) > time() - 60*60){
	// If a cache file exists, and it is newer than 1 hour, use it
	$response_tags = json_decode(file_get_contents($cache));
}else{
	$response_tags = json_decode(get_curl($api_tags));
	file_put_contents($cache,json_encode($response_tags));
}

$images = array();

if($response_tags){
	foreach($response_tags->data as $item){		
        $src = $item->images->standard_resolution->url;
        $thumb = $item->images->thumbnail->url;
		$url = $item->link;
		$userID = $item->user->id;
		
        $images[] = array(
        "src" => htmlspecialchars($src),
        "thumb" => htmlspecialchars($thumb),
        "url" => htmlspecialchars($url),
		"userID" => htmlspecialchars($userID)
        );

    }
}



print_r(str_replace('\\/', '/', json_encode($images)));
die();
?>