#!/usr/bin/php
<?php
/**
 * Sample PHP code for youtube.search.list
 * See instructions for running these code samples locally:
 * https://developers.google.com/explorer-help/guides/code_samples#php
 */

if (!file_exists(__DIR__.'/vendor/autoload.php')) {
  throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('API code samples');
$client->setDeveloperKey('AIzaSyCw_YfGzEYHxGmi6xdcrcBicVJpuckmZPs');

// Define service object for making API requests.
$service = new Google_Service_YouTube($client);

$queryParams = [
    'maxResults' => 3,
    'order' => 'relevance',
    'q' => 'surfing',
    'type' => 'video',
    'videoEmbeddable' => 'true'
];

$response = $service->search->listSearch('snippet', $queryParams);
print_r($response);
?>
