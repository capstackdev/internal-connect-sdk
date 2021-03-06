<?php

namespace EprodigyConnect\Request;

class UpdateRoom extends BaseRequest
{
    public $required = ['name', 'description', 'recording', 'time'];

    public $method    = "POST";
    private $endpoint = "room/update";

    private $participants = [];

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

    public function addInternalParticipant(int $uid, string $name)
    {
        $this->participants[$uid] = [
            'type'  => 'internal',
            'uid'   => $uid,
            'name'  => $name,
            'fixed' => false,
        ];
    }

    public function getEndpoint()
    {
        return "{$this->endpoint}/{$this->id}";
    }

    public function build()
    {
        $isValid = $this->isValid();

        if ($isValid !== true) {
            throw new Exception("CreateRoom Request Error - field {$isValid} is required", 1);

            return false;
        }

        return [
            'name'         => (string) $this->get('name'),
            'description'  => (string) $this->get('name'),
            'time'         => (string) $this->get('time'),
            'recording'    => (bool) $this->get('recording'),
            'participants' => $this->participants,
        ];
    }
}
