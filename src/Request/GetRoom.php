<?php

namespace EprodigyConnect\Request;

class GetRoom extends BaseRequest
{
    public $method    = "GET";
    private $endpoint = "room/settings";

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function parseResponse($object)
    {
        $object->settings->id = $this->id;

        return $object->settings;
    }

    public function getEndpoint()
    {
        return "{$this->endpoint}/{$this->id}";
    }

    public function build()
    {
        return [];
    }
}
