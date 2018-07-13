<?php

class FluentClass
{

    protected $foo;

    public function setFoo($value)
    {
        if ($value <= 0) {
            throw new Exception('Foo must be positive!');
        }
        $this->foo = $value;
        return $this;
    }

    protected $bar;

    public function setBar($value)
    {
        if ($value >= 0) {
            throw new Exception('Bar must be positive!');
        }
        $this->bar = $value;
        return $this;
    }

    protected $baz;

    public function setBaz($value)
    {
        if ($value != 0) {
            throw new Exception('Baz must be null!');
        }
        $this->baz = $value;
        return $this;
    }

    public function fill(array $data)
    {
        $errors = new Errors;
        foreach ($data as $key=>$val) {
            try {
                // $key == 'foo'
                // ucfirst($key) = 'Foo';
                // 'setFoo'
                $method = 'set' . ucfirst($key);
                $this->$method($val);
            } catch (Exception $e) {
                $errors->add($e);
            }
        }
        if (!empty($errors->getErrors())) {
            throw $errors;
        }
    }

    public function getValues()
    {
        return [
            $this->foo,
            $this->bar,
            $this->baz,
        ];
    }

}