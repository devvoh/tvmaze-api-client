<?php
/**
 * @package     Serier
 * @license     MIT
 * @author      Robin de Graaf <hello@devvoh.com>
 * @copyright   2015-2016, Robin de Graaf, devvoh webdevelopment
 */

namespace TVmazeApi\Data;

class Episode
{
    public $id;
    public $url;
    public $name;
    public $season;
    public $number;
    public $airdate;
    public $airtime;
    public $runtime;
    public $image = [];
    public $summary;
    public $links = [];

    /**
     * @param array $response
     *
     * @return static
     */
    public static function fromApiResponse($response)
    {
        $data_object = new static();

        $data_object->id      = $response["id"];
        $data_object->url     = $response["url"];
        $data_object->name    = $response["name"];
        $data_object->season  = $response["season"];
        $data_object->number  = $response["number"];
        $data_object->airdate = $response["airdate"];
        $data_object->airtime = $response["airtime"];
        $data_object->runtime = $response["runtime"];
        $data_object->image   = $response["image"];
        $data_object->summary = $response["summary"];
        $data_object->links   = $response["_links"];

        return $data_object;
    }

    public function getNiceShortTag()
    {
        $season = "S" . str_pad($this->season, 2, 0, STR_PAD_LEFT);
        $number = "E" . str_pad($this->number, 2, 0, STR_PAD_LEFT);

        return $season . $number;
    }
}
