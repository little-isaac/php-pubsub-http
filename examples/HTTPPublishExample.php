<?php

include __DIR__ . '/../vendor/autoload.php';

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../your-gcloud-key.json');

// create the underlying adapter which is going to be decorated
$pubSubClient = new \Google\Cloud\PubSub\PubSubClient([
    'projectId' => 'your-project-id-here',
]);

$subscribeAdapter = new \milind\PubSub\GoogleCloud\GoogleCloudPubSubAdapter($pubSubClient);

// now create our decorator
// the decorator will proxy subscribe calls straight to the $subscribeAdapter
// publish calls will be POSTed to the service uri
$client = new \GuzzleHttp\Client();

$adapter = new \milind\PubSub\HTTP\HTTPPubSubAdapter($client, 'http://127.0.0.1', $subscribeAdapter);

$adapter->publish('my_channel', ['lorem' => 'ipsum']);

$messages = [
    'Hello World',
    [
        'first_name' => 'Bob',
    ],
];
$adapter->publishBatch('my_channel', $messages);
