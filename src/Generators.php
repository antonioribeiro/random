<?php

namespace PragmaRX\Random;

trait Generators
{
    protected $fakerString;

    /**
     * Generate a random string.
     *
     * @return string
     */
    protected function generate()
    {
        if (! is_null($this->fakerString)) {
            return $this->fakerString;
        }

        if ($this->array) {
            return $this->generateArray();
        }

        return $this->numeric
            ? $this->generateNumeric()
            : $this->generateAlpha();
    }

    /**
     * Generate a ramdom integer.
     *
     * @return int
     */
    protected function generateInteger()
    {
        return $this->generateRandomInt($this->getStart(), $this->getEnd());
    }

    /**
     * Generate a random integer.
     *
     * @return int
     */
    protected function generateRandomInt($start, $end)
    {
        return random_int($start, $end);
    }

    /**
     * Generate a random string.
     *
     * @param \Closure $generator
     * @return mixed
     */
    protected function generateString($generator)
    {
        $string = '';

        while (strlen($string) < $size = $this->getSize()) {
            $string .= $this->extractPattern($generator($size));
        }

        return $this->trimToExpectedSize($string, $size);
    }

    /**
     * Get the alpha generator.
     *
     * @return mixed
     */
    protected function getAlphaGenerator()
    {
        return function ($size) {
            return random_bytes($size);
        };
    }

    /**
     * Get the alpha generator.
     *
     * @return mixed
     */
    protected function getNumericGenerator()
    {
        return function () {
            return random_int(0, PHP_INT_MAX);
        };
    }

    /**
     * Generate a random string.
     *
     * @return int|string
     */
    protected function generateAlpha()
    {
        return $this->generateString($this->getAlphaGenerator());
    }

    /**
     * Generate random array elements.
     *
     * @return array
     */
    protected function generateArray()
    {
        $result = [];

        $last = count($this->items)-1;

        foreach (range(1, $this->count) as $counter) {
            $result[] = $this->items[$this->generateRandomInt(0, $last)];
        }

        if ($this->count == 1) {
            return $result[0];
        }

        return $result;
    }

    /**
     * Generate a numeric random value.
     *
     * @return int|string
     */
    protected function generateNumeric()
    {
        if (is_null($this->size) && $this->pattern == static::DEFAULT_PATTERN) {
            return $this->generateInteger();
        }

        return $this->generateString($this->getNumericGenerator());
    }
}
