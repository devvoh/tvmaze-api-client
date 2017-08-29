<?php
/**
 * @package     Serier
 * @license     MIT
 * @author      Robin de Graaf <hello@devvoh.com>
 * @copyright   2015-2016, Robin de Graaf, devvoh webdevelopment
 */

namespace TVmazeApi\Data;

class Show
{
    public $id;
    public $url;
    public $name;
    public $type;
    public $language;
    public $genres = [];
    public $status;
    public $runtime;
    public $premiered;
    public $officialSite;
    public $schedule = [];
    public $rating = [];
    public $weight;
    public $network = [];
    public $webChannel;
    public $externals = [];
    public $image = [];
    public $summary;
    public $updated;
    public $links = [];

    /** @var []|\TVmazeApi\Data\Episode[] */
    public $episodes = [];

    /**
     * @param array $response
     *
     * @return static
     */
    public static function fromApiResponse($response)
    {
        $data_object = new static();

        $data_object->id           = $response["id"];
        $data_object->url          = $response["url"];
        $data_object->name         = $response["name"];
        $data_object->type         = $response["type"];
        $data_object->language     = $response["language"];
        $data_object->genres       = $response["genres"];
        $data_object->status       = $response["status"];
        $data_object->runtime      = $response["runtime"];
        $data_object->premiered    = $response["premiered"];
        $data_object->officialSite = $response["officialSite"];
        $data_object->schedule     = $response["schedule"];
        $data_object->rating       = $response["rating"];
        $data_object->weight       = $response["weight"];
        $data_object->network      = $response["network"];
        $data_object->webChannel   = $response["webChannel"];
        $data_object->externals    = $response["externals"];
        $data_object->image        = $response["image"];
        $data_object->summary      = $response["summary"];
        $data_object->updated      = $response["updated"];
        $data_object->links        = $response["links"];

        return $data_object;
    }
}
