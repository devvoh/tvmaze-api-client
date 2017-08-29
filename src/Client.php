<?php
namespace TVmazeApi;

class Client
{
    /** @var string */
    protected $endpoint = "http://api.tvmaze.com/";

    /**
     * @param string $title
     *
     * @return \TVmazeApi\Data\Show
     */
    public function searchOneShow($title)
    {
        $response = $this->makeRequest('singlesearch/shows?q=' . $title);

        if (!$response) {
            return null;
        }

        return \TVmazeApi\Data\Show::fromApiResponse($response);
    }

    /**
     * @param string $title
     *
     * @return \TVmazeApi\Data\Show[]
     */
    public function searchShow($title)
    {
        $response = $this->makeRequest('search/shows?q=' . $title);

        if (!$response) {
            return [];
        }

        $shows = [];
        foreach ($response as $response_item) {
            $shows[] = \TVmazeApi\Data\Show::fromApiResponse($response_item["show"]);
        }

        return $shows;
    }

    /**
     * @param int $id
     *
     * @return \TVmazeApi\Data\Show|null
     */
    public function fetchShowById($id)
    {
        $response = $this->makeRequest('shows/' . $id);

        if (!$response || $response["status"] == "404") {
            return null;
        }

        return \TVmazeApi\Data\Show::fromApiResponse($response);
    }

    /**
     * @param int $id
     *
     * @return \TVmazeApi\Data\Episode[]|[]
     */
    public function fetchEpisodesByShowId($id)
    {
        $response = $this->makeRequest('shows/' . $id . '/episodes');

        if (!$response || (isset($response["status"]) && $response["status"] == "404")) {
            return [];
        }

        $episodes = [];
        foreach ($response as $response_item) {
            $episodes[] = \TVmazeApi\Data\Episode::fromApiResponse($response_item);
        }
        return $episodes;
    }

    /**
     * @param string $subUrl
     *
     * @return string
     */
    protected function buildUrl($subUrl)
    {
        return $this->endpoint . trim($subUrl, "/");
    }

    /**
     * @param string $subUrl
     *
     * @return array
     */
    protected function makeRequest($subUrl)
    {
        $url = $this->buildUrl($subUrl);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($response)) {
            return [];
        }

        return $response;
    }
}