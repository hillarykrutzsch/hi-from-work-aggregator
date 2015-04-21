<?php

  /**
   * Instagram PHP API
   *
   * @link https://github.com/cosenary/Instagram-PHP-API
   * @author Christian Metz
   * @since 20.06.2012
   */

  require_once 'instagram.class.php';

  // Initialize class for public requests
  $instagram = new Instagram('850f7b03f55946a9a91900882c3bb8b8');

  // Receive AJAX request and create call object
  $tag = $_GET['tag'];
  $maxID = $_GET['max_id'];
  $clientID = $instagram->getApiKey();

  $call = new stdClass;
  $call->pagination->next_max_id = $maxID;
  $call->pagination->next_url = "https://api.instagram.com/v1/tags/{$tag}/media/recent?client_id={$clientID}&max_tag_id={$maxID}";


  // Receive new data
  $media = $instagram->pagination($call);
  

  // Collect everything for json output
  $images = array();
  $object = new stdClass;
  foreach ($media->data as $data) {
	$object = new stdClass; 
	$object->standardResURL = $data->images->standard_resolution->url;
	$object->link = $data->link;
    $images[] = $object;
  }

  echo json_encode(array(
    'next_id' => $media->pagination->next_max_id,
    'images'  => $images
  ));
?>