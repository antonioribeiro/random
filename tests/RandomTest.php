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

    public function testHex()
    {
        $this->assertTrue(strlen($this->random->hex()->get()) == 16);

        $this->assertTrue(strlen($string = $this->random->size($size = 8192)->hex()->get()) == $size);

        $this->assertTrue(preg_match('/^[A-F0-9]+$/', $string) == 1);

        $this->assertFalse(preg_match('/^[a-zE-Z]+$/', $string) == 1);
    }

    public function testRaw()
    {
        $this->assertTrue(strlen($string = $this->random->raw()->size(256)->get()) == 256);

        $this->assertFalse(preg_match('/^[a-zA-F0-9]+$/', $string) == 1);
    }

    public function testPrefix()
    {
        $string = $this->random->hex()->prefix('#')->size(6)->lowercase()->get();

        $this->assertTrue(strlen($string) == 7);

        $this->assertTrue(preg_match('/^#{1}[a-f0-9]{6}$/', $string) == 1);
    }

    public function testSuffix()
    {
        $string = $this->random->hex()->suffix('####')->size(16)->lowercase()->get();

        $this->assertTrue(strlen($string) == 20);

        $this->assertTrue(preg_match('/^[a-f0-9]{16}#{4}$/', $string) == 1);
    }

    public function testFaker()
    {
        $this->assertCount(4, $this->random->words(4)->get());

        $city = $this->random->prefix('city: ')->city()->lowercase()->get();

        $this->assertNotNull($city);

        $this->assertFalse(preg_match('/^city:\s[\sA-Z0-9]+$/', $city) == 1);
        $this->assertTrue(preg_match('/^city:\s[\sa-z0-9]+$/', $city) == 1);
        $this->assertTrue(preg_match('/^city:\s[\sa-zA-Z0-9]+$/', $city) == 1);
    }

    public function testFakerNotFound()
    {
        $this->expectException(\Exception::class);

        $this->expectExceptionMessage('Faker is not installed. Call to undefined method PragmaRX\Random\Random::word');

        $this->assertCount(4, $this->random->fakerClass('Unavailable\Namespace\FakerClass')->words(4)->get());
    }
}

function dd($a)
{
    var_dump($a);
    die;
}
