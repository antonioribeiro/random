<?php

namespace PragmaRX\Random;

trait Faker
{
    protected $fakerClass = 'Faker\Factory';

    protected $faker;

    protected $fakerString;

    /**
     * Instantiate and get Faker.
     *
     * @return \Faker\Generator|null
     */
    public function getFaker()
    {
        if (is_null($this->faker) && class_exists($this->fakerClass)) {
            $this->faker = call_user_func("$this->fakerClass::create");
        }

        return $this->faker;
    }

    public function setFakerClass($class)
    {
        $this->fakerClass = $class;

        return $this;
    }
}
