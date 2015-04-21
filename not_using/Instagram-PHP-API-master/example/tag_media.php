<?php

require 'instagram.class.php';

// Initialize class for public requests
$instagram = new Instagram('850f7b03f55946a9a91900882c3bb8b8');

$tag = 'hifromwork';

// Get recently tagged media
$media = $instagram->getTagMedia($tag);

// Display results
foreach ($media->data as $data) {
  echo "<img src=\"{$data->images->thumbnail->url}\">";
}

?>