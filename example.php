<?php
include("src/devvoh/tvmaze-api-client/Client.php");
include("src/devvoh/tvmaze-api-client/Data/Show.php");
include("src/devvoh/tvmaze-api-client/Data/Episode.php");

$client = new TVmazeApi\Client();
$shows = $client->searchShow("firefl");

// Loop through the shows and show their id & name
foreach ($shows as $show) {
    echo "#{$show->id}: {$show->name}\n";
}

echo "\n";

// Get Firefly by id
$show = $client->fetchShowById(180);
echo "{$show->name} episodes:\n";
foreach ($client->fetchEpisodesByShowId($show->id) as $episode) {
    echo "{$episode->getNiceShortTag()} - {$episode->name}\n";
}
