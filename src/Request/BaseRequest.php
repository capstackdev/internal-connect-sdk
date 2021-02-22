<?php

namespace EprodigyConnect\Request;

class BaseRequest
{
    public $required = [];

    private $data = [];

    protected function set(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public function get(string $name)
    {
        return $this->data[$name];
    }

    public function isValid()
    {
        foreach ($this->required as $name) {
            if (!isset($this->data[$name])) {
                return $name;
            }
        }

        return true;
    }
}
