<?php

require_once('../vendor/autoload.php');

use EprodigyConnect\Request\{CreateRoom, UpdateRoom, DeleteRoom, GetRoom};
use EprodigyConnect\Client;

/****************************************************************/
$createRequest = new CreateRoom();

$createRequest->name        = "test";
$createRequest->description = "test description";
$createRequest->recording   = true;
$createRequest->time        = date('Y-m-d H:i:s');

$createRequest->addInternalParticipant('123', 'devteam');

$client = new EprodigyConnect\Client(
    'http://connect.1wf.localhost/',
    'abcdefjhijklmnopq12345',
    123
);

$response = $client->send($createRequest);

$roomId = $response->id;
/****************************************************************/
$getRequest = new GetRoom($roomId);

$room = $client->send($getRequest);
/****************************************************************/
$updateRoom = new UpdateRoom($room->id);

$updateRoom->name        = "test";
$updateRoom->description = "test description";
$updateRoom->recording   = true;
$updateRoom->time        = date('Y-m-d H:i:s');

foreach ($room->participants as $user) {
    $updateRoom->addInternalParticipant(
        $user->user_id,
        $user->user_name
    );
}

$response = $client->send($updateRoom);
/****************************************************************/
$deleteRoom = new DeleteRoom($room->id);

$response = $client->send($deleteRoom);
/****************************************************************/
