<?php 

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use QLib\VineQ\Vine;

$vine = new Vine();
$vineTags = $vine->searchTags('vietnam');
echo '<pre>'; print_r($vineTags); echo '</pre>'; die;