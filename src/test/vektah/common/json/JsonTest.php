<?php

namespace vektah\common\json;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    public function testEncodeSuccess()
    {
        $this->assertEquals('{"asdf":1234}', Json::encode(['asdf' => 1234]));
    }

    public function testPrettySuccess()
    {
        $this->assertEquals("{\n    \"asdf\": 1234\n}", Json::pretty(['asdf' => 1234]));
    }

    public function testDecodeSuccess()
    {
        $this->assertEquals(['asdf' => 1234], Json::decode('{"asdf": 1234}'));
    }

    public function testDecodeError() {
        $this->setExpectedException(InvalidJsonException::_CLASS, 'Syntax error');

        Json::decode('{');
    }
}
