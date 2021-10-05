<?php

namespace App\Helpers;

class ModelHelper
{
    private $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    public function setFoo($foo)
    {
        $this->foo = $foo;
    }

    public function getFoo()
    {
        return $this->foo;
    }
}
