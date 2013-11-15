<?php

namespace vektah\common\double;

/**
 * Common class for easy mocking using Phake
 */
class DummyClass
{
    const _CLASS = __CLASS__;

    public $public_property;

    public function publicMethod($param)
    {

    }
}
