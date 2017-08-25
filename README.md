# tvmzaze-api-client
A very barebones API client, currently only intended to search for shows and get their information, including episodes. No crew list, etc. at this point.

Here's the example script:
```php
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
```

To get only the highest-scoring search result:
```php
$client = new TVmazeApi\Client();

$show = $client->searchOneShow("firefl");
```

To get an array of matching search results:
```php
$shows = $client->searchShow("firefl");
```

To get a show by its ID:
```php
$show = $client->fetchShowById(180);
```

To get a show's episodes by the show's ID:
```php
$show = $client->fetchShowById(180);
$episodes = $client->fetchEpisodesByShowId($show->id);
```