<?php

namespace PragmaRX\Random;

trait Faker
{
    protected $fakerClass = 'Faker\Factory';

    protected $faker;

    protected $fakerString;

    /**
     * Call faker.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        try {
            $this->fakerString = $this->getFaker()->{$name}(...$arguments);
        } catch (\Error $e) {
            throw new \Exception('Faker is not installed. Call to undefined method PragmaRX\Random\Random::'.$name);
        }

        return $this;
    }

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

    /**
     * Set the faker class.
     *
     * @param $class
     * @return $this
     */
    public function fakerClass($class)
    {
        $this->fakerClass = $class;

        return $this;
    }
}
