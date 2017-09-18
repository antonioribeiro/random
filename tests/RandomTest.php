<?php

namespace PragmaRX\Random;

class RandomTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->random = new Random();
    }

    public function testGenerateRandomString()
    {
        $this->assertTrue(strlen($this->random->size(2)->get()) == 2);

        $this->assertTrue(strlen($this->random->size(12)->get()) == 12);

        $this->assertTrue(strlen($this->random->numeric()->size(12)->get()) == 12);
    }

    public function testUppercase()
    {
        $string = $this->random->size(200)->get();

        $this->assertTrue(1 == preg_match('/^[a-zA-Z0-9]{200}+$/', $string));

        $string = $this->random->lowercase()->size(200)->get(); // lowercase == false
        $this->assertFalse(preg_match('/^[A-Z0-9]{200}+$/', $string) == 1);
        $this->assertTrue(preg_match('/^[a-z0-9]{200}+$/', $string) == 1);
        $this->assertTrue(preg_match('/^[a-zA-Z0-9]{200}+$/', $string) == 1);

        $string = $this->random->uppercase()->size(200)->get(); // lowercase == false
        $this->assertFalse(preg_match('/^[a-z0-9]{200}+$/', $string) == 1);
        $this->assertTrue(preg_match('/^[A-Z0-9]{200}+$/', $string) == 1);
        $this->assertTrue(preg_match('/^[a-zA-Z0-9]{200}+$/', $string) == 1);

        $string = $this->random->mixedcase()->size(200)->get(); // lowercase == false
        $this->assertTrue(preg_match('/^[a-zA-Z0-9]{200}+$/', $string) == 1);
    }

    public function testNumeric()
    {
        $string = $this->random->numeric()->size(201)->get(); // lowercase == false

        $this->assertFalse(preg_match('/^[A-Za-z]{201}+$/', $string) == 1);
        $this->assertTrue(preg_match('/^[0-9]{201}+$/', $string) == 1);

        $string = $this->random->alpha()->size(201)->get(); // lowercase == false
        $this->assertTrue(preg_match('/^[a-zA-Z0-9]{201}+$/', $string) == 1);
    }

    public function testNumericStartEnd()
    {
        $numeric = $this->random->numeric()->get(); // lowercase == false

        $this->assertTrue(is_numeric($numeric));
        $this->assertFalse(is_string($numeric));
        $this->assertGreaterThanOrEqual(0, $numeric);
        $this->assertLessThanOrEqual(PHP_INT_MAX, $numeric);

        $numeric = $this->random->numeric()->start(10)->end(11)->get(); // lowercase == false

        $this->assertTrue(is_numeric($numeric));
        $this->assertFalse(is_string($numeric));
        $this->assertGreaterThanOrEqual(9, $numeric);
        $this->assertLessThanOrEqual(12, $numeric);

        $numeric = $this->random->numeric()->start(10)->end(11)->size($size = 45)->get(); // lowercase == false

        $this->assertTrue(is_numeric($numeric));
        $this->assertTrue(is_string($numeric));
        $this->assertTrue(strlen($numeric) == $size);
    }

    public function testPattern()
    {
        $string = $this->random->size(4)->pattern('[abcd]')->get(); // lowercase == false

        $this->assertTrue(preg_match('/^[abcd]+$/', $string) == 1);
        $this->assertFalse(preg_match('/^[e-z]+$/', $string) == 1);

        $string = $this->random->size(16)->pattern('[z]')->get(); // lowercase == false
        $this->assertEquals(str_repeat('z', 16), $string);
    }

    public function testGetSize()
    {
        $this->assertTrue(strlen($this->random->get()) == 16);

        $this->assertTrue(strlen($this->random->size($size = 2048)->get()) == $size);
    }
}

function dd($a) {
    var_dump($a); die;
}
