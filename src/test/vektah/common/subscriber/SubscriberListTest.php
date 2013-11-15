<?php

namespace vektah\common\subscriber;

use Phake;
use vektah\common\double\DummyClass;
use vektah\common\subscriber\SubscriberList;

class SubscriberListTest extends \PHPUnit_Framework_TestCase
{
    public function testInvokeAll()
    {
        $mock1 = Phake::mock(DummyClass::_CLASS);
        $mock2 = Phake::mock(DummyClass::_CLASS);

        $subscriber = new SubscriberList([$mock1, $mock2]);

        $subscriber->publicMethod('asdf');

        Phake::verify($mock1)->publicMethod('asdf');
        Phake::verify($mock2)->publicMethod('asdf');
    }
}
