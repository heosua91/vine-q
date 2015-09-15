<?php

namespace QLib\VineQ;

/**
 * Vine API class
 *
 * API Documentation: https://github.com/starlock/vino/wiki/API-Reference
 * Class Documentation: https://github.com/starlock/vino/wiki/API-Reference
 *
 * @author Bui Xuan Quy
 * @since 09/08/2015
 * @copyright Bui Xuan Quy - Q' Company 2015
 */
class Vine {

  /**
   * The API base URL
   */
  const API_URL = 'https://api.vineapp.com/';

  /**
   * Default constructor
   *
   * @return void
   */
  public function __construct() {
    
  }

  /**
   * Get popular timelines
   *
   * @param int $size
   * @param int $page
   * @return mixed
   */
  public function getPopular($size = 10, $page = 1) {
	return $this->_makeCall('timelines/popular', array('size' => $size, 'page' => $page));
  }
  
  /**
   * Get user
   *
   * @param string $id
   * @param int $size
   * @param int $page
   * @return mixed
   */
  public function getProfilesUser($id = '', $size = 10, $page = 1)
  {
	return $this->_makeCall('users/profiles/' . $id, array('size' => $size, 'page' => $page));
  }
  
  /**
   * Get user timelines
   *
   * @param string $id
   * @param int $size
   * @param int $page
   * @return mixed
   */
  public function getTimelinesUser($id = '', $size = 10, $page = 1)
  {
	return $this->_makeCall('timelines/users/' . $id, array('size' => $size, 'page' => $page));
  }
  
  /**
   * Get tag
   *
   * @param string $tag
   * @param int $size
   * @param int $page
   * @return mixed
   */
  public function searchTags($tag = '', $size = 10, $page = 1)
  {
	return $this->_makeCall('timelines/tags/' . $tag, array('size' => $size, 'page' => $page));
  }
  
  /**
	  * Get post
   *
   * @param string $id
   * @param int $size
   * @param int $page
   * @return mixed
   */
  public function searchPosts($id = '', $size = 10, $page = 1)
  {
	return $this->_makeCall('timelines/posts/' . $id, array('size' => $size, 'page' => $page));
  }
  
  /**
   * The call operator
   *
   * @param string $function              API resource path
   * @param array [optional] $params      Additional request parameters
   * @param string [optional] $method     Request type GET|POST
   * @return mixed
   */
  protected function _makeCall($function, $params = null, $method = 'GET') {
    if (isset($params) && is_array($params)) {
      $paramString = '?' . http_build_query($params);
    } else {
      $paramString = null;
    }
	
    $apiCall = self::API_URL . $function . (('GET' === $method) ? $paramString : null);
	
    // signed header of POST/DELETE requests
    $headerData = array('Accept: application/json');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiCall);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    if ('POST' === $method) {
      curl_setopt($ch, CURLOPT_POST, count($params));
      curl_setopt($ch, CURLOPT_POSTFIELDS, ltrim($paramString, '&'));
    } else if ('DELETE' === $method) {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }

    $jsonData = curl_exec($ch);
    if (false === $jsonData) {
      throw new \Exception("Error: _makeCall() - cURL error: " . curl_error($ch));
    }
    curl_close($ch);

    return json_decode($jsonData, false, 512, JSON_BIGINT_AS_STRING);
  }
}
