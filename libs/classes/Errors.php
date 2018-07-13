<?php

namespace App;

class Errors
    extends \Exception
    implements \Iterator
{

    protected $data = [];

    public function add(\Exception $e) {
        $this->data[] = $e;
    }

    public function getErrors()
    {
        return $this->data;
    }

    public function current()
    {
        return current($this->data);
    }

    public function next()
    {
        next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function valid()
    {
        return null !== key($this->data);
    }

    public function rewind()
    {
        reset($this->data);
    }

}