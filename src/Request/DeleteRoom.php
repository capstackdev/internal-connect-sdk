<?php

namespace EprodigyConnect\Request;

class DeleteRoom extends BaseRequest
{
    public $method    = "POST";
    private $endpoint = "room/delete";

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __set(string $name, $value)
    {
        if ($name === 'id') {
            $this->id = $value;
        } else {
            $this->set($name, $value);
        }
    }

    public function parseResponse($object)
    {
        return $object;
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
