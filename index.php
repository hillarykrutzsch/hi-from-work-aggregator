<!doctype html>  
<html lang="en">  
<head>  
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
  	<title>Hi From Work ProtoType</title>  
  	<meta name="author" content="Hillary Krutzsch">  
  	<link rel="stylesheet" type="text/css" href="css/style.css">  
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.8.0.min.js"><\/script>')</script>
    <script src="js/main.js"></script>

</head>  
  
<body>  
	<div class="wrapper">
        <header class="shadow">
            <a href="/hifromwork"><img src="img/23210978.jpg" /></a>
            <a href="/hifromwork"><h1>Hi From Work</h1></a>
        </header>
        <nav class="shadow">
        	<ul>
                <li><a href="">SUBMIT A PHOTO</a></li>
            </ul>
        </nav>
        <div class="main-content shadow">  
        	<div id="photos">
        	<?php

				require 'php/instagram.class.php';
				
				// Initialize class for public requests
				$instagram = new Instagram('850f7b03f55946a9a91900882c3bb8b8');
				
				$tag = 'hifromwork';
				$maxID = $_GET['max_id'];
				
				// Get recently tagged media
				$media = $instagram->getTagMedia($tag);
				// Display results
				foreach ($media->data as $data) {
					echo "<div class=\"pic\"><a href=\"{$data->link}\" target=\"_blank\"><img src=\"{$data->images->standard_resolution->url}\"></a></div>";
				  
				}
			

 
			
			?>
            </div>  
            <div class="more-button-holder">
            
			<?php 
				$maxID = $media->pagination->next_max_id;
				if($maxID != ''){
					echo "<a href=\"\" id=\"more\" data-maxid=\"{$media->pagination->next_max_id}\" data-tag=\"{$tag}\">Load More</a>"; 
				}
			?>
        	</div>
        </div>
        
        <footer>
        	<p>&copy; NumberToPencil</p>
        </footer>
    </div>  
</body>  
</html>